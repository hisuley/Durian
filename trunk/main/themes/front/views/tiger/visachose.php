<style>
	div#visachose{
		width: 1100px;
	}
	div#visachose-title{
		border-bottom: 1px solid black;
		margin-bottom: 20px;
	}
	div#visachose-content td,div#visachose-content th{
		text-align: center;
		padding: 5px;
		border-bottom: 1px solid black;
	}
</style>
<div  id="visachose" class='left'>
	<div id="visachose-title">
		<div class="left">
			<img src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/logo.png">
		</div>
		<div class="left">
			<h2>泰国签证</h2>
			<p>
				自己办理泰国签证攻略 泰国签证办理流程： 1.先查使馆是否放假，免的白跑一趟，无论送取签。 2.下载下面的申请表填表（英文填写） 3.准备签证所需资料 4.送签 5.取签
			</p>
		</div>
		<div class="clear"></div>
	</div>
	<div id="visachose-content">
		<table>
			<tr>
				<th>签证名称</th>
				<th>领区</th>
				<th>有效期</th>
				<th>最多停留</th>
				<th>工作日</th>
				<th>签证费</th>

			</tr>
			<?php 
			if (!isset($visa)) {
				$visa= array();
			}
			foreach ($visa as $key => $value) { ?>
			<tr>
				<td><?php echo $value['visa_name']; ?></td>
				<td style="width:550px;"><?php echo $value['consular_district']; ?></td>
				<td><?php echo $value['expiry_date']; ?></td>
				<td><?php echo $value['retentionperiod']; ?></td>
				<td><?php echo $value['visa_week_day'];?></td>
				<td>
					<p><?php echo $value['market_price']; ?></p>
					<a href=<?php echo $this->createUrl('visainfo',array('id'=>$value['visa_id'])); ?>>查看</a>
				</td>
			</tr>	
			<?php }?>			
		</table>
	</div>
</div>
<div id='recommend' class='left'>
	<img src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/logo.png" />
</div>
<div class="clear"></div>