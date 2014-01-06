<?php
/**
 * Class VisaController
 * use to handle the visa related business.
 */
class VisaController extends CController{
    public function beforeAction(){
        if(Yii::app()->user->isGuest && $this->action->id != 'login'){
            $this->redirect(array('default/login'));
        }
        return true;
    }
    public function accessRules(){
        return array(
            UserRole::ROLE_VISA_ADMIN => array(
                'new', 'edit', 'search', 'list', 'view', 'review', 'pay'
                )
            );
    }
	public function actionNew(){
		if(isset($_POST['OfflineOrder'])){
            $startTime = strtotime('now');
            $orderModel = new OfflineOrder();
            $orderModel->attributes = $_POST['OfflineOrder'];
            if($orderModel->save()){
                foreach($_POST['OfflineOrderAttribute'] as $orderAttribute){
                    $orderAttributeModel = new OfflineOrderAttribute();
                    $orderAttribute['offline_order_id'] = $orderModel->id;
                    $orderAttributeModel->attributes = $orderAttribute;
                    $orderAttributeModel->save();
                }
                foreach($_POST['OfflineOrderReviewHistory'] as $orderReviewHistory){
                    $orderReviewHistory['user_id'] = $orderModel->user_id;
                    $orderReviewHistoryModel = new OfflineOrderReviewHistory();
                    $orderReviewHistory['offline_order_id'] = $orderModel->id;
                    $orderReviewHistoryModel->attributes = $orderReviewHistory;
                    $orderReviewHistoryModel->save();
                }
                Yii::log('Save visa order success, id'.$orderModel->id.'. Process time:'.((strtotime('now')-$startTime))." Seconds", 'info', 'portal');
                $this->redirect('list');
            }
		}
		$this->render('visa_form');
	}
    public function actionEdit($id){
        $result = OfflineOrder::model()->findByPk($id);
        if(empty($result))
            throw new CHttpException(404, '签证不存在');
        if(isset($_POST['OfflineOrder']['type'])){
            $result->attributes = $_POST['OfflineOrder'];
            if($result->save() && OfflineOrderAttribute::model()->deleteAllByAttributes(array('offline_order_id'=>$id)) && OfflineOrderReviewHistory::model()->deleteAllByAttributes(array('offline_order_id'=>$id))){
                foreach($_POST['OfflineOrderAttribute'] as $orderAttribute){
                    $orderAttributeModel = new OfflineOrderAttribute();
                    $orderAttribute['offline_order_id'] = $id;
                    $orderAttributeModel->attributes = $orderAttribute;
                    $orderAttributeModel->save();
                }
                foreach($_POST['OfflineOrderReviewHistory'] as $orderReviewHistory){
                    $orderReviewHistory['user_id'] = $result->user_id;
                    $orderReviewHistoryModel = new OfflineOrderReviewHistory();
                    $orderReviewHistory['offline_order_id'] = $id;
                    $orderReviewHistoryModel->attributes = $orderReviewHistory;
                    $orderReviewHistoryModel->save();
                }
                Yii::log('Edit & update visa order success, id:'.$id.' Seconds', 'info', 'portal');
                $this->redirect('list');
            }
        }else{
            $this->render('visa_form', array('result', $result));
        }
    }
    public function actionSearch($id){
       if(count(OfflineOrder::model()->findByPk($id)) == 0){
           throw new CHttpException(404, '签证不存在');
       }
       $this->redirect(array('view', 'id'=>$id));
    }
	public function actionList(){
        $result = OfflineOrder::getListByRole();
		$this->render('list', array('result' => $result));
	}
	public function actionView($id){
		if(!empty($id)){
            $result = OfflineOrder::model()->find('id = :id', array(':id'=>intval($id)));
			$this->render('view', array('result'=>$result));
		}
	}
    public function actionReview($id){
        if(isset($id) && Yii::app()->request->isAjaxRequest){
            $reviewData = $_POST['OfflineOrderReviewHistory'];
            $reviewData['offline_order_id'] = $id;
            $review = OfflineOrder::model()->execOperation($reviewData);
            if($review){
                echo "saved";
            }else{
                echo "save failed";
            }
        }else{
            $reviewData = $_POST['OfflineOrderReviewHistory'];
            $reviewData['offline_order_id'] = $id;
            $review = OfflineOrder::model()->execOperation($reviewData);
            if($review){
                echo "saved";
            }else{
                echo "save failed";
            }
        }
    }
    public function actionPay($id){
        if(!empty($id)){
            $result = OfflineOrder::setPaid($id);
            $message = array('error_code'=>1, 'message'=>'');
            if(!$result){
                $message['error_code'] = OfflineOrder::ERROR_EXECUTION_FAILED;
                $message['message'] = Yii::t('visa', 'Save order state failed.');
                Yii::log('Set paid failed. Request id:'.$id." And container information:".print_r($result, true), 'info', 'portal');
            }
            echo json_encode($message);
        }
    }
    public function actionClose($id){
        if(!empty($id)){
            $result = OfflineOrder::finishOrder($id);
            $message = array('error_code'=>1, 'message'=>'');
            if($result !== true){
                $message['error_code'] = $result;
                $message['message'] = Yii::t('visa', 'Close order failed.');
                Yii::log('Close order failed. Request id:'.$id." And container information:".print_r($result, true), 'info', 'portal');
            }
            echo json_encode($message);
        }
    }
}
?>