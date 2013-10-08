<?php

class DefaultController extends Controller
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
		$this->render('logout');
	}
	public function actionRegister(){
		$this->render('register');
	}
}