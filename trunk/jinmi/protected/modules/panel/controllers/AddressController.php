<?php

class AddressController extends PanelController
{
    public $label = "地址";
    public $subMenu;
    public function getLabel($labelName){
        $label = array('list'=>'列表', 'delete'=>'删除', 'new'=>'新增', 'addType'=>'新签证类型', 'update'=>'编辑','updateType'=>'编辑','delType'=>'删除','getTypesUnderCountry'=>'获取');
        if(empty($label[$labelName])){
            return "";
        }
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
        $this->pageTitle = "地址列表";
        $model = new Address();
        $result = Address::getAddrList();
		$this->render('list', array('result'=>$result, 'model'=>$model));
	}
    public function actionDelete($id)
    {
        $this->pageTitle = "删除地址";
        if(isset($id)){
            if(Address::model()->deleteByPK($id)){
                Yii::app()->user->setFlash('success', Yii::t('panel', '删除记录成功！'));
                $this->redirect(array('address/list'));
            }
        }
    }
    public function actionNew(){
        $this->pageTitle = "新添地址";
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
        $this->pageTitle = "修改地址";
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
        $countryModel = Address::model()->findByPk($country_id);
        $this->pageTitle = "添加".$countryModel->name."签证类型";
        $model->country_id = $country_id;
        if(!empty($_POST['VisaType'])){

            $model->attributes = $_POST['VisaType'];

            if($model->save()){
                Yii::app()->user->setFlash('success', '成功添加一条签证类型记录。');
                $this->redirect($this->createUrl('address/update', array('id'=>$model->country_id)));
            }
        }else{
            $this->render('visatype/new', array('model'=>$model, 'countryModel'=>$countryModel));
        }
        //print_r($model->attributes);

    }
    public function actionAddAgency($type_id){
        $this->pageTitle = "添加送签渠道";
        $typeModel = VisaType::model()->findByPk($type_id);
        $model = new VisaTypeAgency;
        if(!empty($_POST['VisaTypeAgency'])){
            $model->unsetAttributes();
            $model->attributes = $_POST['VisaTypeAgency'];
            $model->type_id = $type_id;
            if($model->save()){
                Yii::app()->user->setFlash('success', '成功添加一条送签渠道。');
                $this->redirect(array('address/updateType', 'id'=>$type_id));
            }

        }
        $this->render('visatype/agency', array('model'=>$model, 'typeModel'=>$typeModel));
    }
    public function actionUpdateAgency($id){
        $this->pageTitle = "修改送签渠道";
        $model = VisaTypeAgency::model()->findByPk($id);
        $typeModel = VisaType::model()->findByPk($model->type_id);
        if(!empty($_POST['VisaTypeAgency'])){
            $model->attributes = $_POST['VisaTypeAgency'];
            if($model->save()){
                Yii::app()->user->setFlash('success', '成功修改该送签渠道。');
                $this->redirect(array('address/updateType', 'id'=>$model->type_id));
            }

        }
        $this->render('visatype/agency', array('model'=>$model, 'typeModel'=>$typeModel));
    }
    public function actionDeleteAgency($id){
        throw new CHttpException(403, '尚未开放该功能！');
    }
    public function actionUpdateType($id){
        $this->pageTitle = "更新签证类型";
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
        $this->pageTitle = "删除类型";
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
                if(!empty($v->source->name)){
                    $v->name = $v->name."[".$v->source->name."]";
                }
                $temp = array('id'=>$v->id, 'name'=>$v->name, 'notes'=>$v->notes,'price'=>$v->price, 'predict_date'=>$v->predict_date);
                if(!empty($v->source->name)){
                    $temp['source'] = $v->source->name;
                }else{
                    $temp['source'] = '未设定';
                }
                array_push($data, $temp);
            }
            //$data = CHtml::listData($model, 'id', 'name');
            echo json_encode($data);
        }
    }
    /*
     * Get countries list by continent_id
     * @param $_POST['continent_id'] int
     */
    public function actionGetCountriesList(){
        if(!empty($_POST['continent_id']) && is_numeric($_POST['continent_id'])){
            $data = Address::model()->findAll('parent_id = :parent_id', array(
                ':parent_id'=>(int)$_POST['continent_id']
            ));
            $data = CHtml::listData($data, 'id', 'name');
            foreach($data as $value=>$name){
                echo CHtml::tag('option', array('value'=>$value), CHtml::encode($name), true);
            }
        }
    }
	
}