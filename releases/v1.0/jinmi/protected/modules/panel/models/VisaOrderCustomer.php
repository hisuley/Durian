<?php
/**
 * Created by Suley.
 * @author: suley<dearsuley@gmail.com>
 * @date: 1/21/14
 * @time: 11:24 AM
 */

class VisaOrderCustomer extends CActiveRecord{
    public static function model($className = __CLASS__){
        return parent::model($className);
    }
    public function tableName(){
        return 'visa_order_customer';
    }
    public function relations(){
        return array(
            'order'=>array(self::BELONGS_TO, 'VisaOrder', 'visa_order_id')
        );
    }
    public function rules(){
        return array(
            array('name, passport, create_date, visa_order_id', 'safe')
        );
    }
}