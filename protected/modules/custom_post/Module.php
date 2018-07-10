<?php

namespace humhub\modules\custom_post;

use Yii;
use yii\helpers\Url;
use humhub\modules\user\models\User;
use humhub\modules\custom_post\models\CustomPost;

/**

 * Custom Post module definition class

 */

class Module extends \humhub\modules\content\components\ContentContainerModule
{
    /**

     * @inheritdoc

     */

    public $controllerNamespace = 'humhub\modules\custom_post\controllers';

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
        foreach (CustomPost::find()->all() as $entry) {
            $entry->delete();
        }
        \Yii::$app->db->createCommand("DROP TABLE custom_post")->execute();
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
