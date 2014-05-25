<?php
/**
 * Created by Suley.
 * @author: suley<dearsuley@gmail.com>
 * @date: 3/6/14
 * @time: 5:37 PM
 */

class Finance extends CActiveRecord{
    const TYPE_ORDER = 'order';
    const TYPE_UNRELATED = 'unrelated';
    const TYPE_CUSTOMER = 'customer';
    const STATUS_FIRST_APPLY = 'first_apply';
    const STATUS_APPROVED = 'approved';
    const STATUS_WAIT_RESUBMIT = 'wait_for_resubmit';
    const STATUS_DONTRESUBMIT = 'dont_resubmit';
    const STATUS_DISCARD = 'discard';
    const DIRECTION_POSITIVE = '+';
    const DIRECTION_NEGATIVE = '-';
    public static $statusIntl = array(
      self::STATUS_FIRST_APPLY => '财务审核',
      self::STATUS_APPROVED => '审核通过',
      self::STATUS_DISCARD => '撤销请求',
      self::STATUS_WAIT_RESUBMIT => '重新提交',
      self::STATUS_DONTRESUBMIT => '禁止提交',
    );
    public static $typeIntl = array(
      self::TYPE_ORDER => '收款',
      self::TYPE_CUSTOMER => '请款'
    );
    public $order_id, $transaction_value, $direction, $memo, $status;
    public static function model($className = __CLASS__){
        return parent::model($className);
    }
    public function tableName(){
        return 'panel_finance_records';
    }
    public function rules(){
        return array(
            array('type, handler, reviewer, charge_account_id, charge_record_id, pay_file2, pay_file3, pay_file4, pay_file5', 'safe'),
            array('status, transaction_value', 'required'),
            array('transaction_value', 'numerical'),
            array('direction', 'in', 'range'=>array(self::DIRECTION_NEGATIVE, self::DIRECTION_POSITIVE)),
            array('memo', 'length', 'min'=>1, 'max'=>2048),
            array('status', 'in', 'range'=>array(self::STATUS_APPROVED, self::STATUS_DONTRESUBMIT, self::STATUS_FIRST_APPLY, self::STATUS_WAIT_RESUBMIT, self::STATUS_DISCARD)),
        );
    }

    public function attributeLabels(){
        return array(
          'charge_account_id'=>'账户'
        );
    }

    public function relations(){
        return array(
            'items'=>array(self::HAS_MANY, 'FinanceItems', 'order_id'),
            'user'=>array(self::BELONGS_TO, 'PanelUser', 'handler'),
            'review_user'=>array(self::BELONGS_TO, 'PanelUser', 'reviewer'),
            'reviews'=>array(self::HAS_MANY, 'FinanceReview', 'order_id'),
            'charge_account'=>array(self::BELONGS_TO, 'PanelBankAccount', 'charge_account_id'),
            'charge_record'=>array(self::BELONGS_TO, 'PanelBankAccountHistory', 'charge_record_id')
        );
    }

    public function beforeDelete(){
        FinanceItems::model()->deleteAllByAttributes(array('order_id'=>$this->id));
        return parent::beforeDelete();
    }

