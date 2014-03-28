<?php

class UserRole extends CActiveRecord{
	const ROLE_VISA_ADMIN = 'visa_admin';
    const ROLE_VISA_FINANCE = 'visa_finance';
    const ROLE_VISA_OPERATE = 'visa_operate';
    const ROLE_VISA_COURIER = 'visa_courier';
	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	public static function tables(){
		return 'user_role';
	}
	public function relations(){
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id')
			);
	}
}
?>