<?php
/**
 * Created by Suley.
 * @author: suley<dearsuley@gmail.com>
 * @date: 1/22/14
 * @time: 10:12 AM
 */

$form = $this->beginWidget('CActiveForm', array(
    'id'=>'order-form',
    'enableAjaxValidation'=>false
));
?>
<form method="post">
    <table class="visa-order">
        <tbody>
        <tr>
            <td><label>操作人员：</label></td>
            <td>
                <?php echo User::getUserRealname(Yii::app()->user->id); ?>
            </td>
        </tr>
        <?php if($inputName == 'sent_comment'){
           echo "<tr><td><label>送签渠道：</label></td><td>";
           echo $form->dropDownList($model, 'agency_id',
                    CHtml::listData(VisaTypeAgency::model()->findAllByAttributes(array('type_id'=>$model->type)), 'id', 'agency.name')
                );
           echo "</td></tr>";
              }?>

        <tr>
            <td><label><?php if($inputName == 'sent_comment'){ echo "送签"; } ?>时间：</label></td>
            <td>
                <?php
                if($inputName == 'op_comment'){
                    echo date('Y-m-d');
                }else{
                    $attrName = explode('_', $inputName);
                    $attrName = $attrName[0]."_time";
                    if(empty($model->$attrName)){
                        $model->$attrName = date('Y-m-d');
                    }
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'attribute' => $attrName,
                        'language'=>'zh-cn',
                        'model'=>$model,
                        'name'=>$model->$attrName,
                        'options' => array(
                            'showAnim' => 'fold',
                            'dateFormat' => 'yy-mm-dd',
                            //'minDate' => date('Y-m-d')
                        ),
                        'value'=>$model->$attrName
                    ));
                }
                 ?>
            </td>
        </tr>
        <tr>
            <td><label>审核意见/备注：</label></td>
            <td>
                <?php echo $form->textArea($model, $inputName, array('cols'=>30, 'rows'=>'7')); ?>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <?php echo CHtml::submitButton($model->isNewRecord ? '审核' : '修改审核'); ?>
            </td>
        </tr>
        </tbody>
        </table>
</form>

<?php $this->endWidget(); ?>