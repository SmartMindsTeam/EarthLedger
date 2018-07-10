<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\datetime\DateTimePicker;

$form = ActiveForm::begin(['id' => 'event-sumitForm', 'method' => 'post', 'options' => ['enctype'=>'multipart/form-data'],]);
?>
<?php
if ($model->image) {
    ?>
  <div id="event_prev_holder">
    <img src="<?= Yii::$app->getModule('events')->getAssetsUrl() . '/images/' . $model->image; ?>" class="event_prev_img">
  </div>
<?php
}
echo $form->field($model, 'image', [ 'options' => ['class' => 'no-padding']])
->widget(FileInput::classname(), [
  'options' => [
    'accept' => 'image/*',
  ],
  'pluginOptions' => [
    'showCaption' => false,
    'showCancel' => true,
    'showRemove' => false,
    'showUpload' => false,
                //'browseLabel' => 'Bild Bläddra',
  ],
  'pluginEvents' => [
    'fileloaded' => 'function(event, file, previewId, index, reader) { 
        $("#event_prev_holder").addClass("displayNone");
    }',
  ],
])
->label(false);  ?>
<?= $form->field($model, 'name')->textInput(); ?>   
<?= $form->field($model, 'date_time')->widget(DateTimePicker::class, [
    //'language' => 'ru',
    //'dateFormat' => 'yyyy-MM-dd',
]) ?> 
<?= $form->field($model, 'locations')->textInput(); ?> 

<?= $form->field($model, 'description')->textArea(['rows' => '6']) ?>  
<?= $form->field($model, 'guest_can_invite')->checkbox(); ?> 
<?= $form->field($model, 'guest_list_showing')->checkbox(); ?> 
<?php echo Html::submitButton('Submit', array('class' => 'btn btn-info')); ?>

<?php ActiveForm::end();

