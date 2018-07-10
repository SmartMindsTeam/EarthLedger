<?php

namespace humhub\modules\custom_post;

use Yii;
use yii\helpers\Url;
use humhub\modules\custom_post\widgets\Share;

/**
 * Event Module Events
 *
 */
class Events extends \yii\base\Object
{

    public static function onTopMenuInit($event)
    {
        if (!Yii::$app->user->isGuest) {
            $event->sender->addItem(array(
                'label' => 'Funding',
                'url' => Url::to(['/custom_post/site/donate']),
                'icon' => '<img src="themes\EarthLedger\img\funding.png">',
                'isActive' => (Yii::$app->controller && Yii::$app->controller->module && Yii::$app->controller->module->id == 'custom_post'),
                'sortOrder' => 102,
            ));

            $event->sender->addItem(array(
                'label' => 'Marketplace',
                'url' => Url::to(['/custom_post/site/marketplace']),
                'icon' => '<img src="themes\EarthLedger\img\market.png">',
                'isActive' => (Yii::$app->controller && Yii::$app->controller->module && Yii::$app->controller->module->id == 'custom_post'),
                'sortOrder' => 103,
            ));

            $event->sender->addItem(array(
                'label' => 'Education',
                'url' => Url::to(['/custom_post/site/marketplace']),
                'icon' => '<img src="themes\EarthLedger\img\education.png">',
                'isActive' => (Yii::$app->controller && Yii::$app->controller->module && Yii::$app->controller->module->id == 'custom_post'),
                'sortOrder' => 104,
            ));
        }
    }

    public static function onWallEntryAddonInit($event)
    {
        $event->sender->addWidget(Share::className(), array(
            'object' => $event->sender->object,
            'seperator' => "&nbsp;&middot;&nbsp;",
            'template' => '<div class="wall-entry-controls">{content}</div>',
                ), array('sortOrder' => 11));
    }
}
