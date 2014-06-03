<?php
/**
 * @project: trunk
 * @file: step1.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-4-15
 * @time: 上午9:24
 * @version: 1.0
 */


?>
<h1>收款申请 <small>第一步：选择订单</small></h1>
<div class="row">
    <div class="span9" style="margin-left:0px;">
        <br />
        <h2>选择订单<small>通过条件筛选您要付款的订单，勾选左侧，点击添加按钮，即可添加到“已选择订单”内。</small></h2>
<?php
$orderModel->is_pay = 0;
$orderModel->notInList = CHtml::listData(Finance::model()->findAll('status != "'.Finance::STATUS_DISCARD.'"'), 'id', 'id');
$data = $orderModel->search();

$this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider'=>$data,
    'filter' => $orderModel,
    'ajaxUpdate' => true,
    'afterAjaxUpdate'=>'reinstallDatePicker',
    'summaryText' => '显示第{start}条至{end}条记录|共{count}条记录',
    'template' => '{pager}{summary}{items}{pager}',
    'columns'=>array(
        array(
            'class'=>'CCheckBoxColumn',
            'selectableRows'=> 2,
            'value' => $orderModel->id
        ),
        array(
            'name'=>'id',
            'filterHtmlOptions'=>array('width'=>'60px'),
            'footer'=>'总计'
        ),
        array(
            'name'=>'country',
            'header'=>'国家',
            'value'=> 'Address::getCountryName($data->country)',
            'filter'=> Address::model()->findCountry(),
            'footer'=>$orderModel->getAmountTotals()
        ),
        array(
            'name'=>'source',
            'header'=>'订单来源',
            'value'=> 'empty($data->order_source->name) ? "无":$data->order_source->name',
            'type'=>'raw',
            'filter'=> CHtml::listData(OrderSource::model()->findAll('type = '.OrderSource::TYPE_SOURCE), 'id', 'name')
        ),
        array(
            'name'=>'type',
            'header'=>'类型',
            'value'=> 'VisaType::getTypeName($data->type)',
            'filter'=> ''
        ),
        array(
            'name'=>'amount',
            'header'=>'人数',
            'filter'=> ''
        ),
        array(
            'name'=>'total_price',
            'header'=>'总价',
            'filter'=> ''
        ),
        array(
            'name'=>'user_id',
            'header'=>'下单人',
            'value'=> 'User::getUserRealname($data->user_id)',
            'filter'=> CHtml::listData(User::model()->findAll('role != "merchant"'), 'id', 'realname')
        ),

        array(
            'name'=>'create_time',
            'header'=>'下单时间',
            'value'=> 'date("Y-m-d H:i", $data->create_time)',
            'filter'=> $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$orderModel,
                    'attribute'=>'start_time',
                    'value' => $orderModel->start_time,
                    'language' => 'zh-cn',
                    'htmlOptions' => array(
                        'id' => 'datepicker_for_create_time',
                        'style'=>'height:20px;width:130px',
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
                ), true).'<br /> To <br />' . $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$orderModel,
                    'attribute'=>'end_time',
                    'name' => 'end_time',
                    'language' => 'zh-cn',
                    'value' => $orderModel->end_time,
                    // additional javascript options for the date picker plugin
                    'options'=>array(
                        'showOn' => 'focus',
                        'showAnim'=>'fold',
                        'dateFormat'=>'yy-mm-dd',
                        'changeMonth' => 'true',
                        'changeYear'=>'true',
                        'constrainInput' => 'false',
                    ),
                    'htmlOptions'=>array(
                        'style'=>'height:20px;width:130px',
                    ),
// DONT FORGET TO ADD TRUE this will create the datepicker return as string
                ),true),
        ),
    )
));
echo '<div class="clearfix"></div><br />';
$this->widget('bootstrap.widgets.TbButton', array('type'=>'success', 'label'=>'添加选中订单', 'htmlOptions'=>array('onclick'=>'addNewRecord()')));

