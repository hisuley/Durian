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
        'height'=>'500px',
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
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array('id' => 'article-form', 'type'=>'horizontal'));

?>
<fieldset>
    <legend><?php echo $model->isNewRecord ? '添加资讯' : "编辑资讯"; ?></legend>

<?php
    echo $form->textFieldRow($model,'title');
    ?>

    <div class="row">
        <div class="span4">
            <div class="control-group ">
            <?php echo $form->labelEx($model, 'continent_id', array('class'=>'control-label')); ?>
            <div class="controls">
                <?php
                echo CHtml::dropDownList('continent_id', (empty($model->related_country->parent_id) ? '': $model->related_country->parent_id),CHtml::listData(
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
            </div>

            </div>
        </div>
        <div class="span4">
            <div class="control-group ">
            <?php echo $form->labelEx($model, 'related_country_id', array('class'=>'control-label')); ?>
            <div class="controls">
                <?php
                    echo $form->dropDownList($model, 'related_country_id', empty($model->related_country->parent_id) ? array(0=>'-请选择-'): CHtml::listData(Address::model()->findAllByAttributes(array('parent_id'=>$model->related_country->parent_id)), 'id', 'name')  );
                ?>
            </div>

            </div>
        </div>
    </div>

    <?php
    echo $form->textAreaRow($model, 'content');

?>
    <div class="form-actions">
        <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'submit',
                'type'=>'primary',
                'label'=>'保存',
            ));
        echo "&nbsp;";
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'link',
                'url'=>$this->createUrl('yutong/articleList'),
                'type'=>'info',
                'label'=>'返回',
            ));
        ?>
    </div>
</fieldset>
<?php $this->endWidget(); ?>