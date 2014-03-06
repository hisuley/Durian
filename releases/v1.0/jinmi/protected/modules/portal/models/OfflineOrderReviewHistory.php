<?php
/**
 * Created by Kimi Tourism.
 * @author Suley<luzhang@jmlvyou.com>
 * @time 13-10-11
 * @version 1.0
 * @copyright 
 **/

class OfflineOrderReviewHistory extends CActiveRecord{
    const TYPE_SUCCESS = 'order_success';
    const TYPE_OPERATE_VERIFY = 'operate_verify';
    const TYPE_FINANCE_VERIFY = 'finance_verify';
    const TYPE_SEND_VISA = 'send_visa';
    const TYPE_VISA_RESULT = 'visa_result';
    const TYPE_VISA_RETURN = 'visa_return';
    const TYPE_COMPLETE = 'complete';
    public static $typeIntl = array(
        self::TYPE_SUCCESS => '下单成功',
        self::TYPE_OPERATE_VERIFY => '操作审核',
        self::TYPE_FINANCE_VERIFY => '财务审核',
        self::TYPE_SEND_VISA => '送签',
        self::TYPE_VISA_RESULT => '出结果',
        self::TYPE_VISA_RETURN => '发回',
        self::TYPE_COMPLETE => '完成'
    );
    const OPINION_ACCEPT = 'accept';
    const OPINION_REFUSE = 'refuse';
    public $user_id, $type, $opinion, $memo, $response, $create_time, $offline_order_id;
    public static function model($className = __CLASS__){
        return parent::model($className);
    }
    public function beforeSave(){
        if($this->isNewRecord){
            $this->create_time = strtotime('now');
        }
        return true;
    }
    public function tableName(){
        return 'offline_order_review_history';
    }
    public function relations(){
        return array(
          'OfflineOrder' => array(self::BELONGS_TO, 'OfflineOrder', array('offline_order_id'=>'id'))
        );
    }
    public static function translateType($type){
        return self::$typeIntl[$type];
    }
    public function rules(){
        return array(
          array('user_id,type,opinion,memo,response,create_time,offline_order_id', 'safe')
        );
    }
    public static function getReviewData($id, $type = self::TYPE_SUCCESS){
        if(!empty($id)){
            $result = self::model()->findByAttributes(array('type'=>$type, 'offline_order_id'=>$id));
            if(!empty($result))
                return $result;
            else
                return false;
        }
        return false;
    }
    public static function getAllReviewData($id){
        $reviewList = array();
        foreach(self::$typeIntl as $key=>$value){
            $reviewList[$key] = self::getReviewData($id, $key);
        }
        return $reviewList;
    }

}