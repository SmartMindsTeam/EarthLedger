<?php

namespace humhub\modules\custom_post\widgets;

use Yii;

class WallEntry extends \humhub\modules\content\widgets\WallEntry
{

    public $editRoute=false;
    public $showFiles=true;


    public function run()
    {
       
        return $this->render('wallentry', array('model' => $this->contentObject,
            'user' => $this->contentObject->content->user,
            'contentContainer' => $this->contentObject->content->container,
            ));
    }
}
