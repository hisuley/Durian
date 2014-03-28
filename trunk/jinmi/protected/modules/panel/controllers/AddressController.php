<?php

class AddressController extends PanelController
{
    public $label = "地址";
    public $subMenu;
    public function getLabel($labelName){
        $label = array('list'=>'列表', 'delete'=>'删除', 'new'=>'新增', 'addType'=>'新签证类型', 'update'=>'编辑','updateType'=>'编辑','delType'=>'删除','getTypesUnderCountry'=>'获取');
        return $label[$labelName];
    }
    public function beforeAction(){
        $this->subMenu = $this->getSubMenu();
        return parent::beforeAction();
    }
    private function getSubMenu(){
        return array(
            array(
                'label'=>'新地址',
                'url'=> array('address/new')
            ),
            array(
                'label'=>'列表',
                'url'=> array('address/list')
            )
        );
    }
	public function actionList()
	{
        $model = new Address();
        $result = Address::getAddrList();
		$this->render('list', array('result'=>$result, 'model'=>$model));
	}
    public function actionDelete($id)
    {
        if(isset($id)){
            if(Address::model()->deleteByPK($id)){
                Yii::app()->user->setFlash('success', Yii::t('panel', '删除记录成功！'));
                $this->redirect(array('address/list'));
            }
        }
    }
    public function actionNew(){
        $model = new Address;
        if(!empty($_POST['Address'])){
            if(isset($_POST['Address']['parent_id']) && ($_POST['Address']['parent_id'] != 0)){
                if(Address::addNewAddr($_POST['Address'], $_POST['Address']['parent_id'])){
                    Yii::app()->user->setFlash('success', Yii::t('panel', '添加成功！'));
                    $this->redirect('list');
                }
            }else{
                if(Address::addNewAddr($_POST['Address'])){
                    Yii::app()->user->setFlash('success', Yii::t('panel', '添加成功！'));
                    $this->redirect('list');
                }
            }
        }else{
            $parentList = Address::model()->findAll('parent_id IS NULL OR parent_id = 0', array());
            $this->render('new', array('parentList'=>$parentList, 'model'=>$model));
        }
    }

    public function actionUpdate($id){
        $model = Address::model()->findByPk($id);
        if(!empty($_POST['Address'])){
            $model->attributes = $_POST['Address'];
            if($model->save()){
                Yii::app()->user->setFlash('success', '修改地址成功。');
                $this->redirect($this->createUrl('address/update', array('id'=>$id)));
            }
        }
        $parentList = Address::model()->findAll('parent_id IS NULL OR parent_id = 0', array());
        $this->render('new', array('parentList'=>$parentList, 'model'=>$model));
    }

    public function actionAddType($country_id){
        $model = new VisaType;
        if(!empty($_POST['VisaType'])){
            $model->unsetAttributes();
            $model->attributes = $_POST['VisaType'];
            $model->country_id = $country_id;
            if($model->save()){
                Yii::app()->user->setFlash('success', '成功添加一条签证类型记录。');
                $this->redirect($this->createUrl('address/update', array('id'=>$model->country_id)));
            }
        }else{
            $this->render('visatype/new', array('model'=>$model));
        }
        //print_r($model->attributes);

    }
    public function actionUpdateType($id){
        $model = VisaType::model()->findByPk($id);
        if(!empty($_POST['VisaType'])){
            $model->attributes = $_POST['VisaType'];
            if($model->save()){
                Yii::app()->user->setFlash('success', '成功修改签证类型记录。');
                $this->redirect($this->createUrl('address/update', array('id'=>$model->country_id)));
            }
        }
        $this->render('visatype/new', array('model'=>$model));
    }
    public function actionDelType($id){
        $model = VisaType::model()->findByPk($id);
        $country_id = $model->country_id;
        VisaType::model()->deleteByPk($id);
        $this->redirect($this->createUrl('address/update', array('id'=>$country_id)));

    }
    public function actionGetTypesUnderCountry(){
        if(Yii::app()->request->isAjaxRequest){
            $model = VisaType::model()->findAllByAttributes(array('country_id'=>$_POST['country_id']));
            $data = array();
            foreach($model as $v){
                $temp = array('id'=>$v->id, 'name'=>$v->name, 'notes'=>$v->notes,'price'=>$v->price, 'predict_date'=>$v->predict_date);
                array_push($data, $temp);
            }
            //$data = CHtml::listData($model, 'id', 'name');
            echo json_encode($data);
        }
    }
	
}