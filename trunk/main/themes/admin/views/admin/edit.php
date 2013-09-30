<?php
//print_r($_POST);
echo CHtml::cssFile(Yii::app()->baseUrl."/themes/admin/css/activity.css");
echo CHtml::scriptFile(Yii::app()->baseUrl."/themes/admin/js/editActivity.js");
echo CHtml::scriptFile(Yii::app()->baseUrl."/themes/admin/js/ueditor/editor_config.js");
echo CHtml::scriptFile(Yii::app()->baseUrl."/themes/admin/js/ueditor/editor_all.js");
?>
<h1>Edit Activity</h1>
<h2>Activity Attributes</h2>
<?php 
echo CHtml::beginForm(Yii::app()->homeUrl.'?r=admin/activityedit','post',array('enctype'=>'multipart/form-data','name'=>'ItemForm'));
echo CHtml::hiddenField('ItemForm[Item][type]',$data['ItemForm']['Item']['type']);
echo CHtml::hiddenField('ItemForm[Item][id]',$_GET['id']);
?>
<table class="baseAttribute">
	<tr>
		<td>
			<label for="">Activity Name</label>
			<?php echo CHtml::textField('ItemForm[Item][name]',$data['ItemForm']['Item']['name']);?>
		</td>
		<td colspan="2">
			<label for="">Location</label>
			<?php 
				echo CHtml::hiddenField('ItemForm[ItemAttribute][0][attr_id]','1');
				echo CHtml::dropDownList('ItemForm[ItemAttribute][0][value]','',array(
					'19'=>'European',
					'24'=>'Asia',
					'25'=>'Africa',
					'29'=>'Oceanica',
					'45'=>'Central and South America',
					'53'=>'North America',
					'68'=>'Belgium',
					'83'=>'Vietnam Danang',
				  	),array(
				  	//地理位置
				  	'id'=>'LocationContinent'
				  	));	
				echo CHtml::dropDownList('','China',array(
					'China'=>'China',
					),array(
					'id'=>'LocationCountry',
					));
				echo CHtml::dropDownList('','',array(
				  	),array(
					'id'=>'LocationCity',
					));
				echo CHtml::hiddenField('ItemForm[ItemAttribute][5][attr_id]','11');
				echo CHtml::textField('ItemForm[ItemAttribute][5][value]',$data['ItemForm']['ItemAttribute'][5]['value'],array('id'=>'LocationOther'));
			?>
		</td>
	</tr>
	<tr>
		<td>
			<label for="">Book in Advance</label>
			<?php 	
				echo CHtml::textField('ItemForm[Item][pre_book]',$data['ItemForm']['Item']['pre_book']);
			?>
			<label for="">Day</label>
		</td>
		<td>
			<label for="">Duration</label>
			<?php
				echo CHtml::textField('tmp_d',floor($data['ItemForm']['ItemAttribute'][1]['value']/24));
				echo CHtml::label('D','');
				echo CHtml::textField('tmp_h',$data['ItemForm']['ItemAttribute'][1]['value']%24);
				echo CHtml::label('H','');
				echo CHtml::hiddenField('ItemForm[ItemAttribute][1][attr_id]',$data['ItemForm']['ItemAttribute'][1]['attr_id']);
				echo CHtml::hiddenField('ItemForm[ItemAttribute][1][value]',$data['ItemForm']['ItemAttribute'][1]['value']);
			?>
		</td>
		<td>
			<?php 
				echo CHtml::label('Language','');
				echo CHtml::dropDownList('ItemForm[Item][language]',$data['ItemForm']['Item']['language'],array('English'=>'English','Sim.Chinese'=>'Sim.Chinese','Tra.Chinese'=>'Tra.Chinese'));
			?>
		</td>
	</tr>
	<tr>
		<td>
			<?php 
				echo CHtml::label('Currency','');
				echo CHtml::hiddenField('ItemForm[ItemAttribute][2][attr_id]','3');
				echo CHtml::dropDownList('ItemForm[ItemAttribute][2][value]',$data['ItemForm']['ItemAttribute'][2]['value'],array('1'=>'Dollar','2'=>'RMB'));
			?>
		</td>
		<td>
			<?php 
				echo CHtml::label('Passing-By Cities','ItemForm[ItemAttribute][3][value]');
				echo CHtml::hiddenField('ItemForm[ItemAttribute][3][attr_id]','4');
				echo CHtml::textField('ItemForm[ItemAttribute][3][value]',$data['ItemForm']['ItemAttribute'][3]['value'],array('maxlength'=>'255'));
			?>
		</td>
		<td>
			<?php
				echo CHtml::label('Custom','ItemForm[ItemAttribute][4][value]');
				echo CHtml::hiddenField('ItemForm[ItemAttribute][4][attr_id]','5');
				echo CHtml::dropDownList('ItemForm[ItemAttribute][4][value]',$data['ItemForm']['ItemAttribute'][4]['value'],array('0'=>'False','1'=>'True'));
			?>
		</td>
	</tr>
