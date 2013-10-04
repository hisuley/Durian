<?php
/**
 * Goods major module
 * @author Suley Lu<dearsuley@gmail.com>
 * @version 1.0
 * @copyright private
 * */

class Item extends CActiveRecord{


	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	public function tableName(){
		return 'item';
	}
	/**
	 * Define relations among item models
	 * */

	public function relations(){
		return array(
			'attachment' => array(self::HAS_MANY,'ItemAttachment', 'item_id'),
			'attribute' => array(self::HAS_MANY, 'ItemAttribute', 'item_id'),
			'comment' => array(self::HAS_MANY, 'ItemComment', 'item_id'),
			'itinerary' => array(self::HAS_MANY, 'ItemItinerary', 'item_id'),
			'price' => array(self::HAS_MANY, 'ItemPrice', 'item_id')
			);
	}
	

}
?>