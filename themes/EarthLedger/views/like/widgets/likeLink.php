<?php

use yii\helpers\Html;

humhub\modules\like\assets\LikeAsset::register($this);

$like_img = "<img src='themes\EarthLedger\img\like.png'>";
$unlike_img = "<img src='themes\EarthLedger\img\unlike.png'>";
?>

<span class="likeLinkContainer" id="likeLinkContainer_<?= $id ?>">

    <?php if (Yii::$app->user->isGuest) : ?>
        <?php echo Html::a('', Yii::$app->user->loginUrl, ['data-target' => '#globalModal']); ?>
    <?php else : ?>
        <a href="#" data-action-click="like.toggleLike" data-action-url="<?= $likeUrl ?>" class="like likeAnchor" style="<?= (!$currentUserLiked) ? '' : 'display:none'?>">
            
        </a>
        <a href="#" data-action-click="like.toggleLike" data-action-url="<?= $unlikeUrl ?>" class="unlike likeAnchor" style="<?= ($currentUserLiked) ? '' : 'display:none'?>">

        </a>
    <?php endif; ?>


</span>