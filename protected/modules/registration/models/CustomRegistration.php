<?php

namespace humhub\modules\registration\models;

use Yii;

class CustomRegistration extends \humhub\modules\user\models\User {
	public $password;
	public $confirm_password;
	public $first_name;
	public $last_name;

	public function rules() {
		/* @var $userModule \humhub\modules\user\Module */
		$userModule = Yii::$app->getModule('user');

		return [
			[['username', 'first_name', 'last_name', 'password', 'confirm_password'], 'required'],
			[['username'], 'string', 'max' => 50, 'min' => $userModule->minimumUsernameLength],
			[['email'], 'unique'],
			[['email'], 'email'],
			[['email', 'password', 'confirm_password', 'first_name', 'last_name'], 'string', 'max' => 254],
			[['email'], 'required', 'when' => function ($model, $attribute) use ($userModule) {
				return $userModule->emailRequired;
			}],
			[['username'], 'unique'],
			[['guid'], 'unique'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'username' => 'Username',
			'email' => 'Email',
			'password' => 'Password',
			'confirm_password' => 'Confirm Password ',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',

		];
	}

}