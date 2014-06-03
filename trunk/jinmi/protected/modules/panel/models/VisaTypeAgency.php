<?php
/**
 * @project: trunk
 * @file: VisaTypeAgency.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-4-3
 * @time: 下午1:46
 * @version: 1.0
 */


class VisaTypeAgency extends CActiveRecord{
    public static function model($className = __CLASS__){
        return parent::model($className);
    }
    public function tableName(){
        return "visa_type_agency";
    }
    public function rules(){
        return array(
          array('type_id, agency_id, price, notes, material, predict_date, is_enabled, show_order, create_time', 'safe')
        );
    }
    public function relations(){
        return array(
          'agency'=>array(self::BELONGS_TO, 'OrderSource', 'agency_id'),
          'type'=>array(self::BELONGS_TO, 'VisaType', 'type_id')
        );
    }

    public function attributeLabels(){
        return array(
            'agency_id'=>'渠道',
            'notes'=>'备注',
            'type_id'=>'种类',
            'predict_date'=>'预测出签时间',
            'price'=>'价格',
            'show_order'=>'显示顺序',
            'material'=>'材料',
            'is_enabled'=>'是否启用'
        );
    }
}