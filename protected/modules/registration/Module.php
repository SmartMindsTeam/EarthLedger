<?php

namespace humhub\modules\registration;

use humhub\modules\user\models\User;

/**

 * Custom Post module definition class

 */

class Module extends \humhub\components\Module {
	/**

	 * @inheritdoc

	 */

	public $controllerNamespace = 'humhub\modules\registration\controllers';

	/**

	 * @inheritdoc

	 */

	public function init() {

		parent::init();
	}

	public function getContentContainerTypes() {
		return [
			User::className(),
		];
	}

	public function disable() {

		parent::disable();
	}

	/**
	 * @inheritdoc
	 */

	public function enable() {
		parent::enable();
	}
}
