<?php

use humhub\modules\directory\widgets\Menu;
use humhub\modules\directory\widgets\Sidebar;
use humhub\widgets\FooterMenu;

\humhub\assets\JqueryKnobAsset::register($this);
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 bg-panel bg-panel-side">
            <?= Menu::widget(); ?>
        </div>
        <div class="col-md-6 bg-panel">
            <?= $content; ?>
        </div>
        <div class="col-md-3">
            <?= Sidebar::widget(); ?>
            <?= FooterMenu::widget(['location' => FooterMenu::LOCATION_SIDEBAR]); ?>
        </div>
    </div>
</div>
