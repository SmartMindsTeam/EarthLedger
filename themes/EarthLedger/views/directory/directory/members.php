<?php
/* @var $this \yii\web\View */
/* @var $keyword string */
/* @var $group humhub\modules\user\models\Group */
/* @var $users humhub\modules\user\models\User[] */
/* @var $pagination yii\data\Pagination */

use yii\helpers\Html;
use humhub\modules\user\widgets\Image;
use humhub\modules\directory\widgets\MemberActionsButton;
use humhub\modules\directory\widgets\UserTagList;
use humhub\modules\directory\widgets\UserGroupList;
?>
<div class="panel panel-default">

    <div class="panel-body">
        <?= Html::beginForm('', 'get', ['class' => 'form-search']); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group form-group-search">
                    <?= Html::hiddenInput('page', '1'); ?>
                    <?= Html::textInput("keyword", $keyword, ['class' => 'form-control form-search form-search-e ', 'placeholder' => Yii::t('DirectoryModule.base', 'Search Community')]); ?>
                    <?= Html::submitButton(Yii::t('DirectoryModule.base', ''), ['class' => 'form-button-search form-button-search-e']); ?>
                </div>
            </div>
        </div>
        <?= Html::endForm(); ?>

        <?php if (count($users) == 0): ?>
            <p><?= Yii::t('DirectoryModule.base', 'No members found!'); ?></p>
        <?php endif; ?>
    </div>

    <hr>

    <ul class="media-list">
        <?php foreach ($users as $user) : ?>
            <li>
                <div class="media">
                    <div class="pull-right memberActions">
                        <?= MemberActionsButton::widget(['user' => $user]); ?>
                    </div>

                    <?= Image::widget(['user' => $user, 'htmlOptions' => ['class' => 'pull-left']]); ?>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <a href="<?= $user->getUrl(); ?>"><?= Html::encode($user->displayName); ?></a>
                            <?= UserGroupList::widget(['user' => $user]); ?>
                        </h4>
                        <h5><?= Html::encode($user->profile->title); ?></h5>
                        <?= UserTagList::widget(['user' => $user]); ?>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

</div>

<div class="pagination-container">
    <?= \humhub\widgets\LinkPager::widget(['pagination' => $pagination]); ?>
</div>
