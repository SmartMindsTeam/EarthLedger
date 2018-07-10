<?php
/**
 * @var \humhub\modules\space\models\Space $space
 * @var string $content
 */

use humhub\widgets\FooterMenu;

$space = $this->context->contentContainer;
?>
<div class="container-fluid space-layout-container">
    <div class="row">
        <div class="col-md-12 bg-panel">
            <?php echo humhub\modules\space\widgets\Header::widget(['space' => $space]); ?>

        </div>
    </div>
    <div class="row space-content">
        <div class="col-md-3 layout-nav-container bg-panel bg-panel-side">
            <?php echo \humhub\modules\space\widgets\Menu::widget(['space' => $space]); ?>
            <br>
        </div>

        <?php if (isset($this->context->hideSidebar) && $this->context->hideSidebar) : ?>
            <div class="col-md-9 layout-content-container bg-panel">
                <?= \humhub\modules\space\widgets\SpaceContent::widget([
                    'contentContainer' => $space,
                    'content' => $content
                ]) ?>
                <?= FooterMenu::widget(['location' => FooterMenu::LOCATION_FULL_PAGE]); ?>
            </div>
        <?php else: ?>
            <div class="col-md-6 layout-content-container bg-panel">
                <?= \humhub\modules\space\widgets\SpaceContent::widget([
                    'contentContainer' => $space,
                    'content' => $content
                ]) ?>
            </div>
            <div class="col-md-3 layout-sidebar-container">
                <?php
                echo \humhub\modules\space\widgets\Sidebar::widget(['space' => $space, 'widgets' => [
                        [\humhub\modules\activity\widgets\Stream::className(), ['streamAction' => '/space/space/stream', 'contentContainer' => $space], ['sortOrder' => 10]],
                        [\humhub\modules\space\modules\manage\widgets\PendingApprovals::className(), ['space' => $space], ['sortOrder' => 20]],
                        [\humhub\modules\space\widgets\Members::className(), ['space' => $space], ['sortOrder' => 30]]
                ]]);
                ?>

                <?= FooterMenu::widget(['location' => FooterMenu::LOCATION_SIDEBAR]); ?>
            </div>
        <?php endif; ?>
    </div>
</div>