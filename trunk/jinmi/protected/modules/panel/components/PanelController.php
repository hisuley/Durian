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
        if(Yii::app()->user->isGuest && $this->action->id != 'login'){
            $this->redirect(array('default/login'));
        }
        $this->menu=array(
            array(
                'label'=>'签证',
                'url'=> array('visa/list'), 'items'=>array(
                    array('label'=>'订单列表', 'url'=>array('visa/list')),
                    array('label'=>'下单', 'url'=>array('visa/new')),
                    array('label'=>'订单统计', 'url'=>array('visa/stat'))
                )
            )
        );
        $this->breadcrumbs = array(
            $this->label=>array($this->id."/list"),
            $this->getLabel($this->action->id)
        );
        return true;
    }
} 