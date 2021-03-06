<?php

use humhub\widgets\FooterMenu;

?>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php
            echo \humhub\modules\user\widgets\AccountMenu::widget(); ?>
        </div>
        <div class="col-md-9 bg-panel">
            <div class="panel panel-default">
                <?php echo $content; ?>
            </div>
            <?= FooterMenu::widget(['location' => FooterMenu::LOCATION_FULL_PAGE]); ?>
        </div>
    </div>
</div>
