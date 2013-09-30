<?php
echo CHtml::cssFile(Yii::app()->baseUrl."/themes/admin/css/activity.css");
echo CHtml::scriptFile(Yii::app()->baseUrl."/themes/admin/js/activity.js");
echo CHtml::scriptFile(Yii::app()->baseUrl."/themes/admin/js/ueditor/editor_config.js");
echo CHtml::scriptFile(Yii::app()->baseUrl."/themes/admin/js/ueditor/editor_all.js");
echo "<h1>Add New Activity</h1>";
echo "<h2>Activity Attributes</h2>";
echo CHtml::beginForm(Yii::app()->homeUrl.'?r=admin/activityadd','post',array('enctype'=>'multipart/form-data','name'=>'ItemForm'));
echo CHtml::hiddenField('ItemForm[Item][type]','activity');
echo CHtml::hiddenField('ItemForm[Item][id]', '');
echo CHtml::openTag('table',array('class'=>'baseAttribute'));
echo CHtml::openTag('tr');
echo CHtml::openTag('td');

echo CHtml::label('Activity Name','ItemForm[Item][name]');
echo CHtml::textField('ItemForm[Item][name]','',array('maxlength'=>'255'));//name value
echo CHtml::closeTag('td');
echo CHtml::openTag('td',array('colspan'=>'2'));
echo CHtml::label('Location','ItemForm[ItemAttribute][0][value]');
echo CHtml::hiddenField('ItemForm[ItemAttribute][0][attr_id]','1');
echo CHtml::dropDownList('ItemForm[ItemAttribute][0][value]','24',
	array(
		'19'=>'European',
		'24'=>'Asia',
		'25'=>'Africa',
		'29'=>'Oceanica',
		'45'=>'Central and South America',
		'53'=>'North America',
		'68'=>'Belgium',
		'83'=>'Vietnam Danang',
		),
	array(
		'id'=>'LocationContinent',
		));
echo CHtml::dropDownList('LocationCountry','China',
	array(
		'China'=>'China',
	),
	array(
		'id'=>'LocationCountry',
	));
echo CHtml::dropDownList('LocationCity','',
	array(),
	array(
		'id'=>'LocationCity',
	));
echo CHtml::hiddenField('ItemForm[ItemAttribute][5][attr_id]','11');
echo CHtml::textField('ItemForm[ItemAttribute][5][value]','',array('id'=>'LocationOther'));
//loccation
echo CHtml::closeTag('td');
echo CHtml::closeTag('tr');
echo CHtml::openTag('tr');
echo CHtml::openTag('td');

echo CHtml::label('Book in Advance','ItemForm[Item][pre_book]');
echo CHtml::textField('ItemForm[Item][pre_book]','',array('maxlength'=>'255'));
echo CHtml::label('Day','ItemForm[Item][pre_book]');
echo CHtml::closeTag('td');
echo CHtml::openTag('td');
echo CHtml::label('Duration','');
echo CHtml::textField('tmp_d','',array('maxlength'=>'255','id'=>'tem_d'));
echo CHtml::label('D','tmp_d');
echo CHtml::textField('tmp_h','',array('maxlength'=>'255','id'=>'tem_h'));
echo CHtml::label('H','tmp_h');
echo CHtml::hiddenField('ItemForm[ItemAttribute][1][attr_id]','2');
echo CHtml::hiddenField('ItemForm[ItemAttribute][1][value]','25');
echo CHtml::closeTag('td');
echo CHtml::openTag('td');
echo CHtml::label('Language','ItemForm[Item][language]');
echo CHtml::dropDownList('ItemForm[Item][language]','English',array('English'=>'English','Sim.Chinese'=>'Sim.Chinese','Tra.Chinese'=>'Tra.Chinese'));
echo CHtml::closeTag('td');
echo CHtml::closeTag('tr');
echo CHtml::openTag('tr');
echo CHtml::openTag('td');
echo CHtml::label('Currency','ItemForm[ItemAttribute][2][value]');
echo CHtml::hiddenField('ItemForm[ItemAttribute][2][attr_id]','3');
echo CHtml::dropDownList('ItemForm[ItemAttribute][2][value]','',array('1'=>'Dollar','2'=>'RMB'));
echo CHtml::closeTag('td');
echo CHtml::openTag('td');

