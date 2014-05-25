<?php
/**
 * @project: trunk
 * @file: FinanceController.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-4-8
 * @time: 下午11:41
 * @version: 1.0
 */

class FinanceController extends PanelController{
    public $label = "财务";
    public $actionLabel;
    public $subMenu;
    public function getLabel($labelName){
        $label = array('collectionRequest'=>'收款申请', 'payRequest'=>'付款申请', 'list'=>'列表', 'update'=>'修改', 'view'=>'查看', 'stat'=>'统计', 'delete'=>'删除', 'verify'=>'审核', 'confirmCustomerIssued'=>'确认下单');
        if(in_array($labelName, $label)){
            return $label[$labelName];
        }
        return '';
    }
    private function getSubMenu(){
        return array(
            array(
                'label'=>'收款申请',
                'url'=> array('finance/collectionRequest')
            )
        );
    }

    public function actionIndex(){
        $stat = Finance::getDefaultStat();
        $this->render('index', array('stat'=>$stat));
    }

    public function actionDelete($id){
        $model = Finance::model()->findByPk($id);
        $model->delete();
        Yii::app()->user->setFlash('success', '删除成功！');
        $this->redirect(Yii::app()->user->returnUrl);

    }

    public function actionRequestList(){
        $this->pageTitle = "申请列表";
        $model = new Finance;
        if(isset($_GET['status'])){
            $model->status = $_GET['status'];
        }

        if(isset($_GET['who']) && $_GET['who'] == 'me'){
            $model->handler = Yii::app()->user->id;
        }

        if(isset($_GET['type'])){
            if($_GET['type'] == Finance::TYPE_CUSTOMER){
                $model->type = Finance::TYPE_CUSTOMER;
            }elseif($_GET['type'] == Finance::TYPE_ORDER){
                $model->type = Finance::TYPE_ORDER;
            }

        }

        $this->render('list/list', array('model'=>$model));
    }

    public function actionCollectionRequest($step = 'one'){
        $this->pageTitle = "收款申请";
        $model = new Finance;
        $orderModel = new VisaOrder;
        if(isset($_GET['VisaOrder']))
            $orderModel->attributes=$_GET['VisaOrder'];
        if($step == 'one'){

            $this->render('collection/step1', array('model'=>$model, 'orderModel'=>$orderModel));
        }elseif($step == 'two'){
            $criteria = new CDbCriteria;
            if(!empty($_POST['FinanceItems']['ids'])){
                $orderIds = explode(',', $_POST['FinanceItems']['ids']);
                $criteria->addInCondition('t.id', $orderIds);

            }
            $orderModel = VisaOrder::model()->findAll($criteria);
            $info = array('price'=>0.00, 'order'=>0, 'vid'=>$orderIds);
            foreach($orderModel as $order){
                if(empty($order->total_price)){
                    $info['price'] += $order->amount*$order->price;
                }else{
                    $info['price'] += $order->total_price;
                }
                $info['order'] ++;
            }
            $this->render('collection/step2', array('info'=>$info,'model'=>$model, 'orderModel'=>$orderModel));
        }elseif($step == 'three'){
            if(!empty($_POST['FinanceItems']) && !empty($_POST['Finance'])){
                $data = $_POST['Finance'];
                $items = $_POST['FinanceItems'];
                foreach($items as $key=>$item){
                    $tempOrder = VisaOrder::model()->findByPk($item['vid']);
                    if(!empty($tempOrder)){
                        $items[$key]['transaction_value'] = $tempOrder->total_price;
                        $items[$key]['memo'] = '';
                    }else{
                        unset($items[$key]);
                    }
                }
                $newModel = $model->newCollectionRequest($data, $items);
                if(!empty($newModel)){
                    if(!empty($_FILES['Finance']['name']['pay_file'])){
                        $image = CUploadedFile::getInstanceByName("Finance[pay_file]");
                        $ext = pathinfo($image->name, PATHINFO_EXTENSION);
                        $fileName = "pay/".$newModel->id."_pay.".$ext;
                        $filePath = Yii::getPathOfAlias('webroot')."/upload/panel/".$fileName;
                        if($image->saveAs($filePath)){
                            $newModel->pay_file = $fileName;

                            $newModel->save();
                        }
                    }
                    if(!empty($_FILES['Finance']['name']['pay_file2'])){
                        $image = CUploadedFile::getInstanceByName("Finance[pay_file2]");
                        $ext = pathinfo($image->name, PATHINFO_EXTENSION);
                        $fileName = "pay/".$newModel->id."_pay_2.".$ext;
                        $filePath = Yii::getPathOfAlias('webroot')."/upload/panel/".$fileName;
                        if($image->saveAs($filePath)){
                            $newModel->pay_file2 = $fileName;

                            $newModel->save();
                        }
                    }
                    if(!empty($_FILES['Finance']['name']['pay_file3'])){
                        $image = CUploadedFile::getInstanceByName("Finance[pay_file3]");
                        $ext = pathinfo($image->name, PATHINFO_EXTENSION);
                        $fileName = "pay/".$newModel->id."_pay_3.".$ext;
                        $filePath = Yii::getPathOfAlias('webroot')."/upload/panel/".$fileName;
                        if($image->saveAs($filePath)){
                            $newModel->pay_file3 = $fileName;

                            $newModel->save();
                        }
                    }
                    $this->render('collection/success');
                }
            }

        }
    }


