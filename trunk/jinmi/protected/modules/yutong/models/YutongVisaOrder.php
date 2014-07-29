<?php
/**
 * Created by Suley.
 * User: suley
 * Date: 1/21/14
 * Time: 2:06 AM
 */

Yii::import('application.modules.panel.models.VisaTypeAgency');
class YutongVisaOrder extends CActiveRecord{
    public $id,$status,$goods_id, $amount, $price, $single_price, $depart_date, $group_sn, $visit_receive, $comment, $company_name, $contact_name, $contact_address, $contact_phone, $user_id, $op_id, $op_comment,$op_time, $material_id, $material_comment, $material_time, $mverify_id, $mverify_comment,$mverify_time, $mverify_resubmit, $sent_id, $sent_comment, $sent_time, $sent_interview, $sent_out_time, $sent_predict_time, $back_id, $back_comment, $back_time, $follow_id, $create_time;
    public $pagination = array('pageSize'=>25);

    const STATUS_WAIT_SALE_CONFIRM = 'wait_sale_confirm';
    const STATUS_SALES_ORDER = 'sales_ordered';
    const STATUS_OP_CONFIRM = 'op_confirm';
    const STATUS_MT_VERIFY = 'material_verify';
    const STATUS_SENTOUT = 'visa_sent';
    const STATUS_ISSUE_VISA = 'issue_visa';
    const STATUS_SENTBACK = 'visa_back';
    const STATUS_COMPLETE = 'complete';
    const STATUS_DELETE = 'delete';
    public static $statusIntl = array(
        self::STATUS_WAIT_SALE_CONFIRM => '订单确认',
        self::STATUS_SALES_ORDER => '下单成功',
        self::STATUS_OP_CONFIRM => '已收证',
        self::STATUS_MT_VERIFY => '资料审核 等待送签',
        self::STATUS_SENTOUT => '已送签',
        self::STATUS_ISSUE_VISA => '已出签',
        self::STATUS_SENTBACK => '已寄回',
        self::STATUS_COMPLETE => '订单完结',
        self::STATUS_DELETE => '订单已删除'
    );
    public function attributeLabels(){
        return array(
            'status' => '状态',
            'accountant_time'=>'支付时间',
            'accountant_id'=>'财务审核人',
            'accountant_handler'=>'财务经手人',
            'accountant_comment'=>'财务备注',
            'country' => '国家',
            'address'=>'地址',
            'sn'=>'订单号',
            'id'=>'订单编号',
            'pay_file'=>'支付水单',
            'single_price'=>'单价',
            'agency_id' => '送签渠道',
            'predict_date' => '预测出签', 'type' => '类型','amount' => '人数','price' => '总价','depart_date' => '出发日期','source' => '订单来源','contact_name' => '联系人姓名','contact_phone' => '电话','contact_address' => '地址','memo' => '备注','material' => '材料','is_pay' => '支付状态','create_time' => '下单时间', 'user_id' => '下单人','accountant_id' => '财务审核','pay_cert' => '支付凭证','op_id' => '操作人','op_comment' => '操作备注','op_time' => '操作时间','sent_id' => '送签人','sent_comment' => '送签备注','sent_time' => '送签时间','issue_id' => '出签人','issue_comment' => '出签备注','issue_time' => '出签时间','back_id' => '物流操作','back_comment' => '物流信息','back_time'=>'物流时间','customer'=>'客户信息', 'order_type'=>'订单信息','sent_agency_source'=>'送签旅行社','delete_id'=>'删除人员', 'delete_comment'=>'删除理由', 'delete_time'=>'删除时间'
        );
    }
    public static function model($className = __CLASS__){
        return parent::model($className);
    }
    public function tableName(){
        return 'yutong_visa_order_info';
    }
    public function afterSave(){

    }
    public function beforeSave(){
        if($this->isNewRecord){
            $this->status = self::STATUS_WAIT_SALE_CONFIRM;
            $this->create_time = strtotime('now');
        }
        $this->update_time = strtotime('now');
        if(!empty($_FILES['YutongVisaOrder']['name']['pay_file'])){
            $image = CUploadedFile::getInstanceByName("YutongVisaOrder[pay_file]");
            $ext = pathinfo($image->name, PATHINFO_EXTENSION);
            $fileName = "pay/".$this->id."_pay.".$ext;
            $filePath = Yii::getPathOfAlias('webroot')."/upload/yutong/".$fileName;
            if($image->saveAs($filePath)){
                $this->pay_file = $fileName;
            }
        }
        return parent::beforeSave();
    }
    public function afterFind(){
       return parent::afterFind();
    }
    public function relations(){
        return array(
            'customers'=>array(self::HAS_MANY, 'YutongVisaOrderCustomers','order_id'),
            'visa' => array(self::BELONGS_TO, 'YutongVisaGoods', 'goods_id'),
            'user' => array(self::BELONGS_TO, 'YutongUser', 'user_id'),
            'op'=> array(self::BELONGS_TO, 'YutongUser', 'op_id'),
            'agency' => array(self::BELONGS_TO, 'VisaTypeAgency', 'agency_id')
        );
    }
    public function rules(){
        return array(
           array('status, agency_id, goods_id, amount, price, single_price, depart_date, group_sn, visit_receive, comment, company_name, contact_name, contact_address, contact_phone, user_id, op_id, op_comment, op_time, material_id ,material_time, material_comment, mverify_id,  mverify_comment ,  mverify_time,  mverify_resubmit ,  sent_id,  sent_comment ,  sent_time,  sent_out_time,  sent_predict_time date not null,  sent_interview ,  back_id,  back_comment ,  back_time,  follow_id,  delivery_id, delivery_comment, delivery_time, accountant_id, accountant_handler, accountant_comment, accountant_time, update_time,  create_time', 'safe')
        );
    }
    public static function translateStatus($status){
        if(!empty(self::$statusIntl[$status]))
            return self::$statusIntl[$status];
        else
            return '';
    }
    
