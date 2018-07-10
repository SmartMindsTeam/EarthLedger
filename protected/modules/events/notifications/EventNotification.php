<?php

namespace humhub\modules\events\notifications;

use Yii;
use yii\bootstrap\Html;
use humhub\modules\notification\components\BaseNotification;
use yii\helpers\Url;

/**
 * If an user was invited to an Event, this notification is fired.
 *
 */
class EventNotification extends BaseNotification
{

    /**
     * @inheritdoc
     */
    public $moduleId = "events";

    public function html()
    {
        return 'You have an invitation to an event';
    }

    public function getUrl()
    {
        return \yii\helpers\Url::to(['/events/site/show-notification', ['event_id' => $this->source->event_id,'request_id' => $this->source->id,'invited_by' => $this->originator->id]]);
    }
}
