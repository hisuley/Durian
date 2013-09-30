<?php

/**
 * Insurance Controller
 *
 * @author xstudio
 * @version 1.0
 * @date 09/08/13
 */
Yii::app()->setTheme('front');

class InsuranceController extends Controller
{

    /**
     * calculate quote by post insurance
     */
    public function actionGetQuote()
    {
        if(Yii::app()->request->isAjaxRequest)
        {
            $scope=array(
                'silver'=>'白银计划', 
                'gold'=>'黄金计划', 
                'diamond'=>'钻石计划'
            );
            $result=array();

            $insurance=new Insurance;

            foreach($scope as $key=>$value)
            {
                $info=array(array('age'=>18, 'time'=>$_GET['days'], 'scope'=>$value));
                $result[$key]=$insurance->calculateQuote($info);
            }

            echo json_encode($result);
        }
    }

    public function actionIndex()
    {
        $this->render('insurancelist');
    }

    public function actionDetail()
    {
        $this->render('insurancedetail');
    }
}
