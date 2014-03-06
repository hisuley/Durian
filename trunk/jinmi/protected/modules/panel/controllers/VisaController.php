<?php
/**
 * Created by PhpStorm.
 * User: suley
 * Date: 1/21/14
 * Time: 1:46 AM
 */

class VisaController extends PanelController{
    public $label = "签证";
    public $actionLabel;
    public $subMenu;
    public function beforeAction(){
        $this->subMenu = $this->getSubMenu();
        return parent::beforeAction();
    }
    public function getLabel($labelName){
        $label = array('new'=>'下单', 'list'=>'列表', 'update'=>'修改', 'view'=>'查看', 'stat'=>'统计', 'delete'=>'删除', 'verify'=>'审核', 'confirmCustomerIssued'=>'确认下单');
        if(in_array($labelName, $label)){
            return $label[$labelName];
        }
       return '';
    }
    private function getSubMenu(){
        return array(
            array(
                'label'=>'下单',
                'url'=> array('visa/new')
            ),
            array(
                'label'=>'列表',
                'url'=> array('visa/list')
            ),
            array(
                'label'=>'统计',
                'url'=> array('visa/stat')
            ),
            array(
                'label'=>'待送签订单',
                'url'=> array('visa/waiting')
            ),
        );
    }
    public function actionNew(){
        $this->pageTitle = '下单';
        $sourceModel = OrderSource::model()->findAllByAttributes(array('is_enabled'=>1, 'type'=>OrderSource::TYPE_SOURCE));
        $addressModel = Address::model()->findAllByAttributes(array('is_enabled'=>1));
        $model = new VisaOrder();
        $this->performAjaxValidation($model);
        if(!empty($_POST['VisaOrder'])){
            $errFlag = true;
            $postData = $_POST['VisaOrder'];
            $postData['status'] = VisaOrder::STATUS_SALES_ORDER;
            $postData['is_pay'] = 0;
            $postData['user_id'] = Yii::app()->user->id;
            if(empty($postData['pay_cert']))
                unset($postData['pay_cert']);
            $model->attributes = $postData;
            if(!empty($postData['memo'])){
                $model->memo = User::getUserRealname(Yii::app()->user->id)."于".date("Y-m-d H:i")."说：".$postData['memo'];
            }
            Yii::log('[VisaOrder]Saving Model Attributes:\n'.print_r($model->attributes, true));
            if($model->save()){
                $errFlag = false;
                if(!empty($_POST['VisaOrderCustomer'])){
                    foreach($_POST['VisaOrderCustomer']['name'] as $key=>$v){
                        $tempData = array('name'=>$v, 'passport'=>$_POST['VisaOrderCustomer']['passport'][$key], 'visa_order_id'=>$model->id);
                        $customerModel = new VisaOrderCustomer();
                        $customerModel->attributes = $tempData;
                        Yii::log('[VisaOrder]Saving Customer Model Attributes:\n'.print_r($customerModel->attributes, true));
                        if(!$customerModel->save()){
                            $errFlag = true;
                        }
                    }
                }
            }
            //print_r($model);
            if(!$errFlag){
                Yii::app()->user->setFlash('success', '新的订单添加成功。');
                $this->redirect(array('visa/list'));
            }else{
                throw new CHttpException(500, '保存订单失败，请检查订单数据是否填写正确。');
            }
        }
        $this->render('form/new', array('model'=>$model, 'addressModel'=>$addressModel, 'sourceModel'=>$sourceModel));
    }
    public function actionUpdate($id){
        $this->pageTitle = '修改';
        $this->actionLabel = "修改";
        $sourceModel = OrderSource::model()->findAllByAttributes(array('is_enabled'=>1, 'type'=>OrderSource::TYPE_SOURCE));
        $addressModel = Address::model()->findAllByAttributes(array('is_enabled'=>1));
        $model = VisaOrder::model()->findByPk($id);
        $this->performAjaxValidation($model);
        if(!empty($_POST['VisaOrder'])){
            $postData = $_POST['VisaOrder'];
            if(empty($postData['pay_cert']))
                unset($postData['pay_cert']);
            if(!empty($postData['memo'])){
                $memoStr = $model->memo."\n".User::getUserRealname(Yii::app()->user->id)."于".date("Y-m-d H:i")."说：".$postData['memo'];

            }
            $model->attributes = $postData;
            if(!empty($postData['memo'])){
                $model->memo = $memoStr;
            }


            if($model->save()){
                $errFlag = false;
                $saveIds = array();
                if(!PanelUser::checkAttributesAccess('customer', $model)){
                    if(!empty($_POST['VisaOrderCustomer'])){
                        foreach($_POST['VisaOrderCustomer']['name'] as $key=>$v){
                            $tempData = array('name'=>$v, 'passport'=>$_POST['VisaOrderCustomer']['passport'][$key], 'visa_order_id'=>$model->id);
                            $customerModel = VisaOrderCustomer::model()->findByPk($_POST['VisaOrderCustomer']['id'][$key]);
                            $customerModel->attributes = $tempData;
                            Yii::log('[VisaOrder]Saving Customer Model Attributes:\n'.print_r($customerModel->attributes, true));
                            if(!$customerModel->save()){
                                $errFlag = true;
                            }
                            array_push($saveIds, $_POST['VisaOrderCustomer']['id'][$key]);
                        }
                    }
                    $criteria = new CDbCriteria;
                    $criteria->compare('visa_order_id', $model->id, 'AND');
                    $criteria->addNotInCondition('id', $saveIds);
                    VisaOrderCustomer::model()->deleteAll($criteria);
                }

            }
            //print_r($model->attributes);
            if(!$errFlag){
                Yii::app()->user->setFlash('success', '订单修改成功。');
                $this->redirect(array('visa/list'));
            }else{
                throw new CHttpException(500, '保存订单失败，请检查订单数据完整性。');
            }
        }
        $this->render('form/new', array('model'=>$model, 'addressModel'=>$addressModel, 'sourceModel'=>$sourceModel));
    }
    public function actionView($id){
        $this->pageTitle = '查看';
        $this->actionLabel = "查看";
        $model = VisaOrder::model()->findByPk($id);
        $this->render('view', array('model'=>$model));
    }

