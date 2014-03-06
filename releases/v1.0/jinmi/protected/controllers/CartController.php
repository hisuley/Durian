<?php

class CartController extends Controller{
	public function actionAdd(){
		if(isset($_POST['CartForm'])){
			$cart = new Cart();
			$cart->attributes = $_POST['CartForm'];
			$cart->user_id = Yii::app()->user->id;
			if($cart->save()){
				if(Yii::app()->request->isAjaxRequest){
					echo json_encode('saved');
				}else{
					throw new CHttpException(500, 'Server error occurs, could not save your cart item this time');
				}
			}
			
		}
		
	}
	public function actionRemove($id){
		$cart = new Cart();
		if($cart->deleteItem($id, Yii::app()->user->id)){
			if(Yii::app()->request->isAjaxRequest){
				echo json_encode('deleted');
			}else{
				throw new CHttpException(500, 'Server error occurs, could not delete your cart item this time');
			}
		}
	}
	public function actionCheckout(){
		$order = new Order();
		$order->checkout(Yii::app()->user->id);
	}
	public function actionChange(){
		
	}
}
?>