<?php

namespace humhub\modules\events;

use yii\web\AssetBundle;
use yii;

class Assets extends AssetBundle
{

    //public $dir= dirname __FILE__;

    public $sourcePath;
    public $css = [

        'css/events.css',
    ];
    public $js = [
        'js/events.js',
    ];

    public function init()
    {
        $baseurl = Yii::$app->request->baseUrl;
        $this->sourcePath = 'protected/modules/events/assets';
        parent::init();
    }

    public $depends = ['humhub\\assets\\AppAsset',];
}
