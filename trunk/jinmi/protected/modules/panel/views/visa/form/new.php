<?php
/**
 * Created by PhpStorm.
 * User: suley
 * Date: 1/21/14
 * Time: 2:36 AM
 */


echo "<h2>";
if(empty($model->isNewRecord)){
    echo "订单#".$model->id."-".$model->country_source->name."-".$model->amount."人-".$model->order_source->name."&nbsp;<small><a class='btn btn-info' href=\"".$this->createUrl("visa/list")."\">返回</a></small>";
}else{
    echo "添加订单";
}
echo "</h2>";
?>


<?php
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'order-form',
    'enableClientValidation' => true,
    'clientOptions'=> array('validateOnSubmit'=>true,
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
<?php echo $form->errorSummary($model); ?>
    <table class="table table-bordered">
        <tbody>
        <tr>
            <td><?php echo $form->labelEx($model,'user_id'); ?></td>
            <td><?php
                echo empty($model->user_id) ? Yii::app()->user->username : User::getUserRealname($model->user_id); ?></td>
            <td><?php echo $form->labelEx($model,'status'); ?></td>
            <td>
                <?php if(!empty($model->status)){
                    echo VisaOrder::translateStatus($model->status);
                }else{
                    echo "新下单";
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
            <td><?php echo $form->labelEx($model,'is_pay'); ?></td>
            <td><?php

                    echo $model->is_pay ? '已支付' : '未支付';

                ?></td>
            <td><?php echo $form->labelEx($model,'accountant_id'); ?></td>
            <td>
                <?php if(!empty($model->accountant_id)){
                    echo User::getUserRealname($model->accountant_id);
                }else{
                    echo '未审核';
                }
                ?>
            </td>
            <td><?php echo $form->labelEx($model,'pay_cert'); ?></td>
            <td>
                <?php
                if(!empty($model->financeRecord) && !empty($model->financeRecord->record->pay_file)){
                    $this->widget('ext.lyiightbox.LyiightBox2', array(
                        'thumbnail' => GlobalHelper::getThumbnail("/panel/".$model->financeRecord->record->pay_file, 60),
                        'image' => GlobalHelper::getThumbnail("/panel/".$model->financeRecord->record->pay_file, 800, 'width'),
                        'title' => '水单.'
                    ));
                }

                ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'country'); ?></td>
            <td>
                <?php

                if($model->is_pay_out || (PanelUser::checkAttributesAccess('country', $model) && VisaOrder::compareStatus($model->status, VisaOrder::STATUS_PARTIAL_SENT))){
                    echo $model->country_source->name;
                }else{
                    echo $form->dropDownList($model, 'country',
                        CHtml::listData(Address::model()->findAll('parent_id > 0'), 'id', 'name', 'parent.name'), array('readonly'=> PanelUser::checkAttributesAccess('country', $model),'style'=>'width:100px;')
                    );
                }
                ?>

            </td>
            <td><?php echo $form->labelEx($model,'type'); ?></td>
            <td>
                <?php
                if($model->is_pay_out || (PanelUser::checkAttributesAccess('type', $model) && VisaOrder::compareStatus($model->status, VisaOrder::STATUS_PARTIAL_SENT))){
                    echo $model->order_type->name;
                }else{
                    echo $form->dropDownList($model, 'type',
                        array('0'=>'请选择国家'), array('readonly'=> PanelUser::checkAttributesAccess('type', $model),'style'=>'width:100px;')
                    );} ?>
            </td>
        </tr>
        <?php if(!PanelUser::checkAttributesAccess('agency_id', $model)){ ?>
        <tr>
            <td>
                <label>送签渠道</label>
            </td>
            <td><?php echo empty($model->agency->agency->name) ? '' : $model->agency->agency->name; ?></td>
            <td><label for="">参考价格</label></td>
            <td><?php echo empty($model->agency->price) ? '' : $model->agency->price; ?></td>
            <td><label for="">备注</label></td>
            <td>
                <?php echo empty($model->agency->notes) ? '' : $model->agency->notes; ?>
            </td>
        </tr>
    <?php } ?>
        <tr>
            <td><?php echo $form->labelEx($model,'amount'); ?></td>
            <td>
                <?php
                if(PanelUser::checkAttributesAccess('amount', $model) || $model->is_pay || $model->is_pay_out){
                    echo $model->amount;
                }else{
                    echo $form->textfield($model, 'amount', array('readonly'=> true));
                    echo $form->error($model,'amount');
                }
                ?>

            </td>
            <td><?php echo $form->labelEx($model,'price'); ?></td>
            <td>
                <?php
                if(PanelUser::checkAttributesAccess('price', $model) || $model->is_pay){
                    echo $model->price;
                }else{
                    echo $form->textfield($model, 'price', array('readonly'=> PanelUser::checkAttributesAccess('price', $model)));
                    echo $form->error($model,'price');
                }
                    ?>
            </td>
            <td>
                <label>总价</label>
            </td>
            <td>
                <?php echo $model->total_price; ?>
            </td>
            </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'depart_date'); ?></td>
            <td>
                <?php
                if(PanelUser::checkAttributesAccess('depart_date', $model)){
                    echo $model->depart_date;
                }else{
                    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'attribute' => 'depart_date',
                        'language'=>'zh-cn',
                        'model'=>$model,
                        'name'=>$model->depart_date,
                        'options' => array(
                            'showAnim' => 'fold',
                            'dateFormat' => 'yy-mm-dd',
                            'minDate' => date('Y-m-d')
                        ),
                        'value'=>$model->depart_date
                    ));
                    echo $form->error($model,'depart_date');
                }

                ?>
            </td>
            <td><?php echo $form->labelEx($model,'source'); ?></td>
            <td colspan="3">
                <?php
                if(PanelUser::checkAttributesAccess('source', $model)){
                    echo $model->order_source->name;
                }else{
                    echo $form->dropDownList($model, 'source',
                        CHtml::listData($sourceModel, 'id', 'name'), array('readonly'=> PanelUser::checkAttributesAccess('source', $model))
                    );
                    echo CHtml::link('设置为订单联系人', '#', array('class'=>'btn btn-primary btn-small', 'style'=>'margin-left:10px','id'=>'setSourceAsContactBtn'));
                }

                ?>
                <?php echo $form->error($model,'contact_name'); ?>

            </td>


        </tr>
        <tr>
            <td colspan="6"><?php echo $form->labelEx($model,'customer'); ?></td>

        </tr>

        <?php
            if(isset($model->customer)){
                if(PanelUser::checkAttributesAccess('customer', $model)  || $model->status == VisaOrder::STATUS_SALES_ORDER){
                    foreach($model->customer as $key=>$v){
                        echo '<tr><td><label>客人'.($key+1).'姓名：</label></td><td>'.$v->name.'</td><td><label>护照号：</label></td><td>'.$v->passport.'</td>';
                        echo "<td>";
                        echo empty($v->agencyType->agency->name) ? "" : "出签渠道：".$v->agencyType->agency->name;
                        echo "</td>";
                        /*
                        if($v->status == VisaOrderCustomer::STATUS_DEFAULT){
                            echo '<td><a href="#" data-customer-id="'.$v->id.'" class="btn btn-default btn-small btn-info confirmIssued">出签</a></td>';
                        }else{
                            echo '<td>已出签</td>';
                        }*/
                        echo "<td>";
                        switch($v->status){
                            case VisaOrderCustomer::STATUS_DEFAULT:
                                echo "未送签";
                                break;
                            case VisaOrderCustomer::STATUS_SENTOUT:
                                echo "已送签";
                                break;
                            case VisaOrderCustomer::STATUS_REJECT:
                                echo "已拒签";
                                break;
                            case VisaOrderCustomer::STATUS_ISSUED:
                                echo "已出签";
                                break;
                        }
                        echo "</td>";
                        echo '</tr>';
                    }
                }else{
                    foreach($model->customer as $key=>$v){
                        echo '<tr class="visa-person-item"><td><label>客人'.($key+1).'姓名：</label></td><td><input type="text" name="VisaOrderCustomer[name][]" ';
                        if(PanelUser::checkAttributesAccess('customer', $model)){
                            echo ' readonly=readonly ';
                        }
                        echo ' value="'.$v->name.'" /></td><td><label>护照号：</label></td><td><input type="text"  name="VisaOrderCustomer[passport][]"';
                        if(PanelUser::checkAttributesAccess('customer', $model)){
                            echo ' readonly=readonly ';
                        }
                        echo ' value="'.$v->passport.'" /></td>';
                        if(!PanelUser::checkAttributesAccess('customer', $model)){
                            echo '<td>出签渠道：';
                            echo empty($v->agencyType) ? ''.(CHtml::dropDownList('VisaOrderCustomer['.$v->id.'][agency_id]', 0,
                                    CHtml::listData(VisaTypeAgency::model()->findAllByAttributes(array('type_id'=>$model->type)), 'id', 'agency.name'), array('style'=>'width:100px;'))) : $v->agencyType->agency->name;
                            echo '</td>';
                            if($v->status == VisaOrderCustomer::STATUS_DEFAULT){
                                if(empty($v->is_pay_out) && empty($v->is_pay)){
                                    echo '<td><a href="#" class="btn btn-default btn-small btn-danger deleteThis">删除</a>&nbsp;<a href="#" data-customer-id="'.$v->id.'" class="btn btn-default btn-small btn-info sentVisa">送签</a></td>';
                                }else{
                                    echo '<td><a href="#" data-customer-id="'.$v->id.'" class="btn btn-default btn-small btn-info sentVisa">送签</a></td>';
                                }

                            }elseif($v->status == VisaOrderCustomer::STATUS_SENTOUT){
                                if(empty($v->is_pay_out) && empty($v->is_pay)){
                                    echo '<td><a href="#" class="btn btn-default btn-small btn-danger deleteThis">删除</a>&nbsp;<a href="#" data-customer-id="'.$v->id.'" class="btn btn-default btn-small btn-info confirmIssued">出签</a>&nbsp;<a href="#" data-customer-id="'.$v->id.'" class="btn btn-default btn-small btn-danger rejectVisa">拒签</a></td>';
                                }else{
                                    echo '<td><a href="#" data-customer-id="'.$v->id.'" class="btn btn-default btn-small btn-info confirmIssued">出签</a>&nbsp;<a href="#" data-customer-id="'.$v->id.'" class="btn btn-default btn-small btn-danger rejectVisa">拒签</a></td>';
                                }
                            }elseif($v->status == VisaOrderCustomer::STATUS_REJECT){
                                echo '<td class="error">已拒签</td>';
                            }elseif($v->status == VisaOrderCustomer::STATUS_ISSUED){
                                echo '<td>已出签</td>';
                            }

                        }else{
                            echo "<td></td>";
                        }
                        echo '<td style="display:none;" ><input type="hidden" name="VisaOrderCustomer[id][]" value="'.$v->id.'"/></td>';
                        echo "</tr>";
                    }
                }

            }
        ?>
        <tr class="add-visa-before">
            <td colspan="6">
                <?php
                if(!PanelUser::checkAttributesAccess('customer', $model) || $model->is_pay || $model->is_pay_out){
                    echo '<a href="#" class="btn btn-default btn-small add-visa-person">添加</a>';
                }
                ?>
            </td>
        </tr>
        <tr>
           <td><?php echo $form->labelEx($model,'contact_name'); ?></td>
            <td><?php
                if(PanelUser::checkAttributesAccess('contact_name', $model)){
                    echo $model->contact_name;
                }else{
                    echo $form->textfield($model, 'contact_name', array('readonly'=> PanelUser::checkAttributesAccess('contact_name', $model)));
                    echo $form->error($model,'contact_name');
                }

                ?></td>
           <td><?php echo $form->labelEx($model,'contact_phone'); ?></td>
            <td><?php
                if(PanelUser::checkAttributesAccess('contact_phone', $model)){
                    echo $model->contact_phone;
                }else{
                    echo $form->textfield($model, 'contact_phone', array('readonly'=> PanelUser::checkAttributesAccess('contact_phone', $model)));
                    echo $form->error($model,'contact_phone');
                }
                ?></td>
            <td><?php echo $form->labelEx($model,'contact_address'); ?></td>
            <td colspan="3">
                <?php
                if(PanelUser::checkAttributesAccess('contact_address', $model)){
                    echo $model->contact_address;
                }else{
                    echo $form->textfield($model, 'contact_address', array('readonly'=> PanelUser::checkAttributesAccess('contact_address', $model)));
                    echo $form->error($model,'contact_address');
                }
                ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'memo'); ?></td>
            <td colspan="5">
                <?php

                    echo str_replace("\n", '<br />', $model->memo)."<br />";
                    echo $form->textArea($model, 'memo', array('rows'=>7, 'cols'=>70, 'value'=>''));
                    echo $form->error($model,'memo');
                ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'material'); ?></td>
            <td colspan="5">
                <?php
                if(PanelUser::checkAttributesAccess('material', $model)){
                    $materialLabel = array('photo'=>'照片', 'passport'=>'护照', 'residence'=>'户口本', 'financeproof'=>'财力证明', 'id'=>'身份证');
                    foreach($model->material as $v){
                        echo $materialLabel[$v]."<br />";
                    }
                }else{
                    echo $form->checkBoxList($model, 'material', array('photo'=>'照片', 'passport'=>'护照', 'residence'=>'户口本', 'financeproof'=>'财力证明', 'id'=>'身份证'), array('readonly'=> PanelUser::checkAttributesAccess('material', $model)));
                    echo $form->error($model,'material');
                }
                ?>
            </td>
        </tr>
        <?php if(!empty($model->id)){ ?>
        <tr>
            <td colspan="6" align="center" style="text-align:center;" >操作审核[<?php

                if(empty($model->op_id)){
                    if($model->status == VisaOrder::STATUS_SALES_ORDER && !PanelUser::checkAttributesAccess('op_id', $model)){
                        echo CHtml::link('审核', $this->createUrl('visa/verify', array('id'=>$model->id, 'type'=>'op_comment')), array('class'=>'btn btn-default btn-small verify-button'));
                    }
                }else{
                    echo "操作员：".User::getUserRealname($model->op_id)."|审核时间：".date('Y-m-d H:i', $model->op_time);
                }

                ?>]</td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'op_comment'); ?></td>
            <td colspan="5" id="op_container">
                <?php echo !empty($model->op_comment) ? $model->op_comment : ''; ?>
            </td>

        </tr>
        <tr>
            <td colspan="6" align="center" style="text-align:center;" >送签确认[
                <?php
                if(empty($model->sent_id) || $model->status == VisaOrder::STATUS_OP_CONFIRM){
                    if($model->status == VisaOrder::STATUS_OP_CONFIRM && !PanelUser::checkAttributesAccess('sent_id', $model)){
                        echo CHtml::link('审核', $this->createUrl('visa/verify', array('id'=>$model->id, 'type'=>'sent_comment')), array('class'=>'btn btn-default btn-small verify-button'));
                    }elseif($model->status == VisaOrder::STATUS_PARTIAL_SENT){
                        echo "部分送签";
                    }
                }else{
                    echo "送签员：".User::getUserRealname($model->sent_id);
                }

                ?>
                ]</td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'sent_time'); ?></td>
            <td>
                <?php echo !empty($model->sent_time) ? date('Y-m-d',$model->sent_time) : ''; ?>
            </td>
            <td><?php echo $form->labelEx($model,'sent_comment'); ?></td>
            <td colspan="3" id="sent_container">
                <?php echo !empty($model->sent_comment) ? $model->sent_comment : ''; ?>
                <?php echo !empty($model->agency) ? "<br />送签渠道：".$model->agency->agency->name : ''; ?>
            </td>
        </tr>
        <tr>
            <td colspan="6" align="center" style="text-align:center;" >出签确认[
                <?php
                if(empty($model->issue_id)){
                    if($model->status == VisaOrder::STATUS_SENTOUT && !PanelUser::checkAttributesAccess('issue_id', $model)){
                        echo CHtml::link('审核', $this->createUrl('visa/verify', array('id'=>$model->id, 'type'=>'issue_comment')), array('class'=>'btn btn-default btn-small verify-button'));
                    }
                }else{
                    echo "收签员：".User::getUserRealname($model->issue_id);
                }

                ?>
                ]</td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'issue_time'); ?></td>
            <td>
                <?php echo !empty($model->issue_time) ? date('Y-m-d',$model->issue_time) : ''; ?>
            </td>
            <td><?php echo $form->labelEx($model,'issue_comment'); ?></td>
            <td colspan="3">
                <?php echo !empty($model->issue_comment) ? $model->issue_comment : ''; ?>
            </td>
        </tr>
        <tr>
            <td colspan="6" align="center" style="text-align:center;" >寄回确认[
                <?php
                if(empty($model->back_id) || true){
                    if($model->status == VisaOrder::STAUTS_ISSUE_VISA && !PanelUser::checkAttributesAccess('back_id', $model)){
                        echo CHtml::link('审核', $this->createUrl('visa/verify', array('id'=>$model->id, 'type'=>'back_comment')), array('class'=>'btn btn-default btn-small verify-button'));
                    }
                }else{
                    echo "经手人：".User::getUserRealname($model->back_id);
                }

                ?>
                ]</td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'back_time'); ?></td>
            <td>
                <?php echo !empty($model->back_time) ? date('Y-m-d',$model->back_time) : ''; ?>
            </td>
            <td><?php echo $form->labelEx($model,'back_comment'); ?></td>
            <td colspan="3">
                <?php echo !empty($model->back_comment) ? $model->back_comment : ''; ?>
            </td>
        </tr>
            <?php
                if(!empty($model->financeRecord)){
                    echo "<tr>";
                    echo "<td>收款记录</td>";
                    echo "<td colspan='3'>时间：".date("Y-m-d h:i", $model->financeRecord->create_time)."&nbsp;操作人：".User::getUserRealname($model->financeRecord->record->handler)."&nbsp;审批人：".User::getUserRealname($model->financeRecord->record->reviewer)."&nbsp;金额：".$model->financeRecord->transaction_value."&nbsp;".CHtml::link("申请撤销", array("finance/cancel", "id"=>$model->financeRecord->id))."&nbsp;".CHtml::link("查看", array("finance/view", "id"=>$model->financeRecord->record->id))."</td>";
                    echo "</tr>";
                }
            ?>
        <?php } ?>
        <tr>
            <td colspan='6' align="center"><?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存',array('class'=>'btn btn-primary')); ?></td>
        </tr>
        </tbody>
    </table>

