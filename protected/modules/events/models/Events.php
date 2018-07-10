<?php

namespace humhub\modules\events\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use humhub\modules\user\models\User;
use humhub\modules\content\components\ContentActiveRecord;

/**
 * This is the model class for table "events".
 *
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property string $locations
 * @property string $date_time
 * @property string $description
 * @property integer $guest_can_invite
 * @property integer $guest_list_showing
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property EventUsers[] $eventUsers
 * @property User $createdAt
 */
class Events extends ContentActiveRecord
{
    public $autoAddToWall = true;
    public $wallEntryClass = 'humhub\modules\events\widgets\WallEntry';

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            BlameableBehavior::className(),
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'events';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'locations', 'date_time', 'description'], 'required','on' => 'wallentry'],
            [['name', 'locations', 'date_time', 'description','image'], 'required','on' => 'create_event'],
            [['date_time'], 'safe'],
            [['description'], 'string'],
            [['guest_can_invite', 'guest_list_showing', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'image', 'locations'], 'string', 'max' => 255],
            [['created_at'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_at' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'image' => 'Image',
            'locations' => 'Locations',
            'date_time' => 'Date Time',
            'description' => 'Description',
            'guest_can_invite' => 'Guest Can Invite',
            'guest_list_showing' => 'Guest List Showing',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    public function getContentName()
    {
        return 'Event';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventUsers()
    {
        return $this->hasMany(EventUsers::className(), ['event_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedAt()
    {
        return $this->hasOne(User::className(), ['id' => 'created_at']);
    }

    public function getInterested()
    {
        return EventUsers::find()->where(['event_id' => $this->id])->andWhere(['status' => EventUsers::STATUS_ACCEPTED])->count();
    }

    public function getMayBe()
    {
        return EventUsers::find()->where(['event_id' => $this->id])->andWhere(['status' => EventUsers::STATUS_MAYBE])->count();
    }

    public function getDecline()
    {
        return EventUsers::find()->where(['event_id' => $this->id])->andWhere(['status' => EventUsers::STATUS_DECLINE])->count();
    }

    public function getActionType()
    {
        $eventUser = EventUsers::find()->where(['event_id' => $this->id])
        ->andWhere(['user_id' => Yii::$app->user->identity->id])
        ->one();
        if ($eventUser) {
            switch ($eventUser->status) {
                case 1:
                    return 'accepted';
                break;
                case 2:
                    return 'may_be';
                break;
                case 3:
                    return 'decline';
                break;
                default:
                    return 'not_invited';
                break;
            }
        } else {
            return 'not_invited';
        }
    }

    public function canInvite()
    {
        if ($this->created_by == Yii::$app->user->id || $this->guest_can_invite == 1) {
            return true;
        } else {
            return false;
        }
    }
}
