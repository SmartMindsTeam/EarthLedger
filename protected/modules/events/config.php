<?php

use humhub\widgets\TopMenu;
use humhub\modules\space\widgets\Menu;
use humhub\modules\admin\widgets\AdminMenu;

return [
    'id' => 'events',
    'class' => 'humhub\modules\events\Module',
    'namespace' => 'humhub\modules\events',
    'events' => [
        ['class' => TopMenu::className(), 'event' => TopMenu::EVENT_INIT, 'callback' => ['humhub\modules\events\Events', 'onTopMenuInit']],
        // ['class' => AdminMenu::className(), 'event' => AdminMenu::EVENT_INIT, 'callback' => ['humhub\modules\events\Events', 'onAdminMenuInit']],
    ],
];
