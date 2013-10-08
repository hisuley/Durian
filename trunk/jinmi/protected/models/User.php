<?php

class User extends CActiveRecord{
	public $username, $password;
	private $salt = 'qigjewoijfiocnonewo';
	public function tableName(){
		return 'user';
	}
	public static function model($className = __CLASS){
		return parent::model($className);
	}
	public static function hashPassword($password, $salt = 0){
		if(empty($salt))
			$salt = $this->salt;
		return md5($password.$salt);
	}
}
?>