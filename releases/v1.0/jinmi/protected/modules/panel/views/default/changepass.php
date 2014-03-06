<?php
/**
 * Created by Suley.
 * @author: suley<dearsuley@gmail.com>
 * @date: 1/24/14
 * @time: 7:09 PM
 */

$form=$this->beginWidget('CActiveForm', array(
    'id'=>'user-form',
    'enableClientValidation' => true,
    'htmlOptions'=>array(
        'role'=>'form','class'=>'form-horizontal'
    )
));

?>

<?php echo $form->errorSummary($model); ?>
<div class="form-group">
    <?php
        echo $form->labelEx($model, 'password', array('class'=>'col-sm-2 control-label'));
    ?>
    <div class="col-sm-10">
        <?php
            echo $form->passwordField($model, 'password', array('class'=>'form-control'));
        ?>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-2 control-label">再次输入</label>
    <div class="col-sm-10">
        <?php
            echo $form->passwordField($model, 'password2', array('class'=>'form-control'));
        ?>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">保存</button>
    </div>
</div>
<?php $this->endWidget(); ?>


