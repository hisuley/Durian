<?php
/**
 * Created by Suley.
 * @author: suley<dearsuley@gmail.com>
 * @date: 1/21/14
 * @time: 4:09 PM
 */

$this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'id',
        array(
            'name'=>'user_id',
            'label'=>'下单人',
            'type'=>'raw',
            'value'=> User::getUserRealname($model->user_id)
        ),
        array(
            'name'=>'status',
            'label'=>'状态',
            'type'=>'raw',
            'value'=> VisaOrder::translateStatus($model->status)
        ),
        array(
            'name'=>'country',
            'label'=>'国家',
            'type'=>'raw',
            'value'=> Address::getCountryName($model->country)
        ),
        array(
            'name'=>'price',
            'label'=>'价格',
            'type'=>'raw'
        ),
        array(
            'name'=>'is_pay',
            'label'=>'支付状态',
            'type'=>'boolean'
        ),
        array(
            'name'=>'predict_date',
            'label'=>'预计出签',
            'type'=>'raw',
            'value'=>date('Y-m-d', strtotime(date('Y-m-d', $model->create_time)." +".$model->predict_date." days"))
        ),
        array(
            'name'=>'type',
            'label'=>'类型',
            'type'=>'raw'
        ),
        array(
            'name'=>'amount',
            'label'=>'人数',
            'type'=>'number'
        ),
        array(
            'name'=>'depart_date',
            'label'=>'出发时间',
            'type'=>'date'
        ),
        array(
            'name'=>'source',
            'label'=>'来源',
            'type'=>'raw'
        ),
        array(
            'name'=>'customer',
            'label'=>'客户',
            'type'=>'raw',
            'value'=> implode('\n', array_map(function($v){
                       return "姓名：".$v->name."  护照号：".$v->passport;
                }, $model->customer))
        ),
        array(
            'name'=>'contact_name',
            'label'=>'联系人姓名',
            'type'=>'raw'
        ),
        array(
            'name'=>'contact_phone',
            'label'=>'联系人电话',
            'type'=>'raw'
        ),
        array(
            'name'=>'contact_address',
            'label'=>'联系人地址',
            'type'=>'raw'
        ),
        array(
            'name'=>'memo',
            'label'=>'备注',
            'type'=>'raw'
        ),
        array(
            'name'=>'material',
            'label'=>'材料清单',
            'type'=>'raw',
            'value'=>implode(' ', array_map(function($material){
                return "<span class='ok'>".VisaOrder::translateMaterial($material)."</span>";
            }, $model->material))
        ),
    ),
));