<?php

namespace humhub\modules\events\widgets;

use Yii;

class WallEntry extends \humhub\modules\content\widgets\WallEntry
{

    public $editRoute=false;
    public $showFiles=false;


    public function run()
    {
       
        return $this->render('wallentry', array('model' => $this->contentObject,
            'user' => $this->contentObject->content->user,
            'contentContainer' => $this->contentObject->content->container,
            ));
    }
}
