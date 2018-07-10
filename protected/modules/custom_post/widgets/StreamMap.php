<?php

namespace humhub\modules\custom_post\widgets;

use humhub\components\Widget;
use humhub\modules\custom_post\models\CustomPost;
use humhub\modules\user\models\User;
use Yii;

class StreamMap extends Widget {
	public function run() {
		$model = new CustomPost();
		$air_count = CustomPost::find()->where(['type' => 'challenge'])->andWhere(['stream' => 'air'])->andWhere(['created_by' => Yii::$app->user->id])->count();
		$land_count = CustomPost::find()->where(['type' => 'challenge'])->andWhere(['stream' => 'land'])->andWhere(['created_by' => Yii::$app->user->id])->count();
		$ocean_count = CustomPost::find()->where(['type' => 'challenge'])->andWhere(['stream' => 'ocean'])->andWhere(['created_by' => Yii::$app->user->id])->count();
		$river_count = CustomPost::find()->where(['type' => 'challenge'])->andWhere(['stream' => 'river'])->andWhere(['created_by' => Yii::$app->user->id])->count();
		return $this->render('stream_map', ['air_count' => $air_count, 'land_count' => $land_count, 'ocean_count' => $ocean_count, 'river_count' => $river_count]);
	}
}

?>