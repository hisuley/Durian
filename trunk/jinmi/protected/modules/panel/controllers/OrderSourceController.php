<?php

class OrderSourceController extends PanelController
{
    public $label = "来源";
    public $subMenu;
    public function getLabel($labelName){
        $label = array('list'=>'列表', 'delete'=>'删除', 'new'=>'新增', 'update'=>'编辑', 'newAccount'=>'新增账号', 'editAccount'=>'编辑账号', 'deleteAccount'=>'删除账号');
        return $label[$labelName];
    }
    public function beforeAction(){
        $this->subMenu = $this->getSubMenu();
        return parent::beforeAction();
    }
    private function getSubMenu(){
        return array(
            array(
                'label'=>'新来源',
                'url'=> array('orderSource/new')
            ),
            array(
                'label'=>'列表',
                'url'=> array('orderSource/list')
            )
        );
    }

    public function actionList()
    {
        $result = OrderSource::getSourceList();
        $model = new OrderSource();
        $this->render('list', array('result'=>$result, 'model'=>$model));
    }
    public function actionDelete($id)
    {
        if(isset($id)){
            if(OrderSource::model()->deleteByPK($id)){
                Yii::app()->user->setFlash('success', Yii::t('panel', '删除记录成功！'));
                $this->redirect($this->createUrl('orderSource/list'));
            }
        }
    }
    public function actionUpdate($id){
        $model = OrderSource::model()->findByPk($id);
        if(!empty($_POST['OrderSource'])){
            $postData = $_POST['OrderSource'];
            $model->attributes = $postData;
            $model->type = OrderSource::TYPE_SOURCE;
            if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('panel', '修改成功！'));
                $this->redirect($this->createUrl('orderSource/list'));
            }
        }else{
            $parentList = OrderSource::model()->findAll('type = 2 AND (parent_id IS NULL OR parent_id = 0) AND id != :id', array(':id'=>$id));
            $this->render('new', array('parentList'=>$parentList, 'model'=>$model));
        }
    }
    public function actionNew(){
        $model = new OrderSource;
        if(!empty($_POST['OrderSource'])){
            $_POST['OrderSource']['type'] = OrderSource::TYPE_SOURCE;
            if(isset($_POST['OrderSource']['parent_id']) && ($_POST['OrderSource']['parent_id'] != 0)){

                if(OrderSource::addNewSource($_POST['OrderSource'], $_POST['OrderSource']['parent_id'])){
                    Yii::app()->user->setFlash('success', Yii::t('panel', '添加成功！'));
                    $this->redirect($this->createUrl('orderSource/list'));
                }
            }else{
                if(OrderSource::addNewSource($_POST['OrderSource'])){
                    Yii::app()->user->setFlash('success', Yii::t('panel', '添加成功！'));
                    $this->redirect($this->createUrl('orderSource/list'));
                }
            }
        }else{
            $parentList = OrderSource::model()->findAll('type = 1 and (parent_id IS NULL OR parent_id = 0)', array());
            $this->render('new', array('parentList'=>$parentList, 'model'=>$model));
        }
    }

    /*
     * Add new account the specific order source record
     * @param $id int the id of order source record.
     * @return nothing.
     */
    public function actionNewAccount($id){
        $this->pageTitle = "新增账号";
        $model = new OrderSourceBankAccount;
        $orderSourceModel = OrderSource::model()->findByPk($id);
        if(empty($orderSourceModel))
            throw new CHttpException(404, '该渠道不存在，请从渠道详情页面使用该功能！');
        if(!empty($_POST['OrderSourceBankAccount'])){
            $model->attributes = $_POST['OrderSourceBankAccount'];
            $model->order_source_id = $id;
            if($model->validate() && $model->save()){
                Yii::app()->user->setFlash('success', '银行账号添加成功！');
                $this->redirect(array('orderSource/update','id'=>$model->order_source_id));
            }
        }
        $this->render('bank', array("model"=>$model, "orderSourceModel"=>$orderSourceModel));
    }

    /*
     * Edit the order source record's bank account record.
     * @param $id int the id of bank account
     * @return nothing
     */
    public function actionEditAccount($id){
        $this->pageTitle = "新增账号";
        $model = OrderSourceBankAccount::model()->findByPk($id);
        $orderSourceModel = $model->order_source;
        if(empty($model))
            throw new CHttpException(404, '您编辑的账号不存在，请从渠道详情页面使用该功能！');
        if(!empty($_POST['OrderSourceBankAccount'])){
            $model->attributes = $_POST['OrderSourceBankAccount'];
            if($model->validate() && $model->save()){
                Yii::app()->user->setFlash('success', '银行账号添加成功！');
                $this->redirect(array('orderSource/update', 'id'=>$model->order_source_id));
            }
        }
        $this->render('bank', array("model"=>$model, "orderSourceModel"=>$orderSourceModel));
    }

    public function actionDeleteAccount($id){
        $model = OrderSourceBankAccount::model()->findByPk($id);
        $orderSourceId = $model->order_source_id;
        $model->delete();
        //Yii::app()->user->setFlash('success', '删除成功！');
        //$this->redirect(array('orderSource/update', array('id'=>$orderSourceId)));
        echo "OK";
    }

}