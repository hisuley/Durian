<?php
/**
 * Created by Suley.
 * User: suley
 * Date: 1/21/14
 * Time: 2:06 AM
 */

class VisaOrder extends CActiveRecord{
    public $id,$status,$country,$predict_date, $type,$amount,$price,$depart_date,$source,$contact_name,$contact_phone,$contact_address,$memo,$material,$is_pay,$create_time, $user_id;
    const STATUS_SALES_ORDER = 'sales_ordered';
    const STATUS_OP_CONFIRM = 'op_confirm';
    const STATUS_SENTOUT = 'visa_sent';
    const STAUTS_ISSUE_VISA = 'issue_visa';
    const STATUS_SENTBACK = 'visa_back';
    const STATUS_RECEIVED = 'received';
    const STATUS_COMPLETE = 'complete';
    public static $statusIntl = array(
        self::STATUS_SALES_ORDER => '操作待确认',
        self::STATUS_OP_CONFIRM => '待送签',
        self::STATUS_SENTOUT => '已送签',
        self::STAUTS_ISSUE_VISA => '已出签',
        self::STATUS_SENTBACK => '已寄回',
        self::STATUS_RECEIVED => '已接受',
        self::STATUS_COMPLETE => '订单完结'
    );
    public static function model($className = __CLASS__){
        return parent::model($className);
    }
    public function tableName(){
        return 'visa_order';
    }
    public function beforeSave(){
        if(is_array($this->material)){
            $this->material = implode(',', $this->material);
        }
        if(!is_numeric($this->depart_date)){
            $this->depart_date = strtotime($this->depart_date);
        }
        //if(!is_numeric($this->predict_date)){
        //    $this->predict_date = strtotime($this->predict_date);
        //}
        if($this->isNewRecord){
            $this->create_time = strtotime('now');
        }
        return parent::beforeSave();
    }
    public function afterFind(){
        $this->material = explode(',', $this->material);
        $this->depart_date = intval($this->depart_date);
        $this->depart_date = date('Y-m-d',$this->depart_date);
        return parent::afterFind();
    }
    public function relations(){
        return array(
            'customer'=>array(self::HAS_MANY, 'VisaOrderCustomer','visa_order_id')
        );
    }
    public function rules(){
        return array(
            array('id, status,country,predict_date,type,amount,price,depart_date,source,contact_name,contact_phone,contact_address,memo,material,is_pay,create_time, user_id','safe')
        );
    }
    public static function translateStatus($status){
        if(!empty(self::$statusIntl[$status]))
            return self::$statusIntl[$status];
        else
            return '';
    }
    public static function allLists(){
        //$criteria = new CDbCriteria;
        return new CActiveDataProvider('VisaOrder', array());
    }
    public static function deleteVisaRecord($id){
        self::model()->deleteByPk($id);
        VisaOrderCustomer::model()->deleteAllByAttributes(array('visa_order_id'=>$id));
        return true;
    }
    public static function translateMaterial($material){
        $mat_base = array('photo'=>'照片', 'passport'=>'护照', 'residence'=>'户口本', 'financeproof'=>'财力证明', 'id'=>'身份证');
        return $mat_base[$material];
    }

    public static function stat(){
        $count = array();
        $count['complete'] = self::model()->countByAttributes(array('status'=>self::STATUS_COMPLETE));
        $count['not_sent'] = self::model()->countByAttributes(array('status'=>array(self::STATUS_OP_CONFIRM, self::STATUS_SALES_ORDER)));
        $count['ongoing'] = self::model()->count('status != :status', array(':status'=>self::STATUS_COMPLETE));
        $count['is_not_paid'] = self::model()->count('is_pay = :pay', array(':pay'=>0));
        $tempAmount = Yii::app()->db->createCommand('SELECT sum(price) as sum FROM visa_order WHERE is_pay = 0')->queryScalar();;
        $count['total_amount'] = $tempAmount;
        return $count;
    }
}