<?php

use yii\db\Migration;

/**
 * Handles the creation of table `register`.
 */
class m180703_094705_create_register_table extends Migration {
	/**
	 * @inheritdoc
	 */
	public function up() {
		$this->createTable('register', [
			'id' => $this->primaryKey(),
			'username' => 'varchar(255)',
			'email' => 'varchar(255)',
			'first_name' => 'varchar(255)',
			'last_name' => 'varchar(255)',
			'password' => 'varchar(255)',
			'confirm_password' => 'varchar(255)',
			'token' => 'varchar(255)',
			'group_id' => 'int(11)',
		]);
	}

	/**
	 * @inheritdoc
	 */
	public function down() {
		$this->dropTable('register');
	}
}
