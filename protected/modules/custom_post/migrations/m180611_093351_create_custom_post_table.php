<?php

use yii\db\Migration;

/**
 * Handles the creation of table `custom_post`.
 */
class m180611_093351_create_custom_post_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableSchema = Yii::$app->db->schema->getTableSchema('custom_post');
        if ($tableSchema == null) {
            $this->createTable('custom_post', [
                'id' => $this->primaryKey(),
                'type' => 'ENUM("challenge","solution","news","product","custom") DEFAULT "challenge"',
                'description' => 'text',
                'location' => 'varchar(255)',
                'support_document' => 'varchar(255)',
                'tags' => 'varchar(255)',
                'connections' => 'varchar(255)',
                'stream' => 'ENUM("ocean","land","river","air") DEFAULT "ocean"',
                'price' => 'int(11)',
                'in_mind' => 'text',
                'connect_challenge' => 'varchar(255)',
                'link' => 'varchar(255)',
                'product_type' => 'varchar(255)',
                'challenge_name' => 'varchar(255)',
                'created_at' => 'int(11) NOT NULL',
                'updated_at' => 'int(11) NOT NULL',
                'created_by' => 'int(11) NOT NULL',
                'updated_by' => 'int(11) NOT NULL',
            ]);
        }
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('custom_post');
    }
}
