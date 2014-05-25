<?php
/**
 * Created by Suley.
 * User: suley
 * Date: 1/21/14
 * Time: 2:06 AM
 */

class VisaOrder extends CActiveRecord{
    public $id,$customer_agency_id,$customer_ids, $status,$country,$predict_date, $type,$amount,$price,$depart_date,$source,$contact_name,$contact_phone,$contact_address,$memo,$material,$is_pay,$create_time, $user_id,$accountant_id ,$pay_cert,$op_id ,$op_comment ,$op_time ,$sent_id ,$sent_comment ,$sent_time ,$issue_id ,$issue_comment,$issue_time,$back_id,$back_comment,$back_time, $sent_agency_source, $search_customer, $delete_time, $delete_id, $delete_comment;
    public $_old;
    public $notInList;
    public $agencyIdNotNull = false;
    public $start_time, $end_time;
    public $pagination = array('pageSize'=>25);
    /* Total Status */
    const STATUS_SALES_ORDER = 'sales_ordered';
    const STATUS_OP_CONFIRM = 'op_confirm';
    const STATUS_PARTIAL_SENT = "visa_partial_sent";
    const STATUS_SENTOUT = 'visa_sent';
    const STAUTS_ISSUE_VISA = 'issue_visa';
    const STATUS_SENTBACK = 'visa_back';
    const STATUS_RECEIVED = 'received';
    const STATUS_COMPLETE = 'complete';
    const STATUS_DELETE = 'delete';
    public static $statusIntl = array(
        self::STATUS_SALES_ORDER => '操作待确认',
        self::STATUS_OP_CONFIRM => '待送签',
        self::STATUS_PARTIAL_SENT => "部分送签",
        self::STATUS_SENTOUT => '已送签',
        self::STAUTS_ISSUE_VISA => '已出签',
        self::STATUS_SENTBACK => '已寄回',
        self::STATUS_RECEIVED => '已接受',
        self::STATUS_COMPLETE => '订单完结',
        self::STATUS_DELETE => '订单已删除'
    );

    /* Sub Sent Status */
    const SENT_NO = 'no';
    const SENT_PARTIAL = 'partial';
    const SENT_ALL = 'all';

    /* Sub Issue Status */


    public function attributeLabels(){
        return array(
            'status' => '状态',
            'country' => '国家',
            'customer_agency_id'=>'送签渠道',
            'predict_date' => '预测出签', 'type' => '类型','amount' => '人数','price' => '价格','depart_date' => '出发日期','source' => '订单来源','contact_name' => '联系人姓名','contact_phone' => '电话','contact_address' => '地址','memo' => '备注','material' => '材料','is_pay' => '支付状态','create_time' => '下单时间', 'user_id' => '下单人','accountant_id' => '财务审核','pay_cert' => '支付凭证','op_id' => '操作人','op_comment' => '操作备注','op_time' => '操作时间','sent_id' => '送签人','sent_comment' => '送签备注','sent_time' => '送签时间','issue_id' => '出签人','issue_comment' => '出签备注','issue_time' => '出签时间','back_id' => '物流操作','back_comment' => '物流信息','back_time'=>'物流时间','customer'=>'客户信息', 'order_type'=>'订单信息','sent_agency_source'=>'送签旅行社','delete_id'=>'删除人员', 'delete_comment'=>'删除理由', 'delete_time'=>'删除时间'
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
                $oldRecord = self::model()->findByPk($this->id);
                if($oldRecord->is_pay == 0){
                    $this->accountant_id = Yii::app()->user->id;
                    $this->memo = $this->memo."\n".User::getUserRealname(Yii::app()->user->id)."于".date("Y-m-d H:i")."更新了订单：订单状态更改为已支付。";
                    foreach($this->customer as $customer){
                        $customer->is_pay = 1;
                        $customer->save();
                    }
                }
            }elseif($this->is_pay == 0){
                $oldRecord = self::model()->findByPk($this->id);
                if($oldRecord->is_pay == 1){
                    $this->accountant_id = Yii::app()->user->id;
                    $this->memo = $this->memo."\n".User::getUserRealname(Yii::app()->user->id)."于".date("Y-m-d H:i")."更新了订单：订单状态变更为未支付。";
                }
            }
        }

