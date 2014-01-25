<?php

$form = $this->beginWidget('CActiveForm', array(
    'id'=>'address-form'
));
?>
  <div class="form-group">
    <label for="inputParentId">父级</label>
      <?php echo $form->dropDownList($model, 'parent_id', CHtml::listData($parentList, 'id', 'name')); ?>
  </div>
  <div class="form-group">
    <label for="inputCountry">名字</label>
    <?php echo $form->textField($model, 'name');?>
  </div>
  <div class="form-group">
    <label>备注</label>
      <?php echo $form->textArea($model, 'notes');?>
  </div>
<?php if(!$model->isNewRecord){ ?>

  <div class="row">
      <label>签证类型：</label>
      <?php echo CHtml::link('添加', $this->createUrl('address/addType',  array('country_id'=>$model->id)), array('class'=>'btn btn-primary')); ?>
      <div class="grid-view">
          <table  class="table table-striped">
              <thead>
              <tr>
                  <th>类型</th>
                  <th>价格</th>
                  <th>备注</th>
                  <th>出签日期</th>
                  <th>操作</th>
              </tr>
              </thead>
              <tbody>
              <?php
              foreach($model->type as $v){
                  echo "<tr>";
                  echo "<td>".CHtml::encode($v->name)."</td>";
                  echo "<td>".CHtml::encode($v->price)."</td>";
                  echo "<td>".CHtml::encode($v->notes)."</td>";
                  echo "<td>".CHtml::encode($v->predict_date)."</td>";
                  echo "<td>";
                  echo CHtml::link('删除', $this->createUrl('address/delType', array('id'=>$v->id)), array('class'=>'btn btn-danger btn-sm', 'style'=>'margin-right:10px;'));
                  echo CHtml::link('修改', $this->createUrl('address/updateType', array('id'=>$v->id)),array('class'=>'btn btn-info btn-sm'));
                  echo "</td>";
                  echo "</tr>";
              }
              ?>
              </tbody>
          </table>
      </div>
  </div>
    <?php } ?>
  <input type="submit" class="btn btn-default" value="提交" />
<?php $this->endWidget(); ?>