<?php
/**
 * @project: trunk
 * @file: PanelBankAccountHistory.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-5-6
 * @time: 下午5:19
 * @version: 1.0
 */

class PanelBankAccountHistory extends CActiveRecord{
    const DIRECTION_POSITIVE = '+';
    const DIRECTION_NEGATIVE = '-';
    public static function model($className = __CLASS__){
        return parent::model($className);
    }
    public function tableName(){
        return "panel_bank_account_history";
    }
    public function relations(){
        return array(
          'account'=>array(self::BELONGS_TO, 'PanelBankAccount', 'account_id'),
          'target'=>array(self::BELONGS_TO, 'PanelBankAccount', 'target_id')
        );
    }
    public function beforeSave(){
        if($this->isNewRecord){
            $this->create_time = strtotime('now');
            $tempModel = PanelBankAccount::model()->findByPk($this->account_id);
            if($this->direction == self::DIRECTION_POSITIVE){
                $this->balance = $tempModel->balance + $this->value;
            }else{
                $this->balance = $tempModel->balance - $this->value;
            }

        }else{
            throw new CHttpException(500, "不允许修改记录，如操作失误，请手动冲账！");
        }
        return parent::beforeSave();
    }

    public function afterSave(){
        if($this->isNewRecord){
            $tempModel = PanelBankAccount::model()->findByPk($this->account_id);
            if($this->direction == self::DIRECTION_POSITIVE){
                $tempModel->balance = $tempModel->balance + $this->value;
            }else{
                $tempModel->balance = $tempModel->balance - $this->value;
            }

            if($tempModel->save()){

            }else{
                $this->delete();
                throw new CHttpException(500, "记录错误，已经删除错误记录。");
            }
        }
        return parent::afterSave();
    }

    public function search(){
        $criteria = new CDbCriteria();
        $criteria->compare('account_id', $this->account_id);
        return new CActiveDataProvider('PanelBankAccountHistory', array(
            'criteria'=>$criteria
        ));
    }

    public function attributeLabels(){
        return array(
          'value'=>'交易金额', 'target_id'=>"对方账户", "account_id"=>"主账户",'create_time'=>"交易时间", 'memo'=>'备注', 'balance'=>'余额', 'direction'=>'收支'
        );
    }
    public function rules(){
        return array(
          array('account_id', 'compare', 'compareAttribute'=>'target_id', 'operator'=>'!=')
        );
    }
}