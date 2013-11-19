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
        Yii::log($id, 'info', 'portal');
        if(isset($id) && Yii::app()->request->isAjaxRequest){
            $review = OfflineOrderReviewHistory::model()->findByAttributes(array('type'=>$_POST['OfflineOrderReviewHistory']['type'], 'offline_order_id'=>$id));
            if(empty($review))
                $review = new OfflineOrderReviewHistory();
            $review->attributes = $_POST['OfflineOrderReviewHistory'];
            $review->user_id = 1;
            $review->offline_order_id = $id;
            if($review->type == 'visa_return' && $review->isNewRecord)
                $review->memo = "快递号：".$review->memo;
            if($review->type == OfflineOrderReviewHistory::TYPE_SEND_VISA && $review->isNewRecord)
                $review->memo = '已经送签，等待大使馆回复';
            if($review->type == OfflineOrderReviewHistory::TYPE_COMPLETE && $review->isNewRecord)
                $review->memo = '订单已经结束，谢谢使用';
            Yii::log('attributes:'.print_r($review->attributes, true), 'info', 'portal');
            if($review->save()){
                $type = $review->type;
                if($review->type == 'visa_result'){
                    $type = ($review->opinion == 'agree') ? OfflineOrder::STATUS_ACCEPT : OfflineOrder::STATUS_REJECT;
                }
                OfflineOrder::model()->updateByPk($id, array('status'=>$type));
                echo "saved";
            }else{
                echo "save failed";
            }
        }else{
            $review = OfflineOrderReviewHistory::model()->findByAttributes(array('type'=>$_POST['OfflineOrderReviewHistory']['type']));
            if(empty($review))
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