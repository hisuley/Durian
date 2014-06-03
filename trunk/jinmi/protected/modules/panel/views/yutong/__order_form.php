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
<h1>#<?php echo $model->id.":".$model->visa->country->name."-".$model->visa->type->name."-".$model->company_name."[".$model->contact_name."]"."-".$model->amount."人" ?>
    <?php
        if(empty($model->is_pay)){
            $this->widget('bootstrap.widgets.TbButton', array(
                'type'=>'primary','buttonType'=>'link', 'url'=>$this->createUrl('yutong/financeConfirm', array('id'=>$model->id)), 'label'=>'财务确认'
            ));
        }

    ?>
</h1>
    <table class="table table-bordered">
        <tbody>
        <tr>
            <td><?php echo $form->labelEx($model,'user_id'); ?></td>
            <td><?php
                echo empty($model->author_id) ? Yii::app()->user->username : User::getUserRealname($model->user_id); ?></td>
            <td><?php echo $form->labelEx($model,'status'); ?></td>
            <td>
                <?php if(!empty($model->status)){
                    echo YutongVisaOrder::translateStatus($model->status);
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
            <td><?php echo $form->labelEx($model,'visa.country_id'); ?></td>
            <td>
                <?php

                echo $model->visa->country->name;
                ?>

            </td>
            <td><?php echo $form->labelEx($model,'visa.type_id'); ?></td>
            <td>
                <?php
                echo $model->visa->type->name;
                ?>
            </td>
            <td><?php echo $form->labelEx($model,'visa.type.source'); ?></td>
            <td>
                <?php echo empty($model->visa->type->source->name) ? '未设置': $model->visa->type->source->name; ?>

            </td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'customer'); ?></td>
            <td colspan="5">
                <?php echo YutongVisaOrder::joinCustomer($model->customers); ?>

            </td>
            </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'is_pay'); ?></td>
            <td>
                <?php
                    echo empty($model->is_pay) ? '未支付' : '已支付';
                    echo empty($model->accountant_id) ? '' : "&nbsp;[确认人：".User::getUserRealname($model->accountant_id)."]";
                ?>

            </td>
            <td><?php echo $form->labelEx($model,'pay_file'); ?></td>
            <td>
                <?php

                    echo empty($model->pay_file ) ? '' : CHtml::link("查看", Yii::app()->request->hostInfo."/upload/yutong/".$model->pay_file, array('target'=>'__BLANK'));

                ?>

            </td>
            <td><?php echo $form->labelEx($model, 'agency_id'); ?></td>
            <td>
                <?php
                echo empty($model->agency) ? '' : $model->agency->agency->name;

                ?>
            </td>
         </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'amount'); ?></td>
            <td>
                <?php echo $model->amount; ?>

            </td>
            <td><?php echo $form->labelEx($model,'price'); ?></td>
            <td>
                ￥<?php echo $model->price; ?>

            </td>
            <td><?php echo $form->labelEx($model,'single_price'); ?></td>
            <td>
                ￥<?php echo $model->single_price; ?>

            </td>
        </tr>

        <tr>
            <td><?php echo $form->labelEx($model,'address'); ?></td>
            <td colspan="5">
                公司名：<?php echo $model->company_name; ?><br />
                地址：<?php echo $model->contact_address."(".$model->contact_name." 收)  ".$model->contact_phone; ?>
            </td>
        </tr>

        </tbody>
    </table>
    <script type="text/javascript">
        $(document).ready(function(){
            $('select[name="YutongVisaGoods[country_id]"]').change(function(){

            });
        });



    </script>
    <div class="orderno" style="padding-bottom: 20px;padding-left:10px;">
            <?php
                if(YutongVisaOrder::checkIfCurrentOps($model->status, YutongVisaOrder::STATUS_SALES_ORDER)){
            ?>
            <ul class="orderse">
                <li><label>当前操作：</label>操作确认</li>
                <li >
                    <label>
                        确认人：</label>
                    <?php echo User::getUserRealname(Yii::app()->user->id); ?>
            </ul>

                    <label>备注：</label>
                    <?php echo $form->textArea($model, 'op_comment', array('rows'=>4, 'cols'=>70)); ?>
            <?php } ?>

        <?php
        if(YutongVisaOrder::checkIfCurrentOps($model->status, YutongVisaOrder::STATUS_OP_CONFIRM)){
            ?>
            <ul class="orderse">
                <li><label>当前操作：</label>材料收取确认</li>
                <li >
                    <label>
                        确认人：</label>
                    <?php echo User::getUserRealname(Yii::app()->user->id); ?>
            </ul>

            <label>备注：</label>
            <?php echo $form->textArea($model, 'material_comment', array('rows'=>4, 'cols'=>70)); ?>
        <?php } ?>

        <?php
        if(YutongVisaOrder::checkIfCurrentOps($model->status, YutongVisaOrder::STATUS_MT_VERIFY)){
            ?>
            <ul class="orderse">
                <li><label>当前操作：</label>资料审核</li>
                <li >
                    <label>
                        确认人：</label>
                    <?php echo User::getUserRealname(Yii::app()->user->id); ?>
            </ul>
            <label>需要补充的材料：</label>
            <?php echo $form->textField($model, 'mverify_resubmit'); ?>
            <br />
            <label>详细描述：</label>
            <?php echo $form->textArea($model, 'mverify_comment', array('rows'=>4, 'cols'=>70)); ?>
        <?php } ?>

        <?php
        if(YutongVisaOrder::checkIfCurrentOps($model->status, YutongVisaOrder::STATUS_SENTOUT)){
            ?>
            <ul class="orderse">
                <li><label>当前操作：</label>送签</li>
                <li >
                    <label>
                        确认人：</label>
                    <?php echo User::getUserRealname(Yii::app()->user->id); ?>

            </ul>
            <label>送签时间：</label>
            <?php

            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'attribute' => 'sent_out_time',
                'language'=>'zh-cn',
                'model'=>$model,
                'name'=>$model->sent_out_time,
                'options' => array(
                    'showAnim' => 'fold',
                    'dateFormat' => 'yy-mm-dd',
                    'minDate' => date('Y-m-d')
                ),
                'value'=>$model->sent_out_time
            )); ?>

            <label>预计出签：</label>
            <?php

            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'attribute' => 'sent_predict_time',
                'language'=>'zh-cn',
                'model'=>$model,
                'name'=>$model->sent_predict_time,
                'options' => array(
                    'showAnim' => 'fold',
                    'dateFormat' => 'yy-mm-dd',
                    'minDate' => date('Y-m-d')
                ),
                'value'=>$model->sent_predict_time
            ));?>
            <br />
            <label>面试情况：</label>
            <?php echo $form->textArea($model, 'sent_comment', array('rows'=>4, 'cols'=>70)); ?>
            <label>送签渠道：</label>
            <?php   echo $form->dropDownList($model ,'agency_id', CHtml::listData(VisaTypeAgency::model()->findAllByAttributes(array('type_id'=>$model->visa->type_id)), 'id', 'agency.name')); ?>
        <?php } ?>
        <?php
        if(YutongVisaOrder::checkIfCurrentOps($model->status, YutongVisaOrder::STATUS_ISSUE_VISA)){
            ?>
            <ul class="orderse">
                <li><label>当前操作：</label>出签</li>
                <li >
                    <label>
                        确认人：</label>
                    <?php echo User::getUserRealname(Yii::app()->user->id); ?>
                </li>
            </ul>
            <label>跟进人：</label>
            <?php echo $form->dropDownList($model, 'follow_id',  CHtml::listData(User::model()->findAll(), 'id', 'realname')); ?>
            <br />
            <label>结果：</label>
            <?php echo $form->textField($model, 'back_comment'); ?>
        <?php }elseif(YutongVisaOrder::checkIfCurrentOps($model->status, YutongVisaOrder::STATUS_SENTBACK)){ ?>
            <ul class="orderse">
                <li><label>当前操作：</label>寄回</li>
                <li >
                    <label>
                        确认人：</label>
                    <?php echo User::getUserRealname(Yii::app()->user->id); ?>
                </li>

            </ul>
            <label>寄回备注：</label>
            <?php echo $form->textField($model, 'delivery_comment'); ?>
        <?php }elseif(YutongVisaOrder::checkIfCurrentOps($model->status, YutongVisaOrder::STATUS_COMPLETE)){ ?>
            <ul class="orderse">
                <li><label>当前操作：</label>完成订单</li>
                <li >
                    <label>
                        确认人：</label>
                    <?php echo User::getUserRealname(Yii::app()->user->id); ?>
                </li>

            </ul>
        <?php } ?>

    </div>
