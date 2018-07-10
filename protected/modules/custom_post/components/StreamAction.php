<?php
/**
 * Created by PhpStorm.
 * User: thetatechnolabs
 * Date: 09/07/18
 * Time: 5:48 PM
 */
namespace humhub\modules\custom_post\components;

use humhub\modules\custom_post\models\CustomPost;
use humhub\modules\stream\actions\ContentContainerStream;
use yii\helpers\ArrayHelper;

class StreamAction extends ContentContainerStream
{
    public function setupFilters()
    {

        // Limit output to specific content type
        $this->activeQuery->andWhere(['content.object_model' => CustomPost::className()]);
        $str_filter = [];
        $sf = '';
            //Air stream filter
        if(in_array('air',$this->filters)){
            if(!empty($this->getVaulesForStream('air')))
                array_push($str_filter,' content.object_id IN ('. implode(',',$this->getVaulesForStream('air')).')');
            else
                array_push($str_filter,' content.object_id IN (0) ');
        }
        //Ocean stream filter
        if(in_array('ocean',$this->filters)){
            if(!empty($this->getVaulesForStream('ocean')))
                array_push($str_filter , ' content.object_id IN ('. implode(',',$this->getVaulesForStream('ocean')).')');
            else
                array_push($str_filter,' content.object_id IN (0) ');
        }
        //Land stream filter
        if(in_array('land',$this->filters)){
            if(!empty($this->getVaulesForStream('land')))
                array_push($str_filter,' content.object_id IN ('. implode(',',$this->getVaulesForStream('land')).')');
            else
                array_push($str_filter,' content.object_id IN (0) ');
        }
        // stream filter
        if(in_array('river',$this->filters)){
            if(!empty($this->getVaulesForStream('river')))
                array_push($str_filter,' content.object_id IN ('. implode(',',$this->getVaulesForStream('river')).') ');
            else
                array_push($str_filter,' content.object_id IN (0) ');
        }

        //print_r(count($str_filter));die;
        for($i=0;$i < count($str_filter); $i++){
            if(count($str_filter)-1 == $i){
                $sf .= $str_filter[$i];
            }else{
                $sf .= $str_filter[$i].' OR ';
            }

        }
       $this->activeQuery->andWhere($sf);
    }

    protected function getVaulesForStream($stream){
        $rows = CustomPost::find()->select('id')->where(['stream'=>$stream])->asArray()->all();
        $row_array = [];
        if(!empty($rows)){
            foreach ($rows as $row){
                array_push($row_array,$row['id']);
            }
        }
          return $row_array;

    }
}