    public function actionDelete($id){
        $model = VisaOrder::model()->findByPk($id);
        if(!empty($_POST['VisaOrder'])){
            $model->status = VisaOrder::STATUS_DELETE;
            $model->delete_comment = $_POST['VisaOrder']['delete_comment'];
            $model->delete_id = Yii::app()->user->id;
            $model->delete_time = strtotime('now');
            if($model->save()){
                Yii::app()->user->setFlash('success', '删除成功，编号为'.$id."的订单已经被删除。");
                $this->redirect(array('visa/list'));
            }
        }
        $this->render('form/delete');
    }

    public function actionVerify($id, $type){
        $this->pageTitle = '审核';
        $model = VisaOrder::model()->findByPk($id);
        if(!empty($_POST['VisaOrder'])){
            $typeAttrTemp = explode('_', $type);
            $typeAttr = $typeAttrTemp[0]."_id";
            $timeAttr = $typeAttrTemp[0]."_time";
            $opAttribute = array($typeAttr=>Yii::app()->user->id);
            $opAttribute = array_merge($opAttribute, $_POST['VisaOrder']);
            $opAttribute['status'] = VisaOrder::findOutStatus($typeAttrTemp[0]);
            if(empty($opAttribute[$timeAttr])){
                $opAttribute[$timeAttr] = strtotime('now');
            }elseif(!is_numeric($opAttribute[$timeAttr])){
                $opAttribute[$timeAttr] = strtotime($opAttribute[$timeAttr]);
            }
            $model->attributes = $opAttribute;
            if(isset($_POST['VisaOrder']['sent_agency_source'])){
                $model->sent_agency_source = $_POST['VisaOrder']['sent_agency_source'];
            }
            if($model->save()){
                Yii::app()->user->setFlash('success', '审核成功，转到查看订单页面。');
                $this->redirect($this->createUrl('visa/view', array('id'=>$id)));
            }
        }
        $this->render('form/verify', array('model'=>$model, 'inputName'=>$type));
    }

