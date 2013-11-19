<?php
/**
 * Created by Kimi Tourism.
 * @author Suley<luzhang@jmlvyou.com>
 * @time 13-10-11
 * @version 1.0
 * @copyright 
 **/

class OfflineOrder extends CActiveRecord{
    public $pay_status, $status, $amount;
    public $create_time;
    const STATUS_SUCCESS = 'order_success';
    const STATUS_PROFILE_RECEIVED = 'profile_received';
    const STATUS_VERIFYING = 'verifying';
    const STATUS_REJECT = 'reject';
    const STATUS_SEND_VISA = 'send_visa';
    const STATUS_PROFILE_INCOMPLETE = 'profile_incomplete';
    const STATUS_SEND_BACK = 'send_back';
    const STATUS_VISA_RETURN = 'visa_return';
    const STATUS_COMPLETE = 'complete';
    const STATUS_FINANCE_VERIFY = 'finance_verify';
    const STATUS_OPERATE_VERIFY = 'operate_verify';
    const STATUS_ACCEPT = 'accept';
    private static $statusIntl = array(
        self::STATUS_SUCCESS => '下单成功',
        self::STATUS_OPERATE_VERIFY => '操作审核',
        self::STATUS_FINANCE_VERIFY => '财务审核',
        self::STATUS_PROFILE_INCOMPLETE => '资料不全，退回',
        self::STATUS_PROFILE_RECEIVED => '收到资料',
        self::STATUS_REJECT => '拒签',
        self::STATUS_ACCEPT => '出签',
        self::STATUS_SEND_BACK => '已寄回',
        self::STATUS_VERIFYING => '资料审核',
        self::STATUS_SEND_VISA => '送签',
        self::STATUS_VISA_RETURN => '归还',
        self::STATUS_COMPLETE => '完结'
    );

    public static function model($className = __CLASS__){
        return parent::model($className);
    }
    public function tableName(){
        return 'offline_order';
    }
    public function relations(){
        return array(
          'attrs' => array(self::HAS_MANY, 'OfflineOrderAttribute', 'offline_order_id'),
          'review' => array(self::HAS_MANY, 'OfflineOrderReviewHistory', 'offline_order_id')
        );
    }
    public function rules(){
        return array(
          array('name, type, amount, total_price, pay_status, status, user_id, create_time', 'safe')
        );
    }
    public function beforeSave(){
        if($this->isNewRecord){
            $this->create_time = strtotime('now');
            $this->status = self::STATUS_SUCCESS;
            $this->pay_status = 'paid';
        }
        return true;
    }

    public static function setStatus($id, $status){

    }
    public static function getListByRole($role = ''){
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
    public static function translateStatus($status){
        return self::$statusIntl[$status];
    }
    public static function getProgress($status){
        $progress = array(self::STATUS_SUCCESS, self::STATUS_OPERATE_VERIFY, self::STATUS_FINANCE_VERIFY, self::STATUS_SEND_VISA, self::STATUS_ACCEPT, self::STATUS_VISA_RETURN, self::STATUS_COMPLETE);
        if(in_array($status, $progress))
            $pos = array_search($status, $progress);
        else
            $pos = count($progress);
        $percent = floatval(intval($pos)/intval(count($progress)))*100;
        return $percent;
    }
}