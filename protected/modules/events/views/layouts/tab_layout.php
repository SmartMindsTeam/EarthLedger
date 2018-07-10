<?php

use humhub\modules\events\Assets;

Assets::register($this);

?>
<div class="container">
    <div class="row">
<div class="col-sm-8 col-sm-offset-2 bg-panel min-height">
  <div class="panel panel-default">
        <?php echo $content; ?>
</div>
</div>
    </div>
</div>

