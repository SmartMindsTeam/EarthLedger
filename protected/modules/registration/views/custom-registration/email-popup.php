<?php
use yii\helpers\Url;

?>

<div class="thankyou-popup">
  <div class="bg-box">
  <a href="#" class="close popup-close">x</a>
  <div class="form_step">i</div>
  <p>Thank you for joining the Earth Ledger Community.<br>
Please check your email address and<br>
follow the next step of verification.</p>
  </div>
</div>
<script type="text/javascript">
  $(document).on('click','.popup-close',function (e) {
      e.preventDefault();
      var redirect_url = "<?php echo Url::to(['/dashboard/dashboard']); ?>";
      location.href = redirect_url;
    });
</script>