<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta name="description" content="">
<meta name="keywords" content="">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/themes/front/css/public.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/themes/front/css/layoutmain.css" />
<script src="<?php echo Yii::app()->baseUrl; ?>/themes/front/js/jQuery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#logo span').click(function(event) {
		/* Act on the event */
		var floatBox= $('<div id="floatBox"></div>');
		floatBox.css({
		width: '100%',
		height: $(document).height(),
		position: 'absolute',
		left: '0px',
		top: '0px',
		"background-color": 'black',
		"z-index": '5',
		'opacity': '0.6'
		});
		$("body").append(floatBox);
		var str= "<div id='floatFrom'><div id='floatFrom-header'><div class='left'><p>登陆</p></div><div class='left'><p>注册</p></div></div><div class='clear'></div><div id='floatFrom-content'></div></div>";
		var floatFrom= $(str);
		floatFrom.css({
			width: '400px',
			height: '400px',
			position: 'absolute',
			top: '40px',
			right: $(document).width()/2,
			'background-color': 'white',
			'opacity': '1',
			'z-index': '6',
		});
		floatFrom.find('div.left').css({
			width: '100px',
			height: '40px',
			"line-height": '40px',
			'text-align': 'center',
			border: '1px solid black'
		});
		floatFrom.find('div#floatFrom-content').html('<form><p><label>用户名<label><input type="text"/></p><p><label>密码</label><input type="text" /></p><p><input type="checkbox"/>记住我的登陆</p><input type="submit" value="登陆"/></form>');
		floatFrom.find('div#floatFrom-header').html('<div id="floatFrom-close">X</div>');
		$('body').append(floatFrom);
		$('div#floatFrom-close').click(function(event) {
			/* Act on the event */
			$('div#floatFrom,div#floatBox').remove();
		});
});
})	
</script>
<script src="<?php echo Yii::app()->baseUrl; ?>/themes/front/js/layoutmain.js"></script>
</head>
<body>
 	<div id="header">
 		<div class='header-left left'>
 			<div id="logo">
 				<p>
 					<img src="<?php echo Yii::app()->baseUrl; ?>/themes/front/resources/logo.png" />
 					<span>金米旅游</span>
 				</p>
 			</div>
 		</div>
 		<div class='header-right right'>
 			<div class="header-right-nav">
 				<ul>
 					<li><a href="#">通信</a></li>
 					<li><a href="#">保险</a></li>
 					<li><a href="#">签证</a></li>
 					<li><a href="#">机票</a></li>
 					<li><a href="#">酒店</a></li>
 				</ul>
 			</div>
 			<div id="search" class='inline'>
 				<input type='text' name='' />
 				<button>搜索</button>
 			</div>
 			<div id="client-msg" class='inline'>
 				<a href='#'>我的金米</a>
 			</div>
 		</div>
 		<div class="clear"></div>
 	</div>
 	<div id="bodyer">
 		<div id="content">
 			<?php echo $content; ?>
 		</div>
 	</div>
 	<div id="footer">
 		<h1>footer</h1>	
 	</div>

</body>
</html>