        if(isset($this->_old)){
            if($this->_old->status != $this->status){
                $message = new PanelMessage();
                $message->addMessage('订单状态修改', '<a href=\''.Yii::app()->createUrl('panel/visa/update', array('id'=>$this->id)).'\'>订单#'.$this->id.'</a>&nbsp;状态从['.self::$statusIntl[$this->_old->status].']变更为['.self::$statusIntl[$this->status].']', PanelMessage::TYPE_NOTICE, $this->user_id);
            }
            if($this->_old->is_pay == 1 && $this->is_pay == 0){
                $this->is_pay = 1;
            }
        }

        $this->need_pay_out_amount = VisaOrder::sumCustomerVal($this->customer);

        return parent::beforeSave();
    }
    public function afterFind(){
        $this->material = explode(',', $this->material);
        if(is_numeric($this->depart_date)){
            $this->depart_date = date('Y-m-d',$this->depart_date);
        }
        if(intval($this->total_price) == 0){
            $this->total_price = floatval($this->price * $this->amount);
        }
        $this->_old = clone $this;
        return parent::afterFind();
    }
    public function relations(){
        //TODO: add condition to both $on statement.
        $on = '(customer.status IS NULL OR customer.status != '.VisaOrderCustomer::STATUS_DELETED.') ';
        if(!empty($this->customer_agency_id)){
            $on = 'customer.agency_id = '.$this->customer_agency_id.' AND customer.status != '.VisaOrderCustomer::STATUS_DELETED;;
        }
        if(!empty($this->customer_ids) && is_array($this->customer_ids)){
            $on = 'customer.id IN ('.implode(',', $this->customer_ids).')';
        }
        return array(
            'customer'=>array(self::HAS_MANY, 'VisaOrderCustomer','visa_order_id', 'on'=>$on),
            'order_source' => array(self::BELONGS_TO, 'OrderSource', 'source'),
            'order_type' => array(self::BELONGS_TO, 'VisaType', 'type'),
            'country_source' => array(self::BELONGS_TO, 'Address', 'country'),
            'agency_source' => array(self::BELONGS_TO, 'OrderSource', 'sent_agency_source'),
            'agency' => array(self::BELONGS_TO, 'VisaTypeAgency', 'agency_id'),
            'financeRecord'=>array(self::HAS_ONE, 'FinanceItems', 'vid', 'on'=>'financeRecord.type = "'.FinanceItems::TYPE_VISA_ORDER.'"'),
            'stat_cost_price'=>array(self::STAT, 'VisaOrderCustomer', 'visa_order_id', 'select'=>'SUM(cost_price)' ),
            'stat_price'=>array(self::STAT, 'VisaOrderCustomer', 'visa_order_id', 'select'=>'SUM(price)' ),
        );
    }
    public function rules(){
        return array(
            //array('id, status,country,predict_date,type,amount,price,depart_date,source,contact_name,contact_phone,contact_address,memo,material,is_pay,create_time, user_id,accountant_id ,pay_cert,op_id ,op_comment ,op_time ,sent_id ,sent_comment ,sent_time ,issue_id ,issue_comment,issue_time,back_id,back_comment,back_time','safe',),
            array('_old,customer_agency_id, agencyIdNotNull, total_price, predict_date, id, status,depart_date,memo,create_time, single_price, user_id,accountant_id ,pay_cert,op_id ,op_comment ,op_time ,sent_id ,sent_comment ,sent_time ,issue_id ,issue_comment,issue_time,back_id,back_comment,back_time,is_pay,sent_agency_source, delete_id, delete_comment, delete_time, start_time, end_time, agency_id, is_pay_out','safe'),
            array('price,country,type,amount,source,contact_name,contact_phone,material,amount', 'required'),
            array('country', 'numerical'),
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

    public function getSearchCriteria()
    {
        $criteria = new CDbCriteria;
        $criteria->with = array('customer'=>array('select'=>'customer.*','together'=>true));
        $criteria->alias = 'order';
        $criteria->compare('order.id', $this->id);
        if(!empty($this->notInList) && is_array($this->notInList)){
            $criteria->addNotInCondition('order.id', $this->notInList);
        }
        $criteria->compare('order.is_pay_out', $this->is_pay_out);
        $criteria->compare('order.country', $this->country);
        $criteria->compare('order.is_pay', $this->is_pay);
        $criteria->compare('order.amount', $this->amount);
        $criteria->compare('order.user_id', $this->user_id);
        $criteria->compare('order.source', $this->source);
        if(empty($this->status)){
            $criteria->compare('order.status !', VisaOrder::STATUS_DELETE);
        }elseif(is_array($this->status)){
            $criteria->addInCondition('order.status', $this->status);
        }else{
            $criteria->compare('order.status', $this->status);
        }
        if(!empty($this->start_time) && !empty($this->end_time)){
            $criteria->addBetweenCondition('order.create_time', strtotime($this->start_time), strtotime($this->end_time." +1 days"));
        }
        /*

        if(!empty($_GET['customer_name'])){
            $this->search_customer = trim($_GET['customer_name']);
            $criteria->compare('customer.name', $this->search_customer, true);
            $criteria->with = array('customer'=>array('select'=>'customer.name','together'=>true));
            //$criteria->join = 'visa_order_customer';
        }*/

        if(!empty($this->customer_agency_id)){
            $criteria2 = new CDbCriteria;
            $criteria2->addCondition('agency_id = '.$this->customer_agency_id);
            $agencyResult = VisaTypeAgency::model()->findAll($criteria2);
            $agencyKeys= array();
            foreach($agencyResult as $agency){
                array_push($agencyKeys, $agency->id);
            }
            $criteria->addInCondition('customer.agency_id', $agencyKeys);
            //$criteria->compare('customer.is_pay_out', 0, false);
            $criteria->with = array('customer'=>array('select'=>'customer.*','together'=>true));
            //$criteria->join = 'visa_order_customer';
        }
        if(is_array($this->customer_ids)){
            $criteria->addInCondition('customer.id', $this->customer_ids);
            $criteria->with = array('customer'=>array('select'=>'customer.*','together'=>true));
        }

        return $criteria;
    }

    public function getUnpaidAmount(){
        $criteria = new CDbCriteria();
        $criteria->addCondition('is_pay = 0');
        $criteria->addCondition('status != "'.VisaOrder::STATUS_DELETE.'"');
        $criteria->select = "SUM(total_price)";
        return $this->commandBuilder->createFindCommand($this->getTableSchema(),$criteria)->queryScalar();
    }

    public function getUnpayoutAmount(){
        $criteria = new CDbCriteria();
        $criteria->addCondition('is_pay_out != 1 AND need_pay_out_amount > 0');
        $criteria->addCondition('status != "'.VisaOrder::STATUS_DELETE.'"');
        $criteria->select = "SUM(need_pay_out_amount-pay_out_amount)";
        return $this->commandBuilder->createFindCommand($this->getTableSchema(),$criteria)->queryScalar();
    }



    public function getTotals()
    {
        $criteria = $this->getSearchCriteria();
        $criteria->select = "SUM(amount*price)";
        return $this->commandBuilder->createFindCommand($this->getTableSchema(),$criteria)->queryScalar();
    }

    public function getCollectionTotals()
    {
        $criteria = $this->getSearchCriteria();
        $result = self::model()->findAll($criteria);
        $totalVal = 0.00;
        foreach($result as $key=>$val){
            if(!empty($val->financeRecord)){
                $totalVal += $val->financeRecord->transaction_value;
            }

        }
        return $totalVal;
    }

    public function getOrderTotals(){
        $criteria = $this->getSearchCriteria();
        return self::model()->count($criteria);
    }

    public function getSentTotals(){
        $criteria = $this->getSearchCriteria();
        $result = self::model()->findAll($criteria);
        $totalVal = 0;
        foreach($result as $key=>$val){
            $totalVal += count($val->customer);

        }
        return $totalVal;
    }

    public function getPayTotals()
    {
        $criteria = $this->getSearchCriteria();
        $result = self::model()->findAll($criteria);
        $totalVal = 0.00;
        foreach($result as $key=>$val){
            if(!empty($val->stat_cost_price)){
                $totalVal += $val->stat_cost_price;
            }

        }
        return $totalVal;
    }

    public function getPriceTotals()
    {
        $criteria = $this->getSearchCriteria();
        $result = self::model()->findAll($criteria);
        $totalVal = 0.00;
        foreach($result as $key=>$val){
            if(!empty($val->stat_price)){
                $totalVal += $val->stat_price;
            }

        }
        return $totalVal;
    }
    public function getCostPriceTotals()
    {
        $criteria = $this->getSearchCriteria();
        $result = self::model()->findAll($criteria);
        $totalVal = 0.00;
        foreach($result as $key=>$val){
            if(!empty($val->stat_price)){
                $totalVal += $val->stat_cost_price;
            }

        }
        return $totalVal;
    }
    //TODO: Fix this function
    public function getCostPriceUnpaidTotals()
    {
        $criteria = $this->getSearchCriteria();
        $result = self::model()->findAll($criteria);
        $totalVal = 0.00;
        foreach($result as $key=>$val){
            if(!empty($val->stat_price)){
                $totalVal += $val->stat_cost_price;
            }

        }
        return $totalVal;
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
        $criteria->with = array('customer'=>array('select'=>'customer.*','together'=>true));
        $criteria->select = "SUM(amount)";
        return $this->commandBuilder->createFindCommand($this->getTableSchema(),$criteria)->queryScalar();
    }

    public function search($params = array('order'=>'order.create_time DESC', 'pagination'=>array('pageSize'=>'25'))){
        $criteria = new CDbCriteria;

        $criteria->alias = 'order';
        $criteria->compare('order.id', $this->id);
        if(!empty($this->notInList) && is_array($this->notInList)){
            $criteria->addNotInCondition('order.id', $this->notInList);
        }
        $criteria->compare('order.is_pay_out', $this->is_pay_out);
        $criteria->compare('order.country', $this->country);
        $criteria->compare('order.is_pay', $this->is_pay);
        $criteria->compare('order.amount', $this->amount);
        $criteria->compare('order.user_id', $this->user_id);
        $criteria->compare('order.source', $this->source);
        if(empty($this->status)){
            $criteria->compare('order.status !', VisaOrder::STATUS_DELETE);
        }elseif(is_array($this->status)){
            $criteria->addInCondition('order.status', $this->status);
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

        if(!empty($this->customer_agency_id)){
            $criteria2 = new CDbCriteria;
            $criteria2->addCondition('agency_id = '.$this->customer_agency_id);
            $agencyResult = VisaTypeAgency::model()->findAll($criteria2);
            $agencyKeys= array();
            foreach($agencyResult as $agency){
                array_push($agencyKeys, $agency->id);
            }
            $criteria->addInCondition('customer.agency_id', $agencyKeys);
            $criteria->addNotInCondition('customer.status', array(VisaOrderCustomer::STATUS_DELETED, VisaOrderCustomer::STATUS_DEFAULT));
            $criteria->with = array('customer'=>array('select'=>'customer.*','together'=>true));
            //$criteria->join = 'visa_order_customer';
        }
        if(is_array($this->customer_ids)){
            $criteria->addInCondition('customer.id', $this->customer_ids);
            $criteria->with = array('customer'=>array('select'=>'customer.*','together'=>true));
        }

        if($this->agencyIdNotNull){
            $result = VisaOrder::model()->findAll($criteria);
            foreach($result as $key=>$item){
                if(count($item->customer) == 0){
                    unset($result[$key]);
                }
            }
            return new CArrayDataProvider($result);
        }else{
            return new CActiveDataProvider('VisaOrder', array(
                'criteria' => $criteria,
                'sort' => array(
                    'defaultOrder'=>$params['order']
                ),
                'pagination' => $params['pagination']
            ));
        }


    }

    public function searchForReport($returnType = 'DataProvider'){
        if(!empty($_POST['start_date'])){
            $startTime = strtotime($_POST['start_date']);
            $endTime = strtotime($_POST['start_date']." + 1 days");

        }else{
            $startTime = strtotime('now - 1 years');
            $endTime = strtotime("now + 1 years");
        }
        $data = VisaOrder::model()->findAll('status = :status AND sent_time BETWEEN :start_time AND :end_time ', array(':status'=>VisaOrder::STATUS_SENTOUT,':start_time'=>$startTime, ':end_time'=>$endTime));

        $compareDuplicate = array();
        foreach($data as $key=>&$records){
            $tempKey = "country".$records->country."sent_agency_source".$records->sent_agency_source."type";
            if(array_key_exists($tempKey, $compareDuplicate)){
                $compareDuplicate[$tempKey]['amount'] += $records->amount;
                $compareDuplicate[$tempKey]['customers'] = array_merge($compareDuplicate[$tempKey]['customers'], (array)$records->customer);
            }else{
                $compareDuplicate[$tempKey]['key'] = $records->id;
                $compareDuplicate[$tempKey]['amount'] = $records->amount;
                $compareDuplicate[$tempKey]['customers'] = (array)$records->customer;
            }
        }

        foreach($data as $key=>&$records){
            $tempKey = "country".$records->country."sent_agency_source".$records->sent_agency_source."type";
            if(array_key_exists($tempKey, $compareDuplicate) && $compareDuplicate[$tempKey]['key'] != $records->id){
               unset($records);
            }else{
                $records->amount = $compareDuplicate[$tempKey]['amount'];
                $records->customer = (object)$compareDuplicate[$tempKey]['customers'];
            }
        }
        if($returnType == 'DataProvider'){
            $data = new CArrayDataProvider($data, array(
                'pagination'=>array(
                    'pageSize' => 10000
                )
            ));
        }

        return $data;
    }

    public function beforeDelete(){
        $name = Yii::app()->user->name;
        $id = Yii::app()->user->id;
        
        parent::beforeDelete();
        return true;
    }

    public function afterDelete(){
        parent::afterDelete();
        VisaOrderCustomer::model()->deleteAllByAttributes(array('visa_order_id'=>$this->id));
        return true;
    }

    public static function deleteVisaRecord($id){
        self::model()->deleteByPk($id);

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

    public static function findOutCurrentStatus($id){


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

    public static function joinCustomerByHiddenInput($data, $id){
        $cutomer = array();
        foreach($data as $v){
            array_push($cutomer, $v->id);
        }
        return CHtml::hiddenField('VisaOrderCustomerIds['.$id.']', implode(',', $cutomer));
    }


    /*
     * Find order and customer filter by customer id and order id
     * @param $cId array
     * @param $oId array
     */
    public function complexOrderProcessByCustomersAndAgency($cId, $oId){
        if(is_array($cId) && is_array($oId)){
            $this->unsetAttributes();
            $this->customer_ids = $cId;
            $this->id = $oId;
            $orders = $this->search();
            return $orders;
        }
        return false;
    }

    public static function joinCustomerByNewLine($data){
        $cutomer = array();
        foreach($data as $v){
            array_push($cutomer, $v->name."[护照号：".$v->passport."]");
        }
        return implode('|', $cutomer);
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


    public static function sumCustomerVal($customers){
        $total_price = 0.00;
        foreach($customers as $customer){
            if(!empty($customer->cost_price)){
                $total_price += floatval($customer->cost_price);
            }
        }
        return $total_price;
    }
    public static function getCustomerPayMethod($customers){
        $method = array();
        foreach($customers as $customer){
            if(!empty($customer->financeRecord->record)){
                if(!array_key_exists($customer->financeRecord->record->charge_account_id, $method)){
                    $method[$customer->financeRecord->record->charge_account_id] = $customer->financeRecord->record->charge_account->name;
                }
            }
        }
        if(count($method > 1)){
            return implode("<br />", $method);
        }else{
            return $method[0];
        }
    }

}