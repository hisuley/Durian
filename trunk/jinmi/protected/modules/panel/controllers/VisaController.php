<?php
/**
 * Created by PhpStorm.
 * User: suley
 * Date: 1/21/14
 * Time: 1:46 AM
 */

class VisaController extends PanelController{

    public function beforeAction(){

        return parent::beforeAction();
    }
    public function actionNew(){
        $data = $_POST['OrderForm'];
        if(!empty($data)){
            $model = new VisaOrder();
            if($model->saveNewOrder()){
                Yii::app()->setFlash('success', '新的订单添加成功。');
            }
        }
    }
    public function actionEdit(){
        $this->render('form/new');
    }
    public function actionView(){

    }
    public function actionUpdate(){

    }
    public function actionList(){

    }
} 