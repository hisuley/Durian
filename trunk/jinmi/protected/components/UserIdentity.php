<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id, $_username, $_realname, $_role;
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
        $this->_id = $record->id; //add this
        $this->_username = $record->username; //add this
        $this->_realname = $record->realname; //add this
        $this->_role = $record->role; //add this
        $this->setState('username',$record->username);
        $this->setState('realname',$record->realname);
        $this->setState('role',$record->role);
		return !$this->errorCode;
	}
    public function getId(){
        return $this->_id;
    }
    public function getUsername(){
        return $this->_username;
    }
    public function getRealname(){
        return $this->_realname;
    }
    public function getRole(){
        return $this->_role;
    }
}