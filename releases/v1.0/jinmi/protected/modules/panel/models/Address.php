<?php
/**
 * Created by Kimi Tourism.
 * @author Suley<luzhang@jmlvyou.com>
 * @time 13-12-29
 * @version 1.0
 * @copyright 
 **/
class Address extends CActiveRecord{
	public $name, $notes, $parent_id, $is_enabled;
    public $create_time;
	public static function model($className = __CLASS__){
        return parent::model($className);
    }
    public function tableName(){
        return 'address';
    }
    public function rules(){
        return array(
          array('name, notes, parent_id, is_enabled', 'safe')
        );
    }

    public function relations(){
        return array(
            'type'=>array(self::HAS_MANY, 'VisaType', 'country_id')
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
    public static function getAddrList(){
    	$criteria = new CDbCriteria;
    	$criteria->addCondition('is_enabled = 1', 'AND');
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

    public static function addNewAddr($data, $parent_id = 0){
    	$model = new Address;
    	$model->attributes = $data;
    	if(!empty($parent_id))
    		$model->parent_id = $parent_id;
    	if($model->save()){
    		return $model->id;
    	}
    	return false;
    }
    public static function getCountryName($id){
        $result = self::model()->findByPk($id);
        if(!empty($result)){
            return $result->name;
        }else{
            return '';
        }
    }
    public static function allLists(){
        //$criteria = new CDbCriteria;
        return new CActiveDataProvider('Address', array());
    }

    public static function findCountry(){
        $criteria = new CDbCriteria;
        $criteria->addCondition('is_enabled = 1', 'AND');
        $criteria->addCondition('(parent_id IS NULL OR parent_id = 0)', 'AND');
        $result = self::model()->findAll($criteria);
        $resultArray = array();
        foreach($result as $value){
           $tempResult = CHtml::listData(self::model()->findAllByAttributes(array('parent_id'=>$value->id)), 'id', 'name');
           $resultArray = $resultArray + $tempResult;
        }
        return $resultArray;
    }
}