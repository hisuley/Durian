<?php
/**
 * Created by Kimi Tourism.
 * @author Suley<luzhang@jmlvyou.com>
 * @time 13-10-11
 * @version 1.0
 * @copyright 
 **/

class OfflineOrder extends CActiveRecord{
    public $pay_status, $status;
    public $create_time;
    const STATUS_SUCCESS = 'order_success';
    const STATUS_OPERATE_VERIFY = 'operate_verify';
    const STATUS_FINANCE_VERIFY = 'finance_verify';
    const STATUS_SEND_VISA = 'send_visa';
    const STATUS_VISA_RESULT = 'visa_result';
    const STATUS_VISA_RETURN = 'visa_return';
    const STATUS_COMPLETE = 'complete';
    public static function model($className = __CLASS__){
        return parent::model($className);
    }
    public function tableName(){
        return 'offline_order';
    }
    public function relations(){
        return array(
          'attributes' => array(self::HAS_MANY, 'OfflineOrderAttribute', 'offline_order_id'),
          'review' => array(self::HAS_MANY, 'OfflineOrderReviewHistory', 'offline_order_id')
        );
    }
    public function rules(){
        return array(
          array('name, type, amount, total_price, pay_status, status, user_id, create_time', 'safe')
        );
    }

    public static function setStatus($id, $status){

    }
    public static function getListByRole($role){
        /**
        switch($role){
            case User::ROLE_VISA_ADMIN:
                $result = self::model()->findAll();
                break;
            case User::ROLE_VISA_COURIER:
                $result = self::model()->findAllByAttributes(array('status'=>self::STATUS_FINANCE_VERIFY));
                break;
            case User::ROLE_VISA_OPERATE;
                $result = self::model()->findAll();
        }
         **/
        $result = self::model()->findAll();
        return $result;
    }
}