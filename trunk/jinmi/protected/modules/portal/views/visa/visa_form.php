<h3>添加订单</h3>
<form action="<?php echo $this->createUrl('visa/new'); ?>" role="form" class="form-horizontal"
      style="margin-left:-100px;" method="POST">
    <input type="hidden" name="OfflineOrder[type]" value="visa"/>
    <input type="hidden" name="OfflineOrder[name]" value="签证订单"/>
    <input type="hidden" name="OfflineOrder[user_id]" value="1"/>
    <input type="hidden" name="OfflineOrder[pay_status]" value="paid"/>
    <div class="form-group">
        <label for="inputCountry" class="col-md-2 control-label">国家：</label>

        <div class="col-md-2">
            <select id="inputContinent" class="form-control input-sm">
                <option value="1">亚洲</option>
            </select>
        </div>
        <div class="col-md-2">
            <input type="hidden" name="OfflineOrderAttribute[0][attr_name]" value="country"/>
            <select name="OfflineOrderAttribute[0][value]" id="inputContinent" class="form-control input-sm">
                <option value="泰国">泰国</option>
            </select>
        </div>
        <label for="inputType" class="col-md-1 control-label">类型：</label>

        <div class="col-md-3">
            <input type="hidden" name="OfflineOrderAttribute[1][attr_name]" value="type"/>
            <input type="text" name="OfflineOrderAttribute[1][value]" class="form-control input-sm" id="inputType" placeholder="旅游/商务/公务">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail1" class="col-md-2 control-label">人数：</label>

        <div class="col-md-3 input-group  input-group-sm">
            <input type="text" name="OfflineOrder[amount]" class="form-control" id="inputEmail1" placeholder="">
            <span class="input-group-addon">人</span>
        </div>
        <label for="inputEmail1" class="col-md-2 control-label">价格：</label>

        <div class="col-md-3 input-group  input-group-sm">
            <span class="input-group-addon">￥</span>
            <input type="text" name="OfflineOrder[total_price]" class="form-control" id="inputEmail1" placeholder="人民币">
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-md-2 control-label">出发时间：</label>

        <div class="col-md-3 input-group date" data-date="<?php echo date('Y-m-d'); ?>" data-date-format="yyyy-mm-dd">
            <input type="hidden" name="OfflineOrderAttribute[2][attr_name]" value="start_time"/>
            <input type="text" name="OfflineOrderAttribute[2][value]" class="form-control input-sm" value="<?php echo date('Y-m-d'); ?>">
  			<span class="input-group-btn">
  				<button class="btn btn-default btn-sm"><span class="glyphicon glyphicon-calendar"></span></button>
  			</span>
        </div>
        <label for="" class="col-md-2 control-label">团号：</label>

        <div class="input-group col-md-2">
            <input type="hidden" name="OfflineOrderAttribute[3][attr_name]" value="group_sn"/>
            <input type="text" class="form-control input-sm" name="OfflineOrderAttribute[3][value]">
        </div>
        <div class="col-md-2">
            <p class="text-primary">
                <small>可选</small>
            </p>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-md-2 control-label">签证人姓名：</label>

        <div class="input-group col-md-3">
            <input type="hidden" name="OfflineOrderAttribute[4][attr_name]" value="customers"/>
            <textarea class="form-control" rows="3" name="OfflineOrderAttribute[4][value]"></textarea>
        </div>
        <div class="col-md-1">
            <p class="text-primary">
                <small>英文逗号隔开客人姓名</small>
            </p>
        </div>
        <label for="" class="col-md-1 control-label">来源：</label>

        <div class="input-group col-md-2">
            <input type="hidden" name="OfflineOrderAttribute[5][attr_name]" value="source"/>
            <input type="text" class="form-control input-sm" name="OfflineOrderAttribute[5][value]" placeholder="订单来源">
        </div>
    </div>
    <div class="form-group">
        <label for="" class="control-label col-md-2">上门收件：</label>

        <div class="col-md-2">
            <div class="col-md-6 radio">
                <input type="hidden" name="OfflineOrderAttribute[6][attr_name]" value="pickup"/>
                <label for=""><input type="radio" name="OfflineOrderAttribute[6][value]" value="1">是</label>
            </div>
            <div class="col-md-6 radio"><label for=""><input type="radio" checked="checked" name="OfflineOrderAttribute[6][value]"
                                                             value="0">否</label></div>
        </div>
        <label for="" class="pickup-address control-label col-md-1">姓名：</label>

        <div class="pickup-address input-group col-md-2">
            <input type="hidden" name="OfflineOrderAttribute[7][attr_name]" value="contact_name"/>
            <input type="text" class="form-control input-sm" name="OfflineOrderAttribute[7][value]">
        </div>
        <label for="" class="pickup-address control-label col-md-1">电话：</label>

        <div class="pickup-address input-group col-md-2">
            <input type="hidden" name="OfflineOrderAttribute[8][attr_name]" value="contact_phone"/>
            <input type="text" class="form-control input-sm" name="OfflineOrderAttribute[8][value]">
        </div>
    </div>
    <div class="pickup-address form-group">
        <label for="" class="control-label col-md-1 col-md-offset-4">地址：</label>

        <div class="input-group col-md-5">
            <input type="hidden" name="OfflineOrderAttribute[9][attr_name]" value="contact_address"/>
            <input type="text" class="form-control input-sm" name="OfflineOrderAttribute[9][value]">
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-md-2 control-label">备注：</label>

        <div class="input-group col-md-5">
            <input type="hidden" name="OfflineOrderReviewHistory[0][type]" value="order_success"/>
            <input type="hidden" name="OfflineOrderReviewHistory[0][opinion]" value="accept"/>
            <textarea class="form-control" rows="3" name="OfflineOrderReviewHistory[0][memo]"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-md-2 control-label">材料清单：</label>

        <div class="col-md-8">
            <input type="hidden" name="OfflineOrderAttribute[10][attr_name]" value="material"/>
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox1"  name="OfflineOrderAttribute[10][value][]" value="照片"> 照片
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox2"  name="OfflineOrderAttribute[10][value][]" value="护照"> 护照
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox3"  name="OfflineOrderAttribute[10][value][]" value="户口本"> 户口本
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox1"  name="OfflineOrderAttribute[10][value][]" value="财力证明"> 财力证明
            </label>
            <label class="checkbox-inline">
                <input type="checkbox" id="inlineCheckbox2"  name="OfflineOrderAttribute[10][value][]" value="身份证"> 身份证
            </label>
        </div>
    </div>
    <div class="row">
        <br/>
        <button type="submit" class="btn btn-default btn-lg btn-primary col-md-offset-4">提交订单</button>
    </div>

</form>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/datepicker.css"/>
<script type="text/javascript">
    $(document).ready(function () {
        $('.date input').datepicker({format: 'yyyy-mm-dd', language: "zh-CN"});
        /**
         $('input[name="VisaForm[pickup]"]').click(function(){
			if($('input[name="VisaForm[pickup]"]:checked').prop('value') == 0){
				$('.pickup-address').hide('normal');
			}else{
				$('.pickup-address').show('normal');
			}
		});
         **/
    });
</script>
<style>
    .pickup-address {
    }
</style>