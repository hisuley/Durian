<?php

class User extends CActiveRecord{
	public $username, $password;
    const ROLE_VISA_ADMIN = 'visa_admin';
    const ROLE_VISA_FINANCE = 'visa_finance';
    const ROLE_VISA_OPERATE = 'visa_operate';
    const ROLE_VISA_COURIER = 'visa_courier';
	private static $salt = 'qigjewoijfiocnonewo';
	public function tableName(){
		return 'user';
	}
	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	public static function hashPassword($password, $salt = 0){
		if(empty($salt))
			$salt = self::$salt;
		return md5($password.$salt);
	}
    public static function getUserRealname($id){
//        $result = self::model()->findByPk($id);
//        return $result->realname;
        return '周丽萍';
    }
}
?>