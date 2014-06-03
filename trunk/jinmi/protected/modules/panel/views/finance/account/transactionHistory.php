<?php
/**
 * @project: trunk
 * @file: transactionHistory.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-5-6
 * @time: 下午5:29
 * @version: 1.0
 */

$this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$dataProvider,
    'filter'=>$model,
    'template'=>"{pager}{items}{pager}",
    'columns'=>array(
        array('name'=>'id', 'header'=>'#','filter'=>''),
        array('name'=>'create_time', 'value'=>'date("Y-m-d H:i:s", $data->create_time)', 'filter'=>''),
        array('name'=>'account.name', 'header'=>'账号', 'filter'=>CHtml::listData(PanelBankAccount::model()->findAll(), 'id', 'name')),
        array('name'=>'account_id', 'header'=>'收入', 'value'=>'(($data->direction == PanelBankAccountHistory::DIRECTION_POSITIVE) ? $data->value : 0)', 'filter'=>''),
        array('name'=>'target_id', 'header'=>'支出', 'value'=>'(($data->direction == PanelBankAccountHistory::DIRECTION_NEGATIVE) ? $data->value : 0)', 'filter'=>''),
        array('name'=>'value', 'filter'=>''),
        array('name'=>'balance', 'filter'=>''),
        array('name'=>'memo', 'filter'=>''),
    ),
)); ?>