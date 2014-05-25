<?php
/**
 * @project: trunk
 * @file: list.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-4-16
 * @time: 下午4:12
 * @version: 1.0
 */

$data = $model->search();
Yii::app()->user->setReturnUrl(Yii::app()->request->url);
$this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider'=>$data,
    'ajaxUpdate' => true,
    'afterAjaxUpdate'=>'reinstallDatePicker',
    'summaryText' => '显示第{start}条至{end}条记录|共{count}条记录',
    'template' => '{pager}{summary}{items}{pager}',
    'columns'=>array(
        array(
            'class'=>'CCheckBoxColumn',
            'selectableRows'=> 2,
            'value' => $model->id
        ),
        array(
            'name'=>'id',
            'filter'=>''
        ),
        array(
            'name'=>'user.realname',
            'header'=>'申请人',
        ),
        array(
            'name'=>'review_user.realname',
            'header'=>'审核人',
        ),
        array(
            'name'=>'transaction_value',
            'header'=>'金额',
            'filter'=>''
        ),
        array(
            'name'=>'direction',
            'header'=>'类型',
            'value'=>'($data->direction == "+" ? "收款":"请款")',
            'filter'=>''
        ),
        array(
            'name'=>'status',
            'header'=>'状态',
            'value'=>'Finance::translateStatus($data->status)',
            'filter'=>''
        ),
        array(
            'name'=>'create_time',
            'header'=>'日期',
            'value'=>'date("Y-m-d", $data->create_time)',
            'filter'=>''
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'buttons'=>array(
                'update'=>array(
                    'label'=>'审核',
                    'url'=>'Yii::app()->createUrl("finance/review", array("id"=>$data->id))',
                    'visible'=>'($data->status != Finance::STATUS_APPROVED)'
                ),
                'view'=>array(
                    'visible'=>'($data->status == Finance::STATUS_APPROVED)'
                ),
                'delete'=>array(

                    'visible'=>'($data->status != Finance::STATUS_APPROVED)'
                )
            )
        )

    )
));