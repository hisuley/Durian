<?php

/**
 * Tiger Visa controller 
 *
 * @author xstudio
 * @version 1.0
 * @date 09/08/13
 */

Yii::app()->setTheme('front');

class TigerController extends Controller
{

    /**
    * get all conutry list 
    */
    public function actionCityList()
    {
        $tiger=new TigerVisa;
        $continent=$tiger->getContinentList();
        $result=array();

        for($i=0; $i<$continent['count']; $i++)
        {
            $cityList=$tiger->getCountryListByContinentID($continent['continent_id_'.$i]);

            $result[$continent['continent_name_'.$i]]=array();

            for($j=0; $j<$cityList['count']; $j++)
            {
                array_push($result[$continent['continent_name_'.$i]], array(
                    'country_id'=>$cityList['country_id_'.$j],
                    'country_name'=>$cityList['country_name_'.$j]
                ));
            }
        }

        $china=$tiger->getVisaListByParams(array('country_id'=>131));
        $mlxy=$tiger->getVisaListByParams(array('country_id'=>41));

        $hot=array(
            array('country_name'=>'中国', 'country_id'=>131, 'count'=>$china['count']),
            array('country_name'=>'马来西亚', 'country_id'=>41, 'count'=>$mlxy['count']),
        );

       $this->render('visalist', array('visa'=>$result, 'hot'=>$hot));
    }

    /**
     * Get single city tiger info by $_GET['id']
     */
    public function actionCityVisa()
    {
        if(isset($_GET['id']))
        {
            $tiger=new TigerVisa;
            $visaInfo=$tiger->getVisaListByParams(array('country_id'=>$_GET['id']));
            $result=array();

            for($i=0; $i<$visaInfo['count']; $i++)
            {
                array_push($result, array(
                    'visa_id'=>$visaInfo['visa_id_'.$i],
                    'visa_name'=>$visaInfo['country_name_0'].$visaInfo['visa_type_'.$i],
                    'consular_district'=>$visaInfo['consular_district_'.$i],
                    'expiry_date'=>$visaInfo['expiry_date_'.$i],
                    'visa_week_day'=>$visaInfo['visa_week_day_'.$i],
                    'retentionperiod'=>$visaInfo['retentionperiod_'.$i],
                    'market_price'=>$visaInfo['market_price_'.$i]
                ));    
            }

            $this->render('visachose', array('visa'=>$result));
        }

    }

    /**
     * Get single visa info by $_GET['id']
     */
    public function actionVisaInfo()
    {
        if(isset($_GET['id']))
        {
            $tiger=new TigerVisa;
            $this->render('visadetail', array('detail'=>$tiger->getVisaByVisaID($_GET['id'])));

        }
    }
}