    public function actionPayRequest($step = 'one'){
        $this->pageTitle = "支出申请";
        $model = new Finance;
        $orderModel = new VisaOrder;
        $customerModel = new VisaOrderCustomer;
        if(isset($_GET['VisaOrder']))
            $orderModel->attributes=$_GET['VisaOrder'];
        if($step == 'one'){
            $this->render('pay/step1', array('model'=>$model, 'orderModel'=>$orderModel));
        }elseif($step == 'two'){
            if(!empty($_POST['FinanceItems']['vid'])){
                $customerIds = explode(',', $_POST['FinanceItems']['vid']);
                $orderIds = explode(',', $_POST['FinanceItems']['orderId']);
                $orderData = $orderModel->complexOrderProcessByCustomersAndAgency($customerIds, $orderIds);
                /* Get Customer Data */
                $customerModel->unsetAttributes();
                $customerModel->id = $customerIds;

                $criteria = new CDbCriteria;
                $criteria->addInCondition('id', $customerIds);
                $customerModels = $customerModel->findAll($criteria);
                $customerData = $customerModel->search();
                $info = array('price'=>0.00, 'order'=>0, 'vid'=>$customerIds);
                foreach($customerModels as $customer){
                    $info['price'] += $customer->cost_price;
                }
                $info['order'] = $orderData->totalItemCount;

                $this->render('pay/step2', array('info'=>$info,'model'=>$model, 'orderData'=>$orderData, 'customerData'=>$customerData));

            }


        }elseif($step == 'three'){
            if(!empty($_POST['FinanceItems']) && !empty($_POST['Finance'])){
                $data = $_POST['Finance'];
                $items = $_POST['FinanceItems'];
                foreach($items as $key=>$item){
                    $tempOrder = VisaOrderCustomer::model()->findByPk($item['vid']);
                    if(!empty($tempOrder)){
                        $items[$key]['transaction_value'] = $tempOrder->cost_price;
                        $items[$key]['memo'] = '销售价：'.$tempOrder->price;
                    }else{
                        unset($items[$key]);
                    }
                }
                $newModel = $model->newPayRequest($data, $items);
                if(!empty($newModel)){
                    if(!empty($_FILES['Finance']['name']['pay_file'])){
                        $image = CUploadedFile::getInstanceByName("Finance[pay_file]");
                        $ext = pathinfo($image->name, PATHINFO_EXTENSION);
                        $fileName = "pay/".$newModel->id."_pay.".$ext;
                        $filePath = Yii::getPathOfAlias('webroot')."/upload/panel/".$fileName;
                        if($image->saveAs($filePath)){
                            $newModel->pay_file = $fileName;
                            $newModel->save();
                        }
                    }
                    $this->render('pay/success');
                }
            }

        }
    }

