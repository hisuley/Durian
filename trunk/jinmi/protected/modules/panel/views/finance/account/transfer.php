<?php
/**
 * @project: trunk
 * @file: transfter.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-5-6
 * @time: 下午7:29
 * @version: 1.0
 */

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
)); ?>

<fieldset>

    <legend>转账</legend>
    <?php echo $form->dropDownListRow($model, 'account_id', CHtml::listData(PanelBankAccount::model()->findAll(), 'id', 'name')); ?>
    <?php echo $form->dropDownListRow($model, 'target_id', CHtml::listData(PanelBankAccount::model()->findAll(), 'id', 'name')); ?>
    <?php echo $form->textFieldRow($model, 'value', array()); ?>
    <?php echo $form->textAreaRow($model, 'memo', array('hint'=>'备注信息')); ?>
</fieldset>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'保存')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'重置')); ?>
</div>

<?php $this->endWidget(); ?>

