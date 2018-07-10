<?php
use humhub\modules\user\models\Group;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php
$session = Yii::$app->session;

$group_id = $session->get('account_type');
$groups = Group::find()->where(['id' => $group_id])->one();
//print_r($groups);exit();
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
				<div class="form_step">1</div>
				<h4>step one : login details</h4>


<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'method' => 'post'], 'action' => ['custom-registration/register']]);?>
 <?=$form->field($model, 'first_name')->textInput(['maxlength' => true, 'placeholder' => 'Type your first name'])?>
 <?=$form->field($model, 'last_name')->textInput(['maxlength' => true, 'placeholder' => 'Type your last name'])?>
 <?=$form->field($model, 'username')->textInput(['maxlength' => true, 'placeholder' => 'Type your username'])?>
 <?=$form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Type your email address'])?>
 <?=$form->field($model, 'password')->passwordInput(['maxlength' => true, 'placeholder' => 'Type your password'])?>
 <?=$form->field($model, 'confirm_password')->passwordInput(['maxlength' => true, 'placeholder' => 'Type your password'])?>
 <?=Html::submitButton('REGISTER', ['class' => 'btn'])?>
 <!-- <a class="back_btn" href="#">Back</a> -->
 <?=Html::a('back', ['/registration/custom-registration/index'], ['class' => 'back_btn']);?>
 <?php ActiveForm::end();?>
			</div>

    	</div>
    </div>
</div>