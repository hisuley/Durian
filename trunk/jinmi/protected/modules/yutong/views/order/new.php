<div id="main">
<div id="vleft">

    <!--常用下载-->
    <ul class="titlelist">
        <li class="title"><span style="width: 52%"><b>·&nbsp;</b>常用下载</span>
            <span class="more"><a href="/Visa/VisaAssociationList?VisaAssociationType=MaterialDownload&amp;Keyword=%E8%8F%B2%E5%BE%8B%E5%AE%BE" target="_blank">
                    更多&gt;&gt;
                </a></span>
        </li>
    </ul>
    <br>
</div>
<div id="vright">
<div>
    <img src="/static/yutong/img/Nv/003.jpg"></div>
<script type="text/javascript">
    $(function(){
        //搜索国家
        $("#KeyWord").keyup(function () {
            var tThis = $(this);
            $("#likeSearch").remove();
            var valuess = tThis.val();

        }).focus(function(){
            countryFocus = true;
            var tThis = $(this);
            if(tThis.val()=="支持关键字和拼音模糊查询"){
                tThis.val("");
            }

            var tTop = tThis.parent("span").offset().top+tThis.height()+1;
            var tLeft = tThis.parent("span").offset().left;
            $(".popupcountry").css({ "top": tTop, "left": tLeft }).show();

            return false;
        });

    });
</script>
<form action="/Visa" id="searchFrm" method="get">    <ul class="findc">
        <li style="width: 15%;">
            <label>
                请输入国家名：</label></li>
        <li style="width: 400px;"><span>
            <input type="text" id="KeyWord" name="KeyWord" value="<?php echo $goodsModel->country->name; ?>" class="textbox  validate[required]" style="width: 355px; color: #999999;padding:5px; font-size:larger" maxlength="50">
        </span></li>
        <li style="width: 15%;">
            <input type="submit" class="btn" value="查询">
        </li>
    </ul>
</form>
<!--
    操作结果时，给出信息提示
-->
<form action="<?php echo $this->createUrl('order/new', array('id'=>$goodsModel->id)); ?>" id="createOrderFrm" method="post" onsubmit="return checkForm();">           <!--创建订单-->
<ul class="cor" style="width: 98%;">
<li>
    <ul>
        <li>
            <label>
                签证国家：</label><?php echo $goodsModel->country->name; ?>
             </li>
        <li>
            <label>
                签证类型：</label><?php echo $goodsModel->type->name; ?></li>
    </ul>
</li>
<li>
    <ul>
        <li>
            <label>
                签证人数：</label><small class="required">*</small>
            <input class="textbox validate[custom[onlyNumberNotZero]]" data-val="true" data-val-number="The field Number must be a number." data-val-required="The Number field is required." id="Number" maxlength="3" name="YutongVisaOrder[amount]" style="width:100px" type="text" value="0">
        </li>
        <li>
            <label>
                签证价格：
            </label>
            ￥<?php echo $goodsModel->price; ?></li>
    </ul>
</li>
<li>
    <ul>
        <li>
            <label>
                出发时间：</label><small class="required">*</small>
            <input class="textbox validate[required]" data-val="true" data-val-required="The DepartureDate field is required." id="DepartureDate" name="YutongVisaOrder[depart_date]" onclick="WdatePicker({lang:'zh-CN'})" style="width:100px" type="text" value="">&nbsp;格式：1990-01-01
        </li>
        <li>
            <label>
                团号(如有)：</label>
            <input class="textbox" id="TuanNo" name="YutongVisaOrder[group_sn]" style="width:100px" type="text" value="">
        </li>
    </ul>
</li>

<li>
    <label>签证人姓名：</label>
    <small class="required">*</small>
    <a href="#" onclick="addNewVisaCustomer();">添加</a>
</li>
<li id="visa_customer_before">
<li>
    <label>
        特殊要求：</label><small class="required">&nbsp;</small>
    <textarea class="textbox" cols="50" id="OtherRemark" name="YutongVisaOrder[comment]" rows="3"></textarea>
</li>
<li>
    <label>
        护照返回地址：</label>
    <?php if(!Yii::app()->user->isGuest){  ?>
    <input data-company-name="<?php echo $usersModel->address->company_name; ?>" data-contact-name="<?php echo $usersModel->address->contact_name; ?>" data-contact-address="<?php echo $usersModel->address->contact_address; ?>" data-contact-phone="<?php echo $usersModel->address->contact_phone; ?>" name="use_contact_address" onclick="useNewAddress('save')" type="radio" value="true" checked="checked" id="useCompanyAddress">
    使用公司地址&nbsp;
    <input id="IsCompanyAddress" name="use_contact_address" onclick="useNewAddress('new')" type="radio" value="false">
    使用其他地址
    <?php } ?>
</li>

<div id="insureUl2" style="display: block">
    <div class="selinsnrancenew" style="width: 500px; margin-left: 100px;">
        公司：<input class="textbox" id="CompanyName" maxlength="50" name="YutongVisaOrder[company_name]" style="width:100px" type="text" value="<?php echo empty($usersModel->address) ? '' :$usersModel->address->company_name; ?>">
        地址：<input class="textbox validate[required]" data-val="true" data-val-required="The CompanyAddress field is required." id="CompanyAddress" maxlength="200" name="YutongVisaOrder[contact_address]" style="width:250px" type="text" value="<?php echo  empty($usersModel->address) ? '' : $usersModel->address->contact_address; ?>" ><br>
        <br>
        联系人：<input class="textbox validate[required]" data-val="true" data-val-required="The ReceiverName field is required." id="ReceiverName" maxlength="10" name="YutongVisaOrder[contact_name]" style="width:100px" type="text" value="<?php echo  empty($usersModel->address) ? '' : $usersModel->address->contact_name; ?>" >
        电话：<input class="textbox validate[required]" data-val="true" data-val-required="The ReceiverPhone field is required." id="ReceiverPhone" maxlength="20" name="YutongVisaOrder[contact_phone]" style="width:100px" type="text" value="<?php echo  empty($usersModel->address) ? '' : $usersModel->address->contact_phone; ?>" ></div>
