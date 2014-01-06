<?php

class AddressController extends CController
{

    public function beforeAction(){
        if(Yii::app()->user->isGuest && $this->action->id != 'login'){
            $this->redirect(array('portal/default/login'));
        }
        return true;
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
                Yii::app()->user->setFlash('success', Yii::t('portal', '删除记录成功！'));
                $this->redirect(array('portal/address/list'));
            }
        }
    }
    public function actionNew(){
        if(!empty($_POST['AddressForm'])){
            if(isset($_POST['AddressForm']['parent_id']) && ($_POST['AddressForm']['parent_id'] != 0)){
                if(Address::addNewAddr($_POST['AddressForm'], $_POST['AddressForm']['parent_id'])){
                    Yii::app()->user->setFlash('success', Yii::t('portal', '添加成功！'));
                    $this->redirect('list');
                }
            }else{
                if(Address::addNewAddr($_POST['AddressForm'])){
                    Yii::app()->user->setFlash('success', Yii::t('portal', '添加成功！'));
                    $this->redirect('list');
                }
            }
        }else{
            $parentList = Address::model()->findAll('parent_id IS NULL OR parent_id = 0', array());
            $this->render('new', array('parentList'=>$parentList));
        }
    }
	
}