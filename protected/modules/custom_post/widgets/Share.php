<?php

namespace humhub\modules\custom_post\widgets;

use humhub\components\Widget;
use Yii;

class Share extends \humhub\modules\content\widgets\WallEntryLinks
{
    public function run()
    {
        return $this->render('_share');
    }
}