<?php $this->endWidget(); ?>
<script type="text/javascript">
    jQuery.noConflict();
    jQuery('document').ready(function(){
        jQuery('.add-visa-person').click(function(){
            var personCount = jQuery('.visa-person-item').length+1;
            var visaHtml = '<tr class="visa-person-item"><td><label>客人'+personCount+'姓名：</label></td><td><input type="text" name="VisaOrderCustomer[name][]"></td><td><label>护照号：</label></td><td><input type="text"  name="VisaOrderCustomer[passport][]"></td><td><a href="#" class="btn btn-default btn-small btn-danger deleteThis">删除</a><input type="hidden" name="VisaOrderCustomer[id][]" value="0"/></td></tr>';
            jQuery('.add-visa-before').before(visaHtml);
            jQuery('#VisaOrder_amount').val(personCount);
            return false;
        });
        jQuery('table.table').delegate('a.deleteThis', 'click', function(){
            var personCount = 0;
            jQuery(this).parent().parent().remove();
            jQuery('tr.visa-person-item').each(function(index,element){
                personCount++;
                jQuery(this).children('td').first().html('<label>客人'+(index+1)+'姓名：</label>');
            });
            //var personCount = jQuery('visa-person-item').length+1;
            jQuery('#VisaOrder_amount').val(personCount);
            return false;
        });
        jQuery('input.unlock-amount').click(function(){
            if(jQuery(this).prop('checked') == true){
                jQuery('input#VisaOrder_amount').attr('readonly', false);
                jQuery('a.add-visa-person').hide();
            }else{
                jQuery('input#VisaOrder_amount').val('0');
                jQuery('input#VisaOrder_amount').attr('readonly', true);
                jQuery('a.add-visa-person').show();
            }
        });
        jQuery('select[name="VisaOrder[country]"]').change(function(){
            updateType();
        });
        jQuery('select[name="VisaOrder[type]"]').change(function(){
            //updateTypeAttr();
        });
        <?php
        if(!PanelUser::checkAttributesAccess('contact_name', $model)){ ?>
            jQuery('#setSourceAsContactBtn').click(function(){
                var sourceId = jQuery('select[name="VisaOrder[source]"]').val();
                var sourceContact = sourceList[sourceId];
                jQuery('input[name="VisaOrder[contact_name]"]').val(sourceContact.contact_name);
                jQuery('input[name="VisaOrder[contact_phone]"]').val(sourceContact.contact_phone);
                jQuery('input[name="VisaOrder[contact_address]"]').val(sourceContact.contact_address);
                return false;
            });
        <?php } ?>

        jQuery('.confirmIssued').click(function(){
           var customerId = jQuery(this).data('customer-id');
           var thisObj = jQuery(this);
            jQuery.ajax({
                type : "POST",
                url : '<?php echo $this->createUrl('visa/confirmCustomerIssued'); ?>',
                data : {id:customerId}
            }).done(function(msg){
                console.log(msg);
                thisObj.parent().text('已出签');
            });
            return false;
        });

        jQuery('.sentVisa').click(function(){
            var customerId = jQuery(this).data('customer-id');
            var thisObj = jQuery(this);
            var agencyTypeId = jQuery("#VisaOrderCustomer_"+customerId+"_agency_id").val();
            if(isNaN(agencyTypeId) || agencyTypeId <= 0){
                alert("请选择出签渠道再使用出签功能！");
                return false;
            }
            var selected =  jQuery("#VisaOrderCustomer_"+customerId+"_agency_id").find("option:selected").text();
            jQuery.ajax({
                type : "POST",
                url : '<?php echo $this->createUrl('visa/confirmCustomerSent'); ?>',
                data : {id:customerId, agency_id:agencyTypeId}
            }).done(function(msg){
                console.log(msg);
                thisObj.parent().prev().text("送签渠道："+selected);
                thisObj.parent().text('已送签');
            });
            return false;
        });

        jQuery('.rejectVisa').click(function(){
            var customerId = jQuery(this).data('customer-id');
            var thisObj = jQuery(this);
            jQuery.ajax({
                type : "POST",
                url : '<?php echo $this->createUrl('visa/confirmCustomerReject'); ?>',
                data : {id:customerId}
            }).done(function(msg){
                console.log(msg);
                thisObj.parent().text('已被拒签');
            });
            return false;
        });

        updateType();
    });
    var chooseType;
    function updateType(){
        var country_id = jQuery('select[name="VisaOrder[country]"]').val();
        jQuery.ajax({
            type: "POST",
            url: "<?php echo $this->createUrl('address/getTypesUnderCountry'); ?>",
            data: "country_id="+country_id,
            success:(function(data){
                //console.log(data);
                var data = eval("("+data+")");
                chooseType = data;
                var optionHtml = '';
                for(i in data){
                    optionHtml += "<option value='"+data[i].id+"' data-price='"+data[i].price+"'  data-predict_date='"+data[i].predict_date+"'";
                    if(data[i].id == parseInt('<?php echo $model->type; ?>')){
                        optionHtml += " selected='selected'";
                        jQuery('span#type_price').text(data[i].price);
                        jQuery('span#type_notes').text(data[i].notes);
                    }
                    optionHtml += ">"+data[i].name+"</option>";
                }
                jQuery('select[name="VisaOrder[type]"]').html(optionHtml);
                /*updateTypeAttr();*/
            })
        })
    }

    var sourceList = {};
    <?php foreach($sourceModel as $source){
        echo 'sourceList['.$source->id.'] = {"contact_name":"'.$source->contact_name.'","contact_phone":"'.$source->contact_phone.'","contact_address":"'.$source->contact_address.'"};'."\n";
    }?>
</script>
