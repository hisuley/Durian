<?php
/**
 * Created by Suley.
 * @author: suley<dearsuley@gmail.com>
 * @date: 1/21/14
 * @time: 11:24 AM
 */

class VisaOrderCustomer extends CActiveRecord{
    const STATUS_DEFAULT = 0;
    const STATUS_ISSUED = 2;
    const STATUS_REJECT = 3;
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
            array('name, passport, create_date, status, visa_order_id', 'safe')
        );
    }
    public function attributeLabels(){
        return array(
          'name'=>'姓名', 'passport'=>'护照'
        );
    }
}