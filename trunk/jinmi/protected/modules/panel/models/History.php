<?php
/**
 * Created by PhpStorm.
 * User: Suley
 * Date: 14-3-11
 * Time: 下午4:57
 */

class History extends CActiveRecord{
    public $message, $create_time, $type, $raw;
    const TYPE_DELETE = 'delete';
    const TYPE_NEW   = 'new';
    const TYPE_MODIFIED = 'modified';
    public function tableName(){
        return 'panel_order_history';
    }
    public function getTypeLabels($label){
        return $label;
    }
}