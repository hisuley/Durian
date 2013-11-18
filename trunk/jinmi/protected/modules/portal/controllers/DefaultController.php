<?php

class DefaultController extends CController
{

	public function actionIndex()
	{
		$this->render('index');
	}
	public function actionLogin(){
		if(isset($_POST['LoginForm'])){
			$result = User::model()->find('username = :username AND password = :password', array(
				':username' => trim($_POST['LoginForm']['username']),
				':password' => User::hashPassword($_POST['LoginForm']['password'])
				));
			if(isset($result)){
				$this->redirect('default/index');
			}else{
				Yii::app()->user->setFlash('failed', '登陆失败，请检查用户名和密码');
			}
		}
		$this->renderPartial('login');
	}
	public function actionLogout(){
        Yii::app()->user->logout();
        Yii::app()->user->setFlash('failed', '已经退出，请重新登录。');
		$this->redirect('login');
	}
	public function actionRegister(){
		$this->render('register');
	}
    public function actionError(){
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }
    public function actionErrorTest(){
        throw new CHttpException(404, '错误');
    }
}