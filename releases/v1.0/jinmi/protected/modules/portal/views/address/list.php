<?php

?>
<a type="button" class="btn btn-primary" href="<?php echo $this->createUrl('address/new'); ?>">添加</a>
<table class="table">
	<thead>
		<tr>
			<th>编号</th>
			<th></th>
			<th>名字</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		<?php 

		foreach($result as $val){
			echo "<tr>";
			echo "<td>".$val['id']."</td>";
			echo "<td colspan='2'>".$val['name']."</td>";
			echo "<td><a href='".Yii::app()->createUrl('portal/address/delete', array('id'=>$val['id']))."'>删除</a></td>";
			echo "</tr>";
			if(!empty($val['children'])){
				foreach($val['children'] as $subVal){
					echo "<tr>";
					echo "<td></td>";
					echo "<td>".$subVal['id']."</td>";
					echo "<td>".$subVal['name']."</td>";
					echo "<td><a href='".Yii::app()->createUrl('portal/address/delete', array('id'=>$subVal['id']))."'>删除</a></td>";
					echo "</tr>";
				}
			}
		}
		?>
	</tbody>
</table>