</table>
<h2>Price Policy</h2>
<div id="policys">
	<?php foreach ($data['ItemForm']['Policy'] as $i => $policyItem) { ?>
		<div id="policy" class=<?php echo "policy".($i+1); ?>>
			<fieldset>
				<legend>
					Policy #<b><?php echo ($i+1); ?></b>
					<input type="button" class="removePolicy btn btn-primary" value='X'></input>
				</legend>
				<div id="leftPolicy" class="left">
					<fieldset>
						<legend>Standard</legend>
						<?php 
						$flag= ($policyItem['ItemAttribute'][0]['value'] == 'packaged') ? true:false;
						echo CHtml::hiddenField('ItemForm[Policy]['.$i.'][ItemAttribute][0][attr_id]','6');//Grouped
						echo CHtml::openTag('label',array('class'=>'radio','for'=>''));
						echo CHtml::radioButton('ItemForm[Policy]['.$i.'][ItemAttribute][0][value]',$flag,array('value'=>'packaged','data-toggle'=>'radio'));
						echo "Grouped";
						echo CHtml::closeTag('label');
						echo CHtml::openTag('label',array('class'=>'radio','for'=>''));
						echo CHtml::radioButton('ItemForm[Policy]['.$i.'][ItemAttribute][0][value]',!$flag,array('value'=>'vip','data-toggle'=>'radio'));
						echo "Personal";
						echo CHtml::closeTag('label');
						?>
					</fieldset>
					<fieldset>
						<legend>Guide</legend>
						<?php 
						$flag= $policyItem['ItemAttribute'][1]['value'] == 'English'? true:false;
						echo CHtml::hiddenField('ItemForm[Policy]['.$i.'][ItemAttribute][1][attr_id]','7');//Grouped
						echo CHtml::openTag('label',array('class'=>'radio','for'=>''));
						echo CHtml::radioButton('ItemForm[Policy]['.$i.'][ItemAttribute][1][value]',$flag,array('value'=>'English','data-toggle'=>'radio'));
						echo "English";
						echo CHtml::closeTag('label');
						echo CHtml::openTag('label',array('class'=>'radio','for'=>''));
						echo CHtml::radioButton('ItemForm[Policy]['.$i.'][ItemAttribute][1][value]',!$flag,array('value'=>'Chinese','data-toggle'=>'radio'));
						echo "Chinese";
						echo CHtml::closeTag('label');
						?>
					</fieldset>
					<fieldset class='hotelDays'>
						<legend>Hotel</legend>
						<?php foreach ($policyItem['ItemItinerary'] as $j => $hotelItem) { ?>
							<div id="hotelDay">
							<label for="">D<?php echo ($j+1); ?></label>
							<?php echo CHtml::textField('ItemForm[Policy]['.$i.'][ItemItinerary]['.$j.']',$hotelItem); ?>
						</div>
						<?php } ?>					
					</fieldset>
					<fieldset>
						<legend>Single Room</legend>
						<?php 
						echo CHtml::hiddenField('ItemForm[Policy]['.$i.'][ItemAttribute][2][attr_id]','8');
						echo CHtml::textField('ItemForm[Policy]['.$i.'][ItemAttribute][2][value]',$policyItem['ItemAttribute'][2]['value']); 
						?>
					</fieldset>
				</div>
				<div id="rightPolicy" class="left">
					<?php 
					echo CHtml::hiddenField('');
					echo CHtml::label('Price Avail','ItemForm[Policy]['.$i.'][ItemAttribute][3][value]');
					$this->widget('zii.widgets.jui.CJuiDatePicker',array(
						'attribute'=>'',
						'id'=>'policy'.($i+1).'begintime',
						'value'=>$data['ItemForm']['Policy'][$i]['ItemAttribute'][3]['value'],
						'language'=>'zh_cn',
						//'id'=>'policy1begintime',
						'name'=>'ItemForm[Policy]['.$i.'][ItemAttribute][3][value]',
						'options'=>array(
						'dateFormat'=>'yy/mm/dd',
						),
						'htmlOptions'=>array(
						//'style'=>'height:10px',
						),
					));
					echo CHtml::hiddenField('ItemForm[Policy]['.$i.'][ItemAttribute][3][attr_id]','9');
					echo CHtml::label('Price Avail','ItemForm[Policy]['.$i.'][ItemAttribute][4][value]');
					$this->widget('zii.widgets.jui.CJuiDatePicker',array(
						'attribute'=>'',
						'id'=>'policy'.($i+1).'endtime',
						'value'=>$data['ItemForm']['Policy'][$i]['ItemAttribute'][4]['value'],
						'language'=>'zh_cn',
						//'id'=>'policy1endtime',
						'name'=>'ItemForm[Policy]['.$i.'][ItemAttribute][4][value]',
						'options'=>array(
						'dateFormat'=>'yy/mm/dd',
						),
						'htmlOptions'=>array(
						//'style'=>'height:18px',
						),
					));
					echo CHtml::hiddenField('ItemForm[Policy]['.$i.'][ItemAttribute][4][attr_id]','10');
					?>
					<h3>
						Aduit Price
						<?php echo CHtml::button('Add',array('class'=>'addAdult btn btn-primary')); ?>
					</h3>
					<table>
						<tr>
							<th>Min Amt</th>
							<th>Max Amt</th>
							<th>Ctm.Price</th>
							<th>Indus.Price</th>
							<th>Delete</th>
						</tr>
						<?php 
						foreach ($policyItem['ItemPrice'] as $k => $priceItem) { 
							if($priceItem['type'] != 'adult') continue;
						?>
							<tr class='priceItemAdult'>
								<?php 
								echo CHtml::hiddenField('ItemForm[Policy]['.$i.'][ItemPrice]['.$k.'][type]','adult');
								echo CHtml::hiddenField('ItemForm[Policy]['.$i.'][ItemPrice]['.$k.'][amt_type]','amount');
								?>
								<td>
									<?php echo CHtml::textField('ItemForm[Policy]['.$i.'][ItemPrice]['.$k.'][min]',$priceItem['min']); ?>
								</td>
								<td>
									<?php echo CHtml::textField('ItemForm[Policy]['.$i.'][ItemPrice]['.$k.'][max]',$priceItem['max']); ?>
								</td>
								<td>
									<?php echo CHtml::textField('ItemForm[Policy]['.$i.'][ItemPrice]['.$k.'][customer]',$priceItem['customer']); ?>
								</td>
								<td>
									<?php echo CHtml::textField('ItemForm[Policy]['.$i.'][ItemPrice]['.$k.'][industrial]',$priceItem['industrial']); ?>
								</td>
								<td>
									<?php echo CHtml::button('X',array('class'=>'removeAdult btn btn-primary')); ?>
								</td>
							</tr>
						<?php }?>
					</table>
					<h3>
						Child Price
						<?php echo CHtml::button('Add',array('class'=>'addChild btn btn-primary')); ?>
					</h3>
					<table>
						<tr>
							<th>Min Age</th>
							<th>Max Age</th>
							<th>Ctm.Price</th>
							<th>Indus.Price</th>
							<th>Delete</th>
						</tr>
						<?php 
						foreach ($policyItem['ItemPrice'] as $k => $priceItem) { 
							if($priceItem['type'] != 'children') continue;
						?>
							<tr class='priceItemChild'>
								<?php 
								echo CHtml::hiddenField('ItemForm[Policy]['.$i.'][ItemPrice]['.$k.'][type]','children');
								echo CHtml::hiddenField('ItemForm[Policy]['.$i.'][ItemPrice]['.$k.'][amt_type]','age');
								?>
								<td>
									<?php echo CHtml::textField('ItemForm[Policy]['.$i.'][ItemPrice]['.$k.'][min]',$priceItem['min']); ?>
								</td>
								<td>
									<?php echo CHtml::textField('ItemForm[Policy]['.$i.'][ItemPrice]['.$k.'][max]',$priceItem['max']); ?>
								</td>
								<td>
									<?php echo CHtml::textField('ItemForm[Policy]['.$i.'][ItemPrice]['.$k.'][customer]',$priceItem['customer']); ?>
								</td>
								<td>
									<?php echo CHtml::textField('ItemForm[Policy]['.$i.'][ItemPrice]['.$k.'][industrial]',$priceItem['industrial']); ?>
								</td>
								<td>
									<?php echo CHtml::button('X',array('class'=>'removeChild btn btn-primary')); ?>
								</td>
							</tr>
						<?php }?>
					</table>
				</div>
				<div id="clear-fix" class="clear"></div>
				<div class="policyContent">
					<?php
					echo CHtml::label('Included','');
					echo CHtml::hiddenField('ItemForm[Policy]['.$i.'][ItemSection][0][name]','Included');
					echo "<textarea class='ueditor' id='includeEditor".($i+1)."' name='ItemForm[Policy][".$i."][ItemSection][0][value]'>".$policyItem['ItemSection'][0]['value']."</textarea>";
					echo CHtml::label('Not-Included','');
					echo CHtml::hiddenField('ItemForm[Policy]['.$i.'][ItemSection][1][name]','Not_included');
					echo "<textarea class='ueditor' id='notIncludeEditor".($i+1)."' name='ItemForm[Policy][".$i."][ItemSection][1][value]'>".$policyItem['ItemSection'][1]['value']."</textarea>";
					?>
				</div>
			</fieldset>
		</div>
	<?php } ?>
	<?php echo CHtml::button('Add Policy',array('id'=>'addPolicy','class'=>'btn btn-primary btn-big')); ?>
