<?php
/**
 * @project: trunk
 * @file: order_source_bank_list.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-4-9
 * @time: 下午2:02
 * @version: 1.0
 */

$data = new CArrayDataProvider($data);

$this->widget('bootstrap.widgets.TbGridView', array(
   'type'=>'striped',
    'dataProvider'=>$data,
    'template'=>'{items}',
    'columns'=>array(
        'id',
        array('name'=>'account_holder', 'header'=>'账户持有人'),
        array('name'=>'account_bank', 'header'=>'开户行'),
        array('name'=>'account_number','header'=>'账号'),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'buttons'=>array(
                'update'=>array(
                    'url'=>'Yii::app()->createUrl("panel/orderSource/editAccount", array("id"=>$data->id))'
                ),
                'delete'=>array(
                    'url'=>'Yii::app()->createUrl("panel/orderSource/deleteAccount", array("id"=>$data->id))'
                ),
                'view'=>array('visible'=>'false')
            )
        )
    )
));