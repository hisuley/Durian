<?php
$form = $this->beginWidget('CActiveForm', array('id'=>'source-form')); ?>
  <div class="form-group">
      <?php
      echo $form->labelEx($model, 'parent_id');
      echo $form->dropDownList($model, 'parent_id', array_merge(array(0=>'无'), CHtml::listData($parentList, 'id', 'name')));
      ?>
  </div>
  <div class="form-group">
      <?php
      echo $form->labelEx($model, 'name');
      echo $form->textField($model,'name');
      ?>
  </div>
  <div class="form-group">
      <?php
      echo $form->labelEx($model, 'notes');
      echo $form->textArea($model,'notes');
      ?>
  </div>
  <div class="form-group">
    <?php
        echo $form->labelEx($model, 'contact_name');
        echo $form->textField($model,'contact_name');
    ?>
  </div>
    <div class="form-group">
        <?php
        echo $form->labelEx($model, 'contact_phone');
        echo $form->textField($model,'contact_phone');
        ?>
    </div>
    <div class="form-group">
        <?php
        echo $form->labelEx($model, 'contact_address');
        echo $form->textField($model,'contact_address');
        ?>
    </div>

<?php
$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'link',
    'type'=>'primary',
    'label'=>'添加账号',
    'url'=>$this->createUrl('agency/newAccount', array('id'=>$model->id))
));
?>
    <div class="row" style="margin-left:30px;">
        <?php $this->renderPartial('application.modules.panel.views.common.order_source_bank_list', array('data'=>$model->account)); ?>
    </div>
    <div class="form-actions">
  <input type="submit" class="btn btn-default" value="提交" />
        </div>

<?php $this->endWidget(); ?>