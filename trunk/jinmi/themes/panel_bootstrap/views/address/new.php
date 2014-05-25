<?php

$form = $this->beginWidget('CActiveForm', array(
    'id'=>'address-form'
));
$addresses = CHtml::listData($parentList, 'id', 'name');
$addresses[0] = '无';

?>
  <div class="form-group">
    <label for="inputParentId">父级</label>
      <?php echo $form->dropDownList($model, 'parent_id', $addresses); ?>
  </div>
  <div class="form-group">
    <label for="inputCountry">名字</label>
    <?php echo $form->textField($model, 'name');?>
  </div>
  <div class="form-group">
    <label>备注</label>
      <?php echo $form->textArea($model, 'notes');?>
  </div>
<?php if(!$model->isNewRecord){
    $dataProvider = new CArrayDataProvider('VisaType');
    $dataProvider->setData($model->type);
    ?>

  <div class="row">
      <label>签证类型：</label>
      <?php echo CHtml::link('添加', $this->createUrl('address/addType',  array('country_id'=>$model->id)), array('class'=>'btn btn-primary')); ?>

      <?php
      $this->widget('bootstrap.widgets.TbGridView', array(
          'type'=>'striped bordered condensed',
          'dataProvider'=>$dataProvider,
          'template'=>"{items}",
          'columns'=>array(
              array('name'=>'id', 'header'=>'编号'),
              array('name'=>'name', 'header'=>'类型'),
              array('name'=>'notes', 'header'=>'备注'),
              array(
                  'class'=>'bootstrap.widgets.TbButtonColumn',
                  'buttons'=>array(
                      'view'=>array('visible'=>'false'),
                      'update'=>array(
                          'url'=>'Yii::app()->createUrl("panel/address/updateType", array("id"=>$data->id))',
                          'visible'=>'1==1',
                          'options'=>array('style'=>'display:inline-block;')
                      ),
                      'delete'=>array('url'=>'Yii::app()->createUrl("panel/address/deleteType", array("id"=>$data->id))')
                  ),
                  'htmlOptions'=>array('style'=>'width: 50px'),
              ),
          ),
      ));
      ?>
  </div>
    <?php } ?>
  <input type="submit" class="btn btn-default" value="提交" />
<?php $this->endWidget(); ?>