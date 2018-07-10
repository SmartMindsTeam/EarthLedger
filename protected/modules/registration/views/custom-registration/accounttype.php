<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="login-first-head">
<?=\humhub\widgets\SiteLogo::widget();?>
    <!-- <button id="cstm_top_signin">SIGN IN</button> -->
</div>
<div class="login-second-head">
</div>
<div class="container">

    <div class="row">
    	<div class="col-sm-6 col-sm-offset-3 login-min-height ">
		<div class="choose-account-box">
		<h4>Choose Your Account Type</h4>
    		<ul>
<?php foreach ($groups as $group) {
	$name = $group->name;
	$id = $group->id;
	?>
			<li><a href="javascript:void(0)" class="account_type" id='<?=$id?>'><?=$name?></a></li>
<?php }?>
</ul>
<!-- <a class="back_btn" href="#">Back</a> -->
<?=Html::a('back', ['/registration/custom-registration/backto-login'], ['class' => 'back_btn']);?>

		</div>
    	</div>
    </div>
</div>

<script type="text/javascript">

		$(document).on('click','.account_type',function (e) {
			e.preventDefault();
			 var site_url = "<?php echo Url::to(['/registration/custom-registration/set-session']); ?>";
			 var redirect_url = "<?php echo Url::to(['/registration/custom-registration/login-details']); ?>";
			 var value = $(this).attr('id');
			$.ajax({
      url: site_url,
      type: 'post',
      data: {value :value, _csrf: yii.getCsrfToken()},
      success: function (response) {
      	location.href = redirect_url;
      }
    });
		});

</script>