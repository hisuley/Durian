<?php
/**
 * Created by PhpStorm.
 * User: Suley
 * Date: 14-3-30
 * Time: 下午5:24
 */

Yii::app()->theme = "panel_bootstrap";

class YutongController extends PanelController{
    public $label = "宇通";
    public $actionLabel;
    public $subMenu;
    public function getLabel($labelName){
        $label = array('new'=>'下单', 'list'=>'列表', 'update'=>'修改', 'view'=>'查看', 'stat'=>'统计', 'delete'=>'删除', 'verify'=>'审核', 'confirmCustomerIssued'=>'确认下单');
        if(in_array($labelName, $label)){
            return $label[$labelName];
        }
        return '';
    }
    public function init(){
        Yii::app()->theme = "panel_bootstrap";
        parent::init();
    }
    private function getSubMenu(){
        return array(
            array(
                'label'=>'新签证',
                'url'=> array('yutong/newVisa')
            ),
            array(
                'label'=>'签证列表',
                'url'=> array('yutong/visaList')
            ),
            array(
                'label'=>'订单列表',
                'url'=> array('yutong/orderList')
            ),
            array(
                'label'=>'资讯管理',
                'url'=> array('yutong/articleList')
            )
        );
    }
    public function beforeAction($action){
        Yii::app()->layoutPath = Yii::getPathofAlias('webroot.themes.panel_bootstrap.views.layouts');
        $this->subMenu = $this->getSubMenu();
        Yii::import('application.modules.panel.models.Finance');
        Yii::import('application.modules.panel.models.PanelUser');
        Yii::import('application.modules.yutong.models.*');
        parent::beforeAction($action);
        $this->breadcrumbs = array(
            $this->label => array('yutong/orderList')
        );
        return true;
    }

    public function actionVisaList(){
        $this->pageTitle = "签证列表";
        $model = new YutongVisaGoods();
        if(isset($_GET['YutongVisaGoods'])){
            $model->attributes = $_GET['YutongVisaGoods'];
        }
        $this->render('__visa_list', array('model'=>$model));
    }

    public function actionDelete($id){
        throw new CHttpException(500, '该功能已经暂停使用！');
        YutongVisaGoods::model()->deleteByPk($id);
        Yii::app()->user->setFlash('success', '您已经删除该签证');
        $this->redirect(array('yutong/visaList'));
    }

    public function actionOrderList(){
        $this->pageTitle = "订单列表";
        $model = new YutongVisaOrder();
        $this->render('__order_list', array('model'=>$model));
    }

    public function actionUpdateOrder($id){
        $this->pageTitle = "修改订单";
        $model = YutongVisaOrder::model()->findByPk($id);
        if(isset($_POST['YutongVisaOrder'])){
            if($model->updateOrder(Yii::app()->user->id)){
                Yii::app()->user->setFlash('success', '修改成功！');
                $this->redirect(array('yutong/orderList'));
            }

        }
        $this->render('__order_form', array('model'=>$model));
    }

    public function actionNewVisa(){
        $this->pageTitle = "添加签证";
        $model = new YutongVisaGoods();
        if(isset($_POST['YutongVisaGoods'])){
            $model->attributes = $_POST['YutongVisaGoods'];
            $model->author_id = Yii::app()->user->id;
            $model->status = 'active';
            if($model->save()){
                Yii::app()->user->setFlash('success','添加成功!');
                $this->redirect(array('yutong/visaList'));
            }
        }
        $this->render('__form_visa', array('model'=>$model));
    }

    public function actionUpdateVisa($id){
        $this->pageTitle = "更新签证";
        $model = YutongVisaGoods::model()->findByPk($id);
        if(isset($_POST['YutongVisaGoods'])){
            $model->attributes = $_POST['YutongVisaGoods'];
            if($model->save()){
                Yii::app()->user->setFlash('success','修改成功!');
                $this->redirect(array('yutong/visaList'));
            }
        }
        $this->render('__form_visa', array('model'=>$model));
    }

