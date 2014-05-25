<?php
/**
 * @project: trunk
 * @file: form.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-4-8
 * @time: 下午1:30
 * @version: 1.0
 */
$this->widget('ext.kindeditor.KindEditorWidget',array(
    'id'=>CHtml::activeId($model, 'content'),   //Textarea id
    // Additional Parameters (Check http://www.kindsoft.net/docs/option.html)
    'items' => array(
        'width'=>'700px',
        'height'=>'300px',
        'themeType'=>'simple',
        'allowImageUpload'=>true,
        'allowFileManager'=>true,
        'items'=>array(
            'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic',
            'underline', 'removeformat', '|', 'justifyleft', 'justifycenter',
            'justifyright', 'insertorderedlist','insertunorderedlist', '|',
            'emoticons', 'image', 'link',),
    ),
));
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array('id' => 'article-form'));

?>
    <h2><?php echo $model->isNewRecord ? '添加资讯' : "编辑资讯"; ?></h2>
    <table class="table table-bordered">
        <tbody>
        <tr>
            <td><?php echo $form->labelEx($model, 'title'); ?></td>
            <td><?php
                echo $form->textField($model, 'title');
                echo $form->error($model, 'title'); ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model, 'continent_id'); ?></td>
            <td>
                <?php echo CHtml::dropDownList('continent_id', '',CHtml::listData(
                        Address::model()->findAll('(parent_id IS NULL OR parent_id = 0 OR parent_id = "")', array()), 'id', 'name'),
                    array(
                        'ajax' => array(
                            'type' => "POST",
                            'url' => $this->createUrl('address/getCountriesList'),
                            'update' => "#" . CHtml::activeId($model, 'related_country_id'),
                            'data' => array(
                                'continent_id' => 'js:$("#continent_id").val()'
                        )
                    )
                ));
                ?>
            </td>
            <td>
                <?php echo $form->labelEx($model, 'related_country_id'); ?>
            </td>
            <td>
                <?php echo $form->dropDownList($model, 'related_country_id', array(0=>'-请选择-')); ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model, 'content'); ?></td>
            <td><?php echo $form->textArea($model, 'content', array('visibility'=>'hidden')); ?></td>
            <td><?php echo $form->error($model, 'content'); ?></td>
        </tr>

        </tbody>
    </table>

<?php $this->endWidget(); ?>