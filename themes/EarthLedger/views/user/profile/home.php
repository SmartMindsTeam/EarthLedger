<?php
/**
 * Created by PhpStorm.
 * User: thetatechnolabs
 * Date: 09/07/18
 * Time: 2:24 PM
 */

//echo \humhub\modules\custom_post\widgets\ProfilePageContent::widget();
?>
<?php echo  \humhub\modules\custom_post\widgets\CustomPostForm::widget(); ?>
<?= \humhub\modules\user\widgets\StreamViewer::widget(['contentContainer' => $user]); ?>

