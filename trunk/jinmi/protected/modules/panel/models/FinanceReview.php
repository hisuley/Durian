<?php
/**
 * @project: trunk
 * @file: FinanceReview.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-4-15
 * @time: 上午10:51
 * @version: 1.0
 */

class FinanceReview extends CActiveRecord{
    public static function model($className = __CLASS__){
        return parent::model($className);
    }
    public function tableName(){
        return "panel_finance_review";
    }

}