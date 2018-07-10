<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

?>

<div class="panel-heading">
  <strong>Events</strong>
</div>
<div class="panel-body event-box">

 <div class="right-btn"> <?=Html::a('Add Event', ['add-event'], ['class' => 'btn btn-info'])?> </div>

    <?=

    ListView::widget([

    'dataProvider' => $dataProvider,

    'itemView' => function ($model, $key, $index, $widget) {
        $btn_type = $model->getActionType();
        $guest_list_showing = $model->guest_list_showing;
        ?>

      <div class="event-list-box">
        <a class="event-image" href="<?=Url::to(['show-event', 'id' => $model->id])?>" style="background-image:url('<?=Yii::$app->getModule('events')->getAssetsUrl() . '/images/' . $model->image;?>')">
      </a>
        <?php
        if ($model->created_by == Yii::$app->user->id) {
            echo Html::a('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', ['edit-event','id'=>$model->id], ['title' => 'Edit','class'=>'event-edit-btn']);
        }
        ?>
        <div class="event-main-details">
    <img src="<?=Yii::$app->getModule('events')->getAssetsUrl() . '/images/calendar.png';?>">
    <h3>
      <a href="<?=Url::to(['/events/site/show-event', 'id' => $model->id])?>">
        <?=$model->name?>
      </a>
    </h3>
    <span><?=date('D, d M y', strtotime($model->date_time))?></span>
  </div>
        <div d="detail_holder_<?= $model->id; ?>" class="event_detail">
        <p class="location"><?=$model->locations?></p>
        <div id="btn_holder_<?= $model->id; ?>" class="btn-holder">
          <button id="interested" class="btn <?= $btn_type == 'accepted' ? 'btn-success' : 'btn-info'; ?>" data-id="<?= $model->id; ?>">Interested</button>

          <button id="may_be" class="btn <?= $btn_type == 'may_be' ? 'btn-success' : 'btn-info'; ?>" data-id="<?= $model->id; ?>">May be</button>

          <button id="decline" class="btn <?= $btn_type == 'decline' ? 'btn-success' : 'btn-info'; ?>" data-id="<?= $model->id; ?>">Decline</button>
        </div>
        <div class="btn-list">
          <span class="list"><?= Html::tag('span', $model->getInterested(), ['class' => $guest_list_showing == 1 ? 'interested_show interested_count' : 'interested_count','data-id' => $model->id]).' attending'; ?></span>
          <span class="list"><?= Html::tag('span', $model->getMayBe(), ['class' => $guest_list_showing == 1 ? 'may_be_show may_be_count' : 'may_be_count','data-id' => $model->id]).' may be'; ?></span>
          <span class="list"><?= Html::tag('span', $model->getDecline(), ['class' => $guest_list_showing == 1 ? 'declined_show declined_count' : 'declined_count','data-id' => $model->id]).' declined'; ?></span>
        </div>
        </div>

      </div>
        <?php
    },

  'summary' => '',

  'pager' => [

    'firstPageLabel' => 'first',

    'lastPageLabel' => 'last',

    'nextPageLabel' => 'next',

    'prevPageLabel' => 'previous',

    'maxButtonCount' => 3,

  ],

    ]);

?>

</div>

<!-- Modal starts-->
<div id="user_list_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">List</h4>
      </div>
      <div class="modal-body">
        <div id="user_list_body"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal ends-->

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
  $(document).on('click','.interested_show',function (e) {
    var id = $(this).attr('data-id');
    var site_url = "<?php echo Url::to(['/events/site/load-list']); ?>";
    loadPopup(site_url,id,1)
  });

  $(document).on('click','.may_be_show',function (e) {
    var id = $(this).attr('data-id');
    var site_url = "<?php echo Url::to(['/events/site/load-list']); ?>";
    loadPopup(site_url,id,2)
  });

  $(document).on('click','.declined_show',function (e) {
    var id = $(this).attr('data-id');
    var site_url = "<?php echo Url::to(['/events/site/load-list']); ?>";
    loadPopup(site_url,id,3)
  });

</script>


