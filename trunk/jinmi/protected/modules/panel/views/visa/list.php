<?php
/**
 * Created by PhpStorm.
 * User: suley
 * Date: 1/21/14
 * Time: 2:05 AM
 */

?>

<form class="navbar-form navbar-right" role="search" type="GET" action="<?php echo $this->createUrl('visa/list'); ?>">

    <div class="form-group">
        <?php echo CHtml::link('添加订单', $this->createUrl('visa/new'), array('class'=>'btn btn-success alink-btn')); ?>
        &nbsp;
        <?php echo CHtml::link('导出数据', $this->createUrl('visa/export'), array('class'=>'btn btn-info alink-btn', 'id'=>'export-button')); ?>
        <input type="text" name="customer_name" class="form-control" placeholder="输入客人姓名搜索">

        <button type="submit" class="btn btn-default">搜索</button>
    </div>
</form>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $model->search(),
    'filter'=> $model,
    'ajaxUpdate' => false,
    'afterAjaxUpdate' => 'reinstallDatePicker', // (#1)
    'pager' => array(
        'maxButtonCount' => '7',
        'pageSize' => 25,
    ),
    'enableHistory'=>true,
    'summaryText' => '显示第{start}条至{end}条记录|共{count}条记录',
    'template' => '{pager}{summary}{items}{pager}',
    'columns' => array(
        array(
            'class' => 'CCheckBoxColumn',
            'selectableRows' => 2,
            'value' => $model->id,
        ),
        array(
          'name'=>'id',
          'filterHtmlOptions'=>array('width'=>'70px'),
          'footer'=>'总计'
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
            'name'=>'is_pay_out',
            'header'=>'支出状态',
            'value'=> '($data->is_pay_out == 1) ? "已支" : (($data->is_pay_out == 2) ? "部分" : "未支")',
            'filter'=> array('0'=>'未支', '1'=>'已支', '2'=>'部分')
        ),

        array(
            'name'=>'status',
            'header'=>'状态',
            'value'=> 'VisaOrder::translateStatus($data->status)',
            'filter' => VisaOrder::$statusIntl
        ),
        array(
            'name'=>'amount',
            'filterHtmlOptions'=>array('width'=>'50px'),
            'footer'=>$model->getAmountTotals()
        ),
        array(
            'name'=>'price',
            'filterHtmlOptions'=>array('width'=>'70px'),
            'footer'=>$model->getTotals()
        ),
        array(
            'name'=>'source',
            'header'=>'订单来源',
            'value'=> '$data->order_source->name',
            'type'=>'raw',
            'filter'=> CHtml::listData(OrderSource::model()->findAll('type = '.OrderSource::TYPE_SOURCE), 'id', 'name')
        ),

        array(
            'name'=>'create_time',
            'header'=>'下单时间',
            'value'=> 'date("Y-m-d H:i", $data->create_time)',
            'filter'=> $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$model,
                    'attribute'=>'start_time',
                    'value' => $model->start_time,
                    'language' => 'zh-cn',
                    'htmlOptions' => array(
                        'id' => 'datepicker_for_create_time',
                        'size' => '10',
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
    )
));
// (#5)
Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
    $('#end_time').datepicker();
    $('#datepicker_for_create_time').datepicker();
}
");
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