</div>
<br>
    <?php if(!Yii::app()->user->isGuest){  ?>
                <span style="width: 500px; margin-left: 100px; ">备注：地址若有误，
<a href="<?php $this->createUrl('user/profile'); ?>" style="color:red;" target="_blank">点此修改</a>，一劳永逸</span><br>
    <?php } ?>
<br>

<li style="text-align: center">
    <input type="submit" class="smallbtn" id="createOrderBtn" value="下单">
    &nbsp; &nbsp; &nbsp;<input type="button" class="smallbtn" value="返回" id="return">
</li>
</ul>
</form>    </div>

</div>
<script type="text/javascript">
    $(document).ready(function(){
        addNewVisaCustomer();
        $('#Number').change(function(){
           var currentVal = $(this).val();
           var currentCount = $('.visa-customer-item').size();
           if(currentVal > currentCount){
               var remains = currentVal - currentCount;

               for(var i = 0; i < remains ; i++){
                  var  inputCount = parseInt(i)+parseInt(currentCount);
                   var htmlStr = '<li class="visa-customer-item"><ul><li><label>客人<strong>'+(i+currentCount+1)+'</strong>姓名：</label><input class="visa-name" name="YutongVisaOrderCustomers['+inputCount+'][customer_name]" type="text" ></li><li><label>护照号：</label><input class="visa-passport" name="YutongVisaOrderCustomers['+inputCount+'][passport]" type="text" ><a href="#" style="margin-left:5px;color:red;" onclick="deleteVisaCustomer(this);">删除</a></li></ul></li>';
                   $('#visa_customer_before').before(htmlStr);

               }
           }else{
               $('.visa-customer-item').slice((currentVal-1), (currentCount-1)).remove();
               var counter = 0;
               $('.visa-customer-item').each(function(){
                   $(this).find('.visa-name').attr('name', 'YutongVisaOrderCustomers['+parseInt(counter)+'][customer_name]');
                   $(this).find('.visa-passport').attr('name', 'YutongVisaOrderCustomers['+parseInt(counter)+'][passport]');
                   $(this).find('strong').text(counter+1);
                   counter++;
               });
           }
        });
    });

    function useNewAddress(type){
        if(type == 'new'){

            $('input[name="YutongVisaOrder[company_name]"]').val('');
            $('input[name="YutongVisaOrder[contact_name]"]').val('');
            $('input[name="YutongVisaOrder[contact_address]"]').val('');
            $('input[name="YutongVisaOrder[contact_phone]"]').val('');
        }else{
            obj = $('#useCompanyAddress');
            $('input[name="YutongVisaOrder[company_name]"]').val(obj.data('company-name'));
            $('input[name="YutongVisaOrder[contact_name]"]').val(obj.data('contact-name'));
            $('input[name="YutongVisaOrder[contact_address]"]').val(obj.data('contact-address'));
            $('input[name="YutongVisaOrder[contact_phone]"]').val(obj.data('contact-phone'));
        }
    }
    function addNewVisaCustomer(){
        var currentCount = $('.visa-customer-item').size();
        var htmlStr = '<li class="visa-customer-item"><ul><li><label>客人<strong>'+(currentCount+1)+'</strong>姓名：</label><input class="visa-name" name="YutongVisaOrderCustomers['+currentCount+'][customer_name]" type="text" ></li><li><label>护照号：</label><input class="visa-passport" name="YutongVisaOrderCustomers['+currentCount+'][passport]" type="text" ><a href="#" style="margin-left:5px;color:red;" onclick="deleteVisaCustomer(this);">删除</a></li></ul></li>';
        $('input[name="YutongVisaOrder[amount]"]').val(currentCount+1);
        $('#visa_customer_before').before(htmlStr);
    }
    function deleteVisaCustomer(obj){
        var obj = $(obj);
        obj.parent().parent().parent().remove();
        var newCount = $('.visa-customer-item').size();
        $('input[name="YutongVisaOrder[amount]"]').val(newCount);
        var counter = 0;
        $('.visa-customer-item').each(function(){
           $(this).find('.visa-name').attr('name', 'YutongVisaOrderCustomers['+counter+'][customer_name]');
            $(this).find('.visa-passport').attr('name', 'YutongVisaOrderCustomers['+counter+'][passport]');
            $(this).find('strong').text(counter+1);
           counter++;
        });
        return false;
    }

    function checkForm(){
        var error = {"type":'ok', "msg":''};
        $('.visa-customer-item').each(function(){
            if($(this).find('.visa-name').val() == ''){
                error.msg = "请填写完整客人姓名！";
                $(this).find('.visa-name').focus();
                error.type = 'error';
                $(this).find('.visa-name').addClass('error');
            }else{
                $(this).find('.visa-name').removeClass('error');
            }

        });
        if($('#DepartureDate').val() == ''){
            error.type = 'error';
            error.msg += "\n请选择出发日期！";
            $('#DepartureDate').addClass('error');
        }else{
            $('#DepartureDate').removeClass('error');
        }
        if(error.type != 'ok'){
            alert(error.msg);
            return false;
        }else{
            return true;
        }

    }

</script>
<style>
    .error{border:1px solid red;outline-color: red;}
</style>