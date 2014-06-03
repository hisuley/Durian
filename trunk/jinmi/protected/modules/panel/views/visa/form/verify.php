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
           echo "<tr><td><label>送签渠道：</label></td><td id='sent-by-all-wrapper'>";
           echo $form->dropDownList($model, 'agency_id',
                    CHtml::listData(VisaTypeAgency::model()->findAllByAttributes(array('type_id'=>$model->type)), 'id', 'agency.name')
                );
           echo "</td><td><a href='#' class='sent-by-customer-btn' data-type='all'>按客户选择出签渠道</a></td></tr>";
              }?>

        <tr id="main-verify-body">
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

<?php if($inputName == 'sent_comment'){
    echo "<table id='sent-by-customer' style='display:none;'><tbody>";
    foreach($model->customer as $key=>$customer){
        echo '<tr class="customer-item"><td><label>客人姓名：'.$customer->name.'</label></td><td><label style="float:left">送签渠道：</label>';
        echo $form->dropDownList($customer, "[$customer->id]agency_id",
            CHtml::listData(VisaTypeAgency::model()->findAllByAttributes(array('type_id'=>$model->type)), 'id', 'agency.name'));
        echo "</td></tr>";
    }
    echo "</tbody></table>";
    echo "<div id='sent-by-all-bak' style='display:none;'>";
    echo $form->dropDownList($model, 'agency_id',
        CHtml::listData(VisaTypeAgency::model()->findAllByAttributes(array('type_id'=>$model->type)), 'agency.id', 'agency.name')
    );
    echo "</div>";
    ?>

    <script type="text/javascript">
        $('document').ready(function(){
           $('.sent-by-customer-btn').click(function(){
               if($(this).data('type') == 'all'){
                   $('#sent-by-all-wrapper').html(' ');
                   var htmlStr = $('#sent-by-customer tbody').html();
                   $('#main-verify-body').before(htmlStr);
                   $(this).text('批量设置出签渠道');
                   $(this).data('type', 'customer');
               }else{
                   $('table.visa-order').find('tr.customer-item').remove();
                   $('#sent-by-all-wrapper').html($('#sent-by-all-bak').html());
                   $(this).text('按客户设置出签渠道');
                   $(this).data('type', 'all');
               }
           });
        });
    </script>
<?php
}
?>