<?php
/**
 * @project: trunk
 * @file: indexGoods.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-5-8
 * @time: 下午6:54
 * @version: 1.0
 */


$form = $this->beginWidget('bootstrap.widgets.TbActiveForm');

?>
<fieldset>
    <legend>
        首页签证管理
    </legend>
    <?php
    echo $form->textFieldRow($model, 'meta_value', array('label'=>'签证', 'hint'=>'填写需要在首页展示的签证id号，并用英文逗号隔开。'));


    ?>
</fieldset>
<div class="form-actions">
    <?php
        $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'label'=>'保存'));
    ?>
</div>
<?php $this->endWidget(); ?>