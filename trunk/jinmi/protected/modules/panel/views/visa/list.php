<?php
/**
 * Created by PhpStorm.
 * User: suley
 * Date: 1/21/14
 * Time: 2:05 AM
 */

?>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => VisaOrder::allLists(),
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
            'value'=> 'Address::getCountryName($data->country)'
        ),
        array(
            'name'=>'user_id',
            'header'=>'下单人',
            'value'=> 'User::getUserRealname($data->user_id)'
        ),
        array(
            'name'=>'is_pay',
            'header'=>'支付状态',
            'value'=> '($data->is_pay == 1) ? "是" : "否"'
        ),

        array(
            'name'=>'status',
            'header'=>'状态',
            'value'=> 'VisaOrder::translateStatus($data->status)'
        ),
        array(
            'name'=>'create_time',
            'header'=>'下单时间',
            'value'=> 'date("Y-m-d H:i", $data->create_time)'
        ),
        array(
            'name'=>'create_time',
            'header'=>'出签时间',
            'value'=> 'date("Y-m-d H:i", $data->create_time)'
        ),
        array(
            'class' => 'CButtonColumn',
            'header' => '操作',
            'deleteConfirmation' => '确定删除？',
        ),
    )
));
?>