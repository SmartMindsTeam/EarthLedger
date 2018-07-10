<?php

namespace humhub\modules\custom_post\widgets;

use Yii;
use humhub\components\Widget;

/**
 * SearchWidget display the search in the EarthLedger theme
 *
 * @author Luke
 */
class SearchWidget extends Widget
{

    /**
     * @inheritdoc
     */
    public function run()
    {
        if (Yii::$app->user->isGuest && !\humhub\modules\user\components\User::isGuestAccessEnabled()) {
            return;
        }

        return $this->render('search');
    }
}
