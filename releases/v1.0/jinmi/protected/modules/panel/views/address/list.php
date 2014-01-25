<?php
echo CHtml::link('添加',$this->createUrl('address/new'), array('class'=>'alink-btn', 'style'=>'margin-bottom:-30px;'));
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => Address::allLists(),
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
            'name'=>'name',
            'header'=>'名字',
            'value'=>$model->name
        ),
        array(
            'name'=>'parent_id',
            'header'=>'上级',
            'type'=>'raw',
            'value'=> 'Address::getCountryName($data->parent_id)'

        ),
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
