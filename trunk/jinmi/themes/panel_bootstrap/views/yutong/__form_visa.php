<?php
/**
 * Created by PhpStorm.
 * User: suley
 * Date: 1/21/14
 * Time: 2:36 AM
 */

$form=$this->beginWidget('CActiveForm', array(
    'id'=>'visa-form',
    'enableClientValidation' => false,
    'clientOptions'=> array('validateOnSubmit'=>false,
        'afterValidate'=>'js:function(form, data, hasError)
                                        {
                                            if(hasError){
                                                return false;
                                            }else{
                                                return true;
                                            }

                                        }'
    ),
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
));
?>
<?php //echo $form->errorSummary($model); ?>
<table class="table table-bordered">
<tbody>
<tr>
    <td><?php echo $form->labelEx($model,'author_id'); ?></td>
    <td><?php
        echo empty($model->author_id) ? Yii::app()->user->username : User::getUserRealname($model->author_id); ?></td>
    <td><?php echo $form->labelEx($model,'status'); ?></td>
    <td>
        <?php if(!empty($model->status)){
            echo $model->status;
        }else{
            echo "新添加";
        }
        ?>
    </td>
    <td><?php echo $form->labelEx($model,'create_time'); ?></td>
    <td>
        <?php if(!empty($model->create_time)){
            echo date('Y-m-d H:i', $model->create_time);
        }else{
            echo date('Y-m-d');
        }
        ?>
    </td>
</tr>
<tr>
    <td><?php echo $form->labelEx($model,'country_id'); ?></td>
    <td>
        <?php

            echo $form->dropDownList($model, 'country_id',
                Address::findCountry()
            );
        ?>

    </td>
    <td><?php echo $form->labelEx($model,'type_id'); ?></td>
    <td>
        <?php
            echo $form->dropDownList($model, 'type_id',
                array('0'=>'请选择国家')
            ); ?>
    </td>
    <td><label>送签社：</label></td>
    <td>
        <?php
            if(isset($model->type->source->name)){
                echo $model->type->source->name;
            }
        ?>
    </td>
</tr>
<tr>
    <td><?php echo $form->labelEx($model,'workdays'); ?></td>
    <td>
       <?php echo $form->textField($model, 'workdays'); ?>

    </td>
    <td><?php echo $form->labelEx($model,'market_price'); ?></td>
    <td>
        <?php echo $form->textField($model, 'market_price'); ?>

    </td>
    <td><?php echo $form->labelEx($model,'price'); ?></td>
    <td>
        <?php echo $form->textField($model, 'price'); ?>

    </td>
</tr>

<tr>
    <td><?php echo $form->labelEx($model,'valid_period'); ?></td>
    <td>
        <?php echo $form->textField($model, 'valid_period'); ?>

    </td>
    <td><?php echo $form->labelEx($model,'stay_period'); ?></td>
    <td>
        <?php echo $form->textField($model, 'stay_period'); ?>

    </td>
    <td><?php echo $form->labelEx($model,'entry_times'); ?></td>
    <td>
        <?php echo $form->textField($model, 'entry_times'); ?>

    </td>
</tr>
<tr>
    <td><?php echo $form->labelEx($model,'need_interview'); ?></td>
    <td>
        <?php echo $form->textField($model, 'need_interview'); ?>

    </td>
    <td ><?php echo $form->labelEx($model,'consular_district'); ?></td>
    <td colspan="3">
        <?php echo $form->textField($model, 'consular_district', array('style'=>'width:95%')); ?>

    </td>
</tr>

<tr>
    <td><?php echo $form->labelEx($model,'material'); ?></td>
    <td colspan="5">
        <?php $this->widget('application.extensions.tinymce.ETinyMce',
            array(
                'model'=>$model,
                'attribute'=>'material',
                'editorTemplate'=>'full',
                'htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'tinymce'),
            )); ?>

    </td>
</tr>

