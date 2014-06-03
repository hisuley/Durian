<?php
/**
 * @project: trunk
 * @file: update.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-4-21
 * @time: 下午4:47
 * @version: 1.0
 */

?>

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
)); ?>

    <fieldset>

        <legend>修改商户资料</legend>

        <?php echo $form->textFieldRow($model, 'username', array('disabled'=>'disabled.')); ?>
        <?php echo $form->textFieldRow($model, 'initial_password', array('disabled'=>'disabled.', 'label'=>'初始密码')); ?>
        <?php echo $form->textFieldRow($model->address, 'company_name'); ?>
        <?php echo $form->textFieldRow($model->address, 'contact_name'); ?>
        <?php echo $form->textFieldRow($model->address, 'contact_phone'); ?>
        <?php echo $form->textFieldRow($model->address, 'contact_address'); ?>
        <?php echo $form->textFieldRow($model->address, 'contact_email'); ?>
        <?php echo $form->dropDownListRow($model->address, 'contact_handler', CHtml::listData(User::model()->findAll('role != "merchant"'), 'id', 'realname')); ?>

    </fieldset>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'保存')); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link', 'label'=>'返回', 'url'=>$this->createUrl('yutong/merchantList'))); ?>
    </div>

<?php $this->endWidget(); ?>