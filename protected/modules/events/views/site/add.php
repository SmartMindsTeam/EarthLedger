<div class="panel-heading">
  <strong>Add Events</strong>        
</div>
<div class="panel-body"> 
  <div class="event-list-box">
    <?php if (Yii::$app->session->hasFlash('failed')) : ?>
    <div class="alert alert-danger alert-dismissable">
      <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
      <h4><i class="icon fa fa-check"></i>Saved!</h4>
        <?= Yii::$app->session->getFlash('failed') ?>
    </div>
    <?php endif; ?> 
    <?= $this->render('_form', ['model' => $model]) ?>  
  </div> 

</div>

