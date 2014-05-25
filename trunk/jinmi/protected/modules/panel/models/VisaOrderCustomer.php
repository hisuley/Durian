<?php
/**
 * Created by Suley.
 * @author: suley<dearsuley@gmail.com>
 * @date: 1/21/14
 * @time: 11:24 AM
 */

class VisaOrderCustomer extends CActiveRecord{
    public $ids;
    const STATUS_DEFAULT = 0;
    const STATUS_SENTOUT = 1;
    const STATUS_ISSUED = 2;
    const STATUS_REJECT = 3;
    const STATUS_DELETED = 4;

    public static function model($className = __CLASS__){
        return parent::model($className);
    }
    public function tableName(){
        return 'visa_order_customer';
    }
    public function relations(){
        return array(
            'order'=>array(self::BELONGS_TO, 'VisaOrder', 'visa_order_id'),
            'agencyType'=>array(self::BELONGS_TO, 'VisaTypeAgency', 'agency_id'),
            'financeRecord'=>array(self::HAS_ONE, 'FinanceItems', 'vid', 'on'=>'financeRecord.type = "'.FinanceItems::TYPE_VISA_CUSTOMER.'"')
        );
    }
    public function rules(){
        return array(
            array('name, passport, create_time, is_pay, price, cost_price, agency_id, status, visa_order_id', 'safe')
        );
    }
    public function attributeLabels(){
        return array(
          'name'=>'姓名', 'cost_price'=>'成本价', 'price'=>'售价', 'is_pay'=>'支付状态','passport'=>'护照', 'agencyType'=>'送签渠道', 'agency_id'=>'送签渠道', 'status'=>'状态'
        );
    }

    public function getUnpayoutAmount(){
        $criteria = new CDbCriteria();
        $criteria->addCondition('is_payout != 1');
        $criteria->select = "SUM()";
        return $this->commandBuilder->createFindCommand($this->getTableSchema(),$criteria)->queryScalar();
    }
    public function beforeSave(){
        if($this->isNewRecord){
            $this->status = self::STATUS_DEFAULT;
            $this->create_time = strtotime('now');
        }else{
            $oldRecord = self::model()->findByPk($this->id);
            $orderModel = VisaOrder::model()->findByPk($this->visa_order_id);
            if($oldRecord->status != $this->status && $this->status == self::STATUS_SENTOUT){
                $agencyModel = VisaTypeAgency::model()->findByPk($this->agency_id);

                $orderModel->memo = $orderModel->memo."\n".date('Y-m-d H:i')." 客户".$this->name."[".$this->passport."]送签到渠道【".$agencyModel->agency->name."】，操作：".User::getUserRealname(Yii::app()->user->id);

                if(self::checkAllCustomerSent($this->visa_order_id, $this->id)){
                    $orderModel->memo = $orderModel->memo."\n".date('Y-m-d H:i')." 订单所有客户送签完毕，订单状态修改为【全部送签】，操作：".User::getUserRealname(Yii::app()->user->id);
                    $orderModel->status = VisaOrder::STATUS_SENTOUT;
                }elseif($orderModel->status != VisaOrder::STATUS_PARTIAL_SENT){
                    $orderModel->memo = $orderModel->memo."\n".date('Y-m-d H:i')." 订单部分客户已经送签，订单状态修改为【部分送签】，操作：".User::getUserRealname(Yii::app()->user->id);
                    $orderModel->status = VisaOrder::STATUS_PARTIAL_SENT;
                }
                $orderModel->save();
            }
            if($oldRecord->status != $this->status && $this->status == self::STATUS_REJECT){
                $orderModel->memo = $orderModel->memo."\n".date('Y-m-d H:i')." 客户".$this->name."[".$this->passport."]被拒签，操作：".User::getUserRealname(Yii::app()->user->id);
                $orderModel->save();
            }
            if($oldRecord->status != $this->status && $this->status == self::STATUS_DELETED){
                $orderModel->memo = $orderModel->memo."\n".date('Y-m-d H:i')." 客户".$this->name."[".$this->passport."]被删除，操作：".User::getUserRealname(Yii::app()->user->id);
                $orderModel->save();
            }
        }
        return parent::beforeSave();
    }

    public static function checkAllCustomerSent($id, $excludeId){
        //$count = self::model()->count("status IN (:default, :sent, :issued, :reject)", array(':default'=>self::STATUS_DEFAULT, ':sent'=>self::STATUS_SENTOUT, ':issued'=>self::STATUS_ISSUED, ':reject'=>self::STATUS_REJECT));
        $count = self::model()->count("visa_order_id = :order_id AND status IN (:default) AND id NOT IN (:exclude_id)", array(':default'=>self::STATUS_DEFAULT, ':order_id'=>$id, ':exclude_id'=>$excludeId));
        error_log("Count:".$count);
        if($count >= 1){
            return false;
        }else{
            return true;
        }
    }

    public function search(){
        $criteria = new CDbCriteria;

        if(is_array($this->id)){
            $criteria->addInCondition('id', $this->id);
        }else{
            $criteria->compare('id', $this->id);
        }

        return new CActiveDataProvider('VisaOrderCustomer', array(
           'criteria'=>$criteria
        ));
    }
}