echo CHtml::label('Passing-By Cities','ItemForm[ItemAttribute][3][value]');
echo CHtml::hiddenField('ItemForm[ItemAttribute][3][attr_id]','4');
echo CHtml::textField('ItemForm[ItemAttribute][3][value]','',array('maxlength'=>'255'));
echo CHtml::closeTag('td');
echo CHtml::openTag('td');

echo CHtml::label('Custom','ItemForm[ItemAttribute][4][value]');
echo CHtml::hiddenField('ItemForm[ItemAttribute][4][attr_id]','5');
echo CHtml::dropDownList('ItemForm[ItemAttribute][4][value]','',array('0'=>'False','1'=>'True'));
echo CHtml::closeTag('td');
echo CHtml::closeTag('tr');
echo CHtml::closeTag('table');
///policy
echo "<h2>Price Policy</h2>";
echo CHtml::openTag('div',array('id'=>'policys'));//policy box
echo CHtml::openTag('div',array('class'=>'policy1','id'=>'policy')); //policy container box
echo CHtml::openTag('fieldset');//policy #1
echo CHtml::openTag('legend');
$policyNum= 1;
echo "Policy #<b>".$policyNum."</b>"; //echo "Policy #"."<b></b>";
echo CHtml::button('X',array('class'=>'removePolicy btn btn-primary'));
echo CHtml::closeTag('legend');

echo CHtml::openTag('div',array('id'=>'leftPolicy','class'=>'left'));//leftbox
echo "<fieldset>";
echo "<legend>Standard</legend>";
echo CHtml::openTag('label',array('class'=>'radio','for'=>''));
echo CHtml::hiddenField('ItemForm[Policy][0][ItemAttribute][0][attr_id]','6');//Grouped
echo CHtml::radioButton('ItemForm[Policy][0][ItemAttribute][0][value]',true,array('value'=>'packaged','data-toggle'=>'radio'));
echo "Grouped";
echo CHtml::closeTag('label');
echo CHtml::openTag('label',array('class'=>'radio','for'=>''));
echo CHtml::hiddenField('ItemForm[Policy][0][ItemAttribute][0][attr_id]','6');//personal
echo CHtml::radioButton('ItemForm[Policy][0][ItemAttribute][0][value]',false,array('value'=>'vip','data-toggle'=>'radio'));
echo "Personal";
echo CHtml::closeTag('label');
echo "</fieldset>";
echo "<fieldset>";
echo "<legend>Guide</legend>";
echo CHtml::openTag('label',array('class'=>'radio','for'=>''));
echo CHtml::hiddenField('ItemForm[Policy][0][ItemAttribute][1][attr_id]','7');//english
echo CHtml::radioButton('ItemForm[Policy][0][ItemAttribute][1][value]',true,array('value'=>'English','data-toggle'=>'radio'));
echo "English";
echo CHtml::closeTag('label');
echo CHtml::openTag('label',array('class'=>'radio','for'=>''));
echo CHtml::hiddenField('ItemForm[Policy][0][ItemAttribute][1][attr_id]','7');//chinese
echo CHtml::radioButton('ItemForm[Policy][0][ItemAttribute][1][value]',false,array('value'=>'Chinese','data-toggle'=>'radio'));
echo "Chinese";
echo CHtml::closeTag('label');
echo "</fieldset>";
echo "<fieldset class='hotelDays'>";//hotelfieldset
echo "<legend>Hotel</legend>";
echo "<div id='hotelDay'>";
echo CHtml::label('D1','ItemForm[Policy][0][ItemItinerary][0]');
echo CHtml::textField('ItemForm[Policy][0][ItemItinerary][0]','');
echo "</div>";
echo "</fieldset>";//hotelfieldset
echo "<fieldset>";//singel room
echo "<legend>Singel Room</legend>";
echo CHtml::hiddenField('ItemForm[Policy][0][ItemAttribute][2][attr_id]','8');
echo CHtml::textField('ItemForm[Policy][0][ItemAttribute][2][value]','');
echo "</fieldset>";//singel room
echo CHtml::closeTag('div');//leftbox

echo CHtml::openTag('div',array('id'=>'rightPolicy','class'=>'left'));//rightbox
echo CHtml::label('Price Avail','ItemForm[Policy][0][ItemAttribute][3][value]');
/**/$this->widget('zii.widgets.jui.CJuiDatePicker',array(
	'attribute'=>'',
	'language'=>'zh_cn',
	'id'=>'policy1begintime',
	'name'=>'ItemForm[Policy][0][ItemAttribute][3][value]',
	'options'=>array(
		'dateFormat'=>'yy/mm/dd',
		),
	'htmlOptions'=>array(
		//'style'=>'height:10px',
		),
	));
