<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

?>

    <div class="panel-heading">
      <strong>Events</strong>
    </div>
    <div class="panel-body event-box">

       <div class="right-btn"> <?=Html::a('Add Event', ['add-event'], ['class' => 'btn btn-info'])?> </div>

        <?=

        ListView::widget([

        'dataProvider' => $dataProvider,

        'itemView' => function ($model, $key, $index, $widget) {
            ?>

            <div class="event-list-box">
            <a class="event-image" href="<?=Url::to(['show-event', 'id' => $model->id])?>" style="background-image:url('<?=Yii::$app->getModule('events')->getAssetsUrl() . '/images/' . $model->image;?>')">
              </a>
                <?php
                if ($model->created_by == Yii::$app->user->id) {
                    echo Html::a('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', ['edit-event','id'=>$model->id], ['class'=>'event-edit-btn']);
                }
                    ?>
                  <div class="event-main-details">
                  <div class="event_date">
                    <span><?=date('M', strtotime($model->date_time))?></span>
                <span><?=date('d', strtotime($model->date_time))?></span>
                
                  </div>
                  <h3><?=$model->name?></h3>
                  </div>
                  <div class="event_detail">
                <p class="date"><?=date('D, d M y', strtotime($model->date_time))?></p>
                <p class="location"><?=$model->locations?></p>
                <p class="interest"><?=$model->getInterested() . ' people interested';?></p>
                  </div>

                </div>
                <?php
        },

    'summary' => '',

    'pager' => [

        'firstPageLabel' => 'first',

        'lastPageLabel' => 'last',

        'nextPageLabel' => 'next',

        'prevPageLabel' => 'previous',

        'maxButtonCount' => 3,

    ],

        ]);

?>


    </div>


