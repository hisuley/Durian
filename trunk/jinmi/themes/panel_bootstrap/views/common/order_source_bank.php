<?php
/**
 * @project: trunk
 * @file: order_source_bank.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-4-8
 * @time: 下午1:57
 * @version: 1.0
 */

$form = $this->beginWidget('CActiveForm', array('id'=>'account-form'));

?>
    <h2><?php echo $model->isNewRecord ? '添加银行账号' : "编辑银行账号"; ?><small>[渠道：<?php echo OrderSource::getSourceName($model->order_source_id); ?>]</small></h2>
    <table class="table table-bordered">
        <tbody>
        <tr>
            <td><?php echo $form->labelEx($model, 'account_holder'); ?></td>
            <td><?php echo $form->textField($model, 'account_holder'); ?></td>
            <td><?php echo $form->error($model, 'account_holder');?></td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model, 'account_bank'); ?></td>
            <td><?php echo $form->textField($model, 'account_bank'); ?></td>
            <td><?php echo $form->error($model, 'account_bank');?></td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model, 'account_number'); ?></td>
            <td><?php echo $form->textField($model, 'account_number'); ?></td>
            <td><?php echo $form->error($model, 'account_number');?></td>
        </tr>
        <tr>
            <td>
                <?php echo CHtml::submitButton('保存', array('class'=>'btn btn-primary')); ?>
            </td>
            <td>
                <?php echo CHtml::resetButton("清空"); ?>
            </td>

        </tr>


        </tbody>
    </table>

<?php $this->endWidget(); ?>