echo CHtml::hiddenField('ItemForm[Policy][0][ItemAttribute][3][attr_id]','9');
echo CHtml::label('To','ItemForm[Policy][0][ItemAttribute][4][value]');
/**/$this->widget('zii.widgets.jui.CJuiDatePicker',array(
	'attribute'=>'',
	'language'=>'zh_cn',
	'id'=>'policy1endtime',
	'name'=>'ItemForm[Policy][0][ItemAttribute][4][value]',
	'options'=>array(
		'dateFormat'=>'yy/mm/dd',
		),
	'htmlOptions'=>array(
		//'style'=>'height:18px',
		),
	));
echo CHtml::hiddenField('ItemForm[Policy][0][ItemAttribute][4][attr_id]','10');
echo "<h3>Aduit Price";
echo CHtml::button('Add',array('class'=>'addAdult btn btn-primary'));
echo "</h3>";
//adult
echo "<table>";
echo "<tr>";
echo "<th>Min Amt</th>";
echo "<th>Max Amt</th>";
echo "<th>Ctm.Price</th>";
echo "<th>Indus.Price</th>";
echo "<th>Delete</th>";
echo "</tr>";
echo "<tr class='priceItemAdult'>";
echo CHtml::hiddenField('ItemForm[Policy][0][ItemPrice][0][type]','adult');
echo CHtml::hiddenField('ItemForm[Policy][0][ItemPrice][0][amt_type]','amount');
echo "<td>";
echo CHtml::textField('ItemForm[Policy][0][ItemPrice][0][min]','1');
echo "</td>";
echo "<td>";
echo CHtml::textField('ItemForm[Policy][0][ItemPrice][0][max]','1');
echo "</td>";
echo "<td>";
echo CHtml::textField('ItemForm[Policy][0][ItemPrice][0][customer]','');
echo "</td>";
echo "<td>";
echo CHtml::textField('ItemForm[Policy][0][ItemPrice][0][industrial]','1');
echo "</td>";
echo "<td>";
echo CHtml::button('X',array('class'=>'removeAdult btn btn-primary'));
echo "</td>";
echo "</tr>";
echo "</table>";
//children
echo "<h3>Child Price";
echo CHtml::button('Add',array('class'=>'addChild btn btn-primary'));
echo "</h3>";
echo "<table>";
echo "<tr>";
echo "<th>Min Age</th>";
echo "<th>Max Age</th>";
echo "<th>Ctm.Price</th>";
echo "<th>Indus.Price</th>";
echo "<th>Delete</th>";
echo "</tr>";
echo "<tr class='priceItemChild'>";
echo CHtml::hiddenField('ItemForm[Policy][0][ItemPrice][1][type]','children');
echo CHtml::hiddenField('ItemForm[Policy][0][ItemPrice][1][amt_type]','age');
echo "<td>";
echo CHtml::textField('ItemForm[Policy][0][ItemPrice][1][min]','1');
echo "</td>";
echo "<td>";
echo CHtml::textField('ItemForm[Policy][0][ItemPrice][1][max]','1');
echo "</td>";
echo "<td>";
echo CHtml::textField('ItemForm[Policy][0][ItemPrice][1][customer]','');
echo "</td>";
echo "<td>";
echo CHtml::textField('ItemForm[Policy][0][ItemPrice][1][industrial]','1');
echo "</td>";
echo "<td>";
echo CHtml::button('X',array('class'=>'removeChild btn btn-primary'));
echo "</td>";
echo "</tr>";
echo "</table>";
echo CHtml::closeTag('div');//rightbox

echo CHtml::openTag('div',array('id'=>'claer-fix','class'=>'clear'));
echo CHtml::closeTag('div');
echo "<div class='policyContent'>";
echo CHtml::label('Included','ItemForm[Policy][0][ItemSection][0][value]');
echo CHtml::hiddenField('ItemForm[Policy][0][ItemSection][0][name]','Included');
echo "<textarea id='includeEditor' name='ItemForm[Policy][0][ItemSection][0][value]'></textarea>";
//echo "</div>";
//echo "<div class='content'>";
echo CHtml::label('Not-Included','ItemForm[Policy][0][ItemSection][1][value]');
echo CHtml::hiddenField('ItemForm[Policy][0][ItemSection][1][name]','Not-included');
echo "<textarea id='notIncludeEditor' name='ItemForm[Policy][0][ItemSection][1][value]'></textarea>";
echo "</div>";
echo "</fieldset>";//Policy fieldset
echo "</div>"; //policy container box
echo CHtml::button('Add Policy',array('id'=>'addPolicy','class'=>'btn btn-primary btn-big'));
echo CHtml::closeTag('div');//policy box 