    public function actionReview($id){
        $this->pageTitle = "审核请求";
        $model = Finance::model()->findByPk($id);
        $dataArray  = array();
        if($model->type == Finance::TYPE_ORDER){
            if(!empty($model->items)){
                foreach($model->items as $item){
                    array_push($dataArray, $item->order);
                }
            }
        }elseif($model->type == Finance::TYPE_CUSTOMER){
            if(!empty($model->items)){
                foreach($model->items as $item){
                    array_push($dataArray, $item->customer);
                }
            }
        }

        $dataProvider = new CArrayDataProvider($dataArray);

        if(isset($_POST['Finance'])){
            $model->status = Finance::STATUS_APPROVED;
            if($model->status == Finance::STATUS_APPROVED){
                foreach($model->items as $item){
                    if($item->type == FinanceItems::TYPE_VISA_CUSTOMER){
                        $itemTempModel = VisaOrderCustomer::model()->findByPk($item->vid);
                        $itemTempModel->is_pay_out = 1;
                        $itemTempOrderModel = VisaOrder::model()->findByPk($itemTempModel->visa_order_id);
                        $itemTempOrderModel->pay_out_amount = $itemTempOrderModel->pay_out_amount + $itemTempModel->cost_price;
                        if($itemTempModel->save() && $itemTempOrderModel->save()){
                            if($itemTempOrderModel->is_pay_out != 1){
                                $needCost = VisaOrder::sumCustomerVal($itemTempOrderModel->customer);
                                $paidCost = $itemTempOrderModel->pay_out_amount;
                                if($needCost <= $paidCost){
                                    $itemTempOrderModel->is_pay_out = 1;
                                    $itemTempOrderModel->pay_out_accountant_id = Yii::app()->user->id;
                                    $itemTempOrderModel->save();
                                }elseif($needCost > $paidCost && $itemTempOrderModel->is_pay_out == 0){
                                    $itemTempOrderModel->is_pay_out = 2;
                                    $itemTempOrderModel->save();
                                }

                            }
                        }

                    }elseif($item->type == FinanceItems::TYPE_VISA_ORDER){
                        $itemTempOrderModel = VisaOrder::model()->findByPk($item->vid);
                        $itemTempOrderModel->is_pay = 1;
                        $itemTempOrderModel->accountant_id = Yii::app()->user->id;
                        if($itemTempOrderModel->save()){
                            VisaOrderCustomer::model()->updateAll(array('is_pay'=>1), 'visa_order_id = '.$itemTempOrderModel->id);
                        }
                    }
                }
                if($model->type == Finance::TYPE_CUSTOMER){
                    $model->charge_account_id = isset($_POST['Finance']['charge_account_id']) ? $_POST['Finance']['charge_account_id'] : 0;
                    if(!empty($_FILES['Finance']['name']['pay_file'])){
                        $image = CUploadedFile::getInstanceByName("Finance[pay_file]");
                        $ext = pathinfo($image->name, PATHINFO_EXTENSION);
                        $fileName = "pay/".$model->id."_payout.".$ext;
                        $filePath = Yii::getPathOfAlias('webroot')."/upload/panel/".$fileName;
                        if($image->saveAs($filePath)){
                            $model->pay_file = $fileName;
                        }
                    }
                    if(!empty($_FILES['Finance']['name']['pay_file2'])){
                        $image = CUploadedFile::getInstanceByName("Finance[pay_file2]");
                        $ext = pathinfo($image->name, PATHINFO_EXTENSION);
                        $fileName = "pay/".$model->id."_payout_2.".$ext;
                        $filePath = Yii::getPathOfAlias('webroot')."/upload/panel/".$fileName;
                        if($image->saveAs($filePath)){
                            $model->pay_file2 = $fileName;
                        }
                    }
                    if(!empty($_FILES['Finance']['name']['pay_file3'])){
                        $image = CUploadedFile::getInstanceByName("Finance[pay_file3]");
                        $ext = pathinfo($image->name, PATHINFO_EXTENSION);
                        $fileName = "pay/".$model->id."_payout_3.".$ext;
                        $filePath = Yii::getPathOfAlias('webroot')."/upload/panel/".$fileName;
                        if($image->saveAs($filePath)){
                            $model->pay_file3 = $fileName;
                        }
                    }
                }
            }
            $model->reviewer = Yii::app()->user->id;
            $model->save();
            Yii::app()->user->setFlash('success', "确认成功。该申请状态已经修改。");
            $this->redirect(array('finance/requestList'));
        }
        if($model->type == Finance::TYPE_CUSTOMER){
            $this->render('review/payReview', array('model'=>$model, 'dataProvider'=>$dataProvider));
        }elseif($model->type == Finance::TYPE_ORDER){
            $this->render('review/collectionReview', array('model'=>$model, 'dataProvider'=>$dataProvider));
        }

    }

