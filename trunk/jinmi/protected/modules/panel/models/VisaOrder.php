<?php
/**
 * Created by Suley.
 * User: suley
 * Date: 1/21/14
 * Time: 2:06 AM
 */

class VisaOrder extends CActiveRecord{
    public $id,$status,$country,$predict_date, $type,$amount,$price,$depart_date,$source,$contact_name,$contact_phone,$contact_address,$memo,$material,$is_pay,$create_time, $user_id,$accountant_id ,$pay_cert,$op_id ,$op_comment ,$op_time ,$sent_id ,$sent_comment ,$sent_time ,$issue_id ,$issue_comment,$issue_time,$back_id,$back_comment,$back_time;
    
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
    public function attributeLabels(){
        return array(
            'status' => '状态',
            'country' => '国家',
            'predict_date' => '预测出签', 'type' => '类型','amount' => '人数','price' => '价格','depart_date' => '出发日期','source' => '订单来源','contact_name' => '联系人姓名','contact_phone' => '电话','contact_address' => '地址','memo' => '备注','material' => '材料','is_pay' => '支付状态','create_time' => '下单时间', 'user_id' => '下单人','accountant_id' => '财务审核人','pay_cert' => '支付凭证','op_id' => '操作人','op_comment' => '操作备注','op_time' => '操作时间','sent_id' => '送签人','sent_comment' => '送签备注','sent_time' => '送签时间','issue_id' => '出签人','issue_comment' => '出签备注','issue_time' => '出签时间','back_id' => '物流操作','back_comment' => '物流信息','back_time'=>'物流时间','customer'=>'客户信息', 'order_type'=>'订单信息'
        );
    }
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
        }else{
            if($this->is_pay == 1){
                $oldRecord = VisaOrder::findByPk($this->id);
                if($oldRecord->is_pay == 0){
                    $this->accountant_id = Yii::app()->user->id;
                }
            }
        }

        return parent::beforeSave();
    }
    public function afterFind(){
        $this->material = explode(',', $this->material);
        if(is_numeric($this->depart_date)){
            $this->depart_date = date('Y-m-d',$this->depart_date);
        }
        return parent::afterFind();
    }
    public function relations(){
        return array(
            'customer'=>array(self::HAS_MANY, 'VisaOrderCustomer','visa_order_id'),
            'order_source' => array(self::BELONGS_TO, 'OrderSource', 'source'),
            'order_type' => array(self::BELONGS_TO, 'VisaType', 'type'),
            'country_source' => array(self::BELONGS_TO, 'Address', 'country')
        );
    }
    public function rules(){
        return array(
            //array('id, status,country,predict_date,type,amount,price,depart_date,source,contact_name,contact_phone,contact_address,memo,material,is_pay,create_time, user_id,accountant_id ,pay_cert,op_id ,op_comment ,op_time ,sent_id ,sent_comment ,sent_time ,issue_id ,issue_comment,issue_time,back_id,back_comment,back_time','safe',),
            array('id, status,depart_date,memo,create_time, user_id,accountant_id ,pay_cert,op_id ,op_comment ,op_time ,sent_id ,sent_comment ,sent_time ,issue_id ,issue_comment,issue_time,back_id,back_comment,back_time,is_pay','safe'),
            array('price,country,predict_date,type,amount,price,source,contact_name,contact_phone,material,amount', 'required'),
            array('country', 'numerical'),
            array('predict_date', 'numerical'),
            array('type', 'numerical'),
            array('amount', 'numerical'),
            array('price', 'numerical'),
            array('source', 'numerical'),
            array('contact_name', 'length', 'min'=> 2, 'max'=> 10),
            array('contact_phone', 'length', 'min'=> 7, 'max'=> 15),
            array('contact_address', 'length', 'min'=> 10, 'max'=> 255),
            array('is_pay', 'numerical')
        );
    }
    public static function translateStatus($status){
        if(!empty(self::$statusIntl[$status]))
            return self::$statusIntl[$status];
        else
            return '';
    }
    public static function allLists(){
        $criteria = new CDbCriteria;
        //$criteria->compare('id', $this->id);
        return new CActiveDataProvider('VisaOrder', array(
            'criteria' => $criteria,
        ));
    }
    public function search(){
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('country', $this->country);
        $criteria->compare('is_pay', $this->is_pay);
        $criteria->compare('status', $this->status);
        $criteria->compare('user_id', $this->user_id);
        $criteria->addBetweenCondition('create_time', strtotime($this->create_time), strtotime($this->create_time." +1 days"));
        $criteria->addBetweenCondition('issue_time', strtotime($this->issue_time), strtotime($this->issue_time." +1 days"));
        return new CActiveDataProvider('VisaOrder', array(
            'criteria' => $criteria,
        ));
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

    public static function findOutStatus($type){
        switch($type){
            case 'op':
                $status = self::STATUS_OP_CONFIRM;
                break;
            case 'sent':
                $status = self::STATUS_SENTOUT;
                break;
            case 'issue':
                $status = self::STAUTS_ISSUE_VISA;
                break;
            case 'back':
                $status = self::STATUS_SENTBACK;
                break;
        }
        return $status;
    }

    public static function stat(){
        $count = array();
        $count['complete'] = self::model()->countByAttributes(array('status'=>self::STATUS_COMPLETE));
        $count['not_sent'] = self::model()->countByAttributes(array('status'=>array(self::STATUS_OP_CONFIRM, self::STATUS_SALES_ORDER)));
        $count['ongoing'] = self::model()->count('status != :status', array(':status'=>self::STATUS_COMPLETE));
        $count['wait_for_issue'] = self::model()->countByAttributes(array('status'=>self::STATUS_SENTOUT));
        $count['is_not_paid'] = self::model()->count('is_pay = :pay', array(':pay'=>0));
        $tempAmount = Yii::app()->db->createCommand('SELECT sum(price) as sum FROM visa_order WHERE is_pay = 0')->queryScalar();;
        $count['total_amount'] = $tempAmount;
        return $count;
    }

    public static function joinCustomer($data){
        $cutomer = array();
        foreach($data as $v){
            array_push($cutomer, $v->name."(".$v->passport.")");
        }
        return implode('<br />', $cutomer);
    }
    public static function getFirstCustomer($data){
        $customer = array();
        foreach($data as $v){
            array_push($customer, $v->name);
        }
        $firstCustomer = '';
        if(isset($customer[0])){
            if(count($customer) > 1){
                $firstCustomer = $customer[0]."等";
            }else{
                $firstCustomer = $customer[0];
            }

        }
        return $firstCustomer;
    }
}