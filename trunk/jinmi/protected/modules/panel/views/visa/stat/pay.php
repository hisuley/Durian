<?php
/**
 * @project: trunk
 * @file: collection.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-5-14
 * @time: 上午1:03
 * @version: 1.0
 */




?>


<form class="navbar-form navbar-right" role="search" type="GET" action="<?php echo $this->createUrl('visa/list'); ?>">

    <div class="form-group">
        <?php echo CHtml::link('导出数据', $this->createUrl('visa/export'), array('class'=>'btn btn-info alink-btn', 'id'=>'export-button')); ?>
    </div>
</form>
<?php
if(empty($model->start_time)){
    $model->start_time = date("Y-m-d", strtotime("now -1 weeks"));

}
if(empty($model->end_time)){
    $model->end_time =  date("Y-m-d", strtotime("now"));
}

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $model->search(),
    'filter'=> $model,
    'ajaxUpdate' => false,
    'pager' => array(
        'maxButtonCount' => '7',
        'pageSize' => 25,
    ),
    'enableHistory'=>true,
    'summaryText' => '显示第{start}条至{end}条记录|共{count}条记录',
    'template' => '{pager}{summary}{items}{pager}',
    'columns' => array(
        array(
            'name'=>'create_time',
            'header'=>'日期',
            'value'=> 'date("Y-m-d H:i", $data->create_time)',
            'filter'=> $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$model,
                    'attribute'=>'start_time',
                    'value' => $model->start_time,
                    'language' => 'zh-cn',
                    'htmlOptions' => array(
                        'id' => 'datepicker_for_create_time',
                        'size' => '10',
                        'style'=>'height:20px;width:130px',
                    ),
                    'defaultOptions' => array(  // (#3)
                        'showOn' => 'focus',
                        'dateFormat' => 'yy-mm-dd',
                        'showOptions'=>array('direction'=>'down'),
                        "direction"=>"down",
                        'showOtherMonths' => true,
                        'selectOtherMonths' => true,
                        'changeMonth' => true,
                        'changeYear' => true,
                        'showButtonPanel' => true,
                    ),
                    'options'=>array(
                        "direction"=>"up",
                        'showOptions'=>array('direction'=>'up'),
                    )
                ), true). '<br> To <br> ' . $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$model,
                    'attribute'=>'end_time',
                    'name' => 'end_time',
                    'language' => 'zh-cn',
                    'value' => $model->end_time,
                    // additional javascript options for the date picker plugin
                    'options'=>array(
                        'showOn' => 'focus',
                        'showAnim'=>'fold',
                        'dateFormat'=>'yy-mm-dd',
                        'changeMonth' => 'true',
                        'changeYear'=>'true',
                        'constrainInput' => 'false',
                        "direction"=>"down",
                        'showOptions'=>array('direction'=>'down'),
                    ),
                    'htmlOptions'=>array(
                        'style'=>'height:20px;width:130px',
                    ),
// DONT FORGET TO ADD TRUE this will create the datepicker return as string
                ),true),
        ),
        array(
            'name'=>'id',
            'header'=>'ID',
            'filterHtmlOptions'=>array('width'=>'60px', 'style'=>'padding-right:30px;'),
        ),

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
            'name'=>'financeRecord.record.charge_account.name',
            'header'=>'付款方式',
            'filter'=> CHtml::listData(OrderSourceBankAccount::model()->findAll(), 'id', 'name'),
            'value'=>'VisaOrder::getCustomerPayMethod($data->customer)',
            'type'=>'raw'
        ),

        array(
            'name'=>'status',
            'header'=>'状态',
            'value'=> 'VisaOrder::translateStatus($data->status)',
            'filter' => VisaOrder::$statusIntl
        ),

        array(
            'name'=>'customer_agency_id',
            'header'=>'送签渠道',
            'value'=>'OrderSource::getMultipleSource($data)',
            'type'=>'raw',
            'filter'=> CHtml::listData(OrderSource::model()->findAllByAttributes(array('type'=>OrderSource::TYPE_AGENCY)),'id', 'name')
        ),

        array(
            'name'=>'stat_cost_price',
            'header'=>'出账金额',
            'filterHtmlOptions'=>array('width'=>'70px'),
            'footer'=>$model->getPayTotals()
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
        /*
        array(
            'class' => 'CButtonColumn',
            'header' => '操作',
            'template'=> PanelUser::getListOp(),
            'viewButtonOptions'=> array(
                'target'=>'__blank'
            ),
            'updateButtonOptions'=> array(
                'target'=>'__blank',
            ),
            'deleteButtonOptions'=>array(
                'url'=>'Yii::app()->createUrl("panel/visa/delete", array("id"=>$model->id))',
                'visible'=>'$data->status != VisaOrder::STATUS_DELETE'
            ),
            'buttons'=>array(
                'delete'=>array(
                    'url'=>'Yii::app()->createUrl("panel/visa/delete", array("id"=>$data->id))'
                )
            ),
            'deleteConfirmation' => '您确定要删除该订单？'
        ),
        */
    )
));
// (#5)

?>
<script type="text/javascript">
    $('#export-button').on('click',function() {
        var url = $('div.keys').attr('title');
        url = url.replace('list','export');
        console.log(url);
        window.location = url;
        return false;
    });
</script>
<style>
    #page{width:1220px;}
    #ui-datepicker-div{z-index:99999999}
    .navbar-fixed-top, .navbar-fixed-bottom{z-index:1}
</style>