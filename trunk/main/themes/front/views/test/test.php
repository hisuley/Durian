<script type="text/javascript">
	$(document).ready(function() {
		$('div#insurancelist-adjust').find('em').click(function(event) {
			/* Act on the event */
			var days= prompt('请输入天数','1');
			if (days != null && days != '') 
				{
					$('div#insurancelist-adjust b').html(days);
				}
			var htmlobject= $.ajax({
				url: '<?php  echo $this->createUrl('insurance/getquote') ?>',
				dataType: 'json',
				data: {'days': days},
			})
			.done(function() {
				console.log("success");
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
				eval('var responseText='+htmlobject.responseText);			
				$('p#insurancelist-content-price').html('￥'+responseText.gold+'元');
			});

			
		});
	});
</script>
<div id="insurancelist" class='left'>
	<div id="insurancelist-title">
		<p>
			旅行保险出境旅行，情况复杂，好的保险在某些情况下能救你一命，这里汇集了最适合出境旅行的保险，一定要选一个再上路。
		</p>
	</div>
	<div id="insurancelist-search">
		<dl class='left'>
			<dt>排序：</dt>
			<dd>推荐</dd>
			<dd>价格</dd>
		</dl>
		<p class='right'>共计24款满足要求</p>
		<div class="clear"></div>
	</div>
	<div id="insurancelist-adjust">
	<p>
		以18岁以上成年人保险期<b>1</b>天计算 
		<em>调整</em>
	</p>
	</div>
	<div id="insurancelist-content">
		<div id="insurancelist-product1">
			<div class="left">
				<a href="">
					<img src="">
				</a>
			</div>
			<div class="left">
				<p>美亚“万国游踪”境外旅行保障计划(钻石计划)</p>
				<p>符合申根签证要求（钻石计划）保障周全，涵盖出国旅游期间意外伤害、疾病和财物损失等24小时全球紧急医疗救援和旅行支援服务 备有短期和全年计划供您灵活选择承保热门娱乐运动：滑雪、潜水、骑马等新添银行卡盗刷（不适用于未成年人）</p>

			</div>
			<div class="left">
				<p id='insurancelist-content-price'>￥210元</p>
				<button>立即订购</button>
				<button>查看详情</button>
			</div>
		</div>
	</div>
</div>
<div class="insurancenav">
<h2>保险预定流程</h2>
<ul>
	<li>选择保险产品</li>
	<li>在线填写保单</li>
	<li>网上支付投保成功</li>
	<li>下载电子表单</li>
</ul>
</div>
<div class="clear"></div>