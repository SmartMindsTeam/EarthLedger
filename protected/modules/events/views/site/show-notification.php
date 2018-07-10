<?php
use yii\helpers\Url;
?>
<div class="show-notification">
  <p>
    <?= $invited_by; ?> invited to join an event.
  </p> 
  <button class="btn btn-success accept_invite">Accept</button>
</div>
<script type="text/javascript">
  $(document).on('click','.accept_invite',function (e) {
    var site_url = "<?php echo Url::to(['/events/site/accept-invite']); ?>";
    var id = "<?= $request_id; ?>";
    $.ajax({
      url: site_url,
      type: 'post',
      data: {id: id, _csrf: yii.getCsrfToken()},
      success: function (response) {
        if (response.error) {
          alert('Something went wrong. Failed to join. Try again.');
        } else {
          window.location.href=response.url;
        }
      }
    });
  });
</script>