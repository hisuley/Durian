$(document).ready(function() {
	//初始化Editor
	updateEditor("includeEditor");
	updateEditor("notIncludeEditor");
	updateEditor('featuredEditor');
	updateEditor('notesEditor');
	
	$('input[name="tmp_d"]').change(function(event) {
		var regReplace= /\[ItemItinerary\]\[\d+\]/g;
		var days= $(this).val();
		days= parseInt(days);
		var curDays= $('div#policy:first').find('div#hotelDay').size();
		if (curDays == days) {return true;}
		else if(curDays < days){
			//加
			$('div#policy').each(function (){
				for(var i= 0;i < (days-curDays); i++ ) {
				var cloneHotel= $(this).find('div#hotelDay:last').clone();
				var oldName= cloneHotel.find('input').attr('name');
				var newName= oldName.replace(regReplace,'[ItemItinerary]['+(curDays+i)+']');
				cloneHotel.find('input').attr('name', newName);
				cloneHotel.find('input').val('');
				cloneHotel.find('label').text('D'+(curDays+i+1));	
				$(this).find('div#hotelDay:last').after(cloneHotel);
				}
			});
			for(var i= 0; i< (days-curDays); i++) { 
				var cloneFieldset= $('div#itenary').find('fieldset:last').clone();
				cloneFieldset.find('input,textarea').val('');
				cloneFieldset.find('legend b').text(curDays+i+1);
				cloneFieldset.find('input,textarea').each(function() {
				var oldName= $(this).attr('name');
				var newName= oldName.replace(regReplace,'[ItemItinerary]['+(curDays+i)+']');
				$(this).attr('name', newName);				
			});
			cloneFieldset.insertAfter('div#itenary>fieldset:last');
			}
		}	
		else{
			//减
			$('div#policy').each(function() {
				for(var i=0;i < (curDays-days); i++) {
				$(this).find('div#hotelDay:last').remove();	
				
				}
			});
			for(var i=0; i <(curDays-days); i++) {
				$('div#itenary').find('fieldset:last').remove();
			}
		}	
	});


	$('#addPolicy').click(function(event) {
		/* Act on the event */
		var policys= $('div#policy').size();
		cloneLeftPolicy= $('div#policy:first div#leftPolicy').clone();
		clonePolicy= $('div#policy:first').clone(true);
		clonePolicy.find('div#leftPolicy').remove();
		clonePolicy.find('legend:first').after(cloneLeftPolicy);
		clonePolicy.attr('class', 'policy'+(policys+1));
		clonePolicy.find('input[name*="ItemForm[Policy]"]').each(function() {
			var oldName= $(this).attr('name');
			var regReplace= /ItemForm\[Policy\]\[\d+\]/g;
			var newName= oldName.replace(regReplace,'ItemForm[Policy]['+(policys)+']');
			$(this).attr({
				name: newName,
			});
		});	
		clonePolicy.find('label').each(function() {
			var oldName= $(this).attr('for');
			var regReplace= /ItemForm\[Policy\]\[\d+\]/g;
			var newName= oldName.replace(regReplace,'ItemForm[Policy]['+(policys)+']');
			$(this).attr({
				for: newName,
			});
		});
		
		clonePolicy.find('input:text,textarea').val('');
		clonePolicy.find('legend b').text(policys+1);
		
		clonePolicy.find('input[name="ItemForm[Policy][0][ItemSection][0][name]"][type="hidden"]').attr({
			name: 'ItemForm[Policy]['+policys+'][ItemSection][0][name]',
			value: 'Included',
		});
		clonePolicy.find('input[name="ItemForm[Policy][0][ItemSection][1][name]"][type="hidden"]').attr({
			name: 'ItemForm[Policy]['+policys+'][ItemSection][1][name]',
			value: 'No_itncluded',
		});
		clonePolicy.find('div.edui-default').remove();

		clonePolicy.find('textarea[id=includeEditor]').attr({
			id: 'includeEditor'+(policys+1),
			name: 'ItemForm[Policy]['+policys+'][ItemSection][0][value]',
		});
		clonePolicy.find('textarea[id=notIncludeEditor]').attr({
			id: 'notIncludeEditor'+(policys+1),
			name: 'ItemForm[Policy]['+policys+'][ItemSection][1][value]',
		});
		
		clonePolicy.find('input#policy1begintime').remove();
		clonePolicy.find('input#policy1endtime').remove();
		clonePolicy.insertAfter('div#policy:last');
		var date= new Date();
		var time= date.getTime();
		var timeName= 'ItemForm[Policy]['+policys+'][ItemAttribute][3][value]';
		var insert= "<input type='text' id=begin"+time+" name='"+timeName+"'/>";
		$(insert).insertAfter('label[for="'+timeName+'"]');
		var timeID= $('input[name="'+timeName+'"]').attr('id');
		$('input#'+timeID).datepicker();
		timeName= 'ItemForm[Policy]['+policys+'][ItemAttribute][4][value]';
		insert= "<input type='text' id=end"+time+" name='"+timeName+"'/>";
		$(insert).insertAfter('label[for="'+timeName+'"]');
		var timeID= $('input[name="'+timeName+'"]').attr('id');
		$('input#'+timeID).datepicker();

		updateEditor(clonePolicy.find('textarea:first').attr('id'));
		updateEditor(clonePolicy.find('textarea:last').attr('id'));
		clonePolicy.find('div.edui-default').css('display', 'block');
		$('div[id*="toolbarmsg"]').css('display', 'none');	
	});

	$('input.removePolicy').click(function(event) {
		/* Act on the event */
		var regReplace= /ItemForm\[Policy\]\[\d+\]/g;
		var policys= $('div#policy').size();
		var parent= $(this).parents('div#policy');
		var index= parent.index();
		var next= parent.next();
		if(index != 0) {
			for(i=1; i< (policys-index); i++)
			{	var nextIndex= next.index();
				next.find('legend>b').text(nextIndex);
				next.attr('class', 'policy'+(nextIndex));
				next.find('textarea').each(function() {
					var regR= /Editor\d+/g;
					var newId= $(this).attr('id').replace(regR,'Editor'+(nextIndex));
					$(this).attr('id', newId);
				});				
				next.find('input[type!="button"],textarea').each(function() {
					var oldName= $(this).attr('name');
					var newName= oldName.replace(regReplace,'ItemForm[Policy]['+(nextIndex-1)+']');
					$(this).attr('name', newName);
				});
				next.find('label').each(function() {
					var oldFor= $(this).attr('for');
					var newFor= oldFor.replace(regReplace,'ItemForm[Policy]['+(nextIndex-1)+']');
					$(this).attr('for', newFor);
				});
				next= next.next();
			}
			parent.remove();
		}

		
	});
	
	$('input.addAdult').click(function(event) {
		/* Act on the event */
		var parentID= $(this).parents('div[id="policy"]').attr('class');
		var addult= $('div.'+parentID).find('tr.priceItemAdult').size();
		var child= $('div.'+parentID).find('tr.priceItemChild').size();
		addult= child+addult;
		var clone= $('div.'+parentID+' tr.priceItemAdult:first').clone(true);
		clone.find('input[type !="button"][type!="hidden"]').val('');
		var regReplace= /\[ItemPrice\]\[\d+\]/g;
		clone.find('input[type!="button"]').each(function() {
			var oldName= $(this).attr('name');
			var newName= oldName.replace(regReplace,'[ItemPrice]['+(addult)+']');//??
			$(this).attr('name', newName);
		});
		clone.insertAfter('div.'+parentID+' tr.priceItemAdult:last');//加在自己的policy下
	});

	$('input.removeAdult').click(function(event) {
		var regReplace= /\[ItemPrice\]\[\d+\]/g;
		var curNum= $(this).parents('tr.priceItemAdult').find('input[type="hidden"]').attr('name');
		curNum= parseInt(curNum.slice(31, 32));//提取数字
		if (curNum !=0) 
			{
				$('tr.priceItemChild,tr.priceItemAdult').each(function() {
					var num= $(this).find('input[type="hidden"]').attr('name');
					num= parseInt(num.slice(31, 32));
					if (num > curNum) {
						var oldName= $(this).find('input[type != "button"]').attr('name');
						var newName= oldName.replace(regReplace,'[ItemPrice]['+(num-1)+']');
						$(this).find('input[type!="button"]').each(function() {
							$(this).attr('name', newName);
						});
					}
				});
				$(this).parents('tr.priceItemAdult').remove();
			}
	});

	$('input.addChild').click(function(event) {
		/* Act on the event */
		var parentID= $(this).parents('div[id="policy"]').attr('class');
		var addult= $('div.'+parentID).find('tr.priceItemAdult').size();
		var child= $('div.'+parentID).find('tr.priceItemChild').size();
		child= addult+child;
		var clone= $('div.'+parentID+' tr.priceItemChild:first').clone(true);
		clone.find('input[type != "button"][type!="hidden"]').val('');
		var regReplace= /\[ItemPrice\]\[\d+\]/g;
		clone.find('input[type !="button"]').each(function() {
			var oldName= $(this).attr('name');
			var newName= oldName.replace(regReplace,'[ItemPrice]['+(child)+']');//??
			$(this).attr('name', newName);
		});
		clone.insertAfter('div.'+parentID+' tr.priceItemChild:last');//加在自己的policy下
	});

	$('input.removeChild').click(function(event) {
		/* Act on the event 
		var tra= $('tr.priceItemAdult').size();
		var trc= $('tr.priceItemChild').size();
		var tr= tra+trc;*/
		var regReplace= /\[ItemPrice\]\[\d+\]/g;
		var curNum= $(this).parents('tr.priceItemChild').find('input[type="hidden"]').attr('name');
		curNum= parseInt(curNum.slice(31, 32));//提取数字
		if (curNum != 1) 
			{
				$('tr.priceItemChild,tr.priceItemAdult').each(function() {
					var num= $(this).find('input[type="hidden"]').attr('name');
					num= parseInt(num.slice(31, 32));
					if (num > curNum) {
						var oldName= $(this).find('input[type != "button"]').attr('name');
						var newName= oldName.replace(regReplace,'[ItemPrice]['+(num-1)+']');
						$(this).find('input[type!="button"]').each(function() {
							$(this).attr('name', newName);
						});
					}
				});
				$(this).parents('tr.priceItemChild').remove();
			}
		//parentName= parentName.slice(, end);
		 //var nextparent= parent.next();	
	});
	
	$('input#addContent').click(function(event) {
		/* Act on the event */
		var regReplace= /\[ItemSection\]\[\d+\]/g;
		var contents= $('div.content').size();
		var clone= $('div.content:first').clone(true);	
		var inputName= clone.find('input[type="hidden"]').attr('name').replace(regReplace,'[ItemSection]['+(contents)+']');
		clone.find('label:first,input[type="hidden"]').remove();
		clone.find('div.edui-default').remove();
		var textareaName= clone.find('textarea').attr('name').replace(regReplace,'[ItemSection]['+(contents)+']');
		clone.find('textarea').attr({
			id:'content'+(contents+1),
			name: textareaName,
		});
		clone.insertAfter('div.content:last');
		updateEditor(clone.find('textarea').attr('id'));
		clone.find('div.edui-default').css('display', 'block');
		$('div[class*="toolbarmsg"]').css('display', 'none');
		clone.prepend('<input type="text" value="" name="'+inputName+'">');
		//$('div.content'+(contents+1)).prepend("<input  type='text' name="+inputName+" />");
	});






	$('input#addPicture').click(function(event) {
		/* Act on the event */
		var pictures= $('div.picture').size();
		var attributes= $('div.attribute').size();
		pictures= attributes+pictures;
		var clone= $('div.picture:last').clone(true);//是否开启事件
		//clone.attr('class', 'picture'+pictures);
		var regReplace= /\[ItemAttachment\]\[\d+\]/g;
		clone.find('input[type !="button"]').each(function() {
			if($(this).attr('type') != "hidden")
				{$(this).val('');}
				var oldName= $(this).attr('name');
				var newName= oldName.replace(regReplace,'[ItemAttachment]['+(pictures)+']');
				$(this).attr('name', newName);
			
		});
		clone.insertAfter('div.picture:last');
	});

	$('input.removePicture').click(function(event) {

		var regReplace= /\[ItemAttachment\]\[\d+\]/g;
		var curNum= $(this).parents('div.picture').find('input[type="hidden"]').attr('name');
		curNum= parseInt(curNum.slice(25, 26));//提取数字
		if (curNum !=0) 
			{
				$('div.picture,div.attribute').each(function() {
					$(this).find('input[type != "button"]').each(function() {
						var num= $(this).attr('name');

						num= parseInt(num.slice(25, 26));
						if (num > curNum) {
							var oldName= $(this).attr('name');
							var newName= oldName.replace(regReplace,'[ItemAttachment]['+(num-1)+']');
							$(this).attr('name', newName);
					}	
					});
					
				});
				$(this).parents('div.picture').remove();
			}
	});


	$('input#addAttribute').click(function(event) {
		/* Act on the event */
		var attributes= $('div.attribute').size();
		var pictures= $('div.picture').size();
		attributes= pictures+attributes;
		var clone= $('div.attribute:last').clone(true);//是否开启事件
		var regReplace= /\[ItemAttachment\]\[\d+\]/g;
		clone.find('input[type != "button"]').each(function() {
			if($(this).attr('type') != "hidden")
				{$(this).val('');}
				var oldName= $(this).attr('name');
				var newName= oldName.replace(regReplace,'[ItemAttachment]['+(attributes)+']');
				$(this).attr('name', newName);
				
		});
		clone.insertAfter('div.attribute:last');

	});

		$('input.removeAttribute').click(function(event) {
		var regReplace= /\[ItemAttachment\]\[\d+\]/g;
		var curNum= $(this).parents('div.attribute').find('input[type="hidden"]').attr('name');
		curNum= parseInt(curNum.slice(25, 26));//提取数字
		if (curNum !=1) 
			{
				$('div.picture,div.attribute').each(function() {
					$(this).find('input[type!="button"]').each(function() {
						var num= $(this).attr('name');
						num= parseInt(num.slice(25, 26));
						if (num > curNum) {
							var oldName= $(this).attr('name');
							var newName= oldName.replace(regReplace,'[ItemAttachment]['+(num-1)+']');
							$(this).attr('name', newName);
					}	
					});
					
				});
				$(this).parents('div.attribute').remove();
			}
	});



	$('input[name*="tmp_"]').change(function(event) {
		var d_val= parseInt($('input[name="tmp_d"]').val())*24;
		var h_val= parseInt($('input[name="tmp_h"]').val());
		var val= h_val+d_val;
		$('input[name="ItemForm[ItemAttribute][1][value]"]').val(val);
	});
	
	$locationData = {"19":{"name":"European","memo":"\u6b27\u6d32","value":"European","sub":{"20":{"name":"British","memo":"\u82f1\u56fd","value":"British","sub":{"21":{"name":"London","memo":"\u4f26\u6566","value":"London"}}},"22":{"name":"France","memo":"\u6cd5\u56fd","value":"France","sub":{"23":{"name":"Paris","memo":"\u5df4\u9ece","value":"Paris"}}},"38":{"name":"Germany","memo":"\u5fb7\u56fd","value":"Germany"},"56":{"name":"Greece","memo":"\u5e0c\u814a","value":"Greece"},"57":{"name":"Ireland","memo":"\u7231\u5c14\u5170","value":"Ireland"},"58":{"name":"Austria","memo":"\u5965\u5730\u5229","value":"Austria"},"59":{"name":"Danmark","memo":"\u4e39\u9ea6 ","value":"Danmark"},"60":{"name":"Germany","memo":"\u5fb7\u56fd ","value":"Germany"},"61":{"name":"Russia","memo":"\u4fc4\u7f57\u65af ","value":"Russia"},"62":{"name":"France","memo":"\u6cd5\u56fd ","value":"France"},"63":{"name":"Holland","memo":"\u8377\u5170 ","value":"Holland"},"64":{"name":"Switzerland","memo":"\u745e\u58eb","value":"Switzerland"},"65":{"name":"Spain","memo":"\u897f\u73ed\u7259","value":"Spain"},"66":{"name":"Italy","memo":"\u610f\u5927\u5229","value":"Italy"},"69":{"name":"Belgium","memo":"\u6bd4\u5229\u65f6","value":"Belgium"},"70":{"name":" Vatican City State","memo":"\u68b5\u8482\u5188","value":" Vatican City State"},"71":{"name":"Finland","memo":"\u82ac\u5170","value":"Finland"},"72":{"name":"Czech","memo":"\u6377\u514b","value":"Czech"},"73":{"name":"Portugal","memo":"\u8461\u8404\u7259","value":"Portugal"},"74":{"name":"sweden","memo":"\u745e\u5178 ","value":"sweden"},"75":{"name":"Turkey","memo":"\u571f\u8033\u5176","value":"Turkey"}}},"24":{"name":"Asia","memo":"\u4e9a\u6d32","value":"Asia","sub":{"27":{"name":"Vietnam","memo":"\u8d8a\u5357","value":"Vietnam","sub":{"84":{"name":"Vietnam Danang","memo":"\u5c98\u6e2f","value":"Vietnam Danang"},"85":{"name":"Vietnam Danang","memo":"\u5c98\u6e2f","value":"Vietnam Danang"},"86":{"name":"Vietnam Danang","memo":"\u5c98\u6e2f","value":"Vietnam Danang"},"87":{"name":"Vietnam Danang","memo":"\u5c98\u6e2f","value":"Vietnam Danang"},"88":{"name":"Vietnam Danang","memo":"\u5c98\u6e2f","value":"Vietnam Danang"},"92":{"name":"Ha Noi","memo":"\u6cb3\u5185","value":"Ha Noi"},"93":{"name":"Ho Chi Minh City ","memo":"\u80e1\u5fd7\u660e\u5e02","value":"Ho Chi Minh City "}}},"28":{"name":"Malaysia ","memo":"\u9a6c\u6765\u897f\u4e9a","value":"Malaysia ","sub":{"89":{"name":"Jesselton","memo":"\u4e9a\u5e87","value":"Jesselton"}}},"31":{"name":"Thailand ","memo":"\u6cf0\u56fd","value":"Thailand ","sub":{"51":{"name":"Bangkok","memo":"\u66fc\u8c37","value":"Bangkok"},"81":{"name":"Phuket Island","memo":"\u666e\u5409\u5c9b","value":"Phuket Island"}}},"32":{"name":"Indonesia ","memo":"\u5370\u5ea6\u5c3c\u897f\u4e9a","value":"Indonesia ","sub":{"80":{"name":"Bali","memo":"\u5df4\u5398\u5c9b","value":"Bali"}}},"33":{"name":"Philippine","memo":"\u83f2\u5f8b\u5bbe","value":"Philippine","sub":{"82":{"name":"Boracay","memo":"\u957f\u6ee9\u5c9b","value":"Boracay"}}},"34":{"name":"HONGKONG","memo":"\u9999\u6e2f","value":"HONGKONG"},"35":{"name":"Japan","memo":"\u65e5\u672c","value":"Japan"},"36":{"name":"Korea","memo":"\u97e9\u56fd","value":"Korea"},"37":{"name":"Taiwan","memo":"\u53f0\u6e7e","value":"Taiwan"},"39":{"name":"Cambodia","memo":"\u67ec\u57d4\u5be8","value":"Cambodia"},"40":{"name":"Maldives","memo":"\u9a6c\u5c14\u4ee3\u592b","value":"Maldives"},"41":{"name":"India","memo":"\u5370\u5ea6","value":"India"},"42":{"name":"Singapore","memo":"\u65b0\u52a0\u5761","value":"Singapore"},"43":{"name":"China","memo":"\u4e2d\u56fd","value":"China","sub":{"44":{"name":"Beijing","memo":"\u5317\u4eac","value":"Beijing"}}},"76":{"name":"HongKong","memo":"\u9999\u6e2f ","value":"HongKong"},"77":{"name":"Nepal","memo":"\u5c3c\u6cca\u5c14","value":"Nepal"},"78":{"name":" Sri Lanka","memo":"\u65af\u91cc\u5170\u5361","value":" Sri Lanka"},"79":{"name":"Israel","memo":"\u4ee5\u8272\u5217 ","value":"Israel"},"90":{"name":"Jordan","memo":"\u7ea6\u65e6","value":"Jordan","sub":{"91":{"name":"Anman","memo":"\u5b89\u66fc","value":"Anman"}}}}},"25":{"name":"Africa","memo":"\u975e\u6d32","value":"Africa","sub":{"26":{"name":"Egypt","memo":"\u57c3\u53ca","value":"Egypt"},"49":{"name":"South africa","memo":"\u5357\u975e","value":"South africa"},"50":{"name":"Kenya","memo":"\u80af\u5c3c\u4e9a","value":"Kenya"}}},"29":{"name":"Oceanica","memo":"\u5927\u6d0b\u6d32","value":"Oceanica","sub":{"30":{"name":"Australia","memo":"\u6fb3\u5927\u5229\u4e9a","value":"Australia"},"54":{"name":"New Zealand","memo":"\u65b0\u897f\u5170","value":"New Zealand"}}},"45":{"name":"Central and South America","memo":"\u4e2d\u5357\u7f8e\u6d32","value":"Central and South America","sub":{"46":{"name":"Costa Rica","memo":"\u54e5\u65af\u8fbe\u9ece\u52a0","value":"Costa Rica"},"47":{"name":"Brazil","memo":"\u5df4\u897f","value":"Brazil"},"48":{"name":"Argentina","memo":"\u963f\u6839\u5ef7","value":"Argentina"}}},"53":{"name":"North America","memo":"\u5317\u7f8e\u6d32","value":"North America","sub":{"55":{"name":"Canada","memo":"\u52a0\u62ff\u5927","value":"Canada"},"67":{"name":"United States","memo":"\u7f8e\u56fd","value":"United States"}}},"68":{"name":"Belgium","memo":"\u6bd4\u5229\u65f6","value":"Belgium","sub":[]},"83":{"name":"Vietnam Danang","memo":"\u5c98\u6e2f","value":"Vietnam Danang","sub":[]}};
	$subData = $locationData[24].sub;
	$cityBody = $("select#LocationCity");
	$("select#LocationContinent").change(function(){
		$current = $(this).prop('value');
		$subData = $locationData[$current].sub;
			//console.log($subData);
		$countryBody = $("select#LocationCountry");			
		$countryBody.children().remove();
		$cityBody.children().remove();
			//console.log('length:'+$subData.length);
		for(var i in $subData){
			$countryBody.append('<option value="'+i+'">'+$subData[i].memo+'</option>');	
			}
		$countryBody.children().last().attr('selected', 'selected');
			//console.log($countryBody.children().last().val());
		$cityData = $subData[$countryBody.children().last().val()].sub;
		for(var i in $cityData){
			$cityBody.append('<option value="'+i+'">'+$cityData[i].memo+'</option>');
			};
		//$cityBody.children().last().attr('selected', 'selected');
		var location= $(this).val()+$('#LocationCountry').val()+$('#LocationCity').val();
		$('input[name="ItemForm[ItemAttribute][0][value]"]').val(location);
	});

	$("select#LocationCountry").change(function(){
		$cityBody.children().remove();
		$cityData = $subData[$(this).val()].sub;
		console.log($cityData);
		for(var i in $cityData){
			$cityBody.append('<option value="'+i+'">'+$cityData[i].memo+'</option>');
			};
		var location= $('#LocationContinent').val()+$(this).val()+$('#LocationCity').val();
		$('input[name="ItemForm[ItemAttribute][0][value]"]').val(location);
	});
	$('select#LocationCity').change(function(){
		var location= $('#LocationContinent').val()+$('#LocationCountry').val()+$(this).val();
		$('input[name="ItemForm[ItemAttribute][0][value]"]').val(location);	
	});

	function updateEditor(id){
		var editorx = new UE.ui.Editor();
	  	$textBox = $('#'+id);
		var textbox = $textBox.get(0);
	  	editorx.render(id);
	}

});