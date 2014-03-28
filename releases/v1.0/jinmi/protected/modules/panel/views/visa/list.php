<?php
/**
 * Created by PhpStorm.
 * User: suley
 * Date: 1/21/14
 * Time: 2:05 AM
 */

?>
<?php echo CHtml::link('添加订单', $this->createUrl('visa/new'), array('class'=>'alink-btn', 'style'=>'margin-bottom:-30px;')); ?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $model->search(),
    'filter'=> $model,
    'ajaxUpdate' => true,
    'afterAjaxUpdate' => 'reinstallDatePicker', // (#1)
    'pager' => array(
        'maxButtonCount' => '7',
    ),
    'summaryText' => '显示第{start}条至{end}条记录|共{count}条记录',
    'template' => '{pager}{summary}{items}{pager}',
    'columns' => array(
        array(
            'class' => 'CCheckBoxColumn',
            'selectableRows' => 2,
            'value' => $model->id,
        ),
        'id',

        array(
            'name'=>'country',
            'header'=>'国家',
            'value'=> 'Address::getCountryName($data->country)',
            'filter'=> Address::model()->findCountry()
        ),
        array(
            'name'=>'type',
            'header'=>'类型',
            'value'=> 'VisaType::getTypeName($data->type)',
            'filter'=> ''
        ),
        array(
            'name'=>'user_id',
            'header'=>'下单人',
            'value'=> 'User::getUserRealname($data->user_id)',
            'filter'=> CHtml::listData(User::model()->findAll(), 'id', 'realname')
        ),
        array(
            'name'=>'is_pay',
            'header'=>'支付状态',
            'value'=> '($data->is_pay == 1) ? "是" : "否"',
            'filter'=> array('0'=>'否', '1'=>'是')
        ),


        array(
            'name'=>'status',
            'header'=>'状态',
            'value'=> 'VisaOrder::translateStatus($data->status)',
            'filter' => VisaOrder::$statusIntl
        ),
        array(
            'name'=>'customer',
            'header'=>'客户',
            'value'=> 'VisaOrder::joinCustomer($data->customer)',
            'type'=>'raw',
            'filter'=> ''
        ),
        array(
            'name'=>'depart_date',
            'header'=>'出发时间',
            'value'=> function($model){
                    if(is_numeric($model->depart_date)){
                        return date('Y-m-d', $model->depart_date);
                    }else{
                        return $model->depart_date;
                    }
            },
            'filter'=> $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$model,
                    'attribute'=>'depart_date',
                    'language' => 'zh-cn',
                    'htmlOptions' => array(
                        'id' => 'datepicker_for_depart_date',
                        'size' => '10',
                    ),
                    'defaultOptions' => array(  // (#3)
                        'showOn' => 'focus',
                        'dateFormat' => 'yy-mm-dd',
                        'showOtherMonths' => true,
                        'selectOtherMonths' => true,
                        'changeMonth' => true,
                        'changeYear' => true,
                        'showButtonPanel' => true,
                    )
                ), true), // (#4)
        ),
        array(
            'name'=>'create_time',
            'header'=>'下单时间',
            'value'=> 'date("Y-m-d H:i", $data->create_time)',
            'filter'=> $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$model,
                    'attribute'=>'create_time',
                    'language' => 'zh-cn',
                    'htmlOptions' => array(
                        'id' => 'datepicker_for_create_time',
                        'size' => '10',
                    ),
                    'defaultOptions' => array(  // (#3)
                        'showOn' => 'focus',
                        'dateFormat' => 'yy-mm-dd',
                        'showOtherMonths' => true,
                        'selectOtherMonths' => true,
                        'changeMonth' => true,
                        'changeYear' => true,
                        'showButtonPanel' => true,
                    )
                ), true), // (#4)
        ),
        /*array(
            'name'=>'issue_time',
            'header'=>'出签时间',
            'value'=> 'empty($data->issue_time) ? "未出签" : date("Y-m-d H:i", $data->issue_time)',
            'filter'=> $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    //'value'=>date('Y-m-d', $model->issue_time),
                    'model'=>$model,
                    'attribute'=>'issue_time',
                    'language' => 'zh-cn',
                    'htmlOptions' => array(
                        'id' => 'datepicker_for_issue_time',
                        'size' => '10',
                    ),
                    'defaultOptions' => array(  // (#3)
                        'showAnim' => 'fold',
                        'dateFormat' => 'yy-mm-dd',
                        'showOtherMonths' => true,
                        'selectOtherMonths' => true,
                        'changeMonth' => true,
                        'changeYear' => true,
                        'showButtonPanel' => true,
                    )
                ), true), // (#4)
        ),*/
        array(
            'name'=>'create_time',
            'header'=>'剩余出发时间',
            'value'=> function($model){
                    //return $model->create_time;
                    return round((strtotime($model->depart_date) - strtotime('now'))/86400);
            },
            'filter' => false
        ),
        array(
            'class' => 'CButtonColumn',
            'header' => '操作',
            'deleteConfirmation' => '确定删除？',
        ),
    )
));
// (#5)
Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
    $('#datepicker_for_issue_time').datepicker();
    $('#datepicker_for_depart_date').datepicker();
    $('#datepicker_for_create_time').datepicker();
}
");
?>