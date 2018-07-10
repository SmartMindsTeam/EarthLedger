<?php
use humhub\modules\user\models\Group;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php
$session = Yii::$app->session;
$group_id = $session->get('account_type');
$groups = Group::find()->where(['id' => $group_id])->one();
?>
<div class="login-first-head">
<?=\humhub\widgets\SiteLogo::widget();?>
    <!-- <button id="cstm_top_signin">SIGN IN</button> -->
</div>
<div class="login-second-head">
<h3><?=$groups->name;?></h3>
</div>
<div class="container">

    <div class="row">
    	<div class="col-sm-6 col-sm-offset-3 login-min-height">
    		<div class="log-form-steps">
				<div class="form_step">2</div>
				<h4>step two : Information details</h4>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'method' => 'post'], 'action' => ['custom-registration/save-details']]);?>
 <?=$form->field($registration_details, 'phone')->textInput(['maxlength' => true, 'placeholder' => 'Type your phone number'])?>
 <?=$form->field($registration_details, 'passport_id')->textInput(['maxlength' => true, 'placeholder' => 'Type your passport/ID'])?>
 <?=$form->field($registration_details, 'profile_picture', ['template' => "<label class='control-label'>Facial Recognition</label><div class='input-box'>{input}<label for='registrationdetails-profile_picture'><span>Choose a file…</span></label></div>"])->fileInput()?>

 <?=Html::submitButton('SUBMIT', ['class' => 'btn'])?>
 <?php ActiveForm::end();?>
 <?=Html::a('skip for now', ['/dashboard/dashboard/index'], ['class' => 'back_btn']);?>

    	</div>
    </div>
</div>
</div>

<script>

'use strict';

;( function ( document, window, index )
{
	var inputs = document.querySelectorAll( '#registrationdetails-profile_picture' );
	Array.prototype.forEach.call( inputs, function( input )
	{
		var label	 = input.nextElementSibling,
			labelVal = label.innerHTML;

		input.addEventListener( 'change', function( e )
		{
			var fileName = '';
			if( this.files && this.files.length > 1 )
				fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
			else
				fileName = e.target.value.split( '\\' ).pop();

			if( fileName )
				label.querySelector( 'span' ).innerHTML = fileName;
			else
				label.innerHTML = labelVal;
		});
	});
}( document, window, 0 ));
</script>