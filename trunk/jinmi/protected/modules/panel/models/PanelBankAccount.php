<?php
/**
 * @project: trunk
 * @file: PanelBankAccount.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-5-6
 * @time: 下午5:18
 * @version: 1.0
 */

class PanelBankAccount extends CActiveRecord{
    CONST STATUS_ACTIVE = 'active';
    CONST STATUS_DELETED = 'deleted';
    CONST ACCOUNT_IN = 6;
    CONST ACCOUNT_OUT = 3;
    public static function model($className = __CLASS__){
        return parent::model($className);
    }
    public function tableName(){
        return "panel_bank_account";
    }
    public function relations(){
        return array(
          'in'=>array(self::HAS_MANY, 'PanelBankAccountHistory', 'to_account'),
          'out'=>array(self::HAS_MANY, 'PanelBankAccountHistory', 'from_account')
        );
    }
    public function search(){
        $criteria = new CDbCriteria();
        $criteria->addCondition('status != "'.self::STATUS_DELETED.'"');
        return new CActiveDataProvider('PanelBankAccount', array(
           'criteria'=>$criteria
        ));
    }


    public function attributeLabels(){
        return array(
            'name'=>'别名', 'status'=>'状态', 'card_holder'=>'持卡人', 'account_number'=>'账号', 'account_agency'=>'开户行', 'memo'=>'备注', 'init_money'=>'初始值', 'balance'=>'余额', 'create_time'=>'创建时间'
        );
    }
    public function rules(){
        return array(
          array('name, status, card_holder, account_number, account_agency, memo, init_money, balance, create_time', 'safe')
        );
    }
}