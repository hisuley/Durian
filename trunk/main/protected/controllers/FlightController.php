<?php

/**
 * Flight controller
 *
 * @author xstudio
 * @version 1.0
 * @date 09/10/13
 */
class FlightController extends Controller
{

    /**
     *
     */
    public function actionIndex()
    {
        $flight=new CtripTicket;

        $result=$flight->intlFilghtSearch(array(
            'TripType'=>'RT',   //RT OW
            'PassengerType'=>'ADT',
            'PassengerCount'=>1,
            'Eligibility'=>'ALL',
            'BusinessType'=>'OWN',
            'ClassGrade'=>'Y',
            'SalesType'=>'Online',
            'FareType'=>'All',
            'ResultMode'=>'All',
            'OrderBy'=>'Price',
            'Direction'=>'Asc',
            'SegmentInfos'=>array(
                array(
                    'DCode'=>'SHA',
                    'ACode'=>'HKG',
                    'DDate'=>'2013-09-11T00:00:00',
                    'TimePeriod'=>'All'
                ),
                array(
                    'DCode'=>'HKG',
                    'ACode'=>'SHA',
                    'DDate'=>'2013-09-12T00:00:00',
                    'TimePeriod'=>'All'
                )
            )
        ));

        print_r($result);
    }
}
