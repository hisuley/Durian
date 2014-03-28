<?php

class PanelUser extends User{
    public $initialPassword, $password2;
    public static function model($className = __CLASS__){
        return parent::model($className);
    }

    public function rules(){
        return array(
            array('password,password2', 'required'),
            array('password,password2', 'length', 'min'=>'6', 'max'=>'100'),
            array('password', 'compare', 'compareAttribute'=>'password2'),
            array('password2', 'safe')
        );
    }

    public function beforeValidate(){
        if(isset($_POST['PanelUser']['password2'])){
            $this->password2 = $_POST['PanelUser']['password2'];
        }
        return parent::beforeValidate();
    }

    public function attributeLabels(){
        $attributes = parent::attributeLabels();
        return array_merge($attributes, array('password2'=>'密码确认'));
    }

    public function beforeSave(){
        if(is_array($this->role)){
            $this->role = implode(',', $this->role);
        }
        $this->password = $this->hashPassword($this->password);
        return parent::beforeSave();
    }

    public function afterFind(){
        $this->initialPassword = $this->password;
        $this->password = null;
        return parent::afterFind();
    }

    public static function checkAttributesAccess($attribute, $model, $original = false){
        if($original){
            return true;
        }
        $roles = Yii::app()->user->role;
        $roles = explode(',', $roles);
        if(isset($model->user_id)){
            $user_id = $model->user_id;
            if($user_id == Yii::app()->user->id){
                array_push($roles,'owner');
            }
        }

        if(empty($model->id)){
            array_push($roles,'owner');
        }

        $privileges = array(
           'operate'=> array('op_id','op_comment','op_time'),
           'finance'=> array('is_pay','accountant_id','pay_cert'),
           'sales'=> array('id','status','country','predict_date','type','amount','price','depart_date','source','contact_name','contact_phone','contact_address','memo','material','create_time','user_id', 'customer'),
           'admin'=>array('id','status','country','predict_date','type','amount','price','depart_date','source','contact_name','contact_phone','contact_address','memo','material','is_pay','create_time','user_id','accountant_id','pay_cert','op_id','op_comment','op_time','sent_id','sent_comment','sent_time','issue_id','issue_comment','issue_time','back_id','back_comment','back_time', 'customer'),
           'owner'=> array('id','status','country','predict_date','type','amount','price','depart_date','source','contact_name','contact_phone','contact_address','memo','material','create_time','user_id', 'customer'),
           'courier_sent'=> array('sent_id','sent_comment','sent_time'),
           'courier_issue'=> array('issue_id','issue_comment','issue_time'),
           'courier_back'=> array('back_id','back_comment','back_time')
        );
        foreach($roles as $role){
            if(!empty($role) && array_key_exists($role, $privileges)){
                $role_access = $privileges[$role];
                if(in_array($attribute, $role_access)){
                    return false;
                }
            }

        }
        return true;
    }
}
?>