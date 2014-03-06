<?php

class OrderSourceController extends PanelController
{
    public $label = "来源";
    public $subMenu;
    public function getLabel($labelName){
        $label = array('list'=>'列表', 'delete'=>'删除', 'new'=>'新增', 'update'=>'编辑');
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

}