<?php

class VisaController extends CController{
	public function actionNew(){
		if(isset($_POST['OfflineOrder'])){
            $startTime = strtotime('now');
            $orderModel = new OfflineOrder();
            $orderModel->attributes = $_POST['OfflineOrder'];
            $orderModel->status = 'order_success';
            $orderModel->pay_status = 'paid';
            $orderModel->create_time = strtotime('now');
            if($orderModel->save()){
                foreach($_POST['OfflineOrderAttribute'] as $orderAttribute){
                    $orderAttributeModel = new OfflineOrderAttribute();
                    if(is_array($orderAttribute['value'])){
                        $orderAttribute['value'] = implode(',', $orderAttribute['value']);
                    }
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
                $this->redirect('list');
//                Yii::log('Save visa order, id'.$orderModel->id.'. Process time:'.((strtotime('now')-$startTime))." Seconds", 'info', 'portal');
            }
		}
		$this->render('visa_form');
	}
	public function actionList(){
        $result = OfflineOrder::model()->findAll();
		$this->render('list', array('result' => $result));
	}
	public function actionView($id = 0){
		if(!empty($id)){
            $result = OfflineOrder::model()->find('id = :id', array(':id'=>intval($id)));
			$this->render('view', array('result'=>$result));
		}
	}
    public function actionReview($id = 0){
        if(isset($id) && Yii::app()->request->isAjaxRequest){
            $review = new OfflineOrderReviewHistory();
            $review->offline_order_id = $id;
            $review->attributes = $_POST['OfflineOrderReviewHistory'];
            if($review->save()){
                echo "saved";
            }else{
                echo "save failed";
            }
        }
    }
}
?>