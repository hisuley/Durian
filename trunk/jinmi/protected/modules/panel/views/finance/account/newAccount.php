<?php
/**
 * @project: trunk
 * @file: newAccount.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-5-6
 * @time: 下午5:29
 * @version: 1.0
 */

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
)); ?>

<fieldset>

    <legend>账号信息</legend>
    <?php echo $form->textFieldRow($model, 'name', array('hint'=>'账号别名，用来区分不同的账号。')); ?>
    <?php echo $form->textFieldRow($model, 'card_holder', array('hint'=>'请输入持卡人信息，方便识别。')); ?>
    <?php echo $form->textFieldRow($model, 'account_number', array()); ?>
    <?php echo $form->textFieldRow($model, 'account_agency', array()); ?>
    <?php echo $form->textFieldRow($model, 'balance', array('disabled'=>'disabled')); ?>
    <?php echo $form->textFieldRow($model, 'init_money', array('hint'=>'首次启用请填写账户余额，以后每笔资金变动都需要使用系统记录，否则余额会不准确。')); ?>
    <?php echo $form->textAreaRow($model, 'memo', array('hint'=>'备注信息')); ?>
</fieldset>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'保存')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'重置')); ?>
</div>

<?php $this->endWidget(); ?>

