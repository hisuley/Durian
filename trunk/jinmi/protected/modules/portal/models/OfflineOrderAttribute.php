<?php
/**
 * Created by Kimi Tourism.
 * @author Suley<luzhang@jmlvyou.com>
 * @time 13-10-11
 * @version 1.0
 * @copyright 
 **/

class OfflineOrderAttribute extends CActiveRecord{
    public static function model($className = __CLASS__){
        return parent::model($className);
    }
    public function tableName(){
        return 'offline_order_attributes';
    }
    public function relations(){
        return array(
            'OfflineOrder' => array(self::BELONGS_TO, 'OfflineOrder', 'offline_order_id')
        );
    }
    public function rules(){
        return array(
          array('attr_name, value, extend, create_time, offline_order_id', 'safe')
        );
    }

}