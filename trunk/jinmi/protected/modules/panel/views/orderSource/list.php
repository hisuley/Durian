<?php
echo CHtml::link('添加',$this->createUrl('orderSource/new'), array('class'=>'alink-btn', 'style'=>'margin-bottom:-30px;'));
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => OrderSource::allLists(),
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
        'name',
        'contact_name',
        'contact_phone',
        'contact_address',
        /*array(
            'name'=>'parent_id',
            'header'=>'上级',
            'type'=>'raw',
            'value'=> $model->parent->name
        ),*/
        array(
            'name'=>'is_enabled',
            'header'=>'启用',
            'type'=>'boolean'
        ),
        array(
            'class' => 'CButtonColumn',
            'header' => '操作',
            'viewButtonOptions'=>array('style'=>'display:none'),
            'deleteConfirmation' => '确定删除？',
        ),
    )
));

?>