    public function actionView($id){
        $model = Finance::model()->findByPk($id);
        $dataArray  = array();
        if($model->type == Finance::TYPE_ORDER){
            if(!empty($model->items)){
                foreach($model->items as $item){
                    array_push($dataArray, $item->order);
                }
            }
        }elseif($model->type == Finance::TYPE_CUSTOMER){
            if(!empty($model->items)){
                foreach($model->items as $item){
                    array_push($dataArray, $item->customer);
                }
            }
        }

        $dataProvider = new CArrayDataProvider($dataArray);
        if($model->type == Finance::TYPE_CUSTOMER){
            $this->render('view/pay', array('model'=>$model, 'dataProvider'=>$dataProvider));
        }elseif($model->type == Finance::TYPE_ORDER){
            $this->render('view/collection', array('model'=>$model, 'dataProvider'=>$dataProvider));
        }
    }

    /* Finance Account Operations */

    public function actionAccountNew(){
        $this->pageTitle = "添加账户";
        $model = new PanelBankAccount();
        if(isset($_POST['PanelBankAccount'])){
            $model->attributes = $_POST['PanelBankAccount'];
            $model->status = PanelBankAccount::STATUS_ACTIVE;
            if($model->save()){
                Yii::app()->user->setFlash('success', '保存账户成功！');
                $this->redirect(array('finance/accountList'));
            }
        }
        $this->render('account/newAccount', array('model'=>$model));
    }

    public function actionAccountUpdate($id){
        $this->pageTitle = "更新账户";
        $model = PanelBankAccount::model()->findByPk($id);
        if(isset($_POST['PanelBankAccount'])){
            $model->attributes = $_POST['PanelBankAccount'];
            if($model->save()){
                Yii::app()->user->setFlash('success', '保存账户成功！');
                $this->redirect(array('finance/accountList'));
            }
        }
        $this->render('account/newAccount', array('model'=>$model));
    }

    public function actionAccountDelete($id){
        $model = PanelBankAccount::model()->findByPk($id);
        if(!empty($model)){
            $model->status = PanelBankAccount::STATUS_DELETED;
            if($model->save()){
                Yii::app()->user->setFlash('success', '保存账户成功！');
                $this->redirect(array('finance/accountList'));
            }
        }
    }

    public function actionAccountList(){
        $this->pageTitle = "账户列表";
        $model = new PanelBankAccount();
        $dataProvider = $model->search();
        $this->render('account/accountList', array('model'=>$model,'dataProvider'=>$dataProvider));
    }

    public function actionTransactionHistory(){
        $this->pageTitle = "交易列表";
        $model = new PanelBankAccountHistory();
        if(isset($_GET['PanelBankAccountHistory'])){
            $model->attributes = $_GET['PanelBankAccountHistory'];
        }

        $dataProvider = $model->search();
        $this->render('account/transactionHistory', array('model'=>$model,'dataProvider'=>$dataProvider));
    }

    public function actionTransfer(){
        $this->pageTitle = "内部转账";
        $model = new PanelBankAccountHistory();
        if(isset($_POST['PanelBankAccountHistory'])){
            $mainChargeRecord = new PanelBankAccountHistory();
            $mainChargeRecord->value = $_POST['PanelBankAccountHistory']['value'];
            $mainChargeRecord->account_id = $_POST['PanelBankAccountHistory']['target_id'];
            $mainChargeRecord->target_id = $_POST['PanelBankAccountHistory']['account_id'];
            $mainChargeRecord->direction = PanelBankAccountHistory::DIRECTION_POSITIVE;
            $mainChargeRecord->memo = "转账系统自动转入：\n".$_POST['PanelBankAccountHistory']['memo'];
            $targetChargeRecord = new PanelBankAccountHistory();
            $targetChargeRecord->value = $_POST['PanelBankAccountHistory']['value'];
            $targetChargeRecord->account_id = $_POST['PanelBankAccountHistory']['account_id'];
            $targetChargeRecord->target_id = $_POST['PanelBankAccountHistory']['target_id'];
            $targetChargeRecord->direction = PanelBankAccountHistory::DIRECTION_NEGATIVE;
            $targetChargeRecord->memo = "转账系统自动扣款：\n".$_POST['PanelBankAccountHistory']['memo'];
            if($mainChargeRecord->validate() && $mainChargeRecord->save() && $targetChargeRecord->save()){
                Yii::app()->user->setFlash('success', "转账成功！");
                $this->redirect(array('finance/transactionHistory'));
            }else{
                throw new CHttpException(500, "转账失败，不能是同一个账户！");
            }
        }
        $this->render('account/transfer', array('model'=>$model));

    }





}