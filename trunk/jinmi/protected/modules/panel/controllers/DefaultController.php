<?php

class DefaultController extends PanelController
{
    public $label = "默认";
    public function getLabel($labelName){
        $label = array('index'=>'首页', 'login'=>'登录', 'logout'=>'注销');
        return $label[$labelName];
    }

    public function actionUpload()
    {
     
            Yii::import("application.extensions.EAjaxUpload.qqFileUploader");
     
            $folder=Yii::getPathOfAlias('webroot').'/upload/panel/';// folder for uploaded files
            $allowedExtensions = array("jpg","jpeg","gif","png","bmp");//array("jpg","jpeg","gif","exe","mov" and etc...
            $sizeLimit = 100 * 1024 * 1024;// maximum file size in bytes
            $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
            $result = $uploader->handleUpload($folder);
            $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
    
            $fileSize=filesize($folder.$result['filename']);//GETTING FILE SIZE
            $fileName=$result['filename'];//GETTING FILE NAME
            //$img = CUploadedFile::getInstance($model,'image');
     
            echo $return;// it's array
    }
	public function actionIndex()
	{
		$this->render('index');
	}
	public function actionLogin(){
        $this->layout = 'login';

        // collect user input data
        if(isset($_POST['LoginForm']))
        {
            $model=new LoginForm;
            $model->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if($model->validate() && $model->login())
                $this->redirect(array('visa/list'));
        }

		$this->render('login');
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