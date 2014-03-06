<?php
/**
 * Created by PhpStorm.
 * @version 1.0
 * @User: suley
 * @Date: 1/7/14
 * @Time: 4:29 PM
 */
class PreDefinedAttributeValue extends CActiveRecord{

    public static function model($className = __CLASS__){
        return parent::model($className);
    }

    public function tableName(){
        return 'pre_defined_attribute_value';
    }

    public function relations(){
        return array(
            'children' => array(self::HAS_MANY, 'PreDefinedAttributeValue', 'parent_id'),
            'parent' => array(self::BELONGS_TO, 'PreDefinedAttributeValue', 'parent_id')
        );
    }

    public function rules(){
        return array(
            array('value, parent_id, extend, comment', 'safe')
        );
    }

} 