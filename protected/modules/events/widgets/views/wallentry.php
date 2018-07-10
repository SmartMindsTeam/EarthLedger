<?php

use yii\helpers\Url;
use \yii\helpers\Html;
use humhub\modules\events\Assets;

Assets::register($this);
?>

<div class="event-list-box dashboard-event-list-box">
  <a class="event-image" href="<?=Url::to(['/events/site/show-event', 'id' => $model->id])?>" style="background-image:url('<?=Yii::$app->getModule('events')->getAssetsUrl() . '/images/' . $model->image;?>')">
  </a>
  <div class="event-main-details">
    <img src="<?=Yii::$app->getModule('events')->getAssetsUrl() . '/images/calendar.png';?>">
    <h3>
      <a href="<?=Url::to(['/events/site/show-event', 'id' => $model->id])?>">
        <?=$model->name?>
      </a>
    </h3>
    <span><?=date('D, d M y', strtotime($model->date_time))?></span>
  </div>
  <div id="detail_holder_<?= $model->id; ?>" class="event_detail">
    <p class="location"><?=$model->locations?></p>
    <?php
    if (!Yii::$app->user->isGuest) {
        $btn_type = $model->getActionType();
        ?>
      <div id="btn_holder_<?= $model->id; ?>" class="btn-holder">
        <button id="interested" class="btn <?= $btn_type == 'accepted' ? 'btn-success' : 'btn-info'; ?>" data-id="<?= $model->id; ?>">Interested</button>

        <button id="may_be" class="btn <?= $btn_type == 'may_be' ? 'btn-success' : 'btn-info'; ?>" data-id="<?= $model->id; ?>">May be</button>

        <button id="decline" class="btn <?= $btn_type == 'decline' ? 'btn-success' : 'btn-info'; ?>" data-id="<?= $model->id; ?>">Decline</button>
      </div>
        <?php
    }
    ?>
    <?= Html::tag('span', $model->getInterested(), ['class' => 'interested_count']).' attending'; ?>
    <?= Html::tag('span', $model->getMayBe(), ['class' => 'may_be_count']).' may be'; ?>
    <?= Html::tag('span', $model->getDecline(), ['class' => 'declined_count']).' declined'; ?>
  </div>

</div>
<script type="text/javascript">
  $(document).on('click','#interested',function (e) {
    var site_url = "<?php echo Url::to(['/events/site/interested']); ?>";
    var id = $(this).attr('data-id');
    changeBtnType(id,1,site_url);
  });

  $(document).on('click','#may_be',function (e) {
    var site_url = "<?php echo Url::to(['/events/site/interested']); ?>";
    var id = $(this).attr('data-id');
    changeBtnType(id,2,site_url);
  });

  $(document).on('click','#decline',function (e) {
    var site_url = "<?php echo Url::to(['/events/site/interested']); ?>";
    var id = $(this).attr('data-id');
    changeBtnType(id,3,site_url);
  });
</script>