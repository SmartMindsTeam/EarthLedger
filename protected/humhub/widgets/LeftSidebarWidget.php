<?php
namespace humhub\widgets;


class LeftSidebarWidget extends \yii\base\Widget
{


    public function run()
    {
            $user = \Yii::$app->user->getIdentity();
            return $this->render('left_sidebar_widget',['user'=>$user]);
    }

}