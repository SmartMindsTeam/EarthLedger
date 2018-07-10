<?php

use humhub\libs\Html;
use humhub\modules\content\widgets\WallEntryAddons;
use humhub\modules\content\widgets\WallEntryControls;
use humhub\modules\content\widgets\WallEntryLabels;
use humhub\modules\space\models\Space;
use humhub\modules\space\widgets\Image as SpaceImage;
use humhub\modules\user\widgets\Image as UserImage;
use humhub\widgets\TimeAgo;
use yii\helpers\Url;

/* @var $object \humhub\modules\content\components\ContentContainerActiveRecord */
/* @var $renderControls boolean */
/* @var $wallEntryWidget string */
/* @var $user \humhub\modules\user\models\User */
/* @var $showContentContainer \humhub\modules\user\models\User */

if (isset($object->type)) {
    $custom_class = 'wall_bg_img_' . $object->type;
} else {
    $custom_class = '';
}

if (isset($object->location)) {
    $custom_post_location = $object->location;
} else {
    $custom_post_location = '';
}
?>



<div class="panel panel-default wall_<?=$object->getUniqueId() . ' ' . $custom_class;?>">
    <div class="panel-body">

        <div class="media">
            <!-- since v1.2 -->
            <div class="stream-entry-loader"></div>

            <!-- start: show wall entry options -->
            <?php if ($renderControls): ?>
                <ul class="nav nav-pills preferences">
                    <li class="dropdown ">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-label="<?=Yii::t('base', 'Toggle stream entry menu');?>" aria-haspopup="true">
                            <i class="fa fa-angle-down"></i>
                        </a>


                            <ul class="dropdown-menu pull-right">
                                <?=WallEntryControls::widget(['object' => $object, 'wallEntryWidget' => $wallEntryWidget]);?>
                            </ul>
                    </li>
                </ul>
            <?php endif;?>
            <!-- end: show wall entry options -->

            <?=
UserImage::widget([
    'user' => $user,
    'width' => 50,
    'htmlOptions' => ['class' => 'pull-left'],
]);
?>

            <?php if ($showContentContainer && $container instanceof Space): ?>
                <?=
SpaceImage::widget([
    'space' => $container,
    'width' => 20,
    'htmlOptions' => ['class' => 'img-space'],
    'link' => 'true',
    'linkOptions' => ['class' => 'pull-left'],
]);
?>
            <?php endif;?>

            <div class="media-body">
                <div class="media-heading">
                    <?=Html::containerLink($user);?>
                    <?php if ($showContentContainer): ?>
                        <span class="viaLink">
                            <i class="fa fa-caret-right" aria-hidden="true"></i>
                            <?=Html::containerLink($container);?>
                        </span>
                    <?php endif;?>

                    <div class="pull-right <?=($renderControls) ? 'labels' : ''?>">
                        <?=WallEntryLabels::widget(['object' => $object]);?>
                    </div>
                </div>
                <div class="media-subheading">
                    <?php
                    if($custom_post_location){
                        echo '<span>'.$custom_post_location.'<span class="line">|</span></span>';
                    }?>
                    <a href="<?=Url::to(['/content/perma', 'id' => $object->content->id], true)?>">
                        <?=TimeAgo::widget(['timestamp' => $createdAt]);?>
                    </a>
                </div>
            </div>
            <hr class="new-line"/>

            <div class="content" id="wall_content_<?=$object->getUniqueId();?>">
                <?=$content;?>
            </div>    

            <!-- wall-entry-addons class required since 1.2 -->
            <?php if ($renderAddons): ?>
                <div class="stream-entry-addons clearfix">
                    <div class="block">
                        <?=WallEntryAddons::widget($addonOptions);?>
                    </div>
                

                </div>
            <?php endif;?>

        </div>
    </div>
</div>