    public function actionArticleList(){
        $this->pageTitle = "资讯列表";
        Yii::import('application.modules.yutong.models.YutongArticle');
        $model = new YutongArticle;
        $this->render('article/list', array('model'=>$model));
    }
    public function actionNewArticle(){
        $this->pageTitle = "添加资讯";
        Yii::import('application.modules.yutong.models.YutongArticle');
        $model = new YutongArticle;
        if(isset($_POST['YutongArticle'])){
            $model->attributes = $_POST['YutongArticle'];
            $model->user_id = Yii::app()->user->id;
            if($model->save()){
                Yii::app()->user->setFlash('success', '资讯添加成功！返回资讯列表。');
                $this->redirect(array('yutong/articleList'));
            }
        }
        $this->render('article/form', array('model'=>$model));
    }
    public function actionUpdateArticle($id){
        $this->pageTitle = "编辑资讯";
        Yii::import('application.modules.yutong.models.YutongArticle');
        $model = YutongArticle::model()->findByPk($id);
        if(empty($model))
            throw new CHttpException(404, '找不到指定的资讯！');
        if(isset($_POST['YutongArticle'])){
            $model->attributes = $_POST['YutongArticle'];
            if($model->save()){
                Yii::app()->user->setFlash('success', '资讯修改成功！返回资讯列表。');
                $this->redirect(array('yutong/articleList'));
            }
        }
        $this->render('article/form', array('model'=>$model));
    }

    public function actionMerchantList(){
        $this->pageTitle = "已注册商户列表";
        $model = new YutongUser;
        $this->render('merchant/list', array('model'=>$model));
    }

    public function actionMerchantUpdate($id){

        $model = YutongUser::model()->findByPk($id);
        if(!empty($model)){
            $this->pageTitle = $model->username;
            if(isset($_POST['YutongUserAddress'])){
                //$model->attributes = $_POST['YutongUser'];
                $addressModel = YutongUserAddress::model()->findByPk($model->address->id);
                $addressModel->attributes = $_POST['YutongUserAddress'];
                if($addressModel->save()){
                    Yii::app()->user->setFlash('success', "修改商户资料成功。");
                    $this->redirect(array("yutong/merchantList"));
                }else{
                    throw new CHttpException(500, "修改错误，服务器请求失败。");
                }
            }
            $this->render('merchant/update', array('model'=>$model));
        }else{
            throw new CHttpException(404, "无法找到该商户，请回到列表重新发起链接。");
        }
    }

    public function actionMerchantDelete($id){
        $model = YutongUser::model()->findByPk($id);
        if($model->roles == YutongUser::ROLE_MERCHANT){
            if($model->delete()){
                Yii::app()->user->setFlash('success', "删除成功！");
                $this->redirect(array('yutong/merchantList'));
            }
        }
        throw new CHttpException(400, '您编辑的用户不是商户，请检查！');
    }


    public function actionFinanceConfirm($id){
        $this->pageTitle = "收款确认";
        $model = YutongVisaOrder::model()->findByPk($id);
        if(empty($model))
            throw new CHttpException(404, '找不到这个订单。');
        if($model->is_pay)
            throw new CHttpException(400, '该订单已经被支付。');
        if(isset($_POST['YutongVisaOrder'])){
            $model->attributes = $_POST['YutongVisaOrder'];
            $model->accountant_id = Yii::app()->user->id;
            $model->accountant_time = strtotime('now');
            $model->is_pay = 1;
            if($model->save()){
                Yii::app()->user->setFlash('success', "确认成功！");
                $this->redirect(array('yutong/updateOrder', 'id'=>$model->id));
            }
        }
        $this->render('finance/step1', array('model'=>$model));
    }

    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='visa-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionIndexVisa(){
        Yii::import('application.modules.yutong.models.YutongConfig');
        $model = YutongConfig::model()->findByAttributes(array('meta_name'=>'index_visa'));
        if(empty($model)){
            throw new CHttpException(404, "系统内没有预设的配置键值，请添加后再使用此功能。");
        }
        if(isset($_POST['YutongConfig']['meta_value'])){
            $model->meta_value = $_POST['YutongConfig']['meta_value'];
            if($model->save()){
                Yii::app()->user->setFlash('success', "更新成功！");
            }
        }
        $this->render('config/indexGoods', array('model'=>$model));
    }

    public function actionTest(){
        $message = new PanelMessage();
        $message->addMessage('订单状态修改', '订单状态已经修改', PanelMessage::TYPE_NOTICE, Yii::app()->user->id);
        $this->render('test');
    }
}