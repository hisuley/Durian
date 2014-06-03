<?php
/**
 * Created by PhpStorm.
 * User: suley
 * Date: 1/21/14
 * Time: 1:46 AM
 */

class VisaController extends YutongController{


    public function actionSearch($keyword){
        $this->pageTitle = "搜索".$keyword."相关签证";
        $model = new YutongVisaGoods();
        $model->keyword = $keyword;
        if(isset($_GET['keyword'])){
            $keyword = trim($_GET['keyword']);
        }
        $criteria = new CDbCriteria;
        $criteria->limit = 5;
        $criteria->order = "id DESC";
        $articleModels = YutongArticle::model()->findAll($criteria);
        $criteria = new CDbCriteria;
        $criteria->limit = 5;
        $criteria->order = "id DESC";
        $keys = $model->search(array('order'=>'t.show_order ASC', 'pagination'=>25), array(), 'CActiveDataProvider')->getKeys();
        $criteria->addInCondition('goods_id', $keys);
        $attachmentModels = YutongVisaGoodsAttachment::model()->findAll($criteria);
        $this->render('list', array('model'=>$model, 'keyword'=>$keyword, 'articleModels'=>$articleModels, 'attachmentModels'=>$attachmentModels));
    }

    public function actionList(){
        $this->pageTitle = "签证列表";

        $model = new YutongVisaGoods();
        if(!empty($_GET['country_id'])){
            $model->all_country_id = $_GET['country_id'];
            Yii::import('application.modules.panel.models.Address');
            $this->pageTitle = Address::getCountryName($model->all_country_id)."签证列表";
        }
        $criteria = new CDbCriteria;
        $criteria->limit = 5;
        $criteria->order = "id DESC";
        $articleModels = YutongArticle::model()->findAll($criteria);
        $criteria = new CDbCriteria;
        $criteria->limit = 5;
        $criteria->order = "id DESC";
        $attachmentModels = YutongVisaGoodsAttachment::model()->findAll($criteria);
        $this->render('list', array('model'=>$model, 'articleModels'=>$articleModels, 'attachmentModels'=>$attachmentModels));
    }
    public function actionView($id){
        $model = YutongVisaGoods::model()->findByPk($id);
        $this->pageTitle = $model->country->name."签证 ".$model->type->name;
        $this->render('view', array('model'=>$model));
    }

    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='visa-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    public function actionDownload($link, $name){
        $link = urldecode($link);
        $name = urldecode($name);
        $path = Yii::app()->basePath."/../upload/yutong/".$link;
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        if(file_exists($path)){
            return Yii::app()->getRequest()->sendFile($name.".".$ext, @file_get_contents($path));
        }
    }
} 