<?php

namespace humhub\modules\custom_post\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\web\HttpException;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\filters\ContentNegotiator;
use yii\web\NotFoundHttpException;
use humhub\modules\user\models\User;
use humhub\modules\custom_post\models\CustomPost;

/**
 * SiteController
 */
class SiteController extends \humhub\components\Controller
{

    public function behaviors()
    {
        return [
            'contentNegotiator' => [
                'class' => ContentNegotiator::className(),
                'only' => ['save'],
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                    'application/xml' => Response::FORMAT_XML,
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'except' => ['save'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }


    public function actionSave()
    {
        $model = new CustomPost();
        switch (Yii::$app->request->post('CustomPost')['type']) {
            case 'challenge':
                $model->scenario = 'challenge';
                break;

            case 'custom':
                $model->scenario = 'custom';
                break;
            
            default:
                $model->scenario = 'other_types';
                break;
        }
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            $errors = \yii\widgets\ActiveForm::validate($model);
            if (count($errors)) {
                return [
                    'error' => true,
                    'message' => $errors,
                ];
            } else {
                if ($model->connections) {
                    $model->connections = implode(',', $model->connections);
                }
                \humhub\modules\content\widgets\WallCreateContentForm::create($model, Yii::$app->user->getIdentity());
                return [
                    'error' => false,
                ];
            }
        }
    }

    /*
    * Funding
    */
    public function actionDonate()
    {
        $this->subLayout = '/layouts/tab_layout';
        return $this->render('donate');
    }
}
