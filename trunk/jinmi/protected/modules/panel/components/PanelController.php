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
        }elseif(!Yii::app()->user->isGuest){

            $isPanelAuthUser = false;
            $privileges = array(
                'operate'=> array('op_id','op_comment','op_time'),
                'finance'=> array('is_pay','accountant_id','pay_cert'),
                'sales'=> array('id','status','country','predict_date','type','amount','price','depart_date','source','contact_name','contact_phone','contact_address','memo','material','create_time','user_id', 'customer'),
                'admin'=>array('id','status','country','predict_date','type','amount','price','depart_date','source','contact_name','contact_phone','contact_address','memo','material','is_pay','create_time','user_id','accountant_id','pay_cert','op_id','op_comment','op_time','sent_id','sent_comment','sent_time','issue_id','issue_comment','issue_time','back_id','back_comment','back_time', 'customer','sent_agency_source'),
                'owner'=> array('id','status','country','predict_date','type','amount','price','depart_date','source','contact_name','contact_phone','contact_address','memo','material','create_time','user_id', 'customer','sent_agency_source'),
                'courier_sent'=> array('sent_id','sent_comment','sent_time'),
                'courier_issue'=> array('issue_id','issue_comment','issue_time'),
                'courier_back'=> array('back_id','back_comment','back_time'),
                'purchase'=>array('purchase')
            );
            if(!empty(Yii::app()->user->role)){
                $roles = explode(',',Yii::app()->user->role);
                foreach($roles as $role){
                    if(array_key_exists($role, $privileges)){
                        $isPanelAuthUser = true;
                    }
                }
            }
            if(!$isPanelAuthUser){
                Yii::app()->user->logout();
                $this->redirect(array('default/login'));
            }

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
            ),
            array(
                'label'=>'宇通<b class="caret"></b>',
                'url'=> array('yutong/visaList'), 'items'=>array(
                array('label'=>'新增签证', 'url'=>array('yutong/newVisa'), 'linkOptions'=>array('class'=>'')),
                array('label'=>'签证列表', 'url'=>array('yutong/visaList'), 'linkOptions'=>array('class'=>'')),
                array('label'=>'订单列表', 'url'=>array('yutong/orderList'), 'linkOptions'=>array('class'=>''))
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