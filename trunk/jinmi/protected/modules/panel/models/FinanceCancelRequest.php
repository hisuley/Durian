<?php
/**
 * @project: trunk
 * @file: FinanceCancelRequest.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-5-22
 * @time: 下午4:02
 * @version: 1.0
 */

class FinanceCancelRequest extends CActiveRecord{

    /* STATUS */
    const STATUS_VERIFYING = 'verifying';
    const STATUS_APPROVED = 'approved';
    const STATUS_CANCEL = 'cancel';
    const STATUS_FINISHED = 'finished';

    public function tableName(){
        return "panel_finance_cancel_request";
    }
    public static function model($className = __CLASS__){
        return parent::model($className);
    }
    public function relations(){

    }
    public function cancelRequest($id){
        if(PanelUser::checkAccessToFunction('finance_cancel')){
           $model = self::model()->findByPk($id);
            if(empty($model)){
                throw new CHttpException(404, "找不到该记录，是否已经删除？");
            }else{
                if($model->status != self::STATUS_APPROVED){
                    throw new CHttpException(401, "错误的记录状态，请检查。");
                }else{
                    if($this->type == Finance::TYPE_ORDER){
                        $mainChargeRecord = new PanelBankAccountHistory();
                        $mainChargeRecord->value = $this->transaction_value;
                        $mainChargeRecord->account_id = $this->charge_account_id;
                        $mainChargeRecord->target_id = PanelBankAccount::ACCOUNT_IN;
                        $mainChargeRecord->direction = PanelBankAccountHistory::DIRECTION_POSITIVE;
                        $mainChargeRecord->memo = "收支系统自动转入：\n".$this->memo;
                        $targetChargeRecord = new PanelBankAccountHistory();
                        $targetChargeRecord->value = $this->transaction_value;
                        $targetChargeRecord->account_id = PanelBankAccount::ACCOUNT_IN;
                        $targetChargeRecord->target_id = $this->charge_account_id;
                        $targetChargeRecord->direction = PanelBankAccountHistory::DIRECTION_NEGATIVE;
                        $targetChargeRecord->memo = "收支系统自动扣款：\n".$this->memo;
                        if($mainChargeRecord->save() && $targetChargeRecord->save()){
                            $this->charge_record_id = $mainChargeRecord->id;
                        }else{
                            throw new CHttpException(500, "无法保存银行流水记录，请检查账号模块是否出错！");
                        }
                    }elseif($this->type == Finance::TYPE_CUSTOMER && !empty($this->charge_account_id)){
                        $mainChargeRecord = new PanelBankAccountHistory();
                        $mainChargeRecord->value = $this->transaction_value;
                        $mainChargeRecord->account_id = PanelBankAccount::ACCOUNT_OUT;
                        $mainChargeRecord->target_id = $this->charge_account_id;
                        $mainChargeRecord->direction = PanelBankAccountHistory::DIRECTION_POSITIVE;
                        $mainChargeRecord->memo = "收支系统自动转入：\n".$this->memo;
                        $targetChargeRecord = new PanelBankAccountHistory();
                        $targetChargeRecord->value = $this->transaction_value;
                        $targetChargeRecord->account_id = $this->charge_account_id;
                        $targetChargeRecord->target_id = PanelBankAccount::ACCOUNT_OUT;
                        $targetChargeRecord->direction = PanelBankAccountHistory::DIRECTION_NEGATIVE;
                        $targetChargeRecord->memo = "收支系统自动扣款：\n".$this->memo;
                        if($mainChargeRecord->save() && $targetChargeRecord->save()){
                            $this->charge_record_id = $mainChargeRecord->id;
                        }else{
                            throw new CHttpException(500, "无法保存银行流水记录，请检查账号模块是否出错！");
                        }
                    }
                }
            }
        }else{
            throw new CHttpException(403, "您没有权限操作此功能！");
        }
    }
}