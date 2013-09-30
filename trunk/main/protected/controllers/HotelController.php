<?php

/**
 * Hotel controller
 *
 * @author xstudio
 * @date 09/10/13
 * @version 1.0
 */
Yii::app()->setTheme('front');
class HotelController extends Controller
{
    
    /**
     *
     */
    public function actionIndex()
    {
        $list=array();

        if(!empty($_POST))
        {
            $hotel=new Hotel;
            $list=$hotel->hotelSearch(array(
                'adults'=>$_POST['adults'], //2
                'arrival'=>$_POST['arrival'],   //2013-09-11
                'destCode'=>$_POST['destCode'], //PEK
                'destType'=>$_POST['destType'], //C
                'duration'=>$_POST['duration'], //2
                'rooms'=>$_POST['rooms'],  //610000000 010000000
            ));

            /*$list=$hotel->hotelSearch(array(
                'adults'=>2, //2
                'arrival'=>'2013-09-23',   //2013-09-11
                'destCode'=>'PEK', //PEK
                'destType'=>'C', //C
                'duration'=>2, //2
                'rooms'=>'61000000',  //610000000 010000000
            ));*/
            
        }

        $this->render('hotellist', array('hotel'=>$list));
    }

    public function actionInfo()
    {
        if(!empty($_GET))
        {
            $hotel=new Hotel;
            echo '<pre>';
            print_r($hotel->getHotelInfo($_GET['item'], $_GET['city'], $_GET['row']));

        }
    }
}
