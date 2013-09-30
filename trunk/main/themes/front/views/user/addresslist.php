<div id='user-nav' class='left'>
	<ul>
		<li><a href="">个人资料</a></li>
		<li><a href="">订单列表</a></li>
		<li><a href="">客服支持</a></li>
	</ul>	
</div>
<div id='userworklist' class='left'>
	<h2>地址列表<?php ?></h2>
	<input type='button' value='新建地址' />
	<table>
		<tr>
			<th>默认</th>
			<th>编号</th>
			<th>地址</th>
			<th>联系人</th>
			<th>操作</th>
		</tr>
<?php  if(!empty($variable)) {foreach ($variable as $key => $value) { ?>
		<tr>
			<td><input type='radio' name='same'></td>
			<td><?php echo ?></td>
			<td><?php echo ?></td>
			<td><?php echo ?></td>
			<td><?php echo ?></td>
		</tr>
<?php }} ?>	
	</table>
</div>
<div class='clear'></div>