    public function actionList(){
        $this->pageTitle = '列表';
        $this->actionLabel = "列表";
        $model = new VisaOrder('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['VisaOrder']))
            $model->attributes=$_GET['VisaOrder'];
        $result = VisaOrder::model()->findAll();
        $this->render('list', array('result'=>$result, 'model'=>$model));
    }

    public function actionWaiting(){
        if(isset($_POST['start_date'])){
            $startDate = $_POST['start_date'];
        }else{
            $startDate = date('Y-m-d');
        }
        if(isset($_POST['start_date'])){
            $startDate = $_POST['start_date'];
        }else{
            $startDate = date('Y-m-d');
        }
        //Yii::import('application.vendors.*');
        $model = new VisaOrder();
        $datas = $model->searchForReport('array');
        spl_autoload_unregister(array('YiiBase','autoload'));
        require_once(Yii::app()->basePath.'/vendors/PHPWord.php');
        $PHPWord = new PHPWord();
        spl_autoload_register(array('YiiBase','autoload'));
        // Define table style arrays
        $styleTable = array('borderSize'=>6, 'borderColor'=>'006699', 'cellMargin'=>80);
        $styleFirstRow = array('borderBottomSize'=>18, 'borderBottomColor'=>'0000FF', 'bgColor'=>'grey');

        // Add table style
        $PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
        $section = $PHPWord->createSection();

        foreach($datas as $data){
            // New portrait section

            $section->addTitle('送签交接凭证', 1);
            //var_dump($data->order_source);
            $section->addText("地接社：".$data->order_source->name."     交接日期：".date('Y-m-d', $data->sent_time));

            // Add table
            $table = $section->addTable('myOwnTableStyle');
            $table->addRow();
            $table->addCell(1750)->addText("国家：");
            $table->addCell(1750)->addText($data->country_source->name);
            $table->addCell(1750)->addText("类型：");
            $table->addCell(1750)->addText($data->order_type->name);
            $table->addRow();
            $table->addCell(1750)->addText("人数：");
            $table->addCell(5250)->addText($data->amount);
            $table->addRow();
            $table->addCell(1750)->addText("客人姓名：");
            $str = '';
            foreach($data->customer as $customer){
                $str .= $customer->name."、";
            }
            $cell =  $table->addCell(5250)->addText($str);
            //$cell->getStyle()->setGridSpan(3);
            $table->addRow();
            $table->addCell(1750)->addText("送签人：");
            $table->addCell(1750)->addText(User::getUserRealname($data->sent_id));
            $table->addCell(1750)->addText("接收人：");
            $table->addCell(1750);
            $table->addRow();
            $table->addCell(1750)->addText("备注：");
            $cell2 = $table->addCell(5250)->addText($data->sent_comment);
            //$cell2->
            //$cell2->getStyle()->setGridSpan(3);
            $section->addTextBreak(2);

        }

        // New portrait section


        // Save File
        $objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
        $objWriter->save(Yii::app()->basePath.'/../upload/sent_'.$startDate.'.docx');
        $this->render('waiting');
    }

    public function actionWaitingResult(){
        if(isset($_POST['start_date'])){
            $startDate = $_POST['start_date'];
        }else{
            $startDate = date('Y-m-d');
        }
        //Yii::import('application.vendors.*');
        $model = new VisaOrder();
        $datas = $model->searchForReport('array');
        spl_autoload_unregister(array('YiiBase','autoload'));
        require_once(Yii::app()->basePath.'/vendors/PHPWord.php');
        $PHPWord = new PHPWord();
        spl_autoload_register(array('YiiBase','autoload'));
        // Define table style arrays
        $styleTable = array('borderSize'=>6, 'borderColor'=>'006699', 'cellMargin'=>80);
        $styleFirstRow = array('borderBottomSize'=>18, 'borderBottomColor'=>'0000FF', 'bgColor'=>'grey');

        // Add table style
        $PHPWord->addTableStyle('myOwnTableStyle', $styleTable, $styleFirstRow);
        $section = $PHPWord->createSection();

        foreach($datas as $data){
            // New portrait section

            $section->addTitle('送签交接凭证', 1);
            //var_dump($data->order_source);
            $section->addText("地接社：".$data->order_source->name."     交接日期：".date('Y-m-d', $data->sent_time));

            // Add table
            $table = $section->addTable('myOwnTableStyle');
            $table->addRow();
            $table->addCell(1750)->addText("国家：");
            $table->addCell(1750)->addText($data->country_source->name);
            $table->addCell(1750)->addText("类型：");
            $table->addCell(1750)->addText($data->order_type->name);
            $table->addRow();
            $table->addCell(1750)->addText("人数：");
            $table->addCell(5250)->addText($data->amount);
            $table->addRow();
            $table->addCell(1750)->addText("客人姓名：");
            $str = '';
            foreach($data->customer as $customer){
                $str .= $customer->name."、";
            }
            $cell =  $table->addCell(5250)->addText($str);
            //$cell->getStyle()->setGridSpan(3);
            $table->addRow();
            $table->addCell(1750)->addText("送签人：");
            $table->addCell(1750)->addText(User::getUserRealname($data->sent_id));
            $table->addCell(1750)->addText("接收人：");
            $table->addCell(1750);
            $table->addRow();
            $table->addCell(1750)->addText("备注：");
            $cell2 = $table->addCell(5250)->addText($data->sent_comment);
            //$cell2->
            //$cell2->getStyle()->setGridSpan(3);
            $section->addTextBreak(2);

        }

        // New portrait section


        // Save File
        $objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
        $objWriter->save(Yii::app()->basePath.'/../upload/sent_'.$startDate.'.docx');

        echo "OK";
        //$this->render('waiting');
    }

    public function actionStat(){
        $this->pageTitle = '统计';
        $model = VisaOrder::stat();
        $this->render('stat', array('model'=>$model));
    }
    public function actionConfirmCustomerIssued(){
        $customerId = intval($_POST['id']);
        if(!empty($customerId)){
           $model = VisaOrderCustomer::model()->findByPk($customerId);
            $model->status = VisaOrderCustomer::STATUS_ISSUED;
            if($model->save()){
                echo "OK with id".$customerId;
            }
        }else{
            echo "Could not get ID value".$customerId;
        }

        $this->layout = false;
    }
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='order-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
} 