    public function beforeSave(){
        if($this->isNewRecord){
            $this->create_time = strtotime('now');

        }
        if($this->status == self::STATUS_DISCARD){
            throw new CHttpException(403, "该记录已经取消，系统自动锁定，无法操作。");
        }
        if($this->status == self::STATUS_APPROVED && empty($this->charge_record)){
            if($this->type == self::TYPE_ORDER){
                $mainChargeRecord = new PanelBankAccountHistory();
                $mainChargeRecord->value = $this->transaction_value;
                $mainChargeRecord->account_id = $this->charge_account_id;
                $mainChargeRecord->target_id = PanelBankAccount::ACCOUNT_IN;
                $mainChargeRecord->direction = PanelBankAccountHistory::DIRECTION_POSITIVE;
                $mainChargeRecord->memo = "收支系统自动转入：\n".$this->memo;
                $targetChargeRecord = new PanelBankAccountHistory();
                $targetChargeRecord->value = $this->transaction_value;
                $targetChargeRecord->account_id = PanelBankAccount::ACCOUNT_IN;
                $targetChargeRecord->target_id = $this->charge_account_id;
                $targetChargeRecord->direction = PanelBankAccountHistory::DIRECTION_NEGATIVE;
                $targetChargeRecord->memo = "收支系统自动扣款：\n".$this->memo;
                if($mainChargeRecord->save() && $targetChargeRecord->save()){
                    $this->charge_record_id = $mainChargeRecord->id;
                }else{
                    throw new CHttpException(500, "无法保存银行流水记录，请检查账号模块是否出错！");
                }
            }elseif($this->type == self::TYPE_CUSTOMER && !empty($this->charge_account_id)){
                $mainChargeRecord = new PanelBankAccountHistory();
                $mainChargeRecord->value = $this->transaction_value;
                $mainChargeRecord->account_id = PanelBankAccount::ACCOUNT_OUT;
                $mainChargeRecord->target_id = $this->charge_account_id;
                $mainChargeRecord->direction = PanelBankAccountHistory::DIRECTION_POSITIVE;
                $mainChargeRecord->memo = "收支系统自动转入：\n".$this->memo;
                $targetChargeRecord = new PanelBankAccountHistory();
                $targetChargeRecord->value = $this->transaction_value;
                $targetChargeRecord->account_id = $this->charge_account_id;
                $targetChargeRecord->target_id = PanelBankAccount::ACCOUNT_OUT;
                $targetChargeRecord->direction = PanelBankAccountHistory::DIRECTION_NEGATIVE;
                $targetChargeRecord->memo = "收支系统自动扣款：\n".$this->memo;
                if($mainChargeRecord->save() && $targetChargeRecord->save()){
                    $this->charge_record_id = $mainChargeRecord->id;
                }else{
                    throw new CHttpException(500, "无法保存银行流水记录，请检查账号模块是否出错！");
                }
            }
        }
        $this->update_time = strtotime('now');
        return parent::beforeSave();
    }

    public function afterSave(){
        if($this->isNewRecord){
            if($this->status == self::STATUS_FIRST_APPLY){
                $message = new PanelMessage();
                $message->addMessage('待审批申请', $this->user->realname.'申请了一笔￥'.$this->transaction_value.'的'.self::$typeIntl[$this->type].'。<a href=\''.Yii::app()->createUrl('panel/finance/review', array('id'=>$this->id)).'\'>查看详情</a>&nbsp;', PanelMessage::TYPE_NOTICE, PanelUser::findAccountant());
            }
        }
        return parent::afterSave();
    }

    public static function translateStatus($status){
        return isset(self::$statusIntl[$status]) ? self::$statusIntl[$status] : "未知";
    }

