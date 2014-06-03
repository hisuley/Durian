<?php
/**
 * Created by PhpStorm.
 * User: suley
 * Date: 1/7/14
 * Time: 4:29 PM
 */
class PreDefinedAttribute extends CActiveRecord{
    public static function model($className = __CLASS__){
        return parent::model($className);
    }
    public function tableName(){
        return 'pre_defined_attribute';
    }
    public function relations(){
        return array(
          'records' => array(SELF::HAS_MANY, 'OfflineOrderAttribute', 'attr_name')
        );
    }
    // Defining types
    const TYPE_CHECKBOX = 'checkbox';
    const TYPE_SELECT = 'select';
    const TYPE_RADIO = 'radio';
    const TYPE_RICHTEXT = 'richtext';
    const TYPE_INPUT = 'input';

    public function rules(){
        return array(
            array('name, label, type, can_empty, comment', 'safe')
        );
    }

} 