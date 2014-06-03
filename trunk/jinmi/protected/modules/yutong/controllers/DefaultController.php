<?php

class DefaultController extends YutongController
{

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

    public function actionQQFrame($userId = 0){
        //$qqList = array(1437092985, 2912100133, 364617731);
        $qqList = array(364617731);
        $serviceInfo = array('is_guest'=>true);
        if(empty($userId)){
            $serviceInfo['is_guest'] = true;
            //$serviceInfo['QQ'] = Yii::app()->user->getState('service_qq');
            if(empty($serviceInfo['QQ'])){
                $serviceInfo['QQ'] = $qqList[array_rand($qqList)];
                Yii::app()->user->setState('service_qq', $serviceInfo['QQ']);
            }
        }else{
            $userModel = YutongUser::model()->findByPk(Yii::app()->user->id);
            if(!empty($userModel->address->handler) && !empty($userModel->address->handler->qq)){
                $serviceInfo['QQ'] = $userModel->address->handler->qq;
                $serviceInfo['realname'] = $userModel->address->handler->realname;
                $serviceInfo['phone'] = $userModel->address->handler->phone;
                $serviceInfo['is_guest'] = false;
            }else{
                $serviceInfo['QQ'] = $qqList[array_rand($qqList)];
                $serviceInfo['is_guest'] = true;
            }
        }
        $this->renderPartial('qq', array('serviceInfo'=>$serviceInfo));
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
        $this->pageTitle = "欢迎使用宇通签证系统";
        $model = YutongUser::model()->findByPk(Yii::app()->user->id);
        $indexVisas = YutongConfig::model()->findByAttributes(array('meta_name'=>'index_visa'));
        $criteria = new CDbCriteria();
        $criteria->limit = 6;
        if(!empty($indexVisas->meta_value)){
            $visaIds = explode(',', $indexVisas->meta_value);
            if(is_array($visaIds)){
                foreach($visaIds as $key=>$val){
                    if($key < 7){
                        if(!empty($val)){
                            $indexVisaModels[$key] = YutongVisaGoods::model()->findByPk($val);
                            if(empty($indexVisaModels[$key])){
                                unset($indexVisaModels[$key]);
                            }
                        }

                    }

                }
            }

        }else{
            $indexVisaModels = YutongVisaGoods::model()->findAll($criteria);
        }

		$this->render('index', array('usersModel'=>$model, 'indexVisaModels'=>$indexVisaModels));
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
            if($model->login())
                $this->redirect(array('visa/list'));
            else{
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
        $this->pageTitle = "注册";
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