//itenary
echo CHtml::tag('h2',array(),'itenary',true);
echo CHtml::openTag('div',array('id'=>'itenary'));//itenarybox
echo CHtml::openTag('fieldset');//itenary fieldset
echo "<legend>Day # <b>1</b></legend>";
echo "<table>";
echo "<tr>";
echo "<td>";
echo CHtml::textField('ItemForm[ItemItinerary][0][title]','',array('placeholder'=>'Title'));
echo "</td>";
echo "<td>";
echo CHtml::textField('ItemForm[ItemItinerary][0][traffic]','',array('placeholder'=>'Traffic'));
echo "</td>";
echo "<td>";
echo CHtml::textField('ItemForm[ItemItinerary][0][food]','',array('placeholder'=>'Food'));
echo "</td>";
echo "</tr>";
echo "<tr>";
echo CHtml::openTag('td',array('colspan'=>'3'));
echo CHtml::textArea('ItemForm[ItemItinerary][0][content]','',array());
echo CHtml::closeTag('td');
echo "</tr>";
echo "</table>";
echo CHtml::closeTag('fieldset');//itenary fieldset
echo CHtml::closeTag('div');// itenary box

echo "<h2>Content";
echo CHtml::button('Add',array('id'=>'addContent','class'=>'btn btn-primary'));
echo "</h2>";
echo CHtml::openTag('div',array('id'=>'contents'));//contents box
echo CHtml::openTag('div',array('class'=>'content'));//content box

echo CHtml::label('Feature','forname');
echo CHtml::hiddenField('ItemForm[ItemSection][0][name]','Feature');
echo "<textarea id='featuredEditor' name='ItemForm[ItemSection][0][value]'></textarea>";
echo CHtml::closeTag('div');//content box

echo CHtml::openTag('div',array('class'=>'content'));//content box

echo CHtml::label('Notes','forname');
echo CHtml::hiddenField('ItemForm[ItemSection][1][name]','Notes');
echo "<textarea id='notesEditor' name='ItemForm[ItemSection][1][value]'></textarea>";
echo CHtml::closeTag('div');//content box

echo CHtml::closeTag('div');// contents box

echo "<h2>Pictures";
echo CHtml::button('Add',array('id'=>'addPicture','class'=>'btn btn-primary'));
echo"</h2>";
echo CHtml::openTag('div',array('id'=>'pictures'));//pictures box
echo "<div class='picture'>";
echo CHtml::hiddenField('ItemForm[ItemAttachment][0][type]','picture');
echo CHtml::textField('ItemForm[ItemAttachment][0][title]','',array('placeholder'=>'Title'));
echo CHtml::textField('ItemForm[ItemAttachment][0][desc]','',array('placeholder'=>'Description'));
echo CHtml::hiddenField('name','value');
echo CHtml::fileField('file[]','');
echo CHtml::button('Remove',array('class'=>'removePicture btn btn-primary'));
echo "</div>";
echo CHtml::closeTag('div');//pictures box

echo "<h2>Attributes";
echo CHtml::button('Add',array('id'=>'addAttribute','class'=>'btn btn-primary'));
echo"</h2>";
echo CHtml::openTag('div',array('id'=>'attributes'));//attributes box
echo CHtml::openTag('div',array('class'=>'attribute'));
echo CHtml::hiddenField('ItemForm[ItemAttachment][1][type]','attribute');
echo CHtml::textField('ItemForm[ItemAttachment][1][title]','',array('placeholder'=>'Title'));
echo CHtml::textField('ItemForm[ItemAttachment][1][desc]','',array('placeholder'=>'Description'));
echo CHtml::fileField('file[]','');
echo CHtml::button('Remove',array('class'=>'removeAttribute btn btn-primary'));
echo CHtml::closeTag('div');
echo CHtml::closeTag('div');//attributes box

echo CHtml::submitButton('Submit',array('class'=>'btn btn-primary btn-big'));
echo CHtml::endForm();

