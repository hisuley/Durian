<?php
/**
 * Created by Kimi Tourism.
 * @author Suley<luzhang@jmlvyou.com>
 * @time 13-12-29
 * @version 1.0
 * @copyright
 **/
class VisaType extends CActiveRecord{
    public $name, $notes, $country_id, $predict_date, $price, $is_enabled;
    public $create_time;
    public static function model($className = __CLASS__){
        return parent::model($className);
    }
    public function tableName(){
        return 'visa_type';
    }
    public function rules(){
        return array(
            array('name, notes, country_id, predict_date, price, is_enabled, source_id', 'safe')
        );
    }
    public function relations(){
        return array(
            'order'=>array(self::HAS_MANY, 'VisaOrder', 'type'),
            'source'=>array(self::HAS_MANY, 'VisaTypeAgency', 'type_id'),
            'country'=>array(self::BELONGS_TO, 'Address', 'country_id')
        );
    }
    public function beforeDelete(){
        Yii::import('application.modules.yutong.models.YutongVisaGoods');
        $orders = VisaOrder::model()->countByAttributes(array('type'=>$this->id));
        $visas = YutongVisaGoods::model()->countByAttributes(array('type_id'=>$this->id));
        if($orders > 0 || $visas > 0){
            throw new CHttpException(403, '该类型下还有'.$orders.'个订单和'.$visas.'个签证，无法删除！');
        }else{
            return parent::beforeDelete();
        }

    }
    public function afterFind(){
        return parent::afterFind();
    }
    /**
     * Some useful action before saving the data
     *
     **/
    public function beforeSave(){
        if($this->isNewRecord){
            $this->create_time = strtotime('now');
            $this->is_enabled = 1;
        }
        return true;
    }

    public function attributeLabels(){
        return array(
            'name'=>'名字',
            'notes'=>'备注',
            'country_id'=>'国家',
            'predict_date'=>'预测出签时间（自然日）',
            'price'=>'价格',
            'source_id'=>'送签社',
            'source'=>'送签社',
            'is_enabled'=>'是否启用'
        );
    }
    public static function getTypeList($country_id){
        $criteria = new CDbCriteria;
        $criteria->addCondition('is_enabled = 1', 'AND');
        $criteria->addCondition('country_id = '.$country_id, 'AND');
        return self::model()->findAll($criteria);
    }
    public static function getSubResult($data){
        if(isset($data['id'])){
            $subResult = self::model()->findAllByAttributes(array('parent_id'=>$data['id']));
            $data['children'] = array();
            if(!empty($subResult)){
                foreach($subResult as $subValue){
                    $subTempRecord['name'] = $subValue->name;
                    $subTempRecord['notes'] = $subValue->notes;
                    $subTempRecord['source'] = $subValue->source->name;
                    $subTempRecord['id'] = $subValue->id;
                    $subTempRecord = self::getSubResult($subTempRecord);
                    $data['children'][$subValue->id] = $subTempRecord;
                }
            }
        }
        return $data;
    }
    public static function addNewAddr($data, $parent_id = 0){
        $model = new VisaType;
        $model->attributes = $data;
        if(!empty($parent_id))
            $model->parent_id = $parent_id;
        if($model->save()){
            return $model->id;
        }
        return false;
    }
    public static function getTypeName($id){
        $result = self::model()->findByPk($id);
        if(!empty($result)){
            return $result->name;
        }else{
            return '无法识别';
        }
    }

    public static function addSourceName($models){
        foreach($models as &$model){
            if(isset($model->source->name)){
                $model->name = $model->name."[".$model->source->name."]";
            }
        }
        return $models;
    }
}