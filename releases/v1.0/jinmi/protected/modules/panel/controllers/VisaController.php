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
        $label = array('new'=>'下单', 'list'=>'列表', 'update'=>'修改', 'view'=>'查看', 'stat'=>'统计', 'delete'=>'删除', 'verify'=>'审核');
        return $label[$labelName];
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
        );
    }
    public function actionNew(){
        $this->pageTitle = '下单';
        $sourceModel = OrderSource::model()->findAllByAttributes(array('is_enabled'=>1));
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
        $sourceModel = OrderSource::model()->findAllByAttributes(array('is_enabled'=>1));
        $addressModel = Address::model()->findAllByAttributes(array('is_enabled'=>1));
        $model = VisaOrder::model()->findByPk($id);
        $this->performAjaxValidation($model);
        if(!empty($_POST['VisaOrder'])){
            $postData = $_POST['VisaOrder'];
            if(empty($postData['pay_cert']))
                unset($postData['pay_cert']);
            $model->attributes = $postData;
            if($model->save()){
                $errFlag = false;
                if(!PanelUser::checkAttributesAccess('customer', $model)){
                    VisaOrderCustomer::model()->deleteAllByAttributes(array('visa_order_id'=>$model->id));
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
        if(VisaOrder::deleteVisaRecord($id)){
            Yii::app()->user->setFlash('success', '删除成功，编号为'.$id."的订单已经被删除。");
            $this->redirect(array('visa/list'));
        }
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

    public function actionStat(){
        $this->pageTitle = '统计';
        $model = VisaOrder::stat();
        $this->render('stat', array('model'=>$model));
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