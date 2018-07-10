<?php

namespace humhub\modules\custom_post;

use yii\web\AssetBundle;
use yii;

class Assets extends AssetBundle
{

    //public $dir= dirname __FILE__;

    public $sourcePath;
    public $css = [

        'css/custom_post.css',
        'css/bootstrap-tagsinput.css',
    ];
    public $js = [
        'js/bootstrap-tagsinput.js',
    ];

    public function init()
    {
        $baseurl = Yii::$app->request->baseUrl;
        $this->sourcePath = 'protected/modules/custom_post/assets';
        parent::init();
    }

    public $depends = ['humhub\\assets\\AppAsset',];
}
