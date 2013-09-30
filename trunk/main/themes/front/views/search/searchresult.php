<script>
$(document).ready(function (){	
	$('ul#searchresult-ul>li').each(function (index,el){
		$(this).click(function (){
			$('div#searchresult-chose div').hide();
			$("div."+$(this).attr('id')).show();
		});
	} );
});
</script>
<style type="text/css">
	ul#searchresult-ul>li{
		width: 100px;
		height: 40px;
		line-height: 40px;
	}
	div#searchresult-sequence{
		border-top: 1px solid black;
		border-bottom: 1px solid black;
		padding: 10px 0;
	}
	div#searchresult-content,div#searchresult-sequence{
		width: 700px;
		margin: 10px auto;
	}
</style>
<div id="searchresult">
	<h2>搜索<b>首尔</b>的结果</h2>
	<ul id="searchresult-ul">
		<li id="activity" class='left'>活动(<span>4</span>)</li>
		<li id="visa" class='left'>签证(<span>4</span>)</li>
		<li id="commnicate" class='left'>通信(<span>10</span>)</li>
		<li id="ticket" class='left'>机票(<span>4</span>)</li>
		
	</ul>
	<div class="clear"></div>
	<div id="searchresult-chose">
		<form action='' method='post'>
			<div class="activity">
				<label for="">城市</label>
				<input type="text" name='city-chose' />
			</div>
			<div class="visa hidden">
				<label for="">国家</label>
				<input type="text" name='visa-chose' />
			</div>
			<div class="communicate hidden">	
			</div>
			<div class="ticket hidden">
				<label for="">出发城市</label>
				<input type="text" />
				<label for="">目的地</label>
				<input type="text" />
				<label for="">出发时间</label>
				<input type="text" />
				<label for="">返回时间</label>
				<input type="text" />
			</div>
			<input type='submit' value='查询' />
		</form>		
	</div>
	<div id="searchresult-sequence" class="left">
		<dl class='left'>
			<dt>排序：</dt>
			<dd>推荐</dd>
			<dd>价格</dd>
		</dl>
		<p class='right'>共计找到<b></b>个结果</p>
		<div class="clear"></div>
	</div>
	<div id="searchresult-content" class='left'>
		<div id="activitylist-product1" class='result'>
			<div class='left'>
				<img  src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/logo.png" />
				<p>
					城市：越南
				</p>
			</div>
			<div class='left'>
				<h3>越南南部3晚5天</h3>
				<p>胡志明市位于湄公河三角洲地区,越南直辖市，为越南最大的城市之一</p>
				<p>
					￥2000起
					<button>查看详情</button>
				</p>
			</div>
			<div class="clear"></div>
		</div>
		<div id="activitylist-product2" class='result'>
			<div class='left'>
				<img  src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/logo.png" />
				<p>
					城市：越南
				</p>
			</div>
			<div class='left'>
				<h3>越南南部3晚5天</h3>
				<p>胡志明市位于湄公河三角洲地区,越南直辖市，为越南最大的城市之一</p>
				<p>
					￥2000起
					<button>查看详情</button>
				</p>
			</div>
			<div class="clear"></div>
		</div>
		<div id="activitylist-product3" class='result'>
			<div class='left'>
				<img  src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/logo.png" />
				<p>
					城市：越南
				</p>
			</div>
			<div class='left'>
				<h3>越南南部3晚5天</h3>
				<p>胡志明市位于湄公河三角洲地区,越南直辖市，为越南最大的城市之一</p>
				<p>
					￥2000起
					<button>查看详情</button>
				</p>
			</div>
			<div class="clear"></div>
		</div>
		<div id="activitylist-product4" class='result'>
			<div class='left'>
				<img  src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/logo.png" />
				<p>
					城市：越南
				</p>
			</div>
			<div class='left'>

				<h3>越南南部3晚5天</h3>
				<p>胡志明市位于湄公河三角洲地区,越南直辖市，为越南最大的城市之一</p>
				<p>
					￥2000起
					<button>查看详情</button>
				</p>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
<div id='recommend'>
	<img src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/logo.png" />
</div>
<div class="clear"></div>