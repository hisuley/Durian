<?php
/**
 * Created by Kimi Tourism.
 * @author Suley<luzhang@jmlvyou.com>
 * @time 13-10-11
 * @version 1.0
 * @copyright 
 **/

class OfflineOrderAttribute extends CActiveRecord{

    /** The Attributes definition table */
    const ATTR_COUNTRY = 'country';
    const ATTR_TYPE = 'type';
    const ATTR_AMOUNT = 'amount';
    const ATTR_TOTAL_PRICE = 'total_price';
    const ATTR_START_TIME = 'start_time';
    const ATTR_GROUP_SN = 'group_sn';
    const ATTR_CUSTOMERS = 'customers';
    const ATTR_PICKUP = 'pickup';
    const ATTR_SOURCE = 'source';
    const ATTR_CONTACT_NAME = 'contact_name';
    const ATTR_CONTACT_PHONE = 'contact_phone';
    const ATTR_CONTACT_ADDRESS = 'contact_address';
    const ATTR_MATERIAL = 'material';

    public static function model($className = __CLASS__){
        return parent::model($className);
    }
    public function tableName(){
        return 'offline_order_attributes';
    }


    /**
     * After this model executes the search, do some tricks
     */
    public function afterFind(){
        if($this->attr_name == self::ATTR_MATERIAL){
            $this->value = explode(',', $this->value);
        }
        return true;
    }
    public function beforeSave(){
        if($this->attr_name == self::ATTR_MATERIAL){
            $this->value = implode(',', $this->value);
        }
        if($this->isNewRecord){
            $this->create_time = strtotime('now');
        }
        return true;
    }
    public function relations(){
        return array(
            'OfflineOrder' => array(self::BELONGS_TO, 'OfflineOrder', 'offline_order_id'),
            'AttrInfo' => array(self::BELONGS_TO, 'PreDefinedAttribute', 'attr_name')
        );
    }
    public function rules(){
        return array(
          array('attr_name, value, extend, create_time, offline_order_id', 'safe')
        );
    }

}