<?php
/**
 * Created by PhpStorm.
 * User: suley
 * Date: 1/21/14
 * Time: 2:36 AM
 */

$form=$this->beginWidget('CActiveForm', array(
    'id'=>'order-form',
    'enableAjaxValidation'=>false,
));

?>
<form method="post">
    <table class="visa-order">
        <tbody>
        <tr>
            <td>录入人：</td>
            <td><?php echo Yii::app()->user->username; ?></td>
        </tr>
        <tr>
            <td>付款状态：</td>
            <td><?php echo $form->radioButtonList($model, 'is_pay', array(0=>'未支付', 1=>'已支付')); ?></td>
        </tr>

        <tr>
            <td>国家：</td>
            <td>
                <?php echo $form->dropDownList($model, 'country',
                    CHtml::listData($addressModel, 'id', 'name')
                ); ?>

            </td>
            <td>类型：</td>
            <td>
                <?php echo $form->dropDownList($model, 'type',
                    array(
                        '旅游'=>'旅游',
                        '商务'=>'商务',
                        '探亲'=>'探亲'
                    )
                ); ?>
            </td>
        </tr>
        <tr>
            <td>人数：</td>
            <td>
                <?php echo $form->textfield($model, 'amount', array('readonly'=>'readonly','id'=>'id_amount')); ?>
            </td>
            <td colspan="2"><input type="checkbox" class="unlock-amount" />解锁</td>
            </tr>
        <tr>
            <td>价格：</td>
            <td>
                <?php echo $form->textfield($model, 'price'); ?>
            </td>
            <td>预计出签：</td>
            <td>
                <?php echo $form->textfield($model, 'predict_date'); ?>
            </td>
        </tr>
        <tr>
            <td>出发时间：</td>
            <td>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'attribute' => 'depart_date',
                    'language'=>'zh-cn',
                    'model'=>$model,
                    'name'=>$model->depart_date,
                    'options' => array(
                        'showAnim' => 'fold',
                        'dateFormat' => 'yy-mm-dd',
                        'minDate' => date('Y-m-d')
                    ),
                    'htmlOptions'=>array(
                        'style'=>'height:25px;',
                    ),
                    'value'=>$model->depart_date
                ));
                ?>
            </td>
            <td>订单来源：</td>
            <td>
                <?php echo $form->dropDownList($model, 'source',
                    array(
                        '其他同业'=>'其他同业',
                    )
                ); ?>
            </td>

        </tr>
        <tr>
            <td>签证人信息：</td>
            <td><a href="#" class="add-visa-person">添加</a></td>
        </tr>
        <?php
            if(isset($model->customer)){
                foreach($model->customer as $key=>$v){
                    echo '<tr class="visa-person-item"><td>客人'.($key+1).'姓名：</td><td><input type="text" name="VisaOrderCustomer[name][]" value="'.$v->name.'"></td><td>护照号：</td><td><input type="text"  name="VisaOrderCustomer[passport][]" value="'.$v->passport.'"></td><td><a href="#" class="deleteThis">删除</a></td></tr>';
                }
            }
        ?>
        <tr class="add-visa-before">
           <td>联系人姓名：</td>
            <td><?php echo $form->textfield($model, 'contact_name'); ?></td>
           <td>电话：</td>
            <td><?php echo $form->textfield($model, 'contact_phone'); ?></td>
        </tr>
        <tr>
            <td>地址：</td>
            <td colspan="3">
                <?php echo $form->textfield($model, 'contact_address'); ?>
            </td>
        </tr>
        <tr>
            <td>备注：</td>
            <td colspan="3">
                <?php echo $form->textArea($model, 'memo'); ?>
            </td>
        </tr>
        <tr>
            <td>材料清单：</td>
            <td colspan="3">
                <?php echo $form->checkBoxList($model, 'material', array('photo'=>'照片', 'passport'=>'护照', 'residence'=>'户口本', 'financeproof'=>'财力证明', 'id'=>'身份证')); ?>
            </td>
        </tr>
        <tr>
            <td colspan='3'><?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存'); ?></td>
        </tr>
        </tbody>
    </table>
</form>
<script type="text/javascript">
    $(document).ready(function(){
        $('.add-visa-person').click(function(){
            var personCount = $('.visa-person-item').length+1;
            var visaHtml = '<tr class="visa-person-item"><td>客人'+personCount+'姓名：</td><td><input type="text" name="VisaOrderCustomer[name][]"></td><td>护照号：</td><td><input type="text"  name="VisaOrderCustomer[passport][]"></td><td><a href="#" class="deleteThis">删除</a></td></tr>';
            $('.add-visa-before').before(visaHtml);
            $('#id_amount').val(personCount);
            return false;
        });
        $('table.visa-order').delegate('tr.visa-person-item a.deleteThis', 'click', function(){
            $(this).parent().parent().remove();
            $('tr.visa-person-item').each(function(index,element){
                $(this).children('td').first().text('客人'+(index+1)+'姓名：');
            });
            var personCount = $('.visa-person-item').length+1;
            $('#id_amount').val(personCount);
            return false;
        });
        $('input.unlock-amount').click(function(){
            if($(this).prop('checked') == true){
                $('input#id_amount').attr('readonly', false);
                $('a.add-visa-person').hide();
            }else{
                $('input#id_amount').val('0');
                $('input#id_amount').attr('readonly', true);
                $('a.add-visa-person').show();
            }
        })
    });
</script>

<?php $this->endWidget(); ?>