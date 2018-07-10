<?php

namespace humhub\modules\events\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\web\HttpException;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use humhub\modules\user\models\User;
use humhub\modules\events\models\Events;
use humhub\modules\events\models\EventUsers;

/**
 * SiteController
 */
class SiteController extends \humhub\components\Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'except' => ['add-event','edit-event','list','show-event'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function init()
    {
        $this->subLayout = '/layouts/tab_layout';
        return parent::init();
    }

    /*
    * Create event
    */
    public function actionAddEvent()
    {
        $model = new Events();
        $model->scenario = 'create_event';
        if ($model->load(Yii::$app->request->post())) {
            $event = Events::find()->orderBy(['id' => SORT_DESC])->one();
            if ($event) {
                $count = $event->id+1;
            } else {
                $count = 1;
            }
            $instance = UploadedFile::getInstance($model, "image");
            $name = 'Event_'.$count.'.'.$instance->extension;
            $model->scenario = 'wallentry';
            \humhub\modules\content\widgets\WallCreateContentForm::create($model, Yii::$app->user->getIdentity());
            
            $instance->saveAs('protected/modules/events/assets/images/' . $name);
            $model->image = $name;
            if ($model->save(false)) {
                return $this->redirect(['list']);
            }
            throw new HttpException(400, 'Failed to create event. Try again.');
        }
        return $this->render('add', ['model' => $model]);
    }

    /*
    * Input Id
    * Edit Event
    */
    public function actionEditEvent($id)
    {
        $event = Events::findOne($id);
        if ($event) {
            $event->scenario = 'wallentry';
            if ($event->created_by == Yii::$app->user->id) {
                $old_image = $event->image;
                if ($event->load(Yii::$app->request->post())) {
                    $instance = UploadedFile::getInstance($event, "image");
                    if (!empty($instance)) {
                        $name = 'Event_'.$event->id.'.'.$instance->extension;
                        $instance->saveAs('protected/modules/events/assets/images/' . $name);
                        $event->image = $name;
                    } else {
                        $event->image = $old_image;
                    }
                    if ($event->save(false)) {
                        return $this->redirect(['list']);
                    } else {
                        print_r($event->getErrors());
                        exit();
                        //throw new HttpException(400, 'Failed to update. Try again.');
                    }
                }
                return $this->render('edit', ['model' => $event]);
            } else {
                throw new HttpException(400, 'You are not allowed to update others data.');
            }
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /*
    * List all properties
    */
    public function actionList()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Events::find()->orderBy(['date_time' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->render('list', ['dataProvider' => $dataProvider]);
    }

    /*
    * Show details of an event
    */
    public function actionShowEvent($id)
    {
        $eventUser = new EventUsers();
        $model = Events::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $user_list = User::find()->select(['concat(firstname,lastname) as value', 'concat(firstname,lastname) as  label','id as id'])->joinWith(['profile'])
        ->where(['visibility' => 1])->asArray()->all();
       // $user_list = ArrayHelper::map($users, 'id', 'displayName');
        return $this->render('show_event', ['model' => $model,'eventUser' => $eventUser,'user_list' => $user_list]);
    }

    /*
    * Add interested people
    */
    public function actionInterested()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $id = Yii::$app->request->post('id');
        $type = Yii::$app->request->post('type');
        $event = Events::findOne($id);
        if (!$event) {
            return [
                'error' => true,
                'message' => 'Event not found',
            ];
        } else {
            $model = EventUsers::find()->where(['event_id' => $event->id])
            ->andWhere(['user_id' => Yii::$app->user->id])
            ->one();
            if (!$model) {
                $model = new EventUsers();
                $model->event_id = $id;
                $model->user_id = Yii::$app->user->identity->id;
            }
            switch ($type) {
                case 1:
                    $model->status = EventUsers::STATUS_ACCEPTED;
                    break;
                case 2:
                    $model->status = EventUsers::STATUS_MAYBE;
                    break;
                case 3:
                    $model->status = EventUsers::STATUS_DECLINE;
                    break;
            }
            
            if ($model->save()) {
                return [
                    'error' => false,
                    'interested' => $event->getInterested(),
                    'may_be' => $event->getMayBe(),
                    'decline' => $event->getDecline(),
                ];
            } else {
                return [
                    'error' => true,
                    'message' => 'Something went wrong try again.',
                ];
            }
        }
    }

    /*
    * Add Invitation
    */
    public function actionInvite()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new EventUsers();
        if ($model->load(Yii::$app->request->post())) {
            $count = EventUsers::find()->where(['event_id' => $model->event_id, 'user_id' => $model->user_id])->count();
            if ($count == 0) {
                $model->status = EventUsers::STATUS_INVITED;
                if ($model->save()) {
                    $this->sendNotification($model);
                    return [
                        'error' => false,
                        'message' => 'Invited successfully',
                    ];
                } else {
                    return [
                        'error' => true,
                        'message' => 'Something went wrong try again',
                    ];
                }
            } else {
                return [
                    'error' => true,
                    'message' => 'User Already invited',
                ];
            }
        }
    }

    /*
    * Accept invitation to join an event
    */
    public function actionAcceptInvite()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $id = Yii::$app->request->post('id');
        $event = EventUsers::findOne($id);
        if (!$event) {
            throw new NotFoundHttpException('The requested event does not exist.');
        }
        $event->status = EventUsers::STATUS_ACCEPTED;
        if ($event->save()) {
            return [
                'error' => false,
                'url' => \yii\helpers\Url::to(['/events/site/show-event','id' => $event->event_id]),
            ];
        } else {
            return [
                'error' => true,
            ];
        }
    }

    /*
    * Send Notification
    * Fired when an invite is made
    */
    private function sendNotification($model)
    {
        $notification = new \humhub\modules\events\notifications\EventNotification();

        $notification->source = $model;

        $notification->originator = User::findOne(['id' => Yii::$app->user->id]);
        $notification->send(User::findOne($model->user_id));
    }

    /**
     * Renders the view for notification
     */
    public function actionShowNotification()
    {
        $data = Yii::$app->request->get('1');
        $event = Events::findOne($data['event_id']);
        if (!$event) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $user = User::findOne(['id' => $data['invited_by']]);
        echo $this->render('show-notification', ['event' => $event, 'request_id' => $data['request_id'],'invited_by' => $user->displayName]);
    }

    /*
    * load popup data
    */
    public function actionLoadList()
    {
        $id = Yii::$app->request->post('id');
        $type = Yii::$app->request->post('type');
        $user_id = EventUsers::find()->select(['user_id'])->where(['event_id' => $id])->andWhere(['status' => $type]);
        $model = User::find()->where(['id' => $user_id])->all();
        return $this->renderAjax('user_list', ['model' => $model]);
    }
}
