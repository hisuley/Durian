<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	/**
	 * Authenticates a user.
	 */
	public function authenticate()
	{
		$record = User::model()->findByAttributes(array('username'=>$this->username));
		if(!isset($record))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($record->password !== User::hashPassword($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}
}