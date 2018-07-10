<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="container">

    <div class="row">
    	<div class="col-sm-6 col-sm-offset-3 login-min-height">

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'method' => 'post'], 'action' => ['custom-registration/save-details']]);?>
 <?=$form->field($registration_details, 'phone')->textInput(['maxlength' => true])?>
 <?=$form->field($registration_details, 'passport_id')->textInput(['maxlength' => true])?>
 <?=$form->field($registration_details, 'profile_picture')->fileInput()?>

 <?=Html::submitButton('SUBMIT', ['class' => 'btn'])?>
 <?php ActiveForm::end();?>
 <?=Html::a('Skip', ['/dashboard/dashboard/index'], ['class' => '']);?>

    	</div>
    </div>
</div>