<?php
if(YutongVisaOrder::checkStatusPos($model->status, YutongVisaOrder::STATUS_SALES_ORDER)){ ?>
    <div class="orstep">
        <ul class="title">
            <li style="width: 50%">&gt;&gt; 第一步&nbsp;下单成功 </li>
            <li style="width: 15%">
                <label>
                    操作人：<?php echo YutongUser::getUserRealname($model->op_id); ?></label></li>
            <li style="width: 35%">
                <label>
                    操作时间：<?php echo date('Y-m-d H:i:s', $model->op_time); ?></label>
            </li>
        </ul>
        <ul class="main">
            <li style="width: 100%">
                <label>
                    备 注：</label>
                <?php echo $model->op_comment; ?>
            </li>
        </ul>
    </div>
<?php } if(YutongVisaOrder::checkStatusPos($model->status, YutongVisaOrder::STATUS_OP_CONFIRM)){ ?>
    <div class="orstep">
        <ul class="title">
            <li style="width: 50%">&gt;&gt; 第二步&nbsp;已收证 </li>
            <li style="width: 15%">
                <label>
                    操作人：<?php echo YutongUser::getUserRealname($model->material_id); ?></label></li>
            <li style="width: 35%">
                <label>
                    操作时间：<?php echo date('Y-m-d H:i:s', $model->material_time); ?></label>
            </li>
        </ul>
        <ul class="main">
            <li style="width: 100%">
                <label>
                    收到资料时间：</label><?php echo date('Y-m-d H:i:s', $model->material_time); ?></li>
            <li style="width: 100%">
                <label>
                    已提交资料：</label><?php echo $model->material_comment; ?></li>
        </ul>
    </div>

<?php } if(YutongVisaOrder::checkStatusPos($model->status, YutongVisaOrder::STATUS_MT_VERIFY)){ ?>
    <div class="orstep">
        <ul class="title">
            <li style="width: 50%">&gt;&gt; 第三步&nbsp;资料审核
                <span>等待送签</span></li>
            <li style="width: 15%">
                <label>
                    操作人：<?php echo YutongUser::getUserRealname($model->mverify_id); ?></label>
            </li>
            <li style="width: 35%">
                <label>
                    操作时间：<?php echo date('Y-m-d H:i:s', $model->mverify_time); ?></label>
            </li>
        </ul>
        <ul class="main">
            <li style="width: 100%"><span style="float: left; width: 250px;">
                        <label>
                            需要补充的资料：</label><?php echo $model->mverify_resubmit; ?>
                    </span><span style="float: left; width: 560px;">
                    </span> </li>
            <li style="width: 100%">
                <label>
                    详细描述：</label><?php echo $model->mverify_comment; ?></li>
        </ul>
    </div>

<?php } if(YutongVisaOrder::checkStatusPos($model->status, YutongVisaOrder::STATUS_SENTOUT)){ ?>
    <div class="orstep">
        <ul class="title">
            <li style="width: 50%">&gt;&gt; 第四步&nbsp;已送签 </li>
            <li style="width: 15%">
                <label>
                    操作人：<?php echo YutongUser::getUserRealname($model->sent_id); ?></label></li>
            <li style="width: 35%">
                <label>
                    操作时间：<?php echo date('Y-m-d H:i:s', $model->sent_time); ?></label>
            </li>
        </ul>
        <ul class="main">
            <li style="width: 48%">
                <label>
                    送签时间：</label><?php echo date('Y-m-d H:i:s', $model->sent_out_time); ?></li>
            <li style="width: 50%">
                <label>
                    预计出证时间：</label><?php echo $model->sent_predict_time; ?></li>
            <li style="width: 100%">
                <label>
                    面试情况：</label><?php echo $model->sent_comment; ?></li>
            <li class="remark">出证时间为预计时间，签证未有结果前请不要出机票，一切损失自行承担. </li>
        </ul>
    </div>
<?php } if(YutongVisaOrder::checkStatusPos($model->status, YutongVisaOrder::STATUS_ISSUE_VISA)){ ?>
    <div class="orstep">
        <ul class="title">
            <li style="width: 50%">&gt;&gt;第五步&nbsp;已出结果 </li>
            <li style="width: 15%">
                <label>
                    操作人：<?php echo YutongUser::getUserRealname($model->back_id); ?></label></li>
            <li style="width: 35%">
                <label>
                    操作时间：<?php echo date('Y-m-d H:i:s', $model->back_time); ?></label>
            </li>
        </ul>
        <ul class="main">
            <li style="width: 46%; color: Red;">
                <label style="color: Red;">
                    签证结果：</label><?php echo $model->back_comment; ?></li>
            <li style="width: 50%">
                <label>
                    指派跟进人：</label><?php echo YutongUser::getUserRealname($model->follow_id); ?></li>
        </ul>
    </div>
<?php } if(YutongVisaOrder::checkStatusPos($model->status, YutongVisaOrder::STATUS_SENTBACK)){ ?>
    <div class="orstep">
        <ul class="title">
            <li style="width: 50%">&gt;&gt;第六步&nbsp;寄回 </li>
            <li style="width: 15%">
                <label>
                    操作人：<?php echo YutongUser::getUserRealname($model->delivery_id); ?></label></li>
            <li style="width: 35%">
                <label>
                    操作时间：<?php echo date('Y-m-d H:i:s', $model->delivery_time); ?></label>
            </li>
        </ul>
        <ul class="main">
            <li style="width: 99%; ">
                <label>寄回备注：</label><?php echo $model->delivery_comment; ?></li>
        </ul>
    </div>
<?php } ?>

