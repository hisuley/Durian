<?php
/**
 * @project: trunk
 * @file: accountList.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-5-6
 * @time: 下午5:51
 * @version: 1.0
 */

$this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'dataProvider'=>$dataProvider,
    'template'=>"{items}",
    'columns'=>array(
        array('name'=>'id', 'header'=>'#'),
        array('name'=>'name'),
        array('name'=>'card_holder'),
        array('name'=>'account_number'),
        array('name'=>'account_agency'),
        array('name'=>'memo'),
        array('name'=>'balance'),
        array('name'=>'init_money'),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'htmlOptions'=>array('style'=>'width: 50px'),
            'buttons'=>array(
                'update'=>array(
                    'url'=>'Yii::app()->createUrl("panel/finance/accountUpdate", array("id"=>$data->id))'
                ),
                'delete'=>array(
                    'url'=>'Yii::app()->createUrl("panel/finance/accountDelete", array("id"=>$data->id))'
                )
            )
        ),
    ),
)); ?>