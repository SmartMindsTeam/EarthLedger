<?php

namespace humhub\modules\registration\models;

class RegistrationDetails extends \yii\db\ActiveRecord {

	public $phone;
	public $passport_id;
	public $profile_picture;

	public function rules() {

		return [
			[['phone', 'passport_id'], 'string', 'max' => 50],
			[['profile_picture'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],

		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'phone' => 'Phone Number',
			'passport_id' => 'Passport/ID',
			'profile_picture' => 'Facial Recognition',

		];
	}

}