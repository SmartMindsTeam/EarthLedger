<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="usr_list">
    <?php
    if ($model) {
        foreach ($model as $user) {
            ?>
          <img id="user-account-image" class="img-rounded"
                     src="<?= $user->getProfileImage()->getUrl(); ?>"
                     height="32" width="32" alt="<?= Yii::t('base', 'My profile image') ?>" data-src="holder.js/32x32"
                     style="width: 32px; height: 32px;"/>
                     <label><?= Html::encode($user->displayName); ?></label>
            <?php
        }
    }
    ?>
</div>

    