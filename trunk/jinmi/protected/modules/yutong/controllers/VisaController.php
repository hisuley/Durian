<?php
/**
 * Created by PhpStorm.
 * User: suley
 * Date: 1/21/14
 * Time: 1:46 AM
 */

class VisaController extends YutongController{


    public function actionSearch(){

    }

    public function actionList(){
        $this->render('list');
    }
    public function actionView($id){
        $this->render('view', array('goods_id'=>$id));
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