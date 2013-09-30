<?php

/**
 * comment management
 * @author Suley Lu<dearsuley@gmail.com>
 * @access public
 * @version 1.0
 * @copyright private
 * */


class ItemPrice extends CActiveRecord{
	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	public function tableName(){
		return 'item_price';
	}
	/**
	 * Define relations among item models
	 * */

	public function relations(){
		return array(
			'item' => array(self::BELONGS_TO, 'Item', 'item_id')
			);
	}

}
?>