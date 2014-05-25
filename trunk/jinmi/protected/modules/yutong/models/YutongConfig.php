<?php
/**
 * @project: trunk
 * @file: YutongConfig.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-5-8
 * @time: 下午6:57
 * @version: 1.0
 */


class YutongConfig extends CActiveRecord{
    public static function model($className = __CLASS__){
        return parent::model($className);
    }
    public function tableName(){
        return "yutong_configs";
    }
    public function rules(){
        return array(
          array('meta_name,meta_value,parent_id', 'safe')
        );
    }
    public function beforeSave(){
        if($this->isNewRecord){
            $this->create_time = strtotime('now');
        }
        return parent::beforeSave();
    }
}