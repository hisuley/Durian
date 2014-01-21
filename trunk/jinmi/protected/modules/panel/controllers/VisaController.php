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
    public function beforeAction(){
        return parent::beforeAction();
    }
    public function getLabel($labelName){
        $label = array('new'=>'下单', 'list'=>'列表', 'update'=>'修改', 'view'=>'查看', 'stat'=>'统计', 'delete'=>'删除');
        return $label[$labelName];
    }
    public function actionNew(){
        $addressModel = Address::model()->findAllByAttributes(array('is_enabled'=>1));
        $model = new VisaOrder();
        if(!empty($_POST['VisaOrder'])){
            $errFlag = true;
            $postData = $_POST['VisaOrder'];
            $postData['status'] = VisaOrder::STATUS_SALES_ORDER;
            $postData['is_pay'] = 0;
            $postData['user_id'] = Yii::app()->user->id;
            $model->attributes = $postData;
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
                throw new CHttpException(500, '保存订单失败，请检查订单数据。'.print_r($model->attributes, true));
            }
        }
        $this->render('form/new', array('model'=>$model, 'addressModel'=>$addressModel));
    }
    public function actionUpdate($id){
        $this->actionLabel = "修改";
        $addressModel = Address::model()->findAllByAttributes(array('is_enabled'=>1));
        $model = VisaOrder::model()->findByPk($id);
        if(!empty($_POST['VisaOrder'])){
            $postData = $_POST['VisaOrder'];
            $model->attributes = $postData;
            if($model->save()){
                VisaOrderCustomer::model()->deleteAllByAttributes(array('visa_order_id'=>$model->id));
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
                Yii::app()->user->setFlash('success', '订单修改成功。');
                $this->redirect(array('visa/list'));
            }else{
                throw new CHttpException(500, '保存订单失败，请检查订单数据。'.print_r($model->attributes, true));
            }
        }
        $this->render('form/new', array('model'=>$model, 'addressModel'=>$addressModel));
    }
    public function actionView($id){
        $this->actionLabel = "查看";
        $model = VisaOrder::model()->findByPk($id);
        $this->render('view', array('model'=>$model));
    }

    public function actionDelete($id){
        if(VisaOrder::deleteVisaRecord($id)){
            Yii::app()->user->setFlash('success', '删除成功，编号为'.$id."的订单已经被删除。");
            $this->redirect(array('visa/list'));
        }
    }

    public function actionList(){
        $this->actionLabel = "列表";
        $model = new VisaOrder();
        $result = VisaOrder::model()->findAll();
        $this->render('list', array('result'=>$result, 'model'=>$model));
    }

    public function actionStat(){
        $model = VisaOrder::stat();
        $this->render('stat', array('model'=>$model));
    }
} 