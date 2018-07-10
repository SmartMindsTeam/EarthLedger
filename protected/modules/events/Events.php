<?php

namespace humhub\modules\events;

use Yii;
use yii\helpers\Url;

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
                'label' => 'Events',
                'url' => Url::to(['/events/site/list']),
                'icon' => '<i class="fa fa-calendar"></i>',
                'isActive' => (Yii::$app->controller && Yii::$app->controller->module && Yii::$app->controller->module->id == 'events'),
                'sortOrder' => 300,
            ));
        }
    }
}
