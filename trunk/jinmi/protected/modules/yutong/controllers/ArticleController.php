<?php
/**
 * @project: trunk
 * @file: ArticleController.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-4-9
 * @time: 下午1:14
 * @version: 1.0
 */

class ArticleController extends YutongController{

    public function actionView($id){

        $model = YutongArticle::model()->findByPk($id);
        $models = YutongArticle::model()->findAll('id != '.$id);
        $this->pageTitle = CHtml::encode($model->title);
        $this->render('view', array('model'=>$model, 'models'=>$models));
    }

}