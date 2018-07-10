<?php

use yii\db\Migration;

class uninstall extends Migration
{

    public function up()
    {
        $this->dropTable('events');
        $this->dropTable('event_users');
    }

    public function down()
    {
        echo "uninstall does not support migration down.\n";
        return false;
    }
}
