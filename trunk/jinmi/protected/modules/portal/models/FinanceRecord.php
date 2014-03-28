<?php
/**
 * Created by PhpStorm.
 * User: suley
 * Date: 1/7/14
 * Time: 4:29 PM
 */
class FinanceRecord extends CActiveRecord{
    public static function model($className = __CLASS__){
        return parent::model($className);
    }
    public function tableName(){
        return 'finance_record';
    }
} 