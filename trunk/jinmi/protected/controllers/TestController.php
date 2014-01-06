<?php

class TestController extends Controller{
	public function actionTestGet(){
		echo Yii::app()->request->getQuery('test', '100');
	}
	public function actionThemeTest(){
		$this->render('testTheme');
	}
	public function actionTestImg(){
		$this->render('img');
	}
}
?>