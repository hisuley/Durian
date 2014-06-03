<?php
/**
 * @project: trunk
 * @file: payReview.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-4-17
 * @time: 下午3:17
 * @version: 1.0
 */

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

    <fieldset>

        <legend>审核请款请求</legend>

        <?php echo $form->textFieldRow($model->user, 'realname', array('disabled'=>'disabled', 'label'=>'经手人')); ?>
        <?php echo $form->textFieldRow($model, 'transaction_value', array('disabled'=>'disabled','label'=>'金额')); ?>
        <?php echo $form->textAreaRow($model, 'memo', array('label'=>'备注')); ?>
        <?php
            echo $form->dropDownListRow($model, 'charge_account_id',CHtml::listData(PanelBankAccount::model()->findAll('status != "'.PanelBankAccount::STATUS_DELETED.'"'), 'id', 'name'));
        ?>
        <?php echo $form->fileFieldRow($model, 'pay_file', array('label'=>'水单')); ?>
        <?php echo $form->fileFieldRow($model, 'pay_file2', array('label'=>'水单2')); ?>
        <?php echo $form->fileFieldRow($model, 'pay_file3', array('label'=>'水单3')); ?>

    </fieldset>

    <h2>您已经选择的订单</h2>

<?php
$customerWidget = $this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider'=>$dataProvider,
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


$this->widget('bootstrap.widgets.TbTabs', array(
    'type'=>'tabs',
    'placement'=>'above', // 'above', 'right', 'below' or 'left'
    'tabs'=>array(
        array('label'=>'客户列表', 'content'=>$customerWidget, 'active'=>true),
        array('label'=>'混合显示', 'content'=>$customerWidget),
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



    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'审核通过')); ?>
    </div>

<?php $this->endWidget(); ?>