<?php
/**
 * Created by Kimi Tourism.
 * @author Suley<luzhang@jmlvyou.com>
 * @time 13-10-11
 * @version 1.0
 * @copyright 
 **/

class OfflineOrderReviewHistory extends CActiveRecord{
    public $user_id, $type, $opinion, $memo, $response, $create_time, $offline_order_id;
    public static function model($className = __CLASS__){
        return parent::model($className);
    }
    public function tableName(){
        return 'offline_order_review_history';
    }
    public function relations(){
        return array(
          'OfflineOrder' => array(self::BELONGS_TO, 'OfflineOrder', array('offline_order_id'=>'id'))
        );
    }
    public function rules(){
        return array(
          array('user_id,type,opinion,memo,response,create_time,offline_order_id', 'safe')
        );
    }

}