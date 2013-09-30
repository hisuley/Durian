<?php

/**
 * Application Test Controller
 *
 * This class is used to test models implementation.
 *
 * PHP 5
 * 
 * Author: Suley[luzhang@jmlvyou.com]
 * Copyright 2012-2013, Kimi Tourism, Inc. (http://www.jmlvyou.com)
 * 
 */
class TestController extends Controller
{

	public $testParams = "I am the variable which will be passed to layout file.";
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	public function actionHertz(){
		$this->render('hertz');
	}

	/**
	 * This is the default 'test' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionTest()
	{
		// echo "this is the test instance for the test controller";
		//Yii::app()->setTheme('admin');
		//Yii::app()->params['menutree']= array(
		//	'top'=>'评论模块',
		//	);
        //$this->render('test');
        Yii::app()->setTheme('front');
		$this->render('test');
	}

	public function actionTestWidget(){
		$this->render('widget');
	}

	public function actionCurlTest(){
		//Test curl extensions
		$url = "http://gbs.gta-travel.com/fe/SearchHotels.jsp";
		$params = array();
		$output = Yii::app()->curl->setOptions(array(CURLOPT_COOKIE=>'JSESSIONID=6B47279DA3B4E4C4245CA78E28BA5A8A.01DJW; sessionSiteId=AOFAN; Hm_lvt_3d143f0a07b6487f65609d8411e5464f=1375064506,1375086114; Hm_lpvt_3d143f0a07b6487f65609d8411e5464f=1375086617'))->get($url, $params);
		var_dump($output);
    }
    public function actionHotelInfo()
    {
        $hotel=new Hotel();
		var_dump($hotel->getHotelInfo('TAI', 'MFM', 1));
		
    }
    public function actionHotel()
    {
        $hotel=new Hotel();
		
		print_r($hotel->hotelSearch(
			array(
				//目的地value前缀
				'destType'=>'C',
				//destType+destCode 组成目的地value
				'destCode'=>'MFM',
				//城市名
				'cityName'=>'Macau 澳门, 中国澳门',
				//入住日
				'arrival'=>'2013-08-07',
				//居住天数 自行计算
				'duration'=>'1',
				/*
				 * 房间代号组合：00 00 00 00 
				 * 最多每人订购四间房 00:占位符
				 */
				'rooms'=>'111620610810',
				//酒店位置 G2：机场
				'loc'=>' ',
				//成人数 ：房间数*每个房间人数
				'adults'=>6,
				//儿童数：根据床位类型
				'children'=>1,
				//每个儿童年龄相连接
				'ages'=>'03',
				//酒店名
				'hotelName'=>'',
				//酒店星级标准
				'star'=>'0',
				//酒店设施：根据checkbox数组选择键值进行组合
				'facilities'=>'1|'
			)
        ));	


        
    }
        public function actionJsonData()
        {
            echo json_encode('{name:afaffefas, age:sasdsad, sex:fsef}');
        }

}
