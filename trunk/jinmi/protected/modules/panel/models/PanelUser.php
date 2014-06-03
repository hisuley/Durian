<?php

class PanelUser extends User{
    public static $privileges = array(
        'operate'=> array('op_id','op_comment','op_time'),
        'finance'=> array('is_pay','accountant_id','pay_cert', 'customer.is_pay', 'customer.status', 'customer.price'),
        'sales'=> array('id','status','country','predict_date','type','amount','price','depart_date','source','contact_name','contact_phone','contact_address','memo','material','create_time','user_id', 'customer'),
        'admin'=>array('agency_id', 'id','status','country','predict_date','type','amount','price','depart_date','source','contact_name','contact_phone','contact_address','memo','material','is_pay','create_time','user_id','accountant_id','pay_cert','op_id','op_comment','op_time','sent_id','sent_comment','sent_time','issue_id','issue_comment','issue_time','back_id','back_comment','back_time', 'customer','sent_agency_source'),
        'owner'=> array('id','status','country','predict_date','type','amount','price','depart_date','source','contact_name','contact_phone','contact_address','memo','material','create_time','user_id', 'customer','sent_agency_source'),
        'courier_sent'=> array('agency_id', 'sent_id','sent_comment','sent_time'),
        'courier_issue'=> array('agency_id', 'issue_id','issue_comment','issue_time'),
        'courier_back'=> array('agency_id','back_id','back_comment','back_time')
    );
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
        return array_merge($attributes, array('password2'=>'密码确认', 'initial_password'=>'初始密码'));
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
           'finance'=> array('is_pay','accountant_id','pay_cert', 'customer.is_pay', 'customer.status', 'customer.price'),
           'sales'=> array('id','status','country','predict_date','type','amount','price','depart_date','source','contact_name','contact_phone','contact_address','memo','material','create_time','user_id', 'customer'),
           'admin'=>array('agency_id', 'id','status','country','predict_date','type','amount','price','depart_date','source','contact_name','contact_phone','contact_address','memo','material','is_pay','create_time','user_id','accountant_id','pay_cert','op_id','op_comment','op_time','sent_id','sent_comment','sent_time','issue_id','issue_comment','issue_time','back_id','back_comment','back_time', 'customer','sent_agency_source'),
           'owner'=> array('id','status','country','predict_date','type','amount','price','depart_date','source','contact_name','contact_phone','contact_address','memo','material','create_time','user_id', 'customer','sent_agency_source'),
           'courier_sent'=> array('agency_id', 'sent_id','sent_comment','sent_time'),
           'courier_issue'=> array('agency_id', 'issue_id','issue_comment','issue_time'),
           'courier_back'=> array('agency_id','back_id','back_comment','back_time')
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


    public static function checkAccessToFunction($name){
        $roles = Yii::app()->user->role;
        $roles = explode(',', $roles);
        $privileges = array(
          'finance'=>array('finance'),
          'admin'=>array('*'),
          'operate'=>array('visa'),
          'sales'=>array('visa'),
          'courier'=>array('visa'),
          'purchase'=>array('admin')
        );
        foreach($roles as $role){
            if($role == 'admin'){
                return true;
            }else{
                if(array_key_exists($role, $privileges)){
                    if(in_array($name, $privileges[$role])){
                        return true;
                    }
                }
            }
        }

        return false;
    }


    public static function getListOp(){
        if(in_array('admin', explode(',',Yii::app()->user->role))){
            return '{view}{update}{delete}';
        }else{
            return '{view}{update}';
        }
    }

    public static function findAccountant(){
        return 6;
    }

    public static function checkIfAdmin(){
        $id = Yii::app()->user->id;
        $model = User::model()->findByPk($id);
        $roles = explode(",", $model->role);
        if($model->role == 'admin'){
            return true;
        }else{
            return false;
        }
    }
}
?>