<?php
/**
 * Created by PhpStorm.
 * User: suley
 * Date: 1/21/14
 * Time: 2:36 AM
 */

$form=$this->beginWidget('CActiveForm', array(
    'id'=>'order-form',
    'enableClientValidation' => true
));
?>
<?php echo $form->errorSummary($model); ?>
<form method="post">
    <table class="table table-bordered">
        <tbody>
        <tr>
            <td><?php echo $form->labelEx($model,'user_id'); ?></td>
            <td><?php echo Yii::app()->user->username; ?></td>
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
                if(PanelUser::checkAttributesAccess('is_pay', $model)){
                    echo $model->is_pay ? '已支付' : '未支付';
                }else{
                    echo $form->radioButtonList($model, 'is_pay', array(0=>'未支付', 1=>'已支付'), array('disabled'=> PanelUser::checkAttributesAccess('is_pay', $model, ($model->is_pay) ? true : false))) ;
                }


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

                if(!empty($model->pay_cert)){
                    $img = "upload/panel/".$model->pay_cert;
                    if(!empty($img) && 0){
                        $this->beginWidget('application.extensions.thumbnailer.Thumbnailer', array(
                                'thumbsDir' => 'upload/panel/thumbs',
                                'thumbWidth' => 50,// Optional
                            )
                        ); ?>

                        <img src="<?php echo str_replace(Yii::getPathOfAlias('webroot'), '', $img); ?>" />

                        <?php $this->endWidget();
                    }else{
                        echo "已上传，<a href='".Yii::app()->request->baseUrl."/".$img."' target='_BLANK'>查看</a>";
                    }
                }else{
                    echo '未上传';

                }
                if(!PanelUser::checkAttributesAccess('pay_cert', $model)){
                    $postUrl = $this->createUrl('default/update');
                    $this->widget('application.extensions.EAjaxUpload.EAjaxUpload',
                        array(
                            'id'=>'uploadFile',
                            'config'=>array(
                                'action'=>Yii::app()->createUrl('panel/default/upload'),
                                'allowedExtensions'=>array("jpg","jpeg","gif","png","bmp"),//array("jpg","jpeg","gif","exe","mov" and etc...
                                'sizeLimit'=>1000*1024*1024,// maximum file size in bytes
                                'minSizeLimit'=>1*1024,
                                'auto'=>true,
                                'multiple' => true,
                                'onComplete'=> "js:function(id, fileName, responseJSON){
                                    $('input[name=\'VisaOrder[pay_cert]\']').val(responseJSON['filename']);
                                 }",
                                'messages'=>array(
                                    'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                                    'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                                    'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                                    'emptyError'=>"{file} is empty, please select files again without it.",
                                    'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                                ),
                                'showMessage'=>"js:function(message){ alert(message); }"
                            )

                        ));
                }

                ?>
                <?php echo $form->hiddenField($model, 'pay_cert'); ?>
            </td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'country'); ?></td>
            <td>
                <?php

                if(PanelUser::checkAttributesAccess('country', $model)){
                    echo $model->country_source->name;
                }else{
                    echo $form->dropDownList($model, 'country',
                        Address::findCountry(), array('readonly'=> PanelUser::checkAttributesAccess('country', $model))
                    );
                }
                     ?>

            </td>
            <td><?php echo $form->labelEx($model,'type'); ?></td>
            <td>
                <?php
                if(PanelUser::checkAttributesAccess('type', $model)){
                    echo $model->order_type->name;
                }else{
                    echo $form->dropDownList($model, 'type',
                        array('0'=>'请选择国家'), array('readonly'=> PanelUser::checkAttributesAccess('type', $model))
                );} ?>
            </td>
            <td><?php echo $form->labelEx($model,'order_type'); ?></td>
            <td>

                价格：<span id='type_price'> <?php if(!empty($model->order_type)){ ?><?php echo $model->order_type->price; ?><?php } ?></span>
                <br />
                备注：<span id='type_notes'> <?php if(!empty($model->order_type)){ ?><?php echo $model->order_type->notes; ?><?php } ?></span>

            </td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'amount'); ?></td>
            <td>
                <?php
                if(PanelUser::checkAttributesAccess('amount', $model)){
                    echo $model->amount;
                }else{
                    echo $form->textfield($model, 'amount', array('readonly'=> PanelUser::checkAttributesAccess('amount', $model, true)));
                    echo $form->error($model,'amount');
                    echo '<input type="checkbox" class="unlock-amount" />解锁';
                }
                ?>

            </td>
            <td><?php echo $form->labelEx($model,'price'); ?></td>
            <td>
                <?php
                if(PanelUser::checkAttributesAccess('price', $model)){
                    echo $model->price;
                }else{
                    echo $form->textfield($model, 'price', array('readonly'=> PanelUser::checkAttributesAccess('price', $model)));
                    echo $form->error($model,'price');
                }
                    ?>
            </td>
            <td><?php echo $form->labelEx($model,'predict_date'); ?></td>
            <td>
                <?php
                if(PanelUser::checkAttributesAccess('predict_date', $model)){
                    echo $model->predict_date;
                }else{
                     echo $form->textfield($model, 'predict_date', array('readonly'=> PanelUser::checkAttributesAccess('predict_date', $model, true)));
                    echo $form->error($model,'predict_date');
                }
                    ?>
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
                    echo CHtml::link('设置为订单联系人', '#', array('class'=>'btn btn-primary btn-xs', 'style'=>'margin-left:10px','id'=>'setSourceAsContactBtn'));
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
                if(PanelUser::checkAttributesAccess('customer', $model)){
                    foreach($model->customer as $key=>$v){
                        echo '<tr><td><label>客人'.($key+1).'姓名：</label></td><td>'.$v->name.'</td><td><label>护照号：</label></td><td>'.$v->passport.'</td></tr>';
                    }
                }else{
                    foreach($model->customer as $key=>$v){
                        echo '<tr class="visa-person-item"><td><label>客人'.($key+1).'姓名：</label></td><td><input type="text" name="VisaOrderCustomer[name][]" ';
                        if(PanelUser::checkAttributesAccess('customer', $model)){
                            echo ' readonly=readonly ';
                        }
                        echo 'value="'.$v->name.'"></td><td><label>护照号：</label></td><td><input type="text"  name="VisaOrderCustomer[passport][]"';
                        if(PanelUser::checkAttributesAccess('customer', $model)){
                            echo ' readonly=readonly ';
                        }
                        echo 'value="'.$v->passport.'"></td>';
                        if(!PanelUser::checkAttributesAccess('customer', $model)){
                            echo '<td><a href="#" class="btn btn-default btn-xs btn-danger deleteThis">删除</a></td>';
                            if($v->status == VisaOrderCustomer::STATUS_DEFAULT){
                                echo '<td><a href="#" data-customer-id="'.$v->id.'" class="btn btn-default btn-xs btn-info confirmIssued">出签</a></td>';
                            }else{
                                echo '<td>已出签</td>';
                            }

                        }else{
                            echo "<td></td>";
                        }
                        echo '<input type="hidden" name="VisaOrderCustomer[id][]" value="'.$v->id.'"/>';
                        echo "</tr>";
                    }
                }

            }
        ?>
        <tr class="add-visa-before">
            <td colspan="6">
                <?php
                if(!PanelUser::checkAttributesAccess('customer', $model)){
                    echo ' <a href="#" class="btn btn-default btn-xs add-visa-person">添加</a>';
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
                    echo $form->checkBoxList($model, 'material', array('photo'=>'照片', 'passport'=>'护照', 'residence'=>'户口本', 'financeproof'=>'财力证明', 'id'=>'身份证'), array('disabled'=> PanelUser::checkAttributesAccess('material', $model)));
                    echo $form->error($model,'material');
                }
                ?>
            </td>
        </tr>
        <?php if(!empty($model->id)){ ?>
        <tr>
            <td colspan="6" align="center">操作审核[<?php

                if(empty($model->op_id)){
                    if($model->status == VisaOrder::STATUS_SALES_ORDER && !PanelUser::checkAttributesAccess('op_id', $model)){
                        echo CHtml::link('审核', $this->createUrl('visa/verify', array('id'=>$model->id, 'type'=>'op_comment')), array('class'=>'btn btn-default btn-xs verify-button'));
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
            <td colspan="6" align="center">送签确认[
                <?php
                if(empty($model->sent_id)){
                    if($model->status == VisaOrder::STATUS_OP_CONFIRM && !PanelUser::checkAttributesAccess('sent_id', $model)){
                        echo CHtml::link('审核', $this->createUrl('visa/verify', array('id'=>$model->id, 'type'=>'sent_comment')), array('class'=>'btn btn-default btn-xs verify-button'));
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
                <?php echo !empty($model->agency_source) ? "<br />送签旅行社：".$model->agency_source->name : ''; ?>
            </td>
        </tr>
        <tr>
            <td colspan="6" align="center">出签确认[
                <?php
                if(empty($model->issue_id)){
                    if($model->status == VisaOrder::STATUS_SENTOUT && !PanelUser::checkAttributesAccess('issue_id', $model)){
                        echo CHtml::link('审核', $this->createUrl('visa/verify', array('id'=>$model->id, 'type'=>'issue_comment')), array('class'=>'btn btn-default btn-xs verify-button'));
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
            <td colspan="6" align="center">寄回确认[
                <?php
                if(empty($model->back_id)){
                    if($model->status == VisaOrder::STAUTS_ISSUE_VISA && !PanelUser::checkAttributesAccess('back_id', $model)){
                        echo CHtml::link('审核', $this->createUrl('visa/verify', array('id'=>$model->id, 'type'=>'back_comment')), array('class'=>'btn btn-default btn-xs verify-button'));
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
        <?php } ?>
        <tr>
            <td colspan='6' align="center"><?php echo CHtml::submitButton($model->isNewRecord ? '创建' : '保存'); ?></td>
        </tr>
        </tbody>
    </table>
</form>
<script type="text/javascript">
    $(document).ready(function(){
        $('.add-visa-person').click(function(){
            var personCount = $('.visa-person-item').length+1;
            var visaHtml = '<tr class="visa-person-item"><td><label>客人'+personCount+'姓名：</label></td><td><input type="text" name="VisaOrderCustomer[name][]"></td><td><label>护照号：</label></td><td><input type="text"  name="VisaOrderCustomer[passport][]"></td><td><a href="#" class="btn btn-default btn-xs btn-danger deleteThis">删除</a></td></tr>';
            $('.add-visa-before').before(visaHtml);
            $('#VisaOrder_amount').val(personCount);
            return false;
        });
        $('table.table').delegate('a.deleteThis', 'click', function(){
            var personCount = 0;
            $(this).parent().parent().remove();
            $('tr.visa-person-item').each(function(index,element){
                personCount++;
                $(this).children('td').first().html('<label>客人'+(index+1)+'姓名：</label>');
            });
            //var personCount = $('visa-person-item').length+1;
            $('#VisaOrder_amount').val(personCount);
            return false;
        });
        $('input.unlock-amount').click(function(){
            if($(this).prop('checked') == true){
                $('input#VisaOrder_amount').attr('readonly', false);
                $('a.add-visa-person').hide();
            }else{
                $('input#VisaOrder_amount').val('0');
                $('input#VisaOrder_amount').attr('readonly', true);
                $('a.add-visa-person').show();
            }
        });
        $('select[name="VisaOrder[country]"]').change(function(){
            updateType();
        });
        $('select[name="VisaOrder[type]"]').change(function(){
            updateTypeAttr();
        });
        <?php
        if(!PanelUser::checkAttributesAccess('contact_name', $model)){ ?>
            $('#setSourceAsContactBtn').click(function(){
                var sourceId = $('select[name="VisaOrder[source]"]').val();
                var sourceContact = sourceList[sourceId];
                $('input[name="VisaOrder[contact_name]"]').val(sourceContact.contact_name);
                $('input[name="VisaOrder[contact_phone]"]').val(sourceContact.contact_phone);
                $('input[name="VisaOrder[contact_address]"]').val(sourceContact.contact_address);
                return false;
            });
        <?php } ?>

        $('.confirmIssued').click(function(){
           var customerId = $(this).data('customer-id');
           var thisObj = $(this);
            $.ajax({
                type : "POST",
                url : '<?php echo $this->createUrl('visa/confirmCustomerIssued'); ?>',
                data : {id:customerId}
            }).done(function(msg){
                console.log(msg);
                thisObj.parent().text('已出签');
            });
            return false;
        });


    });
    var chooseType;
    function updateType(){
        var country_id = $('select[name="VisaOrder[country]"]').val();
        $.ajax({
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
                        $('span#type_price').text(data[i].price);
                        $('span#type_notes').text(data[i].notes);
                    }
                    optionHtml += ">"+data[i].name+"</option>";
                }
                $('select[name="VisaOrder[type]"]').html(optionHtml);
                updateTypeAttr();
            })
        })
    }
    function updateTypeAttr(){
        var type_id = $('select[name="VisaOrder[type]"]').val();
        for(i in chooseType){
            if(chooseType[i].id == type_id){
                $('input[name="VisaOrder[predict_date]"]').val(chooseType[i].predict_date);
                $('span#type_price').text(' ');
                $('span#type_notes').text(' ');
                $('span#type_price').text(chooseType[i].price);
                $('span#type_notes').text(chooseType[i].notes);
            }
        }
    }
    updateType();
    var sourceList = {};
    <?php foreach($sourceModel as $source){
        echo 'sourceList['.$source->id.'] = {"contact_name":"'.$source->contact_name.'","contact_phone":"'.$source->contact_phone.'","contact_address":"'.$source->contact_address.'"};';
    }?>


</script>

<?php $this->endWidget(); ?>