<tr>
    <td><label for="">文件下载：</label></td>
    <td colspan="5">
        <?php
            $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link', 'type'=>'primary', 'label'=>'添加文件', 'htmlOptions'=>array('onclick'=>'insertFiles()')));
        ?>
    </td>
</tr>
<?php

if(!empty($model->attachment)){
    foreach($model->attachment as $key=>$attachment){
        echo "<tr class='old-file-item file-item'><td><label>编号：</label>".($key+1).'</td><td>'.Yii::app()->baseUrl."/upload/yutong/".$attachment->attachment_url.'</td><td><label>标题：</label>：<input type="text" name="YutongVisaGoodsAttachmentOldFiles['.$key.'][attachment_title]"  value="'.$attachment->attachment_title.'" ></td><td><label>内容：</label><input type="text" name="YutongVisaGoodsAttachmentOldFiles['.$key.'][attachment_desc]" value="'.$attachment->attachment_desc.'" ></td><td><a class="btn btn-danger deleteThis">删除</a></td><input type="hidden" name="YutongVisaGoodsAttachmentOldFiles['.$key.'][id]"  value="'.$attachment->id.'" ></tr>';
    }
}

?>

<tr  id="download-file-wrapper">
    <td colspan='6' align="center"><?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存'); ?></td>
</tr>
</tbody>
</table>
    <script type="text/javascript">
        $(document).ready(function(){
            $('select[name="YutongVisaGoods[country_id]"]').change(function(){
                updateType();
            });
            $('table.table').delegate('.deleteThis', 'click', function(){
               $(this).parent().parent().remove();
               var name_counter = 0;
               var input_counter = 0;
               $('table tr.file-item').each(function(){
                   $(this).children('td:first-child').html('<label>编号：</label>'+(name_counter+1));
                   if(!$(this).hasClass('old-file-item')){
                       var $this = $(this);
                       $this.find('input').each(function(){
                           console.log(this.name);
                           var strName = this.name;
                           strName = strName.replace(/[123456789]+/g,input_counter);
                           this.name = strName;
                       });
                       input_counter++;
                   }

                   name_counter++;
               });
            });
        });
        var chooseType;
        function updateType(){
            var country_id = $('select[name="YutongVisaGoods[country_id]"]').val();
            $.ajax({
                type: "POST",
                url: "<?php echo $this->createUrl('address/getTypesUnderCountry'); ?>",
                data: "country_id="+country_id,
                success:(function(data){
                    var data = eval("("+data+")");
                    chooseType = data;
                    var optionHtml = '';
                    for(i in data){
                        optionHtml += "<option value='"+data[i].id+"' data-price='"+data[i].price+"'  data-predict_date='"+data[i].predict_date+"'";
                        if(data[i].id == parseInt('<?php echo $model->type_id; ?>')){
                            optionHtml += " selected='selected'";
                            $('span#type_price').text(data[i].price);
                            $('span#type_notes').text(data[i].notes);
                        }
                        optionHtml += ">"+data[i].name+"</option>";
                    }
                    $('select[name="YutongVisaGoods[type_id]"]').html(optionHtml);
                    //updateTypeAttr();
                })
            })
        }
        updateType();

        function insertFiles(){
            var nameCount = $('tr.file-item').size();
            var filesCount = $('tr.file-item:not(.old-file-item)').size();
            str = '<tr class="file-item"><td><label>编号：</label>'+(nameCount+1)+'</td><td><input type="file" name="YutongVisaGoodsAttachmentFile['+filesCount+']"></td><td><label>标题：</label>：<input type="text" name="YutongVisaGoodsAttachment['+filesCount+'][attachment_title]"  value=""></td><td><label>内容：</label><input type="text" name="YutongVisaGoodsAttachment['+filesCount+'][attachment_desc]" value="" ></td><td><a class="btn btn-danger deleteThis">删除</a></td></tr>';
            //html = $.parseHTML(str);
            $('#download-file-wrapper').before(str);
        }


    </script>
<?php $this->endWidget(); ?>