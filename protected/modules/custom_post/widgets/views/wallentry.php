<?php

use yii\helpers\Url;
use yii\helpers\Html;
use humhub\modules\custom_post\Assets;
use humhub\modules\file\widgets\ShowFiles;

Assets::register($this);
?>
<div class="custom_post_wallentry">
  <div class="custom-post-new-title">
    <span></span>
    <?php
    if($model->challenge_name){
      echo $model->challenge_name;
    } 
    ?>
  </div>
  <p>
    <div data-ui-markdown data-ui-show-more style="overflow: hidden;" class="detail-text">
        <?= humhub\widgets\RichText::widget(['text' => $model->description, 'record' => $model, 'markdown' => true]) ?>
    </div>
  </p>
</div>