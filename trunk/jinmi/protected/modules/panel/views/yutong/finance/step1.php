<?php
/**
 * @project: trunk
 * @file: step1.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-4-14
 * @time: 下午1:55
 * @version: 1.0
 */
$criteria = new CDbCriteria;
$criteria->addNotInCondition('role', array('merchant'));
$userList = User::model()->findAll($criteria);
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm',
    array(
        'type' => 'horizontal',
        'htmlOptions'=>array(
            'enctype'=>'multipart/form-data'
        )
    )
);
?>
    <div class="error-summary">
        <?php echo $form->errorSummary($model); ?>
    </div>
    <fieldset>
        <legend>财务收款确认</legend>
        <div class="control-group ">
            <label class="control-label" for="YutongVisaOrder_pay_file">财务审核人</label>
            <div class="controls">
                <?php echo User::getUserRealname(Yii::app()->user->id); ?>
                </div>
        </div>
        <?php
        echo $form->dropDownListRow($model, 'accountant_handler', CHtml::listData($userList, 'id', 'realname'));
        echo $form->textAreaRow($model, 'accountant_comment');
        echo $form->fileFieldRow($model, 'pay_file');
        ?>
    </fieldset>
    <div class="form-actions">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit', 'type' => 'primary', 'label' => '确认'));
        ?>
    </div>
<?php
$this->endWidget();

