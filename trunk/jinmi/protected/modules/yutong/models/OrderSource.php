<?php
/**
 * Created by Kimi Tourism.
 * @author Suley<luzhang@jmlvyou.com>
 * @time 13-12-29
 * @version 1.0
 * @copyright
 **/
class OrderSource extends CActiveRecord{
    public $name, $notes, $type, $parent_id, $is_enabled, $contact_name, $contact_phone, $contact_address;
    public $create_time;
    const TYPE_SOURCE = 1;
    const TYPE_AGENCY = 2;
    public static function model($className = __CLASS__){
        return parent::model($className);
    }
    public function tableName(){
        return 'order_source';
    }
    public function rules(){
        return array(
            array('name, notes, type, parent_id, is_enabled, contact_name, contact_phone, contact_address', 'safe')
        );
    }
    public function relations(){
        return array(
            'order'=>array(self::HAS_MANY, 'VisaOrder', 'source'),
            'parent' => array(self::BELONGS_TO, 'OrderSource', 'parent_id')
        );
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

    public static function allLists(){
        //$criteria = new CDbCriteria;
        return new CActiveDataProvider('OrderSource', array());
    }

    public static function agencyList(){
        $criteria = new CDbCriteria;
        $criteria->addCondition('type = 2', 'AND');
        return new CActiveDataProvider('OrderSource', array('criteria'=>$criteria));
    }


    public function attributeLabels(){
        return array(
            'parent_id' => '上级',
            'name' => '名字',
            'type' => '类型',
            'notes' => '备注',
            'contact_name' => '联系人姓名',
            'contact_phone' => '电话',
            'contact_address' => '地址'
        );
    }
    public static function getSourceList(){
        $criteria = new CDbCriteria;
        $criteria->addCondition('is_enabled = 1', 'AND');
        $criteria->addCondition('type = 1', 'AND');
        $criteria->addCondition('(parent_id IS NULL OR parent_id = 0)', 'AND');
        $result = self::model()->findAll($criteria);
        $resultArray = array();
        foreach($result as $value){
            //Loop the first level record
            $tempRecord['name'] = $value->name;
            $tempRecord['notes'] = $value->notes;
            $tempRecord['id'] = $value->id;
            $tempRecord = self::getSubResult($tempRecord);
            $resultArray[$value->id] = $tempRecord;
        }
        return $resultArray;
    }
    public static function getAgencyList(){
        $criteria = new CDbCriteria;
        $criteria->addCondition('is_enabled = 1', 'AND');
        $criteria->addCondition('type = 2', 'AND');
        $criteria->addCondition('(parent_id IS NULL OR parent_id = 0)', 'AND');
        $result = self::model()->findAll($criteria);
        $resultArray = array();
        foreach($result as $value){
            //Loop the first level record
            $tempRecord['name'] = $value->name;
            $tempRecord['notes'] = $value->notes;
            $tempRecord['id'] = $value->id;
            $tempRecord = self::getSubResult($tempRecord);
            $resultArray[$value->id] = $tempRecord;
        }
        return $resultArray;
    }
    public static function getSubResult($data){
        if(isset($data['id'])){
            $subResult = self::model()->findAllByAttributes(array('parent_id'=>$data['id']));
            $data['children'] = array();
            if(!empty($subResult)){
                foreach($subResult as $subValue){
                    $subTempRecord['name'] = $subValue->name;
                    $subTempRecord['notes'] = $subValue->notes;
                    $subTempRecord['id'] = $subValue->id;
                    $subTempRecord = self::getSubResult($subTempRecord);
                    $data['children'][$subValue->id] = $subTempRecord;
                }
            }
        }
        return $data;
    }
    public static function addNewSource($data, $parent_id = 0){
        $model = new OrderSource;
        $model->attributes = $data;
        if(!empty($parent_id))
            $model->parent_id = $parent_id;
        if($model->save()){
            return $model->id;
        }
        return false;
    }
    public static function getSourceName($id){
        $result = self::model()->findByPk($id);
        if(!empty($result)){
            return $result->name;
        }else{
            return '无法识别';
        }
    }
}