<?php
/**
 * Created by PhpStorm.
 * User: suley
 * Date: 1/21/14
 * Time: 1:46 AM
 */

class VisaController extends YutongController{
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

    public function actionSearch(){

    }

    public function actionList(){

    }
    public function actionView($id){

    }

    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='visa-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
} 