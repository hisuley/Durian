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
        $label = array('new'=>'下单', 'list'=>'列表', 'update'=>'修改', 'view'=>'查看', 'stat'=>'统计', 'delete'=>'删除', 'verify'=>'审核', 'confirmCustomerIssued'=>'确认下单', 'confirmCustomerSent'=>'确认下单');
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
            $model->total_price = $model->amount*$model->price;
            Yii::log('[VisaOrder]新下单:\n'.print_r($model->attributes, true), 'info', 'order_records');
            if($model->save()){
                $errFlag = false;
                if(!empty($_POST['VisaOrderCustomer'])){
                    foreach($_POST['VisaOrderCustomer']['name'] as $key=>$v){
                        $tempData = array('name'=>$v, 'passport'=>$_POST['VisaOrderCustomer']['passport'][$key], 'visa_order_id'=>$model->id, 'price'=>$model->price);
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
            $memoStr = $model->memo;
            if(!empty($postData['memo'])){
                $memoStr .= "\n".User::getUserRealname(Yii::app()->user->id)."于".date("Y-m-d H:i")."说：".$postData['memo'];

            }
            // Detect type and country changes.
            $statusRollback = false;
            if($postData['type'] != $model->type && VisaOrder::compareStatus($model->status, VisaOrder::STATUS_PARTIAL_SENT)){
                $model->status = VisaOrder::STATUS_OP_CONFIRM;
                $memoStr .= "\n".User::getUserRealname(Yii::app()->user->id)."于".date("Y-m-d H:i")."变更了签证类型，签证类型从【".VisaType::getTypeName($model->type)."】改变为【".VisaType::getTypeName($postData['type'])."】，订单状态已经恢复到待送签状态。";
                $model->sent_id = 0;
                $model->sent_comment = "";
                $model->sent_time = 0;
                $model->agency_id = 0;
                $statusRollback = true;
            }
            $oldAmount = $model->amount;
            if(isset($postData['amount']) && $model->amount != $postData['amount']){
                $memoStr .= "\n".User::getUserRealname(Yii::app()->user->id)."于".date("Y-m-d H:i")."更新了订单：订单人数从".$model->amount."人变成了".$postData['amount']."人";
            }
            $priceUpdated = false;
            if(isset($postData['price']) && $model->price != $postData['price']){
                $priceUpdated = true;
                $memoStr .= "\n".User::getUserRealname(Yii::app()->user->id)."于".date("Y-m-d H:i")."更新了订单：订单价格从￥".$model->price."变成了￥".$postData['price'];
            }
            if(empty($postData['is_pay'])){
                unset($postData['is_pay']);
            }
            $model->attributes = $postData;
            $model->memo = $memoStr;
            $model->total_price = $model->amount*$model->price;
            $errFlag = false;
            if($model->save()){
                $saveIds = array();
                if(!PanelUser::checkAttributesAccess('customer', $model)){
                    $oldCustomerCounter = count($model->customer);
                    if(!empty($_POST['VisaOrderCustomer'])){
                        $customerCounter = 0;
                        foreach($_POST['VisaOrderCustomer']['name'] as $key=>$v){
                            $tempData = array('name'=>$v, 'passport'=>$_POST['VisaOrderCustomer']['passport'][$key], 'visa_order_id'=>$model->id);
                            if(isset($_POST['VisaOrderCustomer']['id'][$key]) && !empty($_POST['VisaOrderCustomer']['id'][$key])){
                                $customerModel = VisaOrderCustomer::model()->findByPk($_POST['VisaOrderCustomer']['id'][$key]);
                            }else{
                                $customerModel = new VisaOrderCustomer();
                                $customerModel->price = $model->price;
                                $model->memo = $model->memo."\n".User::getUserRealname(Yii::app()->user->id)."于".date("Y-m-d H:i")."更新了订单：添加了客户：".$tempData['name']."(护照号：".$tempData['passport'].")";
                                $model->save();
                            }
                            $customerModel->attributes = $tempData;
                            Yii::log('[VisaOrder]Saving Customer Model Attributes:\n'.print_r($customerModel->attributes, true));
                            if($customerModel->save()){
                                array_push($saveIds, $customerModel->id);
                            }else{
                                $errFlag = true;
                            }
                            $customerCounter++;

                        }
                        if(!empty($id) && !empty($saveIds)){
                            $criteria = new CDbCriteria;
                            $criteria->addCondition('visa_order_id = '.$id, 'AND');
                            $criteria->addCondition('is_pay_out = 0');
                            $criteria->addCondition('is_pay = 0');
                            $criteria->addNotInCondition('id', $saveIds);
                            $deleteRecords = VisaOrderCustomer::model()->findAll($criteria);
                            VisaOrderCustomer::model()->deleteAll($criteria);

                            if(!empty($deleteRecords)){
                                $model->memo = $model->memo."\n".User::getUserRealname(Yii::app()->user->id)."于".date("Y-m-d H:i")."更新了订单：删除了客户：";
                                foreach($deleteRecords as $customer){
                                    $model->memo = $model->memo.$customer->name."(护照号：".$customer->passport.", 订单ID：".$customer->visa_order_id."，成本价：".$customer->cost_price."，售价：".$customer->price.")";
                                }
                                $model->save();
                            }
                        }
                    }





                    if(isset($customerCounter) && !empty($customerCounter) && $customerCounter != $oldAmount){
                        $model->memo = $model->memo."\n".User::getUserRealname(Yii::app()->user->id)."于".date("Y-m-d H:i")."更新了订单：订单人数与实际填写人数不符，订单已经被修改，从".$oldAmount."人变成了".$customerCounter."人";
                        $model->amount = $customerCounter;
                        $model->save();
                    }

                }

                //Update Prices
                if($priceUpdated){
                    VisaOrderCustomer::model()->updateAll(array("price"=>$model->price), "visa_order_id = :visa_order_id", array(':visa_order_id'=>$model->id));
                }
                if($statusRollback){
                    VisaOrderCustomer::model()->updateAll(array("status"=>VisaOrderCustomer::STATUS_DEFAULT, "agency_id"=>0, "cost_price"=>0), "visa_order_id = :visa_order_id", array(':visa_order_id'=>$model->id));
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
            $model->delete_comment = isset($_POST['VisaOrder']['delete_comment']) ? Yii::app()->user->realname."说：".$_POST['VisaOrder']['delete_comment'] : '';
            $model->delete_id = Yii::app()->user->id;
            $model->delete_time = strtotime('now');
            if($model->save()){
                Yii::app()->user->setFlash('success', '删除成功，编号为'.$id."的订单已经被删除。");
                $this->redirect(array('visa/list'));
            }
        }
        $this->render('form/delete', array('model'=>$model));
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
            if(isset($_POST['VisaOrder']['agency_id'])){
                $model->agency_id = $_POST['VisaOrder']['agency_id'];
                foreach($model->customer as $customer){
                    $customer->agency_id = $model->agency_id;
                    $agencyModel = VisaTypeAgency::model()->findByPk($customer->agency_id);
                    $customer->cost_price = $agencyModel->price;
                    $customer->status = VisaOrderCustomer::STATUS_SENTOUT;
                    $customer->save();
                }
            }
            if(isset($_POST['VisaOrder']['issue_time'])){
                foreach($model->customer as $customer){
                    if($customer->status != VisaOrderCustomer::STATUS_REJECT && $customer->status != VisaOrderCustomer::STATUS_DELETED){
                        $customer->status = VisaOrderCustomer::STATUS_ISSUED;
                    }
                    $customer->save();
                }
            }
            if(!empty($_POST['VisaOrderCustomer']) && is_array($_POST['VisaOrderCustomer'])){
                foreach($_POST['VisaOrderCustomer'] as $key=>$customer){
                    $customerModel = VisaOrderCustomer::model()->findByPk($key);
                    if(!empty($customerModel)){
                        $customerModel->agency_id = $customer['agency_id'];
                        $agencyModel = VisaTypeAgency::model()->findByPk($customerModel->agency_id);
                        $customerModel->cost_price = $agencyModel->price;
                        $customerModel->save();
                    }
                }
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

    public function actionExport(){
        $fp = fopen('/tmp/export.csv', 'w+');

        /*
         * Write a header of csv file
         */
        $headers = array(
            '编号',
            'create_time',
            'customer.name',
            'customer.passport',
            'country_source.name',
            '类型',
            'price',
            '旅行社',
            '订单编号'
        );

        $row = array();
        foreach($headers as $header) {
            $row[] = VisaOrder::model()->getAttributeLabel($header);
        }
        foreach($row as $key=>$val){
            $row[$key] = iconv('utf-8', 'GBK//IGNORE', $val);
        }
        fputcsv($fp,$row);
        /*
         * Init dataProvider for first page
         */
        $model=new VisaOrder('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['VisaOrder'])) {
            $model->attributes=$_GET['VisaOrder'];
        }
        $dp = $model->search(array('order'=>'order.create_time ASC', 'pagination'=>false));

        /*
         * Get models, write to a file, then change page and re-init DataProvider
         * with next page and repeat writing again
         */
        $models = $dp->getData();
        $error_row = array(array('订单错误信息：'));
        if(!empty($models)) {
            $info = array('amount'=>0,'price'=>0, 'orders_count'=>0, 'countries'=>array(), 'sources'=>array());
            foreach($models as $value) {
                $row = array();
                foreach($value->customer as $customer){
                    $row = array($value->id, date('Y-m-d', $value->create_time), $customer->name, $customer->passport, (empty($value->country_source) ? '':$value->country_source->name), (empty($value->order_type) ? '' : $value->order_type->name), $value->price, (empty($value->order_source->name) ? '':$value->order_source->name), $value->id);
                    foreach($row as $key=>$val){
                        $row[$key] = iconv('utf-8', 'GBK//IGNORE', $val);
                    }
                    fputcsv($fp,$row);
                }
                if(count($value->customer) != $value->amount){
                    array_push($error_row, array('错误订单号：',$value->id,'错误类型:','订单人数错误','订单填写人数:',$value->amount,'实际客户人数：',count($value->customer)));
                }
                $info['orders_count']++;
                $info['amount'] += $value->amount;
                $info['price'] += $value->amount*$value->price;
                if(isset($info['countries'][$value->country])){
                    $info['countries'][$value->country]['amount'] += $value->amount;
                    $info['countries'][$value->country]['price'] += $value->amount*$value->price;
                    if(isset($info['countries'][$value->country]['types'][$value->type])){
                        $info['countries'][$value->country]['types'][$value->type]['amount'] += $value->amount;
                        $info['countries'][$value->country]['types'][$value->type]['price'] += $value->amount*$value->price;
                    }else{
                        $info['countries'][$value->country]['types'][$value->type]['name'] = (empty($value->order_type) ? '' : $value->order_type->name);
                        $info['countries'][$value->country]['types'][$value->type]['amount'] = $value->amount;
                        $info['countries'][$value->country]['types'][$value->type]['price'] = $value->amount*$value->price;
                    }
                }else{
                    $info['countries'][$value->country] = array('name'=>(empty($value->country_source) ? '':$value->country_source->name));
                    $info['countries'][$value->country]['amount'] = $value->amount;
                    $info['countries'][$value->country]['price'] = $value->amount*$value->price;
                    $info['countries'][$value->country]['types'][$value->type]['name'] = (empty($value->order_type) ? '' : $value->order_type->name);
                    $info['countries'][$value->country]['types'][$value->type]['amount'] = $value->amount;
                    $info['countries'][$value->country]['types'][$value->type]['price'] = $value->amount*$value->price;
                }
                if(isset($info['sources'][$value->source])){
                    $info['sources'][$value->source]['amount'] += $value->amount;
                    $info['sources'][$value->source]['price'] += $value->amount*$value->price;
                }else{
                    $info['sources'][$value->source] = array('name'=>(empty($value->order_source->name) ? '':$value->order_source->name));
                    $info['sources'][$value->source]['amount'] = $value->amount;
                    $info['sources'][$value->source]['price'] = $value->amount*$value->price;
                }
            }
        }

        $row = array("总计：", '', $info['amount'], '','','',$info['price'],count($info['sources']), $info['orders_count']);
        foreach($row as $key=>$val){
            $row[$key] = iconv('utf-8', 'GBK//IGNORE', $val);
        }
        fputcsv($fp,$row);
        $row = array('','');
        fputcsv($fp, $row);
        foreach($info['countries'] as $country){

            $row = array("国家：", $country['name'], "总人数：", $country['amount'], '总价格：', $country['price']);
            foreach($row as $key=>$val){
                $row[$key] = iconv('utf-8', 'GBK//IGNORE', $val);
            }
            fputcsv($fp, $row);
            foreach($country['types'] as $type){
                $row = array('', "类型：", $type['name'], "人数：", $type['amount'], "价格：", $type['price']);
                foreach($row as $key=>$val){
                    $row[$key] = iconv('utf-8', 'GBK//IGNORE', $val);
                }
                fputcsv($fp, $row);
            }


        }
        $row = array('','');
        fputcsv($fp, $row);
        foreach($info['sources'] as $source){
            $row = array("旅行社：", $source['name'], "人数：", $source['amount'], '价格：', $source['price']);
            foreach($row as $key=>$val){
                $row[$key] = iconv('utf-8', 'GBK//IGNORE', $val);
            }
            fputcsv($fp, $row);
        }
        if(!empty($error_row)){
            foreach($error_row as $e_key=>$row){
                foreach($row as $key=>$val){
                    $row[$key] = iconv('utf-8', 'GBK//IGNORE', $val);
                }
                fputcsv($fp, $row);
            }

        }
        rewind($fp);
        Yii::app()->request->sendFile('系统数据导出_'.date("Y年m月d日").'.csv',stream_get_contents($fp), 'text/csv; charset=GBK//IGNORE');
        fclose($fp);
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

    public function actionConfirmCustomerReject(){
        $customerId = intval($_POST['id']);
        if(!empty($customerId)){
            $model = VisaOrderCustomer::model()->findByPk($customerId);
            $model->status = VisaOrderCustomer::STATUS_REJECT;
            if($model->save()){
                echo "OK with id".$customerId;
            }
        }else{
            echo "Could not get ID value".$customerId;
        }

        $this->layout = false;
    }

    public function actionConfirmCustomerSent(){
        $customerId = intval($_POST['id']);
        $agencyId = intval($_POST['agency_id']);
        if(!empty($customerId)){
            $model = VisaOrderCustomer::model()->findByPk($customerId);
            $agencyModel = VisaTypeAgency::model()->findByPk($agencyId);
            $model->agency_id = $agencyId;
            $model->cost_price = $agencyModel->price;
            $model->status = VisaOrderCustomer::STATUS_SENTOUT;
            if($model->save()){
                echo "OK with id".$customerId;
            }
        }else{
            echo "Could not get ID value".$customerId;
        }

        $this->layout = false;
    }

    public function actionStatCollection(){
        $this->pageTitle = "收款报表";
        $model = new VisaOrder;

        if(isset($_GET['VisaOrder'])){
            $model->attributes = $_GET['VisaOrder'];
        }
        $model->is_pay = 1;
        $this->render('stat/collection', array('model'=>$model));
    }

    public function actionStatPay(){
        $this->pageTitle = "付款报表";
        $model = new VisaOrder;

        if(isset($_GET['VisaOrder'])){
            $model->attributes = $_GET['VisaOrder'];
        }
        $model->is_pay_out = 1;
        $this->render('stat/pay', array('model'=>$model));
    }

    public function actionStatSent(){
        $this->pageTitle = "送签报表";
        $model = new VisaOrder;

        if(isset($_GET['VisaOrder'])){
            $model->attributes = $_GET['VisaOrder'];
        }
        $model->status = array(VisaOrder::STATUS_SENTOUT, VisaOrder::STATUS_SENTOUT, VisaOrder::STAUTS_ISSUE_VISA, VisaOrder::STATUS_COMPLETE, VisaOrder::STATUS_RECEIVED);
        $model->agencyIdNotNull = true;
        $this->render('stat/sent', array('model'=>$model));
    }

    public function actionStatOperate(){
        $this->pageTitle = "运营报表";
        $model = new VisaOrder;

        if(isset($_GET['VisaOrder'])){
            $model->attributes = $_GET['VisaOrder'];
        }
        $model->status = array(VisaOrder::STATUS_SENTOUT, VisaOrder::STATUS_SENTOUT, VisaOrder::STAUTS_ISSUE_VISA, VisaOrder::STATUS_COMPLETE, VisaOrder::STATUS_RECEIVED);
        //$model->agencyIdNotNull = true;
        $this->render('stat/operate', array('model'=>$model));
    }

    public function actionStatPredict(){
        $this->pageTitle = "预测报表";
        $model = new VisaOrder;

        if(isset($_GET['VisaOrder'])){
            $model->attributes = $_GET['VisaOrder'];
        }
        //$model->agencyIdNotNull = true;
        $model->status = array(VisaOrder::STATUS_SENTOUT, VisaOrder::STATUS_SENTOUT, VisaOrder::STAUTS_ISSUE_VISA, VisaOrder::STATUS_COMPLETE, VisaOrder::STATUS_RECEIVED);
        $this->render('stat/predict', array('model'=>$model));
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