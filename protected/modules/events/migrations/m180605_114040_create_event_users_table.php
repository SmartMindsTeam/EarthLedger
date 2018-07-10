<?php

use yii\db\Migration;

/**
 * Handles the creation of table `event_users`.
 */
class m180605_114040_create_event_users_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableSchema = Yii::$app->db->schema->getTableSchema('event_users');
        if ($tableSchema == null) {
            $this->createTable('event_users', [
                'id' => $this->primaryKey(),
                'event_id' => 'int(11) NOT NULL',
                'user_id' => 'int(11) NOT NULL',
                'status' => 'int(11) NOT NULL',
            ]);
            $this->addForeignKey('fk-event_users-event_id', 'event_users', 'event_id', 'events', 'id', 'CASCADE', 'CASCADE');
            $this->addForeignKey('fk-event_users-user_id', 'event_users', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        }
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('event_users');
    }
}
