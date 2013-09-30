<?php

/**
 * This is the model for table 'user'.
 *
 * @author xstudio
 * @version 1.0
 * @date 08/27/13
 */
class User extends CActiveRecord
{
    public $rememberMe;
    private $_identity;
    /**
     * Hash Key for password md5 store.
     */
    private $_hashkey='SEPV1.0';
    /**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('email, password', 'required', 'on'=>'register'),
            //email
            array('email', 'email', 'on'=>'register'),
            array('email', 'unique', 'on'=>'register'),
            //safe
            array('email, password, nickname, cellphone', 'safe', 'on'=>'register, update')
		);
    }
    
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'user';
    }

    /**
     * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
     */
    public function login()
    {
        if($this->email!==NULL)
            $this->_identity=new UserIdentity($this->email,$this->password);
        else
            $this->_identity=new UserIdentity($this->cellphone, $this->password);
        
        $this->_identity->authenticate();
        
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
        {
            $duration=$this->rememberMe ? 3600*24*30 : 3600*24*1; // 30 days

			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
    }
    /**
     * Validate user->Password equals post or not.
     * @return boolean
     */
    public function validatePassword($pwd)
    {
        return $pwd==$this->password;
    }

    /**
     * @return Hash password 
     */
    public function hashPassword()
    {
        $this->password=md5($this->password.$this->_hashkey);
    }

    /**
     * set attributes on user insert
     * @param array $user=$_POST['user']
     */
    public function setUserAttrs($user=array())
    {
        $this->attributes=$user;
        $this->reg_ip=$this->last_ip=$_SERVER['REMOTE_ADDR'];
        $this->last_login=$this->create_time=time();
        $this->address_id=0;
    }

    /**
     * Update user login ip and modify last_login time
     * @return boolean
     */
    public function updateLoginfo()
    {
        return $this->updateAll(array('last_login'=>time(), 'last_ip'=>$_SERVER['REMOTE_ADDR']), 'email=? OR cellphone=?', array(Yii::app()->user->name, Yii::app()->user->name));
    }

    /**
     * Update user personal information against passsword
     * @return boolean
     */
    public function updateAgainstPwd()
    {
        //echo Yii::app()->user->name;
        return $this->updateAll(array(
            'nickname'=>$this->nickname,
            'cellphone'=>$this->cellphone,
        ), 'email=? OR cellphone=?', array(Yii::app()->user->name, Yii::app()->user->name));
    }

    /**
     * Update user personal information
     * @return boolean
     */
    public function updatePersonal()
    {
        $this->hashPassword();

        return $this->updateAll(array(
            'nickname'=>$this->nickname,
            'password'=>$this->password,
            'cellphone'=>$this->cellphone,
        ), 'email=? OR cellphone=?', array(Yii::app()->user->name, Yii::app()->user->name));
    }

}

