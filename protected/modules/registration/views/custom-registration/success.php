<?php
use yii\helpers\Html;
?>
<div class="thankyou-popup">
  <div class="bg-box">
  <!-- <a href="#" class="close popup-close">x</a> -->
  <div class="form_step">i</div>
  <p>Thank you for joining the Earth Ledger Community.<br>
Your documents have been received and processed<br>
please feel free to browse and contribute to the community.</p>
<?=Html::a('enter', ['/dashboard/dashboard/index'], ['class' => 'back_btn']);?>
  </div>
</div>