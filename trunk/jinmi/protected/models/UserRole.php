<?php

class UserRole extends CActiveRecord{
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