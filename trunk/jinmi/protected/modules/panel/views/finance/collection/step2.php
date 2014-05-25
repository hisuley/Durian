<?php
/**
 * @project: trunk
 * @file: step2.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-4-16
 * @time: 下午3:18
 * @version: 1.0
 */
?>
<h1>收款申请 <small>第二步：确认订单&上传凭证</small>&nbsp;&nbsp;<a class='btn btn-primary' href="<?php echo $this->createUrl('finance/collectionRequest', array('step'=>'one')); ?>">重新选择</a></h1>



<form method="POST" enctype="multipart/form-data" action="<?php echo $this->createUrl('finance/collectionRequest', array('step'=>'three')); ?>">
    <div class="row">
        <div class="span2"></div>
        <div class="well span6">
            <ul>
                <li>
                    <label>订单总金额：</label>
                    <h2 style="color:red">￥<?php echo $info['price']; ?></h2>
                </li>
                <li>
                    <label for="">水单：</label>
                    <?php
                        echo CHtml::fileField('Finance[pay_file]');
                    ?>
                    <br />
                </li>
                <li>
                    <label for="">水单2：</label>
                    <?php
                    echo CHtml::fileField('Finance[pay_file2]');
                    ?>
                    <br />
                </li>
                <li>
                    <label for="">水单3：</label>
                    <?php
                    echo CHtml::fileField('Finance[pay_file3]');
                    ?>
                    <br />
                </li>
                <li>
                    <label for="">备注：</label>
                    <?php
                    echo CHtml::textArea('Finance[memo]');
                    ?>
                    <br />
                </li>
                <li>
                    <label for="">收款账号：</label>
                    <?php
                        echo CHtml::dropDownList('Finance[charge_account_id]', 0, CHtml::listData(PanelBankAccount::model()->findAll('status != "'.PanelBankAccount::STATUS_DELETED.'"'), 'id', 'name'));
                    ?>
                    <br />
                </li>
                <li>
                    <br />
                    <?php

                        foreach($info['vid'] as $key=>$vid){
                            echo '<input type="hidden" name="FinanceItems['.$key.'][vid]" value="'.$vid.'">';
                        }
                        $this->widget('bootstrap.widgets.TbButton', array(
                           'buttonType'=>'submit','type'=>'primary',
                            'label'=>'生成收款申请'
                        ));
                    ?>
                </li>
            </ul>
        </div>
    </div>
</form>
<h2>您已经选择的订单</h2>
<?php
$data = new CArrayDataProvider($orderModel);
$this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider'=>$data,
    'summaryText' => '显示第{start}条至{end}条记录|共{count}条记录',
    'template' => '{pager}{summary}{items}{pager}',
    'columns'=>array(
        array(
            'name'=>'id',
            'filterHtmlOptions'=>array('width'=>'60px'),
            'type'=>'raw',
            'value'=>'CHtml::link($data->id, array("visa/update", "id"=>$data->id))',
            'htmlOptions'=>array('style'=>'width:60px;')
        ),
        array(
            'name'=>'country',
            'header'=>'国家',
            'value'=> 'Address::getCountryName($data->country)',
        ),
        array(
            'name'=>'source',
            'header'=>'订单来源',
            'value'=> 'empty($data->order_source->name) ? "无":$data->order_source->name',
            'type'=>'raw',
        ),
        array(
            'name'=>'type',
            'header'=>'类型',
            'value'=> 'VisaType::getTypeName($data->type)',
            'filter'=> ''
        ),
        array(
            'name'=>'amount',
            'header'=>'人数',
            'filter'=> ''
        ),
        array(
            'name'=>'total_price',
            'header'=>'总价',
            'filter'=> ''
        ),
        array(
            'name'=>'user_id',
            'header'=>'下单人',
            'value'=> 'User::getUserRealname($data->user_id)',
        )
    )
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

