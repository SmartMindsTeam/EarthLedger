<?php

use humhub\widgets\TopMenu;
use humhub\modules\content\widgets\WallEntryAddons;

return [
    'id' => 'custom_post',
    'class' => 'humhub\modules\custom_post\Module',
    'namespace' => 'humhub\modules\custom_post',
    'events' => [
        ['class' => TopMenu::className(), 'event' => TopMenu::EVENT_INIT, 'callback' => ['humhub\modules\custom_post\Events', 'onTopMenuInit']],
        ['class' => WallEntryAddons::className(), 'event' => WallEntryAddons::EVENT_INIT, 'callback' => ['humhub\modules\custom_post\Events', 'onWallEntryAddonInit']],
    ],
];
