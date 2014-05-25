<?php
/**
 * @project: trunk
 * @file: OrderSourceBankAccount.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-4-8
 * @time: 下午1:43
 * @version: 1.0
 */


class OrderSourceBankAccount extends CActiveRecord{
    public static function model($className = __CLASS__){
        return parent::model($className);
    }
    public function tableName(){
        return "order_source_account";
    }
    public function rules(){
        return array(
          array('account_holder', 'length', 'min'=>2, 'max'=>20,'allowEmpty'=>false),
          array('account_bank', 'length', 'min'=>4, 'max'=>80,'allowEmpty'=>false),
          array('account_number', 'length', 'min'=>10, 'max'=>40),
          array('order_source_id', 'safe')
        );
    }

    public function relations(){
        return array(
          'order_source'=>array(self::BELONGS_TO, 'OrderSource', 'order_source_id')
        );
    }

    public function attributeLabels(){
        return array(
            'account_holder'=>'账户持有人',
            'account_bank'=>'开户行',
            'account_number'=>'账号'
        );
    }

}
?>