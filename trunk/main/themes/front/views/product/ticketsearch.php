<style type="text/css">
	div#ticketsearch{
		width: 900px;
	}
	div#ticketsearch-title h2{
		border: 1px solid black;
		margin: 10px 0;
		padding: 10px 0;
	}
	div#ticketsearch-search>div{
		padding-top: 10px;
	}
	div#ticketsearch-content{
		margin-top: 10px;
	}
	div#ticketsearch-content{
		width: 860px;
		margin: 0 auto;
	}
	div#ticketsearch-content tr{
			padding: 10px;
			border-top: 1px solid black;
		}
	div#ticketsearch-content th, div#ticketsearch-content td{
		text-align: center;
		font-size: 16px;
		width: 180px;
		height: 40px;
	}
	
</style>
<div id="ticketsearch" class='left'>
	<div id="ticketsearch-title">
		<h2>
			国际机票
		</h2>
	</div>
	<div id="ticketsearch-search">
		<div>	
			<div class='left'>	
				<p>
					<label>出发城市：</label><input type='text' />
					<label>目的地：</label><input type='text' />
				</p>		
				<p>
					<label>出发时间：</label><input type='text' />
					<label for="">往返</label><input type="checkbox" />
					<label>返回时间：</label><input type='text' />
				</p>
			</div>
			<div class="right">
				<button>搜索</button>
			</div>
			<div class="clear"></div>
		</div>
		<div id="ticketsearch-search-result">
			<dl class='left'>
				<dt>排序：</dt>
				<dd>推荐</dd>
				<dd>价格</dd>
			</dl>
			<p class='right'>共计10家满足您的要求</p>
			<div class="clear"></div>
		</div>
	</div>
	<div id="ticketsearch-content">
		<table>
			<tr>
				<th>时间</th>
				<th>机场</th>
				<th>航空公司/仓位</th>
				<th>价格/折扣</th>
				<th>操作</th>
			</tr>
			<tr>
				<td>
					<p>07:00</p>
					<p>21:00</p>
				</td>
				<td>
					<p>首都机场</p>
					<p>虹桥机场</p>	
				</td>
				<td>
					<p>吉祥航空</p>
					<p>A320 经济舱</p>
				</td>
				<td>
					￥2358
				</td>
				<td>
					<button>预订</button>
				</td>
			</tr>
			<tr>
				<td>
					<p>07:00</p>
					<p>21:00</p>
				</td>
				<td>
					<p>首都机场</p>
					<p>虹桥机场</p>	
				</td>
				<td>
					<p>吉祥航空</p>
					<p>A320 经济舱</p>
				</td>
				<td>
					￥2358
				</td>
				<td>
					<button>预订</button>
				</td>
			</tr>
			<tr>
				<td>
					<p>07:00</p>
					<p>21:00</p>
				</td>
				<td>
					<p>首都机场</p>
					<p>虹桥机场</p>	
				</td>
				<td>
					<p>吉祥航空</p>
					<p>A320 经济舱</p>
				</td>
				<td>
					￥2358
				</td>
				<td>
					<button>预订</button>
				</td>
			</tr>
			<tr>
				<td>
					<p>07:00</p>
					<p>21:00</p>
				</td>
				<td>
					<p>首都机场</p>
					<p>虹桥机场</p>	
				</td>
				<td>
					<p>吉祥航空</p>
					<p>A320 经济舱</p>
				</td>
				<td>
					￥2358
				</td>
				<td>
					<button>预订</button>
				</td>
			</tr>
		</table>
	</div>
</div>
<div id='recommend' class='right'>
	<img src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/logo.png" />
</div>
<div class="clear"></div>