<div id='user-nav' class='left'>
	<ul>
		<li><a href="">个人资料</a></li>
		<li><a href="">订单列表</a></li>
		<li><a href="">客服支持</a></li>
	</ul>	
</div>
<div id='userorderlist' class='left'>
	<h2>订单列表<?php ?></h2>
	<table>
		<tr>
			<th>订单编号</th>
			<th>订单名称</th>
			<th>生成时间</th>
			<th>状态</th>
			<th>操作</th>
		</tr>
<?php  if(!empty($variable)) {foreach ($variable as $key => $value) { ?>
		<tr>
			<td><?php ?></td>
			<td><?php ?></td>
			<td><?php ?></td>
			<td><?php ?></td>
			<td><?php ?></td>
		</tr>
<?php }} ?>	
	</table>
</div>
<div class='clear'></div>