    public function updateOrder($userId){
        if(isset($_POST['YutongVisaOrder'])){
            $postInfo = $_POST['YutongVisaOrder'];
            $updateInfo = array();
            if(isset($postInfo['op_comment'])){
                $updateInfo = $postInfo;
                $updateInfo['op_id'] = $userId;
                $updateInfo['op_time'] = strtotime('now');
            }
            if(isset($postInfo['material_comment'])){
                $updateInfo = $postInfo;
                $updateInfo['material_id'] = $userId;
                $updateInfo['material_time'] = strtotime('now');
            }
            if(isset($postInfo['mverify_comment'])){
                $updateInfo = $postInfo;
                $updateInfo['mverify_id'] = $userId;
                $updateInfo['mverify_time'] = strtotime('now');
            }
            if(isset($postInfo['sent_comment'])){
                $updateInfo = $postInfo;
                $updateInfo['sent_out_time'] = strtotime($updateInfo['sent_out_time']);
                $updateInfo['sent_id'] = $userId;
                $updateInfo['sent_time'] = strtotime('now');
            }
            if(isset($postInfo['back_comment'])){
                $updateInfo = $postInfo;
                $updateInfo['back_id'] = $userId;
                $updateInfo['back_time'] = strtotime('now');
            }
            if(isset($postInfo['delivery_comment'])){
                $updateInfo = $postInfo;
                $updateInfo['delivery_id'] = $userId;
                $updateInfo['delivery_time'] = strtotime('now');
            }
            if(!empty($updateInfo)){
                $this->attributes = $updateInfo;
                $this->status = self::findNextStatus($this->status);
                if($this->save()){
                    return true;
                }
            }

        }
        return false;
    }
    
    public static function allLists(){
        $criteria = new CDbCriteria;
        return new CActiveDataProvider('VisaOrder', array(
            'criteria' => $criteria,
        ));
    }

    public function getSearchCriteria()
    {
        $criteria=new CDbCriteria;

        $criteria->alias = 'order';
        $criteria->compare('order.id', $this->id);
        $criteria->compare('country', $this->country);
        $criteria->compare('is_pay', $this->is_pay);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('source', $this->source);
        $criteria->compare('amount', $this->amount);
        if(empty($this->status)){
            $criteria->compare('order.status !', VisaOrder::STATUS_DELETE);
        }else{
            $criteria->compare('order.status', $this->status);
        }

        if(!empty($this->start_time) && !empty($this->end_time)){
            $criteria->addBetweenCondition('create_time', strtotime($this->start_time), strtotime($this->end_time." +1 days"));
        }

        return $criteria;
    }

    public function getTotals()
    {
        $criteria = $this->getSearchCriteria();
        $criteria->select = "SUM(amount*price)";
        return $this->commandBuilder->createFindCommand($this->getTableSchema(),$criteria)->queryScalar();
    }

