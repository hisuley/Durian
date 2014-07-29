<?php
/**
 * Created by PhpStorm.
 * User: suley
 * Date: 1/21/14
 * Time: 1:46 AM
 */

class OrderController extends YutongController{
    public function beforeAction($action){
        if(Yii::app()->user->isGuest){
            $this->redirect(array('user/login'));
        }
        return parent::beforeAction($action);
    }
    public function actionSearch(){

    }

    public function actionNew($id){
        $this->pageTitle = "下单";
        $goodsModel = YutongVisaGoods::model()->findByPk($id);
        $usersModel = Yii::app()->user->isGuest ? new YutongUser : YutongUser::model()->findByPk(Yii::app()->user->id);
        $model = new YutongVisaOrder();
        if(isset($_POST['YutongVisaOrder'])){
            if(Yii::app()->user->isGuest){
                $usersModel->unsetAttributes();
                if(!empty($_POST['YutongVisaOrder[contact_phone]'])){
                    $phone = $_POST['YutongVisaOrder[contact_phone]'];

                }else{
                    $phone = 283592385;
                }
                $username = $usersModel->getAvailName(intval($phone));
                $usersModel->username = $username;
                $usersModel->initial_password = rand(10000000,99999999);
                $usersModel->password = $usersModel->initial_password;
                $usersModel->password2 = $usersModel->initial_password;
                if($usersModel->save()){
                    $address = new YutongUserAddress;
                    $address->user_id = $usersModel->id;
                    $address->contact_phone = empty( $_POST['YutongVisaOrder[contact_phone]']) ? '': $_POST['YutongVisaOrder[contact_phone]'];
                    $address->contact_name = empty( $_POST['YutongVisaOrder[contact_name]']) ? '': $_POST['YutongVisaOrder[contact_name]'];
                    $address->contact_address = empty( $_POST['YutongVisaOrder[contact_address]']) ? '': $_POST['YutongVisaOrder[contact_address]'];
                    $address->company_name = empty( $_POST['YutongVisaOrder[company_name]']) ? '': $_POST['YutongVisaOrder[company_name]'];
                    $address->save();
                }
                $loginModel = new LoginForm;
                $loginModel->attributes = array('username'=>$usersModel->username, 'password'=>$usersModel->initial_password);
                if(!$loginModel->login()){
                    throw new CHttpException(500, "自动注册用户失败！");
                }
            }
            $tempAttr = $_POST['YutongVisaOrder'];
            $tempAttr['goods_id'] = $id;
            $tempAttr['user_id'] = $usersModel->id;
            $tempAttr['single_price'] = $goodsModel->price;
            $tempAttr['price'] = $goodsModel->price*$tempAttr['amount'];
            $model->attributes = $tempAttr;
            if($model->save()){
                if(isset($_POST['YutongVisaOrderCustomers']) && is_array($_POST['YutongVisaOrderCustomers'])){
                    foreach($_POST['YutongVisaOrderCustomers'] as $customer){
                        $tempNewCustomer = new YutongVisaOrderCustomers();
                        $tempNewCustomer->attributes = $customer;
                        $tempNewCustomer->order_id = $model->id;
                        $tempNewCustomer->save();
                    }
                }
                Yii::app()->user->setFlash("success", "下单成功！");
                if(Yii::app()->user->isGuest){

                    $this->redirect(array('order/view', 'id'=>$model->id));
                }else{
                    $this->redirect(array('order/list'));
                }

            }
        }
        $this->render('new', array('goodsModel'=>$goodsModel, 'usersModel'=>$usersModel, 'model'=>$model));
    }

    public function actionList(){
        $this->pageTitle = "订单列表";
        $model = new YutongVisaOrder();
        $this->render('list', array('model'=>$model));
    }
    public function actionView($id){
        $this->pageTitle = "查看订单";
        $model = YutongVisaOrder::model()->findByPk($id);
        $this->render('view', array('model'=>$model));
    }

    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='visa-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
} 