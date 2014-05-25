<?php
/**
 * Created by Suley.
 * @author: suley<dearsuley@gmail.com>
 * @date: 1/22/14
 * @time: 11:22 AM
 */




$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'visa-type',
    'type'=>'horizontal'
));
if(!$model->isNewRecord){
    $dataProvider = new CActiveDataProvider('VisaTypeAgency', array(
        'criteria'=>array(
            'condition'=>'type_id = '.$model->id,
            'order' => ' show_order ASC',
            'with'=> array('agency')
        ),
        'pagination'=>false
    ));
}

?>
<fieldset>
    <legend><?php echo $model->isNewRecord ? '添加签证类型['.$countryModel->name.']' : '编辑签证类型['.$model->country->name.']';
        ?></legend>
<?php echo $form->errorSummary($model); ?>
<?php echo $form->textFieldRow($model, 'name'); ?>
<?php echo $form->textAreaRow($model, 'notes'); ?>
</fieldset>

<?php
if(!$model->isNewRecord){
    echo "<br /><h3>送签渠道</h3>";
    $this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>'striped bordered condensed',
        'dataProvider'=>$dataProvider,
        'template'=>"{items}",
        'columns'=>array(
            array('name'=>'id', 'header'=>'#'),
            array('name'=>'agency.name', 'header'=>'送签社'),
            array('name'=>'price'),
            array('name'=>'predict_date'),
            array('name'=>'show_order'),
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'buttons'=>array(
                    'view'=>array('visible'=>'false'),
                    'update'=>array(
                        'url'=>'Yii::app()->createUrl("panel/address/updateAgency", array("id"=>$data->id))',
                        'visible'=>'1==1',
                        'options'=>array('style'=>'display:inline-block;')
                    ),
                    'delete'=>array('url'=>'Yii::app()->createUrl("panel/address/deleteAgency", array("id"=>$data->id))')
                ),
                'htmlOptions'=>array('style'=>'width: 50px'),
            ),
        ),
    ));
}

    ?>
<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'提交'));
    $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link', 'label'=>'返回', 'url'=>$this->createUrl('address/update', array('id'=>$model->country_id))));
    ?>
</div>
    <div class="form-actions">
<?php
if(!$model->isNewRecord){
    $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link', 'type'=>'info', 'label'=>'添加送签渠道', 'url'=>$this->createUrl('address/addAgency', array('type_id'=>$model->id))));
}
?>
    </div>
        <?php

$this->endWidget();


?>