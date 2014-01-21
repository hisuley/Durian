<?php
/**
 * Created by PhpStorm.
 * User: suley
 * Date: 1/21/14
 * Time: 1:47 AM
 */

class PanelController extends CController{
    public $menu;
    public $subMenu;
    public $breadcrumbs;
    public function beforeAction(){
        /*if(Yii::app()->user->isGuest && $this->action->id != 'login'){
            $this->redirect(array('panel/default/login'));
        }*/
        $this->menu=array(
            array(
                'label'=>'签证',
                'url'=> 'panel/visa/list', 'items'=>array(
                    array('label'=>'订单列表', 'url'=>array('panel/visa/list')),
                    array('label'=>'下单', 'url'=>array('panel/visa/new')),
                    array('label'=>'订单统计', 'url'=>array('panel/visa/stats'))
                )
            )
        );
        $this->breadcrumbs = array(
            $this->id=>array('panel/'.$this->id),
            $this->action->id
        );
        return true;
    }
} 