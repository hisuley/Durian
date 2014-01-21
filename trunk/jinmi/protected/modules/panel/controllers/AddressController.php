<?php

class AddressController extends PanelController
{
    public $label = "地址";
    public function getLabel($labelName){
        $label = array('list'=>'列表', 'delete'=>'删除', 'new'=>'新增');
        return $label[$labelName];
    }
	public function actionList()
	{
        $result = Address::getAddrList();
		$this->render('list', array('result'=>$result));
	}
    public function actionDelete($id)
    {
        if(isset($id)){
            if(Address::deleteByPK($id)){
                Yii::app()->user->setFlash('success', Yii::t('panel', '删除记录成功！'));
                $this->redirect(array('panel/address/list'));
            }
        }
    }
    public function actionNew(){
        if(!empty($_POST['AddressForm'])){
            if(isset($_POST['AddressForm']['parent_id']) && ($_POST['AddressForm']['parent_id'] != 0)){
                if(Address::addNewAddr($_POST['AddressForm'], $_POST['AddressForm']['parent_id'])){
                    Yii::app()->user->setFlash('success', Yii::t('panel', '添加成功！'));
                    $this->redirect('list');
                }
            }else{
                if(Address::addNewAddr($_POST['AddressForm'])){
                    Yii::app()->user->setFlash('success', Yii::t('panel', '添加成功！'));
                    $this->redirect('list');
                }
            }
        }else{
            $parentList = Address::model()->findAll('parent_id IS NULL OR parent_id = 0', array());
            $this->render('new', array('parentList'=>$parentList));
        }
    }
	
}