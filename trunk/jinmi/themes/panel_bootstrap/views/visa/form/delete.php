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
            <tr>
                <td><label>删除理由：</label></td>
                <td>
                    <?php echo $form->textArea($model, 'delete_comment', array('cols'=>30, 'rows'=>'7')); ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <?php echo CHtml::submitButton('提交'); ?>
                </td>
            </tr>
            </tbody>
        </table>
    </form>

<?php $this->endWidget(); ?>