<?php

/**
 * Website Index Page Controller
 *
 * This class is used to show index content.
 *
 * Model Functions:
 * 
 *
 * PHP 5
 * 
 * Author: Suley[luzhang@jmlvyou.com]
 * Copyright 2012-2013, Kimi Tourism, Inc. (http://www.jmlvyou.com)
 * 
 */

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
            ),
            'chat' => array( 
                'class' => 'ChatAction' 
            ) ,
            'yiichat'=>array('class'=>'YiiChatAction'),

		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
    }
    public function actionChatAdd()
    {
        $model=new chatDbModel();

        if(Yii::app()->user->name!='Guest')
            $from_user=Yii::app()->user->name;
        else
            $from_user=$_COOKIE['PHPSESSID'];

        $model->postMessage($_POST['message'], $from_user, $_POST['to_user']);

    }
    public function actionChatData()
    {
        $model=new chatDbModel();
        $msg=$model->getMessages($_POST['currentActiveUser']);
        print_r($msg);
        //echo json_encode($msg);
    }
    public function actionChat()
    {
        $this->render('chat');
    }

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
    }
    public function actionUnique()
    {
        
    }

    public function actionRegister()
    {
        if(Yii::app()->request->isAjaxRequest)
        {
            $user=User::model()->find('email=?', array($_POST['user']['email']));
            echo count($user)===0?"{state:'success'}":"{state:'false'}";
            return;

        }

        $user=new User;
        $user->scenario='register';        

        $_POST['user']=array(
            'email'=>rand(100,1000).'@11.com',
            'password'=>'aaa',
            'nickname'=>'xstudio1',
            'cellphone'=>'11111',
        );
        if(isset($_POST['user']))
        {
            $user->setUserAttrs($_POST['user']);
            if($user->validate())
            {
                $user->hashPassword();
                if($user->save())
                {
                    $user->login();
                    $this->redirect('index.php?r=user/center');
                }
            }
            else
            {
                var_dump($user->getErrors());
                return;
            }
        }
    }
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$user=new User;
        $user->scenario='login';

		if(isset($_POST['User']))
        {
            $user->attributes=$_POST['User'];
            $user->hashPassword();
			// validate user input and redirect to the previous page if valid
            if($user->validate() && $user->login())
            {
                $user->updateLoginfo();
                $this->redirect(Yii::app()->user->returnUrl);
            }
		}
		// display the login form
		$this->render('login',array('model'=>$user));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
}
