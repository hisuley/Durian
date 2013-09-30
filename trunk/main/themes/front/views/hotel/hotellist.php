<script>
$(document).ready(function(){
	$("select[name='adults']").change(function(event) {
		var val= $(this).val();
		if (val == 1) {$('input[name="rooms"]').val('610000000');}
		else if(val == 2){$('input[name="rooms"]').val('010000000');}
		else {}
	});
	$("#hotellist-content h3").click(function(event) {
		$('div#hotellist-content-iframe').remove();
		var floatBox= $('<div id="floatBox"></div>');
		floatBox.css({
		width: '100%',
		height: $(document).height(),
		position: 'absolute',
		left: '0px',
		top: '0px',
		"background-color": 'black',
		"z-index": '2',
		'opacity': '0.6'
		});
		$("body").append(floatBox);
		var he= $('body').scrollTop();
		var item= $(this).find('input#hotelItem-item').val();
		var rows= $(this).index();
		var city= $(this).find('input#hotelItem-boldsm').val();
		$('<div id="hotellist-content-iframe"><button class="right">X</button></div>').css({
			"position": 'absolute',
			top: he,
			border: 'none',
			"z-index": '5',	
			"background-color": 'white',
			margin: '80px auto'
		}).appendTo('body');
		$('<iframe></iframe>').css({
			width: '1000px',
			height: '600px',
			border: 'none'		
		}).attr('src', "<?php echo $this->createUrl('info',array()); ?>"+"?item="+item+"&city="+city+"&row="+rows).appendTo('div#hotellist-content-iframe');

		$('div#hotellist-content-iframe button.right').click(function(event) {
		$('div#floatBox,div#hotellist-content-iframe').remove();
		});

	});
});	
</script>
<style type="text/css">
	#hotellist{
		position: relative;
	}
</style>
<div id="hotellist" class='left'>
	<div id="hotellist-title">
		<h2>
			酒店预订 全球酒店预订服务
		<h2>
	</div>
	<div id="hotellist-search">
		<form action=<?php echo $this->createUrl('index',array()); ?> method='post'>
			<p>
				<input type="hidden" name='destType' value='C' />
				<label>城市：</label><input type='text' name='destCode' />
				<label>酒店房型：</label>
				<select name='adults'>
					<option value='1' selected='selected'>单人房单人床</option>
					<option value='2'>双人间双人房</option>
				</select>
				<input type="hidden" name='rooms' value='610000000' />
			</p>		
			<label>入住时间：</label>
			<input type='text' name='arrival' />
			<label>入住天数：</label>
			<input type='text' name='duration' />
			<input id='search-submit' type="submit" value='查询'  />
		</form>
		<div>
			<dl class='left'>
				<dt>排序：</dt>
				<dd>推荐</dd>
				<dd>价格</dd>
			</dl>
			<p class='right'>共计10家满足您的要求</p>
			<div class="clear"></div>
		</div>
	</div>
	<div id="hotellist-content">
		<?php foreach ($hotel as $key => $hotelItem) { ?>
			<div class=<?php echo "hotelItem".$key; ?> >
				<p>
					<h3>
						<?php echo $hotelItem['hotelName'].$hotelItem['boldsm']; ?>
						<input type="hidden" id="hotelItem-item" value="<?php echo $hotelItem['item']; ?>" />
						<input type="hidden" id="hotelItem-boldsm" value="<?php echo $hotelItem['boldsm']; ?>" />
					</h3>
					<!--停车，洗澡...图标-->
					<span class="right">
						<?php foreach ($hotelItem['nobr'] as $key => $value) { ?>
						<img src=<?php echo $value."png";?> alt="" />
						<?php }?>
					</span>
				</p>
				<p>
					<img src=<?php echo $hotelItem['imageUrl']; ?> alt="" />
					<span><?php if(isset($hotelItem['description'])) {echo $hotelItem['description'];} ?></span>
				</p>
				<table>
					<?php foreach ($hotelItem['roomInfo'] as $key => $value) { ?>
						<tr>
							<td><?php echo $value['aid']; ?></td>
							<td><?php echo $value['price']; ?></td>
							<td><button>订购</button></td>
						</tr>
					<?php } ?>	
				</table>
			</div>
		<? }?>
	</div>
</div>
<div id='recommend'>
	<img src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/logo.png" />
</div>
<div class="clear"></div>