</div>

<h2>itenary</h2>
<div id="itenary">
	<?php foreach ($data['ItemForm']['ItemItinerary'] as $l =>$itineraryItem) { ?>
		<fieldset>
			<legend>
				Day #
				<b><?php echo ($l+1)?></b>
			</legend>
			<table>
				<tr>
					<td>
						<?php echo CHtml::textField('ItemForm[ItemItinerary]['.$l.'][title]',$itineraryItem['title'],array('placeholder'=>'Title')); ?>
					</td>
					<td>
						<?php echo CHtml::textField('ItemForm[ItemItinerary]['.$l.'][traffic]',$itineraryItem['traffic'],array('placeholder'=>'Traffic')); ?>
					</td>
					<td>
						<?php echo CHtml::textField('ItemForm[ItemItinerary]['.$l.'][food]',$itineraryItem['food'],array('placeholder'=>'Food')); ?>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<?php echo CHtml::textArea('ItemForm[ItemItinerary]['.$l.'][content]',$itineraryItem['content'],array('placeholder'=>'Content')); ?>
					</td>
				</tr>
			</table>
		</fieldset>
	<?php } ?>
</div>
<h2>
	Content
	<?php echo CHtml::button('Add',array('id'=>'addContent','class'=>'btn btn-primary')); ?>