    public function getCountryTotals()
    {
        $criteria = $this->getSearchCriteria();
        $criteria->select = "SUM(amount*price)";
        return $this->commandBuilder->createFindCommand($this->getTableSchema(),$criteria)->queryScalar();
    }

    public function getAmountTotals()
    {
        $criteria = $this->getSearchCriteria();
        $criteria->select = "SUM(amount)";
        return $this->commandBuilder->createFindCommand($this->getTableSchema(),$criteria)->queryScalar();
    }

    public function search($params = array('order'=>'order.create_time DESC', 'pagination'=>array('pageSize'=>'100')), $returnType = 'CActiveDataProvider', $meOnly = true){
        $criteria = new CDbCriteria;
        if($meOnly){
            $criteria->addCondition('user_id = '.Yii::app()->user->id, 'AND');
            $criteria->with = array('visa'=>array('select'=>'visa.*', 'together'=>true), 'user');

        }
        /*
        $criteria->alias = 'order';
        $criteria->compare('order.id', $this->id);
        $criteria->compare('country', $this->country);
        $criteria->compare('is_pay', $this->is_pay);
        $criteria->compare('amount', $this->amount);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('source', $this->source);
        if(empty($this->status)){
            $criteria->compare('order.status !', VisaOrder::STATUS_DELETE);
        }else{
            $criteria->compare('order.status', $this->status);
        }
        if(!empty($this->start_time) && !empty($this->end_time)){
            $criteria->addBetweenCondition('order.create_time', strtotime($this->start_time), strtotime($this->end_time." +1 days"));
        }


        if(!empty($_GET['customer_name'])){
            $this->search_customer = trim($_GET['customer_name']);
            $criteria->compare('customer.name', $this->search_customer, true);
            $criteria->with = array('customer'=>array('select'=>'customer.name','together'=>true));
            //$criteria->join = 'visa_order_customer';
        }
        */
                if($returnType == 'CActiveDataProvider'){
            return new CActiveDataProvider('YutongVisaOrder', array(
                'criteria' => $criteria,
                'sort' => array(
                    //'defaultOrder'=>$params['order']
                ),
                //'pagination' => $params['pagination']
            ));
        }else{
            return self::model()->findAll($criteria);
            //return self::model()->findAll($criteria);
        }


    }
    public static function joinCustomer($data, $cut = false){
        $customer = array();
        foreach($data as $v){
            array_push($customer, $v->customer_name."(护照：".$v->passport.")");
        }
        if($cut){
            $customer = array_slice($customer,0, 3);
            array_push($customer,'等');
        }
        return implode(',', $customer);
    }

    public static function checkStatusPos($currentStatus,$status){
        $statusKey = 0;
        $currentStatusKey = 0;
        $counter = 0;
        foreach(self::$statusIntl as $key=>$val){
            if($key == $status){
                $statusKey = $counter;
            }
            if($key == $currentStatus){
                $currentStatusKey = $counter;
            }

            $counter++;
        }
        if($currentStatusKey >= $statusKey){
            return true;
        }else{
            return false;
        }
    }

    public static function findNextStatus($status){
        if(array_key_exists($status, self::$statusIntl)){
            $statusData = self::$statusIntl;
            reset($statusData);
            while(key($statusData) != $status){
                next($statusData);
            }
            next($statusData);
            return key($statusData);
        }
    }

    public static function checkIfCurrentOps($currentStatus,$status){
        $statusKey = 0;
        $currentStatusKey = 0;
        $counter = 0;
        foreach(self::$statusIntl as $key=>$val){
            if($key == $status){
                $statusKey = $counter;
            }
            if($key == $currentStatus){
                $currentStatusKey = $counter;
            }

            $counter++;
        }
        if(($currentStatusKey+1) == $statusKey){
            return true;
        }else{
            return false;
        }
    }

    /*
     * The SN generator of an order
     * @param CActiveReocord $model
     * @format
     * Y0   20130707    000000     000000000
     * OrderType    OrderDate   OrderPlacer     OrderId
     */

    public static function generateOrderSnNumber($model){
        $currentDate = date('ymd');
        $orderType = "Y0";
        $orderId = $model->id;
        $userId = $model->user_id;
        if(count($orderId) < 7){
            for($i = 0; $i < (7 - count($model->id)); $i++){
                $orderId = "0".$orderId;
            }
        }
        if(count($model->user_id) < 5){
            for($i = 0; $i < (5 - count($model->id)); $i++){
                $userId = "0".$userId;
            }
        }
        return $orderType.$currentDate.$userId.$orderId;

    }

}