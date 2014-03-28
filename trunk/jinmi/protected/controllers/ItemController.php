<?php
Yii::app()->setTheme('frontV1');
class ItemController extends Controller{
	public function actionIndex(){
		echo "You are at wrong page. Please return to your page and revisit agian";
	}
	public function actionView($id){
		$result = Item::model()->find('id = :item_id', array(':item_id'=>$id));
		switch($result->type){
			case 'activity':
				$this->render('activity', array('result'=>$result));
				break;
			case 'telecom':
				$this->render('telecom', array('result'=>$result));
				break;
			case 'insurance':
				$this->render('insurance', array('result'=>$result));	
				break;
			case 'visa':
				$this->render('visa', array('result'=>$result));
				break;
			default:
				break;
		}
	}
	
	//Activity List
	public function actionActivity(){
		$result = Item::model()->findAll();
		$this->render('activity_list', array('result'=>$result));
	}
	public function actionHotel(){
		$result = Item::model()->findAll();
		$this->render('hotel_list', array('result'=>$result));
	}
	public function actionVisa(){
		$result = Item::model()->findAll();
		$this->render('visa_list', array('result'=>$result));
	}
	public function actionInsurance(){
		$result = Item::model()->findAll();
		$this->render('insurance_list', array('result'=>$result));
	}
	public function actionTelecom(){
		$result = Item::model()->findAll();
		$this->render('telecom_list', array('result'=>$result));
	}
	public function actionCar(){
		$result = Item::model()->findAll();
		$this->render('car_list', array('result'=>$result));
	}

}

?>