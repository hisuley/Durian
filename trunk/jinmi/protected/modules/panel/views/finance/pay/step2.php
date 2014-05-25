<?php
/**
 * @project: trunk
 * @file: step2.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-4-17
 * @time: 下午12:57
 * @version: 1.0
 */

?>
<h1>请款申请 <small>第二步：填写请款信息&确认订单</small>&nbsp;&nbsp;<a class='btn btn-primary' href="<?php echo $this->createUrl('finance/payRequest', array('step'=>'one')); ?>">重新选择</a></h1>

<form method="POST" enctype="multipart/form-data" action="<?php echo $this->createUrl('finance/payRequest', array('step'=>'three')); ?>">
    <div class="row">
        <div class="span2"></div>
        <div class="well span6">
            <ul>
                <li>
                    <label>订单总金额：</label>
                    <h2 style="color:red">￥<?php echo $info['price']; ?></h2>
                </li>
                <li>
                    <label for="">备注：</label>
                    <?php
                    echo CHtml::textArea('Finance[memo]');
                    ?>
                    <br />
                </li>
                <li>
                    <br />
                    <?php

                    foreach($info['vid'] as $key=>$vid){
                        echo '<input type="hidden" name="FinanceItems['.$key.'][vid]" value="'.$vid.'">';
                    }
                    $this->widget('bootstrap.widgets.TbButton', array(
                        'buttonType'=>'submit','type'=>'primary',
                        'label'=>'生成请款申请'
                    ));
                    ?>
                </li>
            </ul>
        </div>
    </div>
</form>
<h2>您已经选择的订单</h2>

<?php

$orderWidgets = $this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider'=>$orderData,
    'summaryText' => '显示第{start}条至{end}条记录|共{count}条记录',
    'template' => '{pager}{summary}{items}{pager}',
    'columns'=>array(
        array(
            'name'=>'id',
            'filterHtmlOptions'=>array('width'=>'60px'),
            'type'=>'raw',
            'value'=>'CHtml::link($data->id, array("visa/update", "id"=>$data->id))',
            'htmlOptions'=>array('style'=>'width:60px;')
        ),
        array(
            'name'=>'country',
            'header'=>'国家',
            'value'=> 'Address::getCountryName($data->country)',
        ),
        array(
            'name'=>'source',
            'header'=>'收款方',
            'value'=> 'OrderSource::getMultipleSource($data)',
            'type'=>'raw',
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
            'filter'=> '',
            'value'=>'VisaOrder::sumCustomerVal($data->customer)'
        ),
        array(
            'name'=>'user_id',
            'header'=>'下单人',
            'value'=> 'User::getUserRealname($data->user_id)',
        )
    )
), true);

$customerWidget = $this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider'=>$customerData,
    'summaryText' => '显示第{start}条至{end}条记录|共{count}条记录',
    'template' => '{pager}{summary}{items}{pager}',
    'columns'=>array(
        array(
            'name'=>'visa_order_id',
            'header'=>'订单ID',
            'value'=>'CHtml::link($data->visa_order_id, array("visa/update", "id"=>$data->visa_order_id))',
            'type'=>'raw',
            'filterHtmlOptions'=>array('width'=>'60px'),
            'htmlOptions'=>array('style'=>'width:60px;')
        ),
        array(
            'name'=>'id',
            'filterHtmlOptions'=>array('width'=>'60px'),
        ),
        array(
            'name'=>'name',
            'header'=>'姓名',
        ),
        array(
            'name'=>'passport',
            'header'=>'护照号',
        ),
        array(
            'name'=>'agencyType.agency.name',
            'header'=>'送签渠道',
            'type'=>'raw',
        ),
        array(
            'name'=>'cost_price',
            'header'=>'价格',
            'filter'=> ''
        ),
        array(
            'name'=>'order.user_id',
            'header'=>'下单人',
            'value'=> 'User::getUserRealname($data->order->user_id)',
        )
    )
), true);

$comboWidget = $this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider'=>$orderData,
    'summaryText' => '显示第{start}条至{end}条记录|共{count}条记录',
    'template' => '{pager}{summary}{items}{pager}',
    'columns'=>array(
        array(
            'name'=>'id',
            'filterHtmlOptions'=>array('width'=>'60px'),
            'type'=>'raw',
            'value'=>'CHtml::link($data->id, array("visa/update", "id"=>$data->id))',
            'htmlOptions'=>array('style'=>'width:60px;')
        ),
        array(
            'name'=>'country',
            'header'=>'国家',
            'value'=> 'Address::getCountryName($data->country)',
        ),
        array(
            'name'=>'source',
            'header'=>'订单来源',
            'value'=> 'empty($data->order_source->name) ? "无":$data->order_source->name',
            'type'=>'raw',
        ),
        array(
            'name'=>'customer_agency_id',
            'header'=>'送签渠道',
            'value'=>'OrderSource::getMultipleSource($data)',
            'type'=>'raw',
            'filter'=> CHtml::listData(OrderSource::model()->findAllByAttributes(array('type'=>OrderSource::TYPE_AGENCY)),'id', 'name')
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
            'name'=>'customer',
            'header'=>'客户',
            'value'=>'VisaOrder::joinCustomer($data->customer)',
            'filter'=> '',
            'type'=>'raw'
        ),
        array(
            'name'=>'total_price',
            'header'=>'总价',
            'filter'=> '',
            'value'=>'VisaOrder::sumCustomerVal($data->customer)'
        ),
        array(
            'name'=>'user_id',
            'header'=>'下单人',
            'value'=> 'User::getUserRealname($data->user_id)',
        )
    )
), true);


$this->widget('bootstrap.widgets.TbTabs', array(
    'type'=>'tabs',
    'placement'=>'above', // 'above', 'right', 'below' or 'left'
    'tabs'=>array(
        array('label'=>'显示订单', 'content'=>$orderWidgets, 'active'=>true),
        array('label'=>'显示客户', 'content'=>$customerWidget),
        array('label'=>'混合显示', 'content'=>$comboWidget),
    ),
));



?>

<style>
    div.well ul li{
        list-style-type: none;
        font-size: 14px;
        color: blue;
        text-align: center;
    }
</style>

