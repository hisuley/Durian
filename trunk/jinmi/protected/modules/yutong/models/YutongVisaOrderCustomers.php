<?php
/**
 * Created by Suley.
 * @author: suley<dearsuley@gmail.com>
 * @date: 1/21/14
 * @time: 11:24 AM
 */

class YutongVisaOrderCustomers extends CActiveRecord{
    const STATUS_DEFAULT = 0;
    const STATUS_ISSUED = 2;
    const STATUS_REJECT = 3;
    public static function model($className = __CLASS__){
        return parent::model($className);
    }
    public function tableName(){
        return 'yutong_visa_order_customers';
    }
    public function beforeSave(){
        if($this->isNewRecord){
            $this->create_time = strtotime('now');
        }
        return parent::beforeSave();
    }
    public function relations(){
        return array(
            'order'=>array(self::BELONGS_TO, 'YutongVisaOrder', 'order_id')
        );
    }
    public function rules(){
        return array(
            array('customer_name, order_id, passport', 'safe')
        );
    }
    public function attributeLabels(){
        return array(
          'customer_name'=>'姓名','passport'=>'护照'
        );
    }
}