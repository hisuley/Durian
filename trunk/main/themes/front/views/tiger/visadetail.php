<style>
	div#visadetail{
		width:1000px;
	}
	div#visadetail-title{
		border-bottom: 1px solid black;
	}
	div#visadetail-content h3{
		padding: 10px 0;
	}
	div#visadetail-content>div{
		padding:5px;
		border: 1px solid black;
	}
	div#visadetail-content-require p,strong,em,b,span,div{
		margin: 0px;
		padding: 5px;
		font-size: 14px;
		font-weight: normal;
	}
</style>
<div id="visadetail" class='left'>
	<div id="visadetail-title">
		<h2>
				<img src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/logo.png" />
				<?php echo $detail['country_name'].$detail['visa_type'];?>		
				￥<?php echo $detail['market_price'];?>
				<button>订购</button>
		</h2>
		<div class="clear"></div>
	</div>
	<div id="visadetail-content">
		<h3>签证详情</h3>
		<div id="visadetail-content-detail">
			
			<ul>
				<li class="left">有效期：<?php echo $detail['expiry_date'];?></li>
				<li class="left">最多停留：<?php echo $detail['retentionperiod']; ?></li>
				<li class="left">工作日：<?php echo $detail['visa_week_day']; ?></li>
				<li class="left">是否面试：<?php echo $detail['interview'];?></li>
				<li class="left">所属领区：<?php echo $detail['consular_district'];?></li>
				<li class="left">类型：<?php echo $detail['visa_type'];?></li>
			</ul>
			<div class="clear"></div>
		</div>
		<h3>所需材料</h3>
		<div id="visadetail-content-require">
			<?php echo $detail['visa_data'];?>
		</div>
		<h3>费用提示</h3>
		<div id="visadetail-content-cost">
			<h3>价格包含</h3>
			<ol>
				<li>1.使馆</li>
				<li>2.申请资料辅助填表服务</li>
				<li>3.申请资料整理服务</li>
				<li>4.代送签证服务</li>
				<li>5.代取签证服务</li>
			</ol>
			<h3>价格不包含</h3>
			<ol>
				<li>1.未提及费用</li>
			</ol>
		</div>
	</div>
</div>
<div id='recommend' class='left'>
	<h2>推荐</h2>
	<img src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/logo.png" />
</div>
<div class="clear"></div>