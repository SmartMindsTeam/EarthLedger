<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2018 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\dashboard;

use Yii;
use yii\helpers\Url;
use humhub\modules\dashboard\widgets\ShareWidget;

/**
 * Description of Events
 *
 * @author luke
 */
class Events
{

    /**
     * On build of the TopMenu, check if module is enabled
     * When enabled add a menu item
     *
     * @param type $event
     */
    public static function onTopMenuInit($event)
    {

        // Is Module enabled on this workspace?
        $event->sender->addItem([
            'label' => Yii::t('DashboardModule.base', 'Log'),
            'id' => 'dashboard',
            'icon' => '<img src="themes\EarthLedger\img\log.png">',
            'url' => Url::toRoute('/dashboard/dashboard'),
            'sortOrder' => 100,
            'isActive' => (Yii::$app->controller->module && Yii::$app->controller->module->id == 'dashboard'),
        ]);
    }
}
