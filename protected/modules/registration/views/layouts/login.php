<?php
/* @var $this \yii\web\View */
/* @var $content string */

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
    <body class="login-container">
        <?php $this->beginBody()?>

        <?=$content;?>

        <?php $this->endBody()?>
    </body>
</html>
<?php $this->endPage()?>
