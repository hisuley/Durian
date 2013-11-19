<?php

?>
<table class="table">
	<thead>
		<tr>
			<th>订单号</th>
			<th>签证国家</th>
			<th>客人姓名</th>
			<th>来源</th>
			<th>下单人</th>
			<th>人数</th>
			<th>总额</th>
			<th>支付状态</th>
			<th>处理状态</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		<?php 

		foreach($result as $order){
			echo "<tr>";
			echo "<td>".$order->id."</td>";
			echo "<td>".OrderHelper::findAttr('country', $order->attrs)."</td>";
			echo "<td>".OrderHelper::findAttr('customers', $order->attrs)."</td>";
			echo "<td>".OrderHelper::findAttr('source', $order->attrs)."</td>";
			echo "<td>".OrderHelper::findAttr('user_id', $order->attrs)."</td>";
			echo "<td>".$order->amount."</td>";
			echo "<td>".$order->total_price."</td>";
			echo "<td>";
			switch($order['pay_status']){
				case 'paid':
					echo "未支付";
					break;
				case 'not_paid':
					echo "未支付";
					break;
				default:
					echo "未支付";
					break;
				}
			echo "</td>";
			echo "<td>";
			switch($order->status){
				case 'order_success':
					echo "下单成功";
					break;
				case 'profile_receive':
					echo "收到资料";
					break;
				case 'verifing':
					echo "资料审核";
					break;
				case 'reject':
					echo "拒签";
					break;
				case 'profile_incomplete':
					echo "资料不全，退回";
					break;
				case 'send_back':
					echo "已寄回";
					break;
				case 'complete':
					echo "完结";
					break;
				default:
					echo "状态未知";
					break;
			};
			echo "</td>";
			echo "<td><a href='".$this->createUrl('visa/view', array('id'=>$order['id']))."'>查看</a></td>";
			echo "</tr>";
		}
		?>
	</tbody>
</table>