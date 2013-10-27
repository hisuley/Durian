<?php
/**
 * Created by JetBrains PhpStorm.
 * User: suley
 * Date: 13-10-11
 * Time: AM1:00
 * To change this template use File | Settings | File Templates.
 */

class Visa extends CActiveRecord{
    public static function model($className = __CLASS__){
        return parent::model($className);
    }
    public function tableName(){
        return 'visa_order';
    }
}