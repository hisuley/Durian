<?php

class DefaultController extends PanelController
{
    public $label = "默认";
    public function getLabel($labelName){
        $label = array('index'=>'首页', 'login'=>'登录', 'logout'=>'注销', 'upload'=>'上传', 'changepass'=>'修改密码');
        return isset($label[$labelName]) ? $label[$labelName] : '';
    }
    public $subMenu;
    public function beforeAction(){
        $this->subMenu = $this->getSubMenu();
        return parent::beforeAction();
    }

    private function getSubMenu(){
        return array(
            array(
                'label'=>'退出',
                'url'=> array('default/logout')
            ),
            array(
                'label'=>'修改密码',
                'url'=> array('default/changepass')
            )
        );
    }

    public function actionChangepass(){
        $this->pageTitle = "修改密码";
        $model = PanelUser::model()->findByPk(Yii::app()->user->id);
        if(isset($_POST['PanelUser'])){
            if(PanelUser::hashPassword($_POST['PanelUser']['password']) == $model->initialPassword){
                Yii::app()->user->setFlash('info', '密码没有改变。');
            }else{
                $model->attributes = $_POST['PanelUser'];
                if($model->save()){
                    Yii::app()->user->setFlash('success', '密码修改成功。');
                    $model = PanelUser::model()->findByPk(Yii::app()->user->id);
                }
            }
        }
        $this->render('changepass', array('model'=>$model));
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
        $this->pageTitle = "登录";
        $this->layout = 'login';

        // collect user input data
        if(isset($_POST['LoginForm']))
        {
            $model=new LoginForm;
            $model->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if($model->login()){
                if(Yii::app()->user->role == 'finance'){
                    $this->redirect(array('finance/requestList'));
                }elseif(Yii::app()->user->role == 'purchase'){
                    $this->redirect(array('agency/list'));
                }
                else{
                    $this->redirect(array('visa/list'));
                }
            }else{
                Yii::app()->user->setFlash('error', '登录失败，请检查用户名密码。');
            }
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