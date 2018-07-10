<?php

namespace humhub\modules\events\models;

use Yii;
use humhub\modules\user\models\User;

/**
 * This is the model class for table "event_users".
 *
 * @property integer $id
 * @property integer $event_id
 * @property integer $user_id
 * @property integer $status
 *
 * @property Events $event
 * @property User $user
 */
class EventUsers extends \yii\db\ActiveRecord
{
    const STATUS_INVITED = 0;
    const STATUS_ACCEPTED = 1;
    const STATUS_MAYBE = 2;
    const STATUS_DECLINE = 3;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_id', 'user_id', 'status'], 'required'],
            [['event_id', 'user_id', 'status'], 'integer'],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Events::className(), 'targetAttribute' => ['event_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_id' => 'Event ID',
            'user_id' => 'User ID',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Events::className(), ['id' => 'event_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
