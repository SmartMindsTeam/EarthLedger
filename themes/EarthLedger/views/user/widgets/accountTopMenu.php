<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2017 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

use humhub\widgets\FooterMenu;
use \yii\helpers\Html;
use \yii\helpers\Url;

/** @var \humhub\modules\user\models\User $userModel */
$userModel = Yii::$app->user->getIdentity();
?>
<?php if ($userModel === null): ?>
    <a href="#" class="btn btn-enter" data-action-click="ui.modal.load" data-action-url="<?= Url::toRoute('/user/auth/login'); ?>">
        <?php if (Yii::$app->getModule('user')->settings->get('auth.anonymousRegistration')): ?>
            <?= Yii::t('UserModule.base', 'Sign in / up'); ?>
        <?php else: ?>
            <?= Yii::t('UserModule.base', 'Sign in'); ?>
        <?php endif; ?>
    </a>
<?php else: ?>
<?php $user = \Yii::$app->user->identity;?>
    <ul class="nav">
        <li class="dropdown account">
            <a href="<?=$user->createUrl('/user/profile/home')?>"  aria-label="<?= Yii::t('base', 'Profile dropdown') ?>">

            <img id="user-account-image" class="img-rounded pull-left"
                     src="<?= $userModel->getProfileImage()->getUrl(); ?>"
                     height="32" width="32" alt="<?= Yii::t('base', 'My profile image') ?>" data-src="holder.js/32x32"
                     style="width: 32px; height: 32px;"/>
                     
                <?php if ($this->context->showUserName): ?>
                    <div class="user-title pull-left hidden-xs">
                        <strong><?= Html::encode($userModel->displayName); ?></strong><br/><span class="truncate"><?= Html::encode($userModel->profile->title); ?></span>
                        <b class="caret"></b>
                    </div>
                <?php endif; ?>

                
            </a>
            <!--<ul class="dropdown-menu pull-right">
                <?php /*foreach ($this->context->getItems() as $item): */?>
                    <?php /*if ($item['label'] == '---'): */?>
                        <li class="divider"></li>
                        <?php /*else: */?>
                        <li>
                            <a <?/*= isset($item['id']) ? 'id="' . $item['id'] . '"' : '' */?> href="<?/*= $item['url']; */?>" <?/*= isset($item['pjax']) && $item['pjax'] === false ? 'data-pjax-prevent' : '' */?>>
                                <?/*= $item['icon'] . ' ' . $item['label']; */?>
                            </a>
                        </li>
                    <?php /*endif; */?>
                <?php /*endforeach; */?>
                <?/*= FooterMenu::widget(['location' => FooterMenu::LOCATION_ACCOUNT_MENU]); */?>
            </ul>-->
        </li>
    </ul>
<?php endif; ?>
