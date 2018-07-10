<?php

namespace humhub\modules\events;

use Yii;
use yii\helpers\Url;
use humhub\modules\user\models\User;
use humhub\modules\events\models\Events;

/**

 * Bon Property module definition class

 */

class Module extends \humhub\modules\content\components\ContentContainerModule
{
    /**

     * @inheritdoc

     */

    public $controllerNamespace = 'humhub\modules\events\controllers';

    /**

     * @inheritdoc

     */

    public function init()
    {

        parent::init();
    }

    public function getContentContainerTypes()
    {
        return [
            User::className(),
        ];
    }


    public function disable()
    {
        \Yii::$app->db->createCommand("DROP TABLE event_users")->execute();
        foreach (Events::find()->all() as $entry) {
            $entry->delete();
        }
        parent::disable();
    }

    /**
     * @inheritdoc
     */

    public function enable()
    {
        parent::enable();
    }
}
