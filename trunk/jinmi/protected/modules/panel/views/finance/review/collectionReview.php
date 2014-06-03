<?php
/**
 * @project: trunk
 * @file: collectionReview.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-4-17
 * @time: 下午3:17
 * @version: 1.0
 */

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
)); ?>

    <fieldset>

        <legend>审核收款请求</legend>

        <?php echo $form->textFieldRow($model->user, 'realname', array('disabled'=>'disabled', 'label'=>'经手人')); ?>
        <?php echo $form->textFieldRow($model, 'transaction_value', array('disabled'=>'disabled','label'=>'金额')); ?>
        <?php echo $form->textFieldRow($model->charge_account, 'name', array('disabled'=>'disabled','label'=>'收款账号')); ?>
        <?php echo $form->textAreaRow($model, 'memo', array('label'=>'备注')); ?>
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
            'name'=>'id',
            'filterHtmlOptions'=>array('width'=>'70px'),
            'type'=>'raw',
            'value'=>'CHtml::link($data->id, array("visa/update", "id"=>$data->id))',
            'htmlOptions'=>array('style'=>'width:60px;')
        ),

        array(
            'name'=>'country',
            'header'=>'国家',
            'value'=> 'Address::getCountryName($data->country)',
            'filter'=> Address::model()->findCountry()
        ),
        array(
            'name'=>'type',
            'header'=>'类型',
            'value'=> 'VisaType::getTypeName($data->type)',
            'filter'=> ''
        ),
        array(
            'name'=>'user_id',
            'header'=>'下单人',
            'value'=> 'User::getUserRealname($data->user_id)',
            'filter'=> CHtml::listData(User::model()->findAll(), 'id', 'realname')
        ),

        array(
            'name'=>'status',
            'header'=>'状态',
            'value'=> 'VisaOrder::translateStatus($data->status)',
            'filter' => VisaOrder::$statusIntl
        ),
        array(
            'name'=>'total_price',
            'header'=>'总价',
        ),

        array(
            'name'=>'source',
            'header'=>'订单来源',
            'value'=> '$data->order_source->name',
            'type'=>'raw',
            'filter'=> CHtml::listData(OrderSource::model()->findAll('type = '.OrderSource::TYPE_SOURCE), 'id', 'name')
        ),

        array(
            'name'=>'create_time',
            'header'=>'下单时间',
            'value'=> 'date("Y-m-d H:i", $data->create_time)'
        ),
    )
), true);


$this->widget('bootstrap.widgets.TbTabs', array(
    'type'=>'tabs',
    'placement'=>'above', // 'above', 'right', 'below' or 'left'
    'tabs'=>array(
        array('label'=>'订单列表', 'content'=>$customerWidget, 'active'=>true),
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