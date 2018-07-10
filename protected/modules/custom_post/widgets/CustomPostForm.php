<?php

namespace humhub\modules\custom_post\widgets;

use Yii;
use yii\helpers\ArrayHelper;
use humhub\modules\user\models\User;
use humhub\modules\like\models\Like;
use humhub\modules\custom_post\models\CustomPost;

class CustomPostForm extends \yii\base\Widget
{

    public function run()
    {
        $model = new CustomPost();
        $user_list = ArrayHelper::map(User::find()->where(['visibility' => 1])->all(), 'displayName', 'displayName');
        $query = Like::find()->select('object_id')->where(['object_model' => 'humhub\modules\custom_post\models\CustomPost'])->andWhere(['created_by' => Yii::$app->user->id]);
        $challenge_list = ArrayHelper::map(CustomPost::find()->where(['type' => 'challenge'])->andWhere(['id' => $query])->all(), 'id', 'challenge_name');
        return $this->render('_custom_post_form', ['model' => $model,'user_list' => $user_list,'challenge_list' => $challenge_list]);
    }
}
