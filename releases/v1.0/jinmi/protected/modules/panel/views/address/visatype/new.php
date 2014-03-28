<?php
/**
 * Created by Suley.
 * @author: suley<dearsuley@gmail.com>
 * @date: 1/22/14
 * @time: 11:22 AM
 */

$form = $this->beginWidget('CActiveForm', array(
    'id'=>'visa-type',
    //'enableAjaxValidation'=>true,
    //'enableClientValidation'=>true,
    'focus'=>array($model,'name'),
)); ?>

<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name'); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'price'); ?>
        <?php echo $form->textField($model,'price'); ?>
        <?php echo $form->error($model,'price'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'predict_date'); ?>
        <?php
        echo $form->textField($model,'predict_date');
        ?>
        <?php echo $form->error($model,'predict_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'notes'); ?>
        <?php echo $form->textArea($model,'notes'); ?>
        <?php echo $form->error($model,'notes'); ?>
    </div>

    <?php echo CHtml::submitButton('提交'); ?>

<?php $this->endWidget(); ?>