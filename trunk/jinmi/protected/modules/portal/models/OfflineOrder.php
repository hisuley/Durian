<?php
/**
 * Created by Kimi Tourism.
 * @author Suley<luzhang@jmlvyou.com>
 * @time 13-10-11
 * @version 1.0
 * @copyright 
 **/

class OfflineOrder extends CActiveRecord{
    public $pay_status, $status, $sub_status, $amount;
    public $create_time;
    
    /**
     * Define order's type
     **/
    const TYPE_VISA = 'visa';
    public static $typeIntl = array(self::TYPE_VISA => '签证');
    
    /**
     * Define payment's status
     **/
    const PAY_OK = 1;
    const PAY_NO = 0
    
    /**
     * Define Global status of order
     * */
    const STATUS_NEW = 'new_order';
    const STATUS_ONGOING = 'ongoing';
    const STATUS_COMPLETE = 'complete';
    public static $statusIntl = array(self::STATUS_NEW => '下单成功',self::STATUS_ONGOING => '进行中', self::STATUS_COMPLETE => '订单完成');
    
    /** Sub order-status defination **/
    /**
     * Visa Order Sub-Status
     * 
     * 流程：销售下单(new_order)->
     *      操作确认(operate_confirm)->
     *      送签人确认(sender_confirm)->
     *      出签(issue_visa)->
     *      送签人确认(sender_issue_confirm)->
     *      送出(visa_sent)->
     *      确认收到(visa_received)->
     *      订单完成(complete)(需满足订单支付条件)
     * Define Visa Order Sub-Status **/

    const SUBSTATUS_VISA_NEW = 'new_order';
    const SUBSTATUS_VISA_OPERATE_CONFIRM = 'operate_confirm';
    const SUBSTATUS_VISA_SENDER_CONFIRM = 'sender_confirm';
    const SUBSTATUS_VISA_ISSUE_VISA = 'issue_visa';
    const SUBSTATUS_VISA_SENDER_ISSUE_CONFIRM = 'sender_issue_confirm';
    const SUBSTATUS_VISA_VISA_SENT = 'visa_sent';
    const SUBSTATUS_VISA_VISA_RECEIVED = 'visa_received';
    const SUBSTATUS_VISA_COMPLETE = 'complete';
    public static $subStatus_visa = array(self::SUBSTATUS_VISA_NEW => '销售下单', self::SUBSTATUS_VISA_OPERATE_CONFIRM => '操作确认', self::SUBSTATUS_VISA_SENDER_CONFIRM => '送签人确认', self::SUBSTATUS_VISA_ISSUE_VISA => '出签', self::SUBSTATUS_VISA_SENDER_ISSUE_CONFIRM => '送签人确认', self::SUBSTATUS_VISA_VISA_SENT => '签证送出', self::SUBSTATUS_VISA_VISA_RECEIVED => '签证收到', self::SUBSTATUS_VISA_COMPLETE => '完成订单');

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
          array('name, type, amount, total_price, pay_status, status, sub_status, user_id, create_time', 'safe')
        );
    }
    /**
     * Some useful action before saving the data 
     * 
     **/
    public function beforeSave(){
        if($this->isNewRecord){
            $this->create_time = strtotime('now');
            $this->status = self::STATUS_SUCCESS;
            $this->pay_status = self::PAY_NO;
            switch($this->type){
                case self::TYPE_VISA:
                    $this->sub_status = self::SUBSTATUS_VISA_NEW;
                    break;
            }
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
            $pos = array_search($status, $progress)+1;
        else
            $pos = count($progress);
        $percent = floatval(intval($pos)/intval(count($progress)))*100;
        return $percent;
    }
}