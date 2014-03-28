<?php
/**
 * Created by Suley.
 * @author: suley<dearsuley@gmail.com>
 * @date: 3/6/14
 * @time: 5:37 PM
 */

class VisaOrder extends CActiveRecord{
    public $order_id, $transaction_value, $direction, $memo, $status;
    public static function model($className = __CLASS__){
        return parent::model($className);
    }
    public function tableName(){
        return 'panel_finance_records';
    }
    public function rules(){
        return array(
            array('order_id, notes, parent_id, is_enabled', 'safe')
        );
    }

    public function relations(){
        return array(
            'type'=>array(self::HAS_MANY, 'VisaType', 'country_id')
        );
    }
}