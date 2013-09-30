<?php echo CHtml::cssFile(Yii::app()->baseUrl."/themes/admin/css/list.css");?>
<h1>Activity List</h1>
<table>
	<tr>
		<th>No.</th>
		<th>Name</th>
		<th>Operation</th>
	</tr>
	<?php if(!empty($items)) { foreach ($items as $key => $item) { ?>
		<tr>
			<td><?php echo $item['id']; ?></td>
			<td><?php echo $item['name']; ?></td>
			<td>
				<?php
				echo CHtm::link('Preview','');
				echo CHtm::link('Edit',"r=item/edit&id=".$item['id']);
				echo CHtm::link('Delete',"r=item/activitydelete&id=".$item['id']);
				?>
			</td>
		</tr>
	<?php } } ?>
	
</table>
<?php $this->widget('CLinkPager',array('pages'=>$pages,))?>
