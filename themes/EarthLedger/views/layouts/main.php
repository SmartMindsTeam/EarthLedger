<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;

\humhub\assets\AppAsset::register($this);
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>">
    <head>
        <title><?=strip_tags($this->pageTitle);?></title>
        <meta charset="<?=Yii::$app->charset?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <?php $this->head()?>
        <?=$this->render('head');?>
    </head>
    <body>
        <?php $this->beginBody()?>

        <!-- start: first top navigation bar -->
        <div id="topbar-first" class="topbar no-padding">
            <div class="container-fluid">
                    <div class="topbar-brand hidden-xs">
                    <?=\humhub\widgets\SiteLogo::widget();?>
                </div>

                <div class="topbar-actions pull-right">
                    <?php echo \humhub\modules\user\widgets\AccountTopMenu::widget();?>
                    <div class="notifications">
                    <?=\humhub\widgets\NotificationArea::widget();?>
                </div>
                </div>


            </div>
        </div>
        <!-- end: first top navigation bar -->

        <!-- start: second top navigation bar -->
        <div id="topbar-second" class="topbar no-padding">
            <div class="container-fluid">
                <ul class="nav" id="top-menu-nav">

                    <!-- load navigation from widget -->
                    <?=\humhub\widgets\TopMenu::widget();?>
                </ul>

                <ul class="nav pull-right" id="search-menu-nav">
                    <!-- load space chooser widget -->
                    <?=\humhub\modules\space\widgets\Chooser::widget();?>
                    <li>
                        <?php 
                        if (Yii::$app->hasModule('mail')) {
                            echo Html::a('<img src="themes\EarthLedger\img\message.png"><br> Message', ['/mail/mail/index'], ['class' => '']);
                        }
                        ?>
</li>
                    <li>
                    <?=\humhub\modules\custom_post\widgets\SearchWidget::widget();?>
                    </li>

                </ul>
            </div>
        </div>
        <!-- end: second top navigation bar -->

        <?=$content;?>

        <?php $this->endBody()?>
    </body>
</html>
<?php $this->endPage()?>
