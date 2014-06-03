<?php
/**
 * @project: trunk
 * @file: agency.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-4-3
 * @time: 下午1:52
 * @version: 1.0
 */

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array('type'=>'horizontal'));
?>
    <fieldset>

        <legend><?php
            echo $model->isNewRecord ? '新增送签渠道' : '修改送签渠道';
            echo '['.$typeModel->country->name."-".$typeModel->name."]"; ?>
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link', 'label'=>'返回', 'url'=>$this->createUrl('address/updateType', array('id'=>$typeModel->id)), 'htmlOptions'=>array('class'=>'pull-right'))); ?>
        </legend>

<?php
echo $form->textFieldRow($model, 'price');
echo $form->textFieldRow($model, 'predict_date');
echo $form->textFieldRow($model, 'show_order');
echo $form->dropDownListRow($model, 'agency_id', CHtml::listData(OrderSource::model()->findAllByAttributes(array('type'=>OrderSource::TYPE_AGENCY)), 'id', 'name'));
echo $form->textAreaRow($model, 'notes');


?>
 </fieldset>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'保存')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'reset', 'label'=>'清空')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link', 'label'=>'返回', 'url'=>$this->createUrl('address/updateType', array('id'=>$typeModel->id)))); ?>
</div>
<?php $this->endWidget(); ?>