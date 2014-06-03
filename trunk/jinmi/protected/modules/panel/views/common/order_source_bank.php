<?php
/**
 * @project: trunk
 * @file: order_source_bank.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-4-8
 * @time: 下午1:57
 * @version: 1.0
 */

//$form = $this->beginWidget('CActiveForm', array('id'=>'account-form'));
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array('type'=>'horizontal'));

?>
    <fieldset>
        <legend><?php echo $model->isNewRecord ? '添加银行账号' : "编辑银行账号"; ?><small>[渠道：<?php echo $orderSourceModel->name; ?>]</legend>
        <?php
            echo $form->textFieldRow($model, 'account_holder');
            echo $form->textFieldRow($model, 'account_bank');
            echo $form->textFieldRow($model, 'account_number');
        ?>
    </fieldset>
<div class="form-actions">
    <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'保存'
        ))
    ?>
</div>

<?php $this->endWidget(); ?>