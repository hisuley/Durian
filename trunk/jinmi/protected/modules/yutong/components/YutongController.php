<?php
/**
 * Created by PhpStorm.
 * User: suley
 * Date: 1/21/14
 * Time: 1:47 AM
 */

class YutongController extends CController{
    public function beforeAction($action){
        if(!Yii::app()->user->isGuest){
            $userModel = YutongUser::model()->findByPk(Yii::app()->user->id);
            if(!is_array($userModel->role)){
                $userModel->role = explode(',', $userModel->role);
            }

            if(!in_array('merchant', $userModel->role)){
                Yii::app()->user->logout();
                //$this->redirect(array('user/login'));
            }
        }
        return parent::beforeAction($action);
    }
} 