<?php

namespace humhub\modules\registration\models;

class Register extends \yii\db\ActiveRecord {

	public static function tableName() {
		return 'register';
	}

	public function rules() {

		return [
			[['username', 'first_name', 'last_name', 'email', 'password', 'confirm_password'], 'required'],
			[['username'], 'string', 'max' => 50],
			[['email'], 'unique'],
			[['email'], 'email'],
			[['group_id'], 'integer'],
			[['email', 'password', 'confirm_password', 'first_name', 'last_name', 'token'], 'string', 'max' => 254],
			[['username'], 'unique'],

		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'username' => 'Username',
			'email' => 'Email',
			'password' => 'Password',
			'confirm_password' => 'Confirm Password ',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',

		];
	}

}