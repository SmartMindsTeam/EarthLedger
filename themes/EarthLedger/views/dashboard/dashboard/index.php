<?php
/**
 * @var \humhub\modules\user\models\User $contentContainer
 * @var bool $showProfilePostForm
 */
use humhub\modules\activity\widgets\Stream;
use humhub\modules\dashboard\widgets\Sidebar;
use humhub\widgets\FooterMenu;

?>

<div class="container-fluid">
    <div class="row">
    <div class="col-md-3">
        <?php echo \humhub\widgets\LeftSidebarWidget::widget();?>
    </div>

        <div class="col-md-6 layout-content-container bg-panel">
        <?php
if (Yii::$app->hasModule('custom_post')) {
    echo \humhub\modules\custom_post\widgets\DashboardContent::widget([
        'contentContainer' => $contentContainer,
        'showProfilePostForm' => $showProfilePostForm,
    ]);
} else {
    echo \humhub\modules\dashboard\widgets\DashboardContent::widget([
        'contentContainer' => $contentContainer,
        'showProfilePostForm' => $showProfilePostForm,
    ]);
}
?>
        </div>
        <div class="col-md-3 layout-sidebar-container">

        <?php echo \humhub\modules\custom_post\widgets\StreamMap::widget([]); ?>

            <?php echo Sidebar::widget([
                'widgets' => [
                    [
                        Stream::className(),
                        ['streamAction' => '/dashboard/dashboard/stream'],
                        ['sortOrder' => 150],
                    ],
                ],
            ]);
        ?>
            <?=FooterMenu::widget(['location' => FooterMenu::LOCATION_SIDEBAR]);?>
        </div>
    </div>
</div>