<?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存'); ?>
<?php $this->endWidget(); ?>
<style>
    .orderno{
        border:1px solid #b9d6db;
        padding-left:5px;
        margin:10px 0 10px 0;
    }
    .orderse{
        padding:10px 0 0px 0;
        overflow:hidden;
    }
    .orderse li{
        float:left;
        width:49%;
    }
    .orderse li label{
        color:#656565;
        display:inline-block;
        width:100px;
    }
    .orstep{
        border:1px solid #91b3e6;
        overflow:hidden;
        margin-top:10px;
    }
    .orstep .title{
        overflow:hidden;
        padding:5px;
        border-bottom:1px solid #91b3e6;
        background-color:#d9e4f7;
        margin-bottom:10px;
    }
    .orstep .title li{
        float:left;
    }
    .orstep label{
        color:#656565;
    }
    .orstep .main{
        width:95%;
        margin:0 auto;
        overflow:hidden;
        border:1px solid #C9F;
        padding:5px;
        line-height:20px;
        margin-bottom:10px;
        background-color:#e3ecfb;
    }
    .orstep .main li label{
        width:100px;
        display:inline-block;
        text-align:right;
    }
    .orstep .main li{
        float:left;
    }
    .orstep .remark{
        color:red;
        width:100%;
        text-align:center;
    }
    .ods{
        margin-top:10px;
        text-align:center;
    }
</style>