    public function search(){
        $criteria = new CDbCriteria;
        $criteria->compare('status', $this->status);
        $criteria->compare('handler', $this->handler);
        $criteria->compare('type', $this->type);
        return new CActiveDataProvider('Finance', array(
           'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'id DESC'
            )
        ));
    }

    public function checkData($data = array(), $type = 'new', $error = 'return'){
        return true;
    }

    public function newCollectionRequest($data = array(), $items = array()){
        $newModel = false;
        $transaction = Yii::app()->db->beginTransaction();
        //Begin Transaction
        try{
            if($this->checkData($data, 'new', 'exception')){
                $newModel = new Finance;
                $newModel->unsetAttributes();
                $newModel->handler = Yii::app()->user->id;
                $newModel->transaction_value = 0.00;
                $newModel->type = Finance::TYPE_ORDER;
                //Detect transaction direction
                $newModel->direction = self::DIRECTION_POSITIVE;
                $totalTransactionValue = 0.00;
                //EOF detect transaction direction
                $newModel->memo = $data['memo'];
                $newModel->charge_account_id = $data['charge_account_id'];
                $newModel->status = self::STATUS_FIRST_APPLY;
                if($newModel->save()){
                    //Loop the items of finance records.
                    foreach($items as $item){
                        $newItemModel = new FinanceItems;
                        $newItemModel->vid = $item['vid'];
                        $newItemModel->transaction_value = $item['transaction_value'];
                        $newItemModel->memo = $item['memo'];
                        $newItemModel->type = FinanceItems::TYPE_VISA_ORDER;
                        if($newItemModel->transaction_value > 0){
                            $newItemModel->direction = self::DIRECTION_POSITIVE;
                        }else{
                            $newItemModel->direction = self::DIRECTION_NEGATIVE;
                        }
                        $newItemModel->order_id = $newModel->id;
                        $totalTransactionValue += $newItemModel->transaction_value;
                        $newItemModel->save();
                    }
                    //EOF Loop finance items

                    //BEGIN Detecting the value's direction
                    $newModel->transaction_value = $totalTransactionValue;
                    if($newModel->transaction_value > 0){
                        $newModel->direction = self::DIRECTION_POSITIVE;
                    }else{
                        $newModel->direction = self::DIRECTION_NEGATIVE;
                    }
                    //EOF Value direction detection
                    if($newModel->save()){
                        $transaction->commit();
                    }


                }
            }
        }catch(Exception $e){
            $transaction->rollback();
        }
        return $newModel;

    }

    public static function getDefaultStat(){
        $stat = array();
        $orderModel = new VisaOrder;
        $stat['unpay_order'] = VisaOrder::model()->count('is_pay = 0 AND status != "'.VisaOrder::STATUS_DELETE.'"');
        $stat['unpayout_order'] = VisaOrder::model()->count('is_pay_out != 1 AND (need_pay_out_amount > 1) AND status != "'.VisaOrder::STATUS_DELETE.'"');
        $stat['unpay_order_price'] = $orderModel->getUnpaidAmount();
        $stat['unpayout_order_price'] = $orderModel->getUnpayoutAmount();
        return $stat;
    }


    public function newPayRequest($data = array(), $items = array()){
        $newModel = false;
        $transaction = Yii::app()->db->beginTransaction();
        //Begin Transaction
        try{
            if($this->checkData($data, 'new', 'exception')){
                $newModel = new Finance;
                $newModel->unsetAttributes();
                $newModel->handler = Yii::app()->user->id;
                $newModel->transaction_value = 0.00;
                $newModel->type = Finance::TYPE_CUSTOMER;
                //Detect transaction direction
                $newModel->direction = self::DIRECTION_NEGATIVE;
                $totalTransactionValue = 0.00;
                //EOF detect transaction direction
                $newModel->memo = $data['memo'];
                $newModel->status = self::STATUS_FIRST_APPLY;
                if($newModel->save()){
                    //Loop the items of finance records.
                    foreach($items as $item){
                        $newItemModel = new FinanceItems;
                        $newItemModel->vid = $item['vid'];
                        $newItemModel->transaction_value = $item['transaction_value'];
                        $newItemModel->memo = $item['memo'];
                        $newItemModel->type = FinanceItems::TYPE_VISA_CUSTOMER;
                        $newItemModel->direction = self::DIRECTION_NEGATIVE;
                        $newItemModel->order_id = $newModel->id;
                        $totalTransactionValue += $newItemModel->transaction_value;
                        $newItemModel->save();
                    }
                    //EOF Loop finance items

                    //BEGIN Detecting the value's direction
                    $newModel->transaction_value = $totalTransactionValue;
                    //EOF Value direction detection
                    if($newModel->save()){
                        $transaction->commit();
                    }


                }
            }
        }catch(Exception $e){
            error_log('ERROR HAPPENED!');
            $transaction->rollback();
        }
        return $newModel;

    }


    public function reviewCollectionRequest($data){

    }

    public function addNewRecord($data = array()){
        if(!empty($data)){

        }else{
            throw new CHttpException(400, "财务数据不完整！");
        }
        return false;
    }
}