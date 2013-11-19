<?php

class DefaultController extends CController
{

    public function beforeAction(){
        if(Yii::app()->user->isGuest && $this->action->id != 'login'){
            $this->redirect(array('portal/default/login'));
        }
        return true;
    }
	public function actionIndex()
	{
		$this->render('index');
	}
	public function actionLogin(){
        $model=new LoginForm;

        // collect user input data
        if(isset($_POST['LoginForm']))
        {
            $model->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if($model->validate() && $model->login())
                $this->redirect('index');
        }
        // display the login form

        /*
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
		}*/
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