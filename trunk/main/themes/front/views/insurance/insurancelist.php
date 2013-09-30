<style type="text/css">
	div#insurancelist{
		width: 920px;
	}
	div#insurancelist-title h2{
		border: 1px solid black;
		margin: 10px 0;
		padding: 10px 0;
	}
	div#insurancelist-adjust {
		width: 500px;
		font-size: 16px;
		border: 1px solid black;
		background-color: yellow;
		margin: 10px 0;
		padding: 5px;
	}
	div#insurancelist-content>div{
		padding: 20px 0;
		border-top: 1px solid black;
	}
	div#insurancelist-content div.leftmiddle{
		width: 700px;
		margin: 0 20px;
	}
	div.insurancenav li{
		margin: 8px 0;
		padding: 10px 0;
		border: 1px solid black;
	}

</style>
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
				$('h3#insurancelist-content-price').html('￥'+responseText.gold+'元');
			});			
		});
	});
</script>
<div id="insurancelist" class='left'>
	<div id="insurancelist-title">
		<h2>
			旅行保险出
		</h2>
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
					<img src="<?php echo yii::app()->baseUrl; ?>/themes/front/resources/logo.png" />
				</a>
			</div>
			<div class="left leftmiddle">
				<h3>美亚“万国游踪”境外旅行保障计划(钻石计划)</h3>
				<p>符合申根签证要求（钻石计划）保障周全，涵盖出国旅游期间意外伤害、疾病和财物损失等24小时全球紧急医疗救援和旅行支援服务 备有短期和全年计划供您灵活选择承保热门娱乐运动：滑雪、潜水、骑马等新添银行卡盗刷（不适用于未成年人）</p>
				<p>意外伤害：600000￥</p>
				<p>医疗补偿：2343434￥</p>
			</div>
			<div class="right">
				<h3 id='insurancelist-content-price'>￥210元</h3>
				<p><button>立即订购</button></p>
				<p><button>查看详情</button></p>
			</div>
			<div class="clear"></div>
		</div>
		<div id="insurancelist-product1">
			<div class="left">
				<a href="">
					<img src="<?php echo yii::app()->baseUrl; ?>/themes/front/resources/logo.png" />
				</a>
			</div>
			<div class="left leftmiddle">
				<h3>美亚“万国游踪”境外旅行保障计划(钻石计划)</h3>
				<p>符合申根签证要求（钻石计划）保障周全，涵盖出国旅游期间意外伤害、疾病和财物损失等24小时全球紧急医疗救援和旅行支援服务 备有短期和全年计划供您灵活选择承保热门娱乐运动：滑雪、潜水、骑马等新添银行卡盗刷（不适用于未成年人）</p>
				<p>意外伤害：600000￥</p>
				<p>医疗补偿：2343434￥</p>
			</div>
			<div class="right">
				<h3 id='insurancelist-content-price'>￥210元</h3>
				<p><button>立即订购</button></p>
				<p><button>查看详情</button></p>
			</div>
			<div class="clear"></div>
		</div>
		<div id="insurancelist-product1">
			<div class="left">
				<a href="">
					<img src="<?php echo yii::app()->baseUrl; ?>/themes/front/resources/logo.png" />
				</a>
			</div>
			<div class="left leftmiddle">
				<h3>美亚“万国游踪”境外旅行保障计划(钻石计划)</h3>
				<p>符合申根签证要求（钻石计划）保障周全，涵盖出国旅游期间意外伤害、疾病和财物损失等24小时全球紧急医疗救援和旅行支援服务 备有短期和全年计划供您灵活选择承保热门娱乐运动：滑雪、潜水、骑马等新添银行卡盗刷（不适用于未成年人）</p>
				<p>意外伤害：600000￥</p>
				<p>医疗补偿：2343434￥</p>
			</div>
			<div class="right">
				<h3 id='insurancelist-content-price'>￥210元</h3>
				<p><button>立即订购</button></p>
				<p><button>查看详情</button></p>
			</div>
			<div class="clear"></div>
		</div>
		<div id="insurancelist-product1">
			<div class="left">
				<a href="">
					<img src="<?php echo yii::app()->baseUrl; ?>/themes/front/resources/logo.png" />
				</a>
			</div>
			<div class="left leftmiddle">
				<h3>美亚“万国游踪”境外旅行保障计划(钻石计划)</h3>
				<p>符合申根签证要求（钻石计划）保障周全，涵盖出国旅游期间意外伤害、疾病和财物损失等24小时全球紧急医疗救援和旅行支援服务 备有短期和全年计划供您灵活选择承保热门娱乐运动：滑雪、潜水、骑马等新添银行卡盗刷（不适用于未成年人）</p>
				<p>意外伤害：600000￥</p>
				<p>医疗补偿：2343434￥</p>
			</div>
			<div class="right">
				<h3 id='insurancelist-content-price'>￥210元</h3>
				<p><button>立即订购</button></p>
				<p><button>查看详情</button></p>
			</div>
			<div class="clear"></div>
		</div>
		<div id="insurancelist-product1">
			<div class="left">
				<a href="">
					<img src="<?php echo yii::app()->baseUrl; ?>/themes/front/resources/logo.png" />
				</a>
			</div>
			<div class="left leftmiddle">
				<h3>美亚“万国游踪”境外旅行保障计划(钻石计划)</h3>
				<p>符合申根签证要求（钻石计划）保障周全，涵盖出国旅游期间意外伤害、疾病和财物损失等24小时全球紧急医疗救援和旅行支援服务 备有短期和全年计划供您灵活选择承保热门娱乐运动：滑雪、潜水、骑马等新添银行卡盗刷（不适用于未成年人）</p>
				<p>意外伤害：600000￥</p>
				<p>医疗补偿：2343434￥</p>
			</div>
			<div class="right">
				<h3 id='insurancelist-content-price'>￥210元</h3>
				<p><button>立即订购</button></p>
				<p><button>查看详情</button></p>
			</div>
			<div class="clear"></div>
		</div>

	</div>
</div>
<div class="insurancenav right">
<h2>保险预定流程</h2>
<ul>
	<li>选择保险产品</li>
	<li>在线填写保单</li>
	<li>网上支付投保成功</li>
	<li>下载电子表单</li>
</ul>
</div>
<div class="clear"></div>