// (#5)
Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
    $('#end_time').datepicker();
    $('#datepicker_for_create_time').datepicker();
}
");
?>
     <div class="clearfix"></div>
        <br />
        <h2>已选择订单<small>点击订单右侧删除按钮可删除订单</small></h2>
        <div id="selected" class="grid-view">
           <table class="items table">
                <thead>
                <tr>
                    <th>Id</th><th>国家</th><th>类型</th><th>人数</th><th>总价</th><th>下单人</th><th>下单时间</th><th>操作</th></tr>
                </thead>
                <tfoot>
                <tr>
                    <td>总计</td><td>1</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <div class="span3">
        <form method="post" action="<?php echo $this->createUrl('finance/collectionRequest', array('step'=>'two')); ?>">
        <div class="well" data-spy="affix" data-offset-top="40" style="width:220px;margin-left:10px;">
            <h3>概览</h3>
            <span class="label label-default">收款人</span>&nbsp;<?php
                echo User::getUserRealname(Yii::app()->user->id);
            ?>
            <br />
            <span class="label label-danger">总金额</span> ￥<span id="total-money">0.00</span>
            <br />
            <span class="label label-info">客户数</span> <span id="total-amount">0</span>人
            <br />
            <span class="label label-primary">订单统计</span> <span id="total-order">0</span>订单
            <div class="clearfix"></div>
            <br />
            <input id="hiddenOrderIds" type="hidden" name="FinanceItems[ids]"/>
            <?php
            $this->widget('bootstrap.widgets.TbButton', array('type'=>'primary', 'label'=>'下一步，确认申请', 'buttonType'=>'submit'));
            ?>
        </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    var orderInfo = new Array();
    orderInfo['price'] = 0.00;
    orderInfo['order'] = 0;
    orderInfo['amount'] = 0;
    var addedRecords = new Array();
    var addedRecordsComplex = new Array();
    function addNewRecord(){
        $('div#yw0 table tbody tr').each(function(){
           if($(this).find('input[type="checkbox"]').prop('checked')){
                var keyVal = parseInt($(this).children('td').eq(1).text());
                if(addedRecords[keyVal] == undefined || addedRecords[keyVal]['key'] == undefined){
                    addedRecords[keyVal] = new Array();
                    addedRecords[keyVal]['key'] = keyVal;
                    addedRecords[keyVal]['price'] = 0.00;
                    addedRecords[keyVal]['amount'] = 0;
                    addedRecords[keyVal]['price'] = parseFloat($(this).children('td').eq(6).text());
                    addedRecords[keyVal]['amount'] = parseInt($(this).children('td').eq(5).text());
                    addedRecords[keyVal]['html'] = $(this).clone();
                    addedRecords[keyVal]['html'].children('td').eq(3).remove();
                    addedRecords[keyVal]['html'].find('.checkbox-column').remove();
                    addedRecords[keyVal]['html'].append('<td><a class="delete" rel="tooltip" href="#" data-original-title="Delete"><i class="icon-trash"></i></a></td>');
                    addedRecords[keyVal]['html'].attr('id', keyVal);
                    $('div#selected table tbody').append(addedRecords[keyVal]['html']);
                    orderInfo['amount'] += addedRecords[keyVal]['amount'];
                    orderInfo['order'] ++;
                    orderInfo['price'] = addedRecords[keyVal]['price'] + orderInfo['price'];
                }
            }
            $('div#selected table tfoot tr').children('td').eq(1).text(orderInfo['order']);
            $('#total-order').text(orderInfo['order']);
            $('#total-amount').text(orderInfo['amount']);
            $('#total-money').text(orderInfo['price']);
            updateIds();
        });
        return false;
    }

    function updateIds(){
        var idStr = new Array();
        for(var i in addedRecords){
            if(addedRecords[i] != undefined && addedRecords[i]['key'] != undefined){
                if(parseInt(addedRecords[i]['key']) > 0){
                    idStr.push(addedRecords[i]['key']);
                }

            }
        }
        $('#hiddenOrderIds').val(idStr.join(','));
        return true;
    }

    $('document').ready(function(){
       $('div#selected').delegate('a.delete', 'click', function(){
          var parentId = $(this).parent().parent().prop('id');
           orderInfo['amount'] = orderInfo['amount'] - addedRecords[parentId]['amount'];
           orderInfo['order'] = orderInfo['order'] - 1;
           orderInfo['price'] = orderInfo['price'] - addedRecords[parentId]['price'];
           addedRecords[parentId] = new Array();
           $('div#selected table tfoot tr').children('td').eq(1).text(orderInfo['order']);
           $('#total-order').text(orderInfo['order']);
           $('#total-amount').text(orderInfo['amount']);
           $('#total-money').text(orderInfo['price']);
           $(this).parent().parent().remove();
           updateIds();
           return false;
       });
        $('form').submit(function(){
            var hiddenVals = $('#hiddenOrderIds').val();
            if(hiddenVals.length <= 0){
                alert("请至少选择一个订单！");
                return false;
            }
        });
    });
</script>
<style>
    div.pagination{float:left;margin:0px;}
    div.summary{float:right;margin:0px;}
    th#yw0_c1{width:90px;}
    .row{margin:0px;}
</style>