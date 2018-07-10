<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\jui\AutoComplete;
use yii\widgets\ActiveForm;

$eventUser->event_id = $model->id;
$btn_type = $model->getActionType();
$guest_list_showing = $model->guest_list_showing;
?>
<div class="panel-body">
<div class="show_event event-list-box">
  <div class="event-image" style="background-image:url('<?= Yii::$app->getModule('events')->getAssetsUrl() . '/images/'.$model->image; ?>')">
  </div>

  
  <div class="event-main-details">
    <img src="<?=Yii::$app->getModule('events')->getAssetsUrl() . '/images/calendar.png';?>">
    <h3>
      <a href="<?=Url::to(['/events/site/show-event', 'id' => $model->id])?>">
        <?=$model->name?>
      </a>
    </h3>
    <span><?=date('D, d M y', strtotime($model->date_time))?></span>
  </div>


    <div id="btn_holder_<?= $model->id; ?>" class="btn-holder">
    <button id="interested" class="btn <?= $btn_type == 'accepted' ? 'btn-success' : 'btn-info'; ?>" data-id="<?= $model->id; ?>">Interested</button>

    <button id="may_be" class="btn <?= $btn_type == 'may_be' ? 'btn-success' : 'btn-info'; ?>" data-id="<?= $model->id; ?>">May be</button>

    <button id="decline" class="btn <?= $btn_type == 'decline' ? 'btn-success' : 'btn-info'; ?>" data-id="<?= $model->id; ?>">Decline</button>
    <?php
    if ($model->canInvite()) {
        echo Html::button('Invite', ['class' => 'btn btn-info','data-toggle'=>'modal','data-target'=>'#inviteUser']);
    }
    ?>
    </div>

  <div id="detail_holder_<?= $model->id; ?>" class="event_detail">
    <p><?= $model->locations ?></p>
    <div class="btn-list">
    <span class="list"><?= Html::tag('span', $model->getInterested(), ['class' => $guest_list_showing == 1 ? 'interested_show interested_count' : 'interested_count','data-id' => $model->id]).' attending'; ?></span>
    <span class="list"><?= Html::tag('span', $model->getMayBe(), ['class' => $guest_list_showing == 1 ? 'may_be_show may_be_count' : 'may_be_count','data-id' => $model->id]).' may be'; ?></span>
    <span class="list"><?= Html::tag('span', $model->getDecline(), ['class' => $guest_list_showing == 1 ? 'declined_show declined_count' : 'declined_count','data-id' => $model->id]).' declined'; ?></span>
    </div>
  </div>
    <?= $model->description ?>
</div>
</div>

<!-- Modal starts-->
<div id="inviteUser" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Invite User</h4>
      </div>
      <div class="modal-body">
        <?php
        $form = ActiveForm::begin(['id' => 'userInviteForm', 'method' => 'post']);
        ?>
        <label>User Name</label>
        <?php
        echo AutoComplete::widget([
          'name' => 'event_user_name',
          'id' => 'event_user_name',
          'options' => ['class' => 'form-control',],
          'clientOptions' => [
            'appendTo'=>'#userInviteForm',
            'source' => $user_list,
            'autoFill'=>true,
            'select' => new JsExpression("function( event, ui ) {
              $('#eventusers-user_id').val(ui.item.id);
            }")
          ],
        ]);
        ?>
        <?= $form->field($eventUser, 'user_id')->hiddenInput()->label(false); ?>
        <?= $form->field($eventUser, 'event_id')->hiddenInput()->label(false); ?>
        <?php echo Html::submitButton('Send Request', array('class' => 'btn btn-primary send_request')); ?>
        <?php ActiveForm::end();?>
        <div class="alert alert-success success-flash" style="display:none;">
          <strong>Success!</strong> <span class='success-msg'></span>.
        </div>
        <div class="alert alert-danger error-flash" style="display:none;">
          <strong>Error!</strong> <span class='error-msg'></span>.
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal ends-->


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

  $(document).on('click','.send_request',function (e) {
    e.preventDefault();
    var site_url = "<?php echo Url::to(['/events/site/invite']); ?>";
    $.ajax({
      url: site_url,
      type: 'post',
      data: $('#userInviteForm').serialize(),
      success: function (response) {
        if (response.error) {
          $('.error-msg').html(response.message);
          $('.error-flash').show();
          setInterval(function(){
            $('.error-flash').hide();
          }, 3000);
        } else {
          $("#userInviteForm")[0].reset()
          $('.success-msg').html(response.message);
          $('.success-flash').show();
          setInterval(function(){
            $('.success-flash').hide();
          }, 3000);
        }
      }
    });
  });
</script>