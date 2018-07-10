<?php

use yii\helpers\Html;
use yii\helpers\Url;

$commentCount = $this->context->getCommentsCount();
$hasComments = ($commentCount > 0);
$commentCountSpan = Html::tag('span', ' ('.$commentCount.')', [
    'class' => 'comment-count',
    'data-count' => $commentCount,
    'style' => ($hasComments) ? null : 'display:none'
]);

$comment_img = "<img src='themes\EarthLedger\img\comment.png'>";

?>

<?php if ($mode == \humhub\modules\comment\widgets\CommentLink::MODE_POPUP) : ?>
    <?php $url = Url::to(['/comment/comment/show', 'contentModel' => $objectModel, 'contentId' => $objectId, 'mode' => 'popup']); ?>
    <a href="#" class="cstm-comment" data-action-click="ui.modal.load" data-action-url="<?= $url ?>">
        
    </a>
<?php elseif (Yii::$app->user->isGuest) : ?>
    <?= Html::a('', Yii::$app->user->loginUrl, ['data-target' => '#globalModal', 'class'=>'cstm-comment']) ?>
<?php else : ?>
    <?= Html::a('', "#", ['onClick' => "$('#comment_" . $id . "').slideToggle('fast');$('#newCommentForm_" . $id . "').focus();return false;", 'class'=>'cstm-comment']); ?>
<?php endif; ?>