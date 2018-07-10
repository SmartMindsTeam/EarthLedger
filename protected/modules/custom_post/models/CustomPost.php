<?php

namespace humhub\modules\custom_post\models;

use humhub\modules\content\components\ContentActiveRecord;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "custom_post".
 *
 * @property integer $id
 * @property string $message
 * @property string $type
 * @property string $description
 * @property string $location
 * @property string $support_document
 * @property string $tags
 * @property string $connections
 * @property string $stream
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 */
class CustomPost extends ContentActiveRecord
{
    public $autoAddToWall = true;
    public $wallEntryClass = 'humhub\modules\custom_post\widgets\WallEntry';

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
        return 'custom_post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'description'], 'required', 'on' => 'other_types'],
            [['type','in_mind'], 'required', 'on' => 'custom'],
            [['type', 'description','challenge_name'], 'required', 'on' => 'challenge'],
            [['type', 'description', 'stream','in_mind'], 'string'],
            [['created_at', 'updated_at', 'created_by', 'updated_by','price'], 'integer'],
            [['location', 'support_document', 'tags', 'connect_challenge','link','product_type'], 'string', 'max' => 255],
            [['connections'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'description' => 'Description',
            'location' => 'Location',
            'support_document' => 'Supporting Documentation',
            'tags' => 'Tags',
            'connections' => 'Select a connection',
            'stream' => 'Stream',
            'aprox_cost' => 'Approximate Cost',
            'solution' => 'What types of challenges is your solution best suited for?',
            'product_feature' => 'Product Features',
            'in_mind' => 'What is in your mind?',
            'connect_challenge' => 'Connect To Challenge',
            'link' => 'Link',
            'product_type' => 'Type of Product',
            'challenge_name' => 'Name your Challenge',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    public function getContentName()
    {
        return $this->type;
    }
}
