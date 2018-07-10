<?php

namespace humhub\modules\registration\controllers;

use humhub\components\Controller;
use humhub\libs\ProfileImage;
use humhub\models\forms\UploadProfileImage;
use humhub\modules\registration\models\Register;
use humhub\modules\registration\models\RegistrationDetails;
use humhub\modules\user\models\forms\Registration;
use humhub\modules\user\models\Group;
use humhub\modules\user\models\Profile;
use humhub\modules\user\models\User;
use Yii;
use yii\filters\ContentNegotiator;
use yii\helpers\Url;
use yii\web\HttpException;
use yii\web\Response;
use yii\web\UploadedFile;

class CustomRegistrationController extends Controller {

	public function behaviors() {
		return [
			'contentNegotiator' => [
				'class' => ContentNegotiator::className(),
				'only' => ['set-session'],
				'formats' => [
					'application/json' => Response::FORMAT_JSON,
					'application/xml' => Response::FORMAT_XML,
				],
			],
		];
	}

	public function actionIndex() {
		$this->layout = 'login';
		$groups = Group::find()->where(['!=', 'name', 'Administrator'])->all();
		if (isset($_SESSION['account_type'])) {
			unset($_SESSION['account_type']);
		}
		return $this->render('accounttype', [
			'groups' => $groups,
		]);
	}
	public function actionSetSession() {
		if (Yii::$app->request->isPost && Yii::$app->request->isAjax) {
			$idValue = Yii::$app->request->post('value');
			$session = Yii::$app->session;
			$session->set('account_type', $idValue);
			return $this->redirect(['custom-registration/login-details']);
		}
	}

	public function actionLoginDetails() {
		$this->layout = 'login';
		$model = new Register();

		return $this->render('login-details', [
			'model' => $model,
		]);
	}

	public function actionRegister() {
		// return $this->render('email-popup');exit();
		$tempmodel = new Register();
		if ($tempmodel->load(Yii::$app->request->post())) {

			$session = Yii::$app->session;
			$group_id = $session->get('account_type');
			$usercount = User::find()->where(['or', ['username' => $tempmodel->username], ['email' => $tempmodel->email]])->count();
			if ($usercount > 0) {
				throw new HttpException(400, 'Username or email already exists.');
			} else {
				$tempmodel->group_id = $group_id;

				$string = Yii::$app->security->generateRandomString(50);
				$tempmodel->token = $string;
				if ($tempmodel->validate()) {

					$tempmodel->save();

					$email_id = $tempmodel->email;
					$token = $tempmodel->token;
					$registrationUrl = Url::to(['/registration/custom-registration/verify', 'token' => $token], true);
					$mail = Yii::$app->mailer->compose([
						'html' => '/mails/UserInviteSelf',
						'text' => '/mails/plaintext/UserInviteSelf',
					], [
						'token' => $token,
						'registrationUrl' => $registrationUrl,
					]);
					$mail->setTo($email_id);
					$mail->setSubject(Yii::t('UserModule.views_mails_UserInviteSelf', 'Welcome to %appName%', ['%appName%' => Yii::$app->name]));
					$mail->send();
					// if ($mail->send()) {
					// 	echo 'mail send';
					// } else {
					// 	echo 'failed';
					// }
					//exit();
					return $this->render('email-popup');

				} else {
					$tempmodel->getErrors();
				}
			}
		}
	}
	public function actionVerify() {
		$this->layout = 'login';
		$inviteToken = Yii::$app->request->get('token', '');
		$model = Register::find()->where(['token' => $inviteToken])->one();
		$registration = new Registration();
		$registration->enableEmailField = true;
		$registration->enableUserApproval = false;
		$registration->validate();
		$registration->models['User']->username = $model->username;
		
		$registration->models['User']->email = $model->email;
		$registration->models['Profile']->firstname = $model->first_name;
		$registration->models['Profile']->lastname = $model->last_name;
		$registration->models['User']->registrationGroupId = $model->group_id;
		$registration->models['Password']->newPassword = $model->password;
		$registration->models['Password']->newPasswordConfirm = $model->confirm_password;
		
		$authClient = null;
		
		if ($registration->validate() && $registration->register($authClient)) {
			Yii::$app->user->switchIdentity($registration->models['User']);
			$registration_details = new RegistrationDetails();
			return $this->render('steptwo_details', [
				'registration_details' => $registration_details,
			]);
			unset($_SESSION['account_type']);
		} else {
			$registration->models['Profile']->getErrors();
			
		}

	}

	public function actionSaveDetails() {
		//return $this->render('success');exit();

		$model = new RegistrationDetails();
		if ($model->load(Yii::$app->request->post())) {

			$user = Yii::$app->user;
			$user_id = Yii::$app->user->id;
			$profile = Profile::find()->where(['user_id' => $user_id])->one();

			$profile->phone = $model->phone;
			$profile->passport_id = $model->passport_id;
			//print_r($profile);
			if ($profile->validate()) {
				$profile->save();
			}

			$files = UploadedFile::getInstance($model, 'profile_picture');
			//print_r($files);exit();
			if ($files) {
				$this->uploadImage($user, $files);
			}

			return $this->render('success');

			//return $this->redirect(['/dashboard/dashboard/index']);
		}
	}

	public function uploadImage($user, $files) {
		$allowModifyProfileImage = false;
		if (Yii::$app->user->getIdentity()->isSystemAdmin() && Yii::$app->getModule('user')->adminCanChangeUserProfileImages) {
			$allowModifyProfileImage = true;
		} elseif (Yii::$app->user->getIdentity()->id == $user->id) {
			$allowModifyProfileImage = true;
		}

		$model = new UploadProfileImage();

		if (isset($files->tempName)) {
			$model->image = $files->tempName;
		}

		if (!$model->validate()) {
			return false;
		}

		if (!$allowModifyProfileImage) {
			return false;
		}
		$image = new ProfileImage($user->guid);

		$image->setNew($model->image);

		return true;
	}
	
	public function actionBack() {
		$this->layout = 'login';
		$groups = Group::find()->where(['!=', 'name', 'Administrator'])->all();
		unset($_SESSION['account_type']);
		return $this->render('accounttype', [
			'groups' => $groups,
		]);

	}
	
	public function actionBacktoLogin() {
		$this->layout = 'login';
		return $this->goBack();
	}

}