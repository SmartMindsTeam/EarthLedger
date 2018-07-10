<?php

use yii\widgets\ActiveForm;
use \humhub\compat\CHtml;
use \yii\helpers\html;

$this->pageTitle = Yii::t('UserModule.views_auth_login', 'Login');
?>
<div class="login-first-head">

    <button id="cstm_top_signin">SIGN IN</button>
</div>
<div class="login-second-head">
</div>

<div class="container">

    <div class="row">
        <div class="col-sm-6 col-sm-offset-3 login-min-height">
        <div class="animated bounceIn" id="login-form">
            <a class="login-logo" href="#"></a>
        <h2>WELCOME TO<br> EARTH LEDGER</h2>
    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger" role="alert">
            <?=Yii::$app->session->getFlash('error')?>
        </div>
    <?php endif;?>
<div id="custom_sign_inForm" class="custom_displayNone">
    <?php $form = ActiveForm::begin(['id' => 'account-login-form', 'enableClientValidation' => false]);?>
    <?=$form->field($model, 'username')->textInput(['id' => 'login_username', 'placeholder' => 'Username or Email', 'aria-label' => $model->getAttributeLabel('username')])->label(false);?>
    <?=$form->field($model, 'password')->passwordInput(['id' => 'login_password', 'placeholder' => 'Password', 'aria-label' => $model->getAttributeLabel('password')])->label(false);?>

            <?=CHtml::submitButton(Yii::t('UserModule.views_auth_login', 'Log In'), array('id' => 'login-button', 'data-ui-loader' => "", 'class' => ''));?>

    <?php ActiveForm::end();?>
    </div>
    <?php
if (Yii::$app->hasModule('registration')) {?>
	<?=Html::a('SIGN UP', ['/registration/custom-registration/index'], ['class' => 'btn custom_sign_upBtn']);?>
<?php }
?>

</div>
        </div>
    </div>



</div>

<script type="text/javascript">
    $(function () {
        // set cursor to login field
        $('#login_username').focus();
    });

    // Shake panel after wrong validation
<?php if ($model->hasErrors()) {?>
        $('#login-form').removeClass('bounceIn');
        $('#login-form').addClass('shake');
        $('#register-form').removeClass('bounceInLeft');
        $('#app-title').removeClass('fadeIn');
<?php }?>

    // Shake panel after wrong validation
<?php if ($invite->hasErrors()) {?>
        $('#register-form').removeClass('bounceInLeft');
        $('#register-form').addClass('shake');
        $('#login-form').removeClass('bounceIn');
        $('#app-title').removeClass('fadeIn');
<?php }?>

$(document).on('click','#cstm_top_signin',function(){
    $('#custom_sign_inForm').show();
    $('#custom_sign_upBtn').hide();
});

</script>


