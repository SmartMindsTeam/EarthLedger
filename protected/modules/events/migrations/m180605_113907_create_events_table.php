<?php

use yii\db\Migration;

/**
 * Handles the creation of table `events`.
 */
class m180605_113907_create_events_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableSchema = Yii::$app->db->schema->getTableSchema('events');
        if ($tableSchema == null) {
            $this->createTable('events', [
                'id' => $this->primaryKey(),
                'name' => 'varchar(255) NOT NULL',
                'image' => 'varchar(255) DEFAULT NULL',
                'locations' => 'varchar(255) NOT NULL',
                'date_time' => 'datetime NOT NULL',
                'description' => 'text NOT NULL',
                'guest_can_invite' => 'TINYINT NOT NULL DEFAULT 1',
                'guest_list_showing' => 'TINYINT NOT NULL DEFAULT 1',
                'created_at' => 'int(11) NOT NULL',
                'updated_at' => 'int(11) NOT NULL',
                'created_by' => 'int(11) NOT NULL',
                'updated_by' => 'int(11) NOT NULL',
            ]);
            $this->addForeignKey('fk-events-created_by', 'events', 'created_by', 'user', 'id', 'CASCADE', 'CASCADE');
        }
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('events');
    }
}
