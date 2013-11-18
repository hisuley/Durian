<?php
/**
 * Class VisaController
 * use to handle the visa related business.
 */
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
        }else{
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