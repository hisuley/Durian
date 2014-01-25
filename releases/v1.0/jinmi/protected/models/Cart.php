<?php

class Cart extends CActiveRecord{
	public static function model($className = __CLASS){
		return parent::model($className);
	}
	public function tableName(){
		return 'cart';
	}
	public function relations(){
		return array(
			'cart_item' => array(HAS_MANY, 'CartItem', 'cart_id'),
			'cart_plan' => array(HAS_ONE, 'CartPlan', 'cart_plan_id')	
			);
	}
}
?>