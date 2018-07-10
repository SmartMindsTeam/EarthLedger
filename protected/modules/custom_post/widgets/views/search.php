<?php

use humhub\modules\custom_post\Assets;
use humhub\libs\Html;
use yii\helpers\Url;

Assets::register($this);
?>

    <?= Html::beginForm(Url::to(['//search/search/index']), 'GET'); ?>
    <div class="form-group form-group-search">
        <?= Html::textInput('SearchForm[keyword]', '', array('placeholder' => Yii::t('base', 'Search this network'), 'title' => Yii::t('SearchModule.views_search_index', 'Search for user, spaces and content'), 'class' => 'form-control black-search-box', 'id' => 'search-input-field')); ?>
        <?= Html::submitButton(Yii::t('base', 'Search'), array('class' => 'btn btn-default btn-sm form-button-search hidden')); ?>
    </div>
    <?= Html::endForm(); ?>
