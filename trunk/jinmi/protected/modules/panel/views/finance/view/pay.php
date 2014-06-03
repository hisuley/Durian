<?php
/**
 * @project: trunk
 * @file: pay.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-5-4
 * @time: 下午4:00
 * @version: 1.0
 */


$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
)); ?>

    <fieldset>

        <legend>查看请款请求</legend>

        <?php echo $form->textFieldRow($model->user, 'realname', array('disabled'=>'disabled', 'label'=>'经手人')); ?>
        <?php echo $form->textFieldRow($model->review_user, 'realname', array('disabled'=>'disabled', 'label'=>'审核人')); ?>
        <?php echo $form->textFieldRow($model, 'transaction_value', array('disabled'=>'disabled','label'=>'金额')); ?>
        <?php echo $form->textFieldRow($model->charge_account, 'name', array('disabled'=>'disabled','label'=>'付款账号')); ?>
        <?php echo $form->textAreaRow($model, 'memo', array('disabled'=>'disabled','label'=>'备注')); ?>
        <div class="control-group "><label class="control-label" for="PanelUser_realname">水单</label><div class="controls">
                <?php
                if(!empty($model->pay_file)){
                    $this->widget('ext.lyiightbox.LyiightBox2', array(
                        'thumbnail' => GlobalHelper::getThumbnail("/panel/".$model->pay_file, 60),
                        'image' => GlobalHelper::getThumbnail("/panel/".$model->pay_file, 800, 'width'),
                        'title' => '水单.'
                    ));
                }

                ?>
            </div></div>
        <?php if(!empty($model->pay_file2)){ ?>
            <div class="control-group "><label class="control-label" for="PanelUser_realname">水单2</label><div class="controls">
                    <?php
                    if(!empty($model->pay_file2)){
                        $this->widget('ext.lyiightbox.LyiightBox2', array(
                            'thumbnail' => GlobalHelper::getThumbnail("/panel/".$model->pay_file2, 60),
                            'image' => GlobalHelper::getThumbnail("/panel/".$model->pay_file2, 800, 'width'),
                            'title' => '水单2'
                        ));
                    }

                    ?>
                </div></div>
    <?php } ?>
        <?php if(!empty($model->pay_file3)){ ?>
            <div class="control-group "><label class="control-label" for="PanelUser_realname">水单3</label><div class="controls">
                    <?php
                    if(!empty($model->pay_file3)){
                        $this->widget('ext.lyiightbox.LyiightBox2', array(
                            'thumbnail' => GlobalHelper::getThumbnail("/panel/".$model->pay_file3, 60),
                            'image' => GlobalHelper::getThumbnail("/panel/".$model->pay_file3, 800, 'width'),
                            'title' => '水单3'
                        ));
                    }

                    ?>
                </div></div>
        <?php } ?>
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
            'name'=>'price',
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
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link', 'type'=>'primary', 'label'=>'返回', 'url'=>$this->createUrl('finance/requestList'))); ?>
    </div>

<?php $this->endWidget(); ?>