</h2>
<div id="contents">
	<?php foreach ($data['ItemForm']['ItemSection'] as $m => $sectionItem) { ?>
		<div class="content">
			<?php 
			echo CHtml::textField('ItemForm[ItemSection]['.$m.'][name]',$sectionItem['name']);
			echo CHtml::textArea('ItemForm[ItemSection]['.$m.'][value]',$sectionItem['value'],array(
				'id'=>'content'.($m+1),
				'class'=>'ueditor'
				));
			?>
		</div>
	<?php } ?>
</div>
<h2>
	Pictures
	<?php echo CHtml::button('Add',array('id'=>'addPicture','class'=>'btn btn-primary')); ?>
</h2>
<div id="pictures">
	<?php foreach ($data['ItemForm']['ItemAttachment'] as $n => $attachmentItem) { 
		if($attachmentItem['type'] != 'picture') continue; ?>
		<div class="picture">
			<?php 
			echo CHtml::hiddenField('ItemForm[ItemAttachment]['.$n.'][type]','picture');
			echo CHtml::label('title','');
			echo CHtml::textField('ItemForm[ItemAttachment]['.$n.'][title]',$attachmentItem['title'],array('placeholder'=>'Title'));
			echo CHtml::label('description','');
			echo CHtml::textField('ItemForm[ItemAttachment]['.$n.'][desc]',$attachmentItem['desc'],array('placeholder'=>'Description'));
			echo CHtml::fileField('file[]',$attachmentItem['path']);
			echo CHtml::button('Remove',array('class'=>'removePicture btn btn-primary'));
			?>
			<img src="" alt="" />
		</div>
	<?php } ?>
</div>
<h2>
	Attributes
	<?php echo CHtml::button('Add',array('id'=>'addAttribute','class'=>'btn btn-primary')); ?>
</h2>
<div id="attributes">
	<?php foreach ($data['ItemForm']['ItemAttachment'] as $o => $attachmentItem) { 
		if($attachmentItem['type'] != 'attribute') continue; ?>
		<div class="attribute">
			<?php 
			echo CHtml::hiddenField('ItemForm[ItemAttachment]['.$o.'][type]','attribute');
			echo CHtml::label('title','');
			echo CHtml::textField('ItemForm[ItemAttachment]['.$o.'][title]',$attachmentItem['title'],array('placeholder'=>'Title'));
			echo CHtml::label('description','');
			echo CHtml::textField('ItemForm[ItemAttachment]['.$o.'][desc]',$attachmentItem['desc'],array('placeholder'=>'Description'));
			echo CHtml::fileField('file[]',$attachmentItem['path']);
			echo CHtml::button('Remove',array('class'=>'removeAttribute btn btn-primary'));
			
			?>
		</div>
	<?php } ?>
</div>
<?php 
echo CHtml::submitButton('Submit',array('class'=>'btn btn-primary'));
echo CHtml::endForm();
?>
