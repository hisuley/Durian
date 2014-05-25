<?php
/**
 * @project: trunk
 * @file: FinanceItems.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-4-15
 * @time: 上午10:48
 * @version: 1.0
 */

class FinanceItems extends CActiveRecord{

    //TYPE of this Single Item
    const TYPE_VISA_ORDER = 'visa_order'; //with relation to actual order
    const TYPE_UNRELATED = 'unrelated';
    const TYPE_VISA_CUSTOMER = 'customer';
    //STATUS


    public static function model($className = __CLASS__){
        return parent::model($className);
    }
    public function tableName(){
        return "panel_finance_items";
    }

    public function beforeSave(){
        if($this->isNewRecord){
            $this->create_time = strtotime('now');
        }
        $this->update_time = strtotime('now');
        return parent::beforeSave();
    }

    public function relations(){
        return array(
          'record'=>array(self::BELONGS_TO, 'Finance', 'order_id'),
          'order'=>array(self::BELONGS_TO, 'VisaOrder', 'vid'),
          'customer'=>array(self::BELONGS_TO, 'VisaOrderCustomer', 'vid'),
        );
    }
    public function rules(){
        return array(
            array('type, vid, status, memo', 'safe'),
            array('transaction_value', 'required'),
            array('transaction_value', 'numerical'),
            array('direction', 'in', 'range'=>array(Finance::DIRECTION_NEGATIVE, Finance::DIRECTION_POSITIVE)),
        );
    }
}