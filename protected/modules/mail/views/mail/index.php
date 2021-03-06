<?php

use humhub\modules\mail\permissions\StartConversation;
use yii\helpers\Html;

if ($messageId != "") {
    $this->registerJs('loadMessage(' . Html::encode($messageId) . ');');
}

$canStartConversation = Yii::$app->user->can(StartConversation::class);
?>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= Yii::t('MailModule.views_mail_index', 'Conversations') ?>
                    <?php if($canStartConversation) : ?>
                        <?= Html::a(Yii::t('MailModule.views_mail_index', 'New message'), ['/mail/mail/create'], ['class' => 'btn btn-info pull-right', 'data-target' => '#globalModal']); ?>
                    <?php endif; ?>
                </div>

                <hr>
                <ul id="inbox" class="media-list">
                    <?php if (count($userMessages) != 0) : ?>
                        <?php foreach ($userMessages as $userMessage) : ?>
                            <?php echo $this->render('_messagePreview', array('userMessage' => $userMessage)); ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="placeholder"><?php echo Yii::t('MailModule.views_mail_index', 'There are no messages yet.'); ?></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="pagination-container">
                <?= \humhub\widgets\LinkPager::widget(['pagination' => $pagination]); ?>
            </div>
        </div>
        <div class="col-md-8 messages">
            <div id="mail_message_details">
                <div class="loader"></div>
            </div>
        </div>
    </div>
</div>
