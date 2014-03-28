<?php
/**
 * Created by Suley.
 * @author: suley<dearsuley@gmail.com>
 * @date: 1/21/14
 * @time: 4:09 PM
 */

?>

<form role="form" action="<?php echo $this->createUrl('visa/waiting'); ?>" method="POST">
    <div class="form-group">
        <label for="Date">送签日期：</label>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'attribute' => 'start_date',
            'language'=>'zh-cn',
            'model'=> VisaOrder::model()->findAll(),
            'name'=> 'start_date',
            'options' => array(
            'showAnim' => 'fold',
            'dateFormat' => 'yy-mm-dd',
            //'minDate' => date('Y-m-d')
            ),
            'value'=> (empty($_POST['start_date']) ? date('Y-m-d') : $_POST['start_date']),
        )); ?>
        <?php echo CHtml::submitButton("生成"); ?>
    </div>
</form>
<div class="sent_visa_table">

<?php

echo CHtml::link('导出结果', $this->createUrl(Yii::app()->baseUrl."/upload/sent_".(empty($_POST['start_date']) ? date('Y-m-d') : $_POST['start_date']).".docx"),array('class'=>'btn btn-default btn-success'));

$this->widget('zii.widgets.CListView', array(
    'dataProvider'=> VisaOrder::searchForReport(),
    'itemView'=>'_order',   // refers to the partial view named '_post'
    'sortableAttributes'=>array(

    ),
));
?>
</div>
