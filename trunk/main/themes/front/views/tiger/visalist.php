<style>
	div#visalist-title{
		width: 820px;
		height: 70px;
		line-height: 70px;
	}
	div#visalist-title span{
		font-size: 14px;
	}
	div#visalist-content{
		width: 820px;
	}
	div#visalist-content-hot{
		margin: 20px auto;
		height: 100px;
		padding: 20px 10px;
		border:1px solid black;
	}
	div#visalist-content-hot li{
		width: 100px;
	}
	div#visalist-content-all{
		margin: 20px auto;
		padding: 20px 10px;
		border:1px solid black;
	}
	div#visalist-content-all div{
		padding: 10px 0;
	}
	
</style>
<div   id="visalist" class='left'>
	<div id="visalist-title">
		<h2>
			全球签证
			<span>
				提供超过100个国家、近1000个签证类别签证办理服务,全国北京、上海、广州、昆明、武汉均设分公司
			</span>
		</h2>
		<div class="clear"></div>
	</div>
	<?php if (!isset($visa)) {
		$visa= array();
	}?>
	<div id="visalist-content">
		<h3>热门国家</h3>
		<div id="visalist-content-hot">
			<ul>
				<?php foreach ($hot as $key => $value) { ?>
					<li class='left'>
						<p>
							<img src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/logo.png" />
							<a href=<?php echo $this->createUrl('cityvisa',array('id'=>$value['country_id'])); ?>>
								<?php echo $value['country_name']."(".$value['count'].")"; ?>
							</a>
						</p>
					</li>
				<?php }?>
			</ul>
			<div class="clear"></div>
		</div>
		<h3>全部国家</h3>
		<div id="visalist-content-all">
			<dl>
				<?php foreach ($visa as $continent => $value) {?>
				<div>
					<dt><?php echo $continent; ?>:</dt>
					<?php foreach ($value as $key => $subvalue) { ?>
						<dd>
								<a href=<?php echo $this->createUrl('cityvisa',array('id'=>$subvalue['country_id'])); ?>>
								<?php echo $subvalue['country_name']; ?>
							</a>	
						</dd>
					<?php }?>	
				</div>					
				<?php }?>
			</dl>
		</div>
		<h3>我们的优势</h3>
		<div id="visalist-content-super">
			<img src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/logo.png" />
		</div>
	</div>
</div>
<div id='recommend' class='left'>
	<img src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/logo.png" />
</div>
<div class="clear"></div>
