<?php

/**
 * Created by PhpStorm.
 * User: Suley
 * Date: 14-3-29
 * Time: 下午3:46
 */
class UserController extends YutongController
{
    public function beforeAction($action){
        if(Yii::app()->user->isGuest && $this->action->id == 'profile'){
            $this->redirect(array('user/login'));
        }
        return parent::beforeAction($action);
    }
    public function actionLogout()
    {
        Yii::app()->user->logout();
        Yii::app()->user->setFlash('failed', '已经退出，请重新登录。');
        $this->redirect('login');
    }

    public function actionLogin()
    {
        $this->pageTitle = "登录";
        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model = new LoginForm;
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->login())
                $this->redirect(array('default/index'));
            else {
                Yii::app()->user->setFlash('error', '登录失败，请检查用户名密码。');
            }
        }
        $this->render('member');
    }

    public function actionProfile()
    {
        $this->pageTitle = "个人资料";
        $model = YutongUser::model()->findByPk(Yii::app()->user->id);
        if (isset($_POST['YutongUserAddress'])) {

            $addressModel = YutongUserAddress::model()->findByPk($model->address->id);
            $addressModel->attributes = $_POST['YutongUserAddress'];
            if ($addressModel->save()) {
                Yii::app()->user->setFlash('success', '成功保存！');
                $this->redirect(array('user/profile'));
            }

        }
        $this->render('profile', array('model' => $model));
    }

    public function actionRegister()
    {
        $this->pageTitle = "注册会员";
        $model = new YutongUser();
        if (isset($_POST['YutongUser'])) {
            $model->attributes = $_POST['YutongUser'];
            if ($model->save()) {
                $addressModel = new YutongUserAddress();
                $addressModel->attributes = $_POST['YutongUserAddress'];
                $addressModel->user_id = $model->id;
                if($addressModel->save()) {
                    $this->redirect(array('default/index'));
                }
            } else {
                throw new CHttpException(500, 'Internal server error');
            }
        }
        $this->render('member');
    }
}