<?php

use humhub\widgets\FooterMenu;

$user = $this->context->getUser();
?>
<div class="container-fluid profile-layout-container">
    <div class="row">
        <div class="col-md-12 bg-panel">
            <?= \humhub\modules\user\widgets\ProfileHeader::widget(['user' => $user]); ?>
        </div>
    </div>
    <div class="row profile-content">
        <div class="col-md-3 layout-nav-container bg-panel bg-panel-side">
            <?php //\humhub\modules\user\widgets\ProfileMenu::widget(['user' => $this->context->user]); ?>
            <?php echo \humhub\widgets\LeftSidebarWidget::widget();?>
        </div>

        <?php if (isset($this->context->hideSidebar) && $this->context->hideSidebar) : ?>
            <div class="col-md-9 layout-content-container bg-panel">
                <?php echo $content; ?>
                <?= FooterMenu::widget(['location' => FooterMenu::LOCATION_FULL_PAGE]); ?>
            </div>
        <?php else: ?>
            <div class="col-md-6 layout-content-container bg-panel">
                <?php echo $content; ?>
            </div>
            <div class="col-md-3 layout-sidebar-container">
                <?php
                echo \humhub\modules\user\widgets\ProfileSidebar::widget([
                    'user' => $this->context->user,
                    'widgets' => [
                        [\humhub\modules\user\widgets\UserTags::className(), ['user' => $this->context->user], ['sortOrder' => 10]],
                        [\humhub\modules\user\widgets\UserSpaces::className(), ['user' => $this->context->user], ['sortOrder' => 20]],
                        [\humhub\modules\friendship\widgets\FriendsPanel::className(), ['user' => $this->context->user], ['sortOrder' => 30]],
                        [\humhub\modules\user\widgets\UserFollower::className(), ['user' => $this->context->user], ['sortOrder' => 40]],
                    ]
                ]);
                ?>
                <?= FooterMenu::widget(['location' => FooterMenu::LOCATION_SIDEBAR]); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
