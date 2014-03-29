<?php
/**
 * Created by PhpStorm.
 * User: Suley
 * Date: 14-3-29
 * Time: 下午3:46
 */


class UserController extends YutongController{
    public function actionLogin(){
        $this->render('member');
    }
    public function actionRegister(){
        $this->render('member');
    }
}