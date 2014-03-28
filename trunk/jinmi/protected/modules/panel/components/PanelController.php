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
                'label'=>'签证<b class="caret"></b>',
                'url'=> array('visa/list'), 'items'=>array(
                    array('label'=>'订单列表', 'url'=>array('visa/list'), 'linkOptions'=>array('class'=>'')),
                    array('label'=>'下单', 'url'=>array('visa/new'), 'linkOptions'=>array('class'=>'')),
                    array('label'=>'订单统计', 'url'=>array('visa/stat'), 'linkOptions'=>array('class'=>''))
                ),
                'linkOptions' => array('class'=>'dropdown-toggle', 'data-toggle'=>"dropdown")
            ),
            array(
                'label'=>'国家<b class="caret"></b>',
                'url'=> array('address/list'), 'items'=>array(
                    array('label'=>'新增国家', 'url'=>array('address/new'), 'linkOptions'=>array('class'=>'')),
                    array('label'=>'国家列表', 'url'=>array('address/list'), 'linkOptions'=>array('class'=>''))
                ),
                'linkOptions' => array('class'=>'dropdown-toggle', 'data-toggle'=>"dropdown")
            ),
            array(
                'label'=>'来源<b class="caret"></b>',
                'url'=> array('orderSource/list'), 'items'=>array(
                array('label'=>'新增来源', 'url'=>array('orderSource/new'), 'linkOptions'=>array('class'=>'')),
                array('label'=>'来源列表', 'url'=>array('orderSource/list'), 'linkOptions'=>array('class'=>''))
                ),
                'linkOptions' => array('class'=>'dropdown-toggle', 'data-toggle'=>"dropdown")
            ),
            array(
                'label'=>'送签<b class="caret"></b>',
                'url'=> array('orderSource/list'), 'items'=>array(
                array('label'=>'新增送签旅行社', 'url'=>array('agency/new'), 'linkOptions'=>array('class'=>'')),
                array('label'=>'送签旅行社列表', 'url'=>array('agency/list'), 'linkOptions'=>array('class'=>''))
            ),
                'linkOptions' => array('class'=>'dropdown-toggle', 'data-toggle'=>"dropdown")
            )

        );
        $this->breadcrumbs = array(
            $this->label=>array($this->id."/list"),
            $this->getLabel($this->action->id)
        );
        return true;
    }
} 