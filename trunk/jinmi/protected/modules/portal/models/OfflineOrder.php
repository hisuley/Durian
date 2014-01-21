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
     * Define Const error code
     **/
    const ERROR_EXECUTION_FAILED = '2';
    const ERROR_ORDER_STATUS_IS_NOT_ONGOING = '3';

    /**
     * Define order's type
     **/
    const TYPE_VISA = 'visa';
    public static $typeIntl = array(self::TYPE_VISA => '签证');
    
    /**
     * Define payment's status
     **/
    const PAY_OK = 1;
    const PAY_NO = 0;
    
    /**
     * Define Global status of order
     **/
    const STATUS_NEW = "new_order";
    const STATUS_ONGOING = 'ongoing';
    const STATUS_COMPLETE = 'complete';
    const STATUS_ABORT = 'abort';
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
    const SUBSTATUS_VISA_REJECT = 'reject';
    public static $subStatus_visa = array(self::SUBSTATUS_VISA_NEW => '销售下单', self::SUBSTATUS_VISA_OPERATE_CONFIRM => '操作确认', self::SUBSTATUS_VISA_SENDER_CONFIRM => '送签人确认', self::SUBSTATUS_VISA_ISSUE_VISA => '出签', self::SUBSTATUS_VISA_SENDER_ISSUE_CONFIRM => '送签人确认', self::SUBSTATUS_VISA_VISA_SENT => '签证送出', self::SUBSTATUS_VISA_VISA_RECEIVED => '签证收到', self::SUBSTATUS_VISA_COMPLETE => '完成订单');
    /** Define the user's role's access **/
    public static $roleAccess = array(
        self::TYPE_VISA => array(
            User::ROLE_VISA_ADMIN => array(self::SUBSTATUS_VISA_NEW , self::SUBSTATUS_VISA_OPERATE_CONFIRM , self::SUBSTATUS_VISA_SENDER_CONFIRM , self::SUBSTATUS_VISA_ISSUE_VISA, self::SUBSTATUS_VISA_SENDER_ISSUE_CONFIRM, self::SUBSTATUS_VISA_VISA_SENT, self::SUBSTATUS_VISA_VISA_RECEIVED, self::SUBSTATUS_VISA_COMPLETE),
            User::ROLE_VISA_OPERATE => array(self::SUBSTATUS_VISA_NEW, self::SUBSTATUS_VISA_NEW)
            )
        );

    public static function operationList(){

    }
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
            $this->status = self::STATUS_NEW;
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
    public static function getList($params, $role){
        $criteria = new CDbCriteria;
        $criteria = self::filterByRole($role);
    }
    public static function filterByRole($role = User::ROLE_VISA_OPERATE){
        switch($role){
            case User::ROLE_VISA_OPERATE:
                break;
            case User::ROLE_VISA_ADMIN:
                break;
            case User::ROLE_VISA_COURIER:
                break;
            case User::ROLE_VISA_FINANCE;
                break;

        }
    }
    public static function getListByRole($role = ''){
        /***
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
        if(isset(self::$statusIntl[$status]))
            return self::$statusIntl[$status];
        else
            return '';
    }
    /**
     * Get the workflow of specific type order.
     * @param string $type the type of order
     * @return array 
     **/
    public static function workflow($type){
        switch($type){
            case self::TYPE_VISA:
                return array(
                    self::SUBSTATUS_VISA_NEW => array('true'=>self::SUBSTATUS_VISA_OPERATE_CONFIRM, 'false'=>self::SUBSTATUS_VISA_REJECT),
                    self::SUBSTATUS_VISA_OPERATE_CONFIRM => array('true' => self::SUBSTATUS_VISA_SENDER_CONFIRM, 'false'=>self::SUBSTATUS_VISA_REJECT),
                    self::SUBSTATUS_VISA_SENDER_CONFIRM => array('true' => self::SUBSTATUS_VISA_ISSUE_VISA, 'false' => self::SUBSTATUS_VISA_REJECT),
                    self::SUBSTATUS_VISA_ISSUE_VISA => array('true' => self::SUBSTATUS_VISA_VISA_SENT, 'fasle'=> self::SUBSTATUS_VISA_REJECT),
                    self::SUBSTATUS_VISA_VISA_SENT => array('true'=> self::SUBSTATUS_VISA_VISA_RECEIVED, 'fasle'=> self::SUBSTATUS_VISA_REJECT),
                    self::SUBSTATUS_VISA_VISA_RECEIVED => array('true' => self::SUBSTATUS_VISA_COMPLETE, 'fasle'=> self::SUBSTATUS_VISA_REJECT),
                    self::SUBSTATUS_VISA_COMPLETE => array('true'=> self::STATUS_COMPLETE, 'false' => self::SUBSTATUS_VISA_REJECT)             
                    );
                break;
        }
    }
    public static function getFinishStatus($type){
        $workflow = self::workflow($type);
        $status = key(array_slice($workflow, -1, 1, true));
        return $status;
    }
    /**
     * Get the next operation of current status
     * @param string $type the type of order
     * @param string $status current status
     * @param string $opinion verify opinion
     **/
    public static function getNextOperation($type, $status, $opinion){
        $workflow = self::workflow($type);
        $opinion = ($opinion == 'accept') ? 'true' : 'false';
        return $workflow[$status][$opinion];
    }
    /**
     * Main function
     * @param array $reviewData = array('type'=> '', 'opinion'=> '', 'memo'=> '', 'response'=> '', 'offline_order_id'=> '')
     * @return bool
     **/
    public static function execOperation($reviewData){
        if(isset($reviewData['offline_order_id']))
            $offlineOrder = self::model()->findByPk($reviewData['offline_order_id']);
        $workflow = self::workflow($offlineOrder->type);
        if(empty($workflow)){
            Yii::log('Executing the operation on specific order failed. workflow is empty.'.print_r($reviewData, true), 'error', 'portal');
            throw new CHttpException(500, '无法执行操作，找不到该订单类型的工作流信息。');
            return false;
        }
        $opinion = ($reviewData['opinion'] == 'accept') ? 'true' : 'false';
        if($reviewData['type'] != $workflow[$offlineOrder['sub_status']] && empty($reviewData['id'])){
            Yii::log('Executing the operation on specific order failed. This operation doesn\' fit the pre-defined workflow.'.print_r($reviewData, true), 'error', 'portal');
            throw new CHttpException(500, '无法执行操作，您的操作与工作流不符合。');
            return false;
        }
        if(empty($reviewData['id']))
            $review = new OfflineOrderReviewHistory;
        else
            $review = OfflineOrderReviewHistory::model()->findByPk($reviewData['id']);
        if(empty($review)){
            Yii::log('Executing the operation on specific order failed. Could not build review model.'.print_r($reviewData, true), 'error', 'portal');
            throw new CHttpException(500, '无法执行操作，审核功能出错。');
            return false;
        }
        $review->attributes = $reviewData;
        if($review->save()){
            $offlineOrder->sub_status = $review->type;
            if($offlineOrder->save())
                self::detectFinish($review->id);
                return true;
        }
        return false;
    }
    /**
     * Get the current progress of workflow
     * @param string $type the type of order
     * @param string $status the status of current order
     **/
    public static function getProgress($type, $status){
        $workflow = self::workflow($type);
        $pos = (array_search($status, $workflow)+1);
        $percent = floatval(intval($pos)/intval(count($workflow)))*100;
        return $percent;
    }
    /**
     * The way which deal with rejected progress
     * @param array $reviewData = array('id'=>'', 'opinion'=>'', 'response'=>'')
     * @param int @userId
     **/
    public static function doResponse($reviewData, $userId){
        if(empty($reviewData['id'])){
            Yii::log('Reviewing data failed, review id doesn\' provided.'.print_r($reviewData, true), 'error', 'portal');
            throw new CHttpException(500, '无法执行操作，无法获取审核id。');
            return false;
        }
        $review = OfflineOrderReviewHistory::model()->findByPk($reviewData['id']);
        if(empty($review)){
            Yii::log('Reviewing data failed, review id is invalid.'.print_r($reviewData, true), 'error', 'portal');
            throw new CHttpException(500, '无法执行操作，审核id无效。');
            return false;
        }
        if($reviewData['opinion'] == OfflineOrderReviewHistory::OPINION_ACCEPT){
            $review->opinion = OfflineOrderReviewHistory::OPINION_ACCEPT;
            $review->response = $reviewData['response'];
            if($review->save()){
                self::detectFinish($review->id);
                return true;
            }else{
                return false;
            }
        }elseif($reviewData['opinion'] == OfflineOrderReviewHistory::OPINION_REFUSE){
            self::model()->updateByPk($reviewData['offline_order_id'], array('status'=>self::STATUS_ABORT));
        }
        return true;
    }
    public static function detectFinish($reviewId){
        $review = OfflineOrderReviewHistory::model()->findByPk($reviewId);
        $offlineOrder = OfflineOrder::model()->findByPk($review->offline_order_id);
        $finalStatus = self::getFinishStatus($offlineOrder->type);
        if($review->type == $finalStatus && $review->opinion == OfflineOrderReviewHistory::OPINION_ACCEPT && $offlineOrder->pay_status == self::PAY_OK){
            self::finishOrder($offlineOrder->id);
            return true;
        }
        return false;
    }
    /**
     * Complete the order
     * @param int $orderId the order's id
     **/
    public static function finishOrder($orderId){
        $offlineOrder = self::model()->findByPk($orderId);
        if($offlineOrder->status != self::STATUS_ONGOING){
            Yii::log('Order status is not "Ongoing".'.print_r($orderId, true), 'error', 'portal');
            //throw new CHttpException(500, '订单的状态不是在进行中，无法结束订单。');
            return SELF::ERROR_ORDER_STATUS_IS_NOT_ONGOING;
        }
        if($offlineOrder->sub_status == self::getFinishStatus($offlineOrder['type'])){
            if($offlineOrder->pay_status == self::PAY_OK){
                $offlineOrder->status = self::STATUS_COMPLETE;
                if($offlineOrder->save()){
                    return true;
                }else
                    Yii::log('Order could not be saved.'.print_r($orderId, true), 'error', 'portal');
            }else{
                Yii::log('Order pay-status is not the paid state.'.print_r($orderId, true), 'error', 'portal');
            }
        }else{
            Yii::log('Order sub-status is not the finish state.'.print_r($orderId, true), 'error', 'portal');
            
        }
        return false;
    }
    /**
     * 
     * Payment Confirm
     * @param int $orderId the order's 
     **/
    public static function setPaid($orderId){
        return self::model()->updateByPk($orderId, array('pay_status'=>self::PAY_OK));
    }
}