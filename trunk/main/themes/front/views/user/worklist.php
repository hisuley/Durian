<div id='user-nav' class='left'>
	<ul>
		<li><a href="">个人资料</a></li>
		<li><a href="">订单列表</a></li>
		<li><a href="">客服支持</a></li>
	</ul>	
</div>
<div id='userworklist' class='left'>
	<h2>工单列表</h2>
	<input type='button'/>
	<table>
		<tr>
			<th>编号</th>
			<th>主题</th>
			<th>最新回复</th>
			<th>操作</th>
			<th>操作</th>
		</tr>
<?php  if(!empty($variable)) {foreach ($variable as $key => $value) { ?>
		<tr>
			<td><?php  ?></td>
			<td><?php  ?></td>
			<td><?php  ?></td>
			<td><?php  ?></td>
			<td><?php  ?></td>
		</tr>
<?php }} ?>	
	</table>
</div>
<div class='clear'></div>