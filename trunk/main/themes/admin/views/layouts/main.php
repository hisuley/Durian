<?php /* @var $this Controller */ ?>
<?php
		$menutree=array(
			'0'=>array(
				'name'=>'活动模块',
				'list'=>array(
					'0'=>array(
						'name'=>'活动添加',
						'href'=>'?r=admin/add'
						),
					'1'=>array(
						'name'=>'活动列表',
						'href'=>'?r=admin/list'
						)
					),
				),
			'1'=>array(
				'name'=>'交通模块',
				'list'=>array(
					'0'=>array(
						'name'=>'交通管理',
						'href'=>'.'
						),
					'1'=>array(
						'name'=>'交通列表',
						'href'=>'.'
						)
					)
				),
			'2'=>array(
				'name'=>'酒店模块',
				'list'=>array(
					'0'=>array(
						'name'=>'酒店管理',
						'href'=>'.',
						),
					'1'=>array(
						'name'=>'酒店列表',
						'href'=>'.',
						)
					),
				),
			'3'=>array(
				'name'=>'签证模块',
				'list'=>array(
					'0'=>array(
						'name'=>'签证管理',
						'href'=>'.',
						),
					'1'=>array(
						'name'=>'签证列表',
						'href'=>'.',
						)
					),
				),
			'4'=>array(
				'name'=>'订单模块',
				'list'=>array(
					'0'=>array(
						'name'=>'订单管理',
						'href'=>'.',
						),
					'1'=>array(
						'name'=>'订单列表',
						'href'=>'.',
						)
					),
				),
			'5'=>array(
				'name'=>'促销模块',
				'list'=>array(
					'0'=>array(
						'name'=>'促销管理',
						'list'=>array(
							'0'=>array(
								'name'=>'添加促销',
								'href'=>'.',
								),
							'1'=>array(
								'name'=>'促销单页',
								'href'=>'.',
								)
							),
						),
					'1'=>array(
						'name'=>'促销列表',
						'href'=>'.',
						)
					),
				),
			'6'=>array(
				'name'=>'会员模块',
				'list'=>array(
					'0'=>array(
						'name'=>'达人管理',
						'list'=>array(
							'0'=>array(
								'name'=>'达人添加',
								'href'=>'.',
								),
							'1'=>array(
								'name'=>'达人列表',
								'href'=>'.',
								),
							),
						),
					'1'=>array(
						'name'=>'会员管理',
						'list'=>array(
							'0'=>array(
								'name'=>'会员列表',
								'href'=>'.',
								),
							),
						),
					)
				),
			'7'=>array(
				'name'=>'达人推荐',
				'list'=>array(
					'0'=>array(
						'name'=>'达人行程单列表',
						'href'=>'.',
						),
					),
				),
			'8'=>array(
				'name'=>'评论模块',
				'list'=>array(
					'0'=>array(
						'name'=>'评论列表',
						'href'=>'.',
						),
					),
				),
			'9'=>array(
				'name'=>'广告模块',
				'list'=>array(
					'0'=>array(
						'name'=>'广告添加',
						'href'=>'.',
						),
					'1'=>array(
						'name'=>'广告列表',
						'href'=>'.',
						),
					),
				),
			'10'=>array(
				'name'=>'站点模块',
				'list'=>array(
					'0'=>array(
						'name'=>'站点访问统计',
						'href'=>'.',
						),
					),
				),
			'11'=>array(
				'name'=>'其他设置',
				'list'=>array(
					'0'=>array(
						'name'=>'邮箱设置',
						'href'=>'.',
						),
					'1'=>array(
						'name'=>'短信API',
						'href'=>'.',
						),
					'2'=>array(
						'name'=>'SEO关键词设置',
						'href'=>'.',
						),
					'3'=>array(
						'name'=>'站点维护设置',
						'href'=>'.',
						),
					'4'=>array(
						'name'=>'站点标题属性设置',
						'href'=>'.',
						),
					'5'=>array(
						'name'=>'邮箱队列',
						'href'=>'.',
						),
					'6'=>array(
						'name'=>'注册协议',
						'href'=>'.',
						),
					),
				),
		);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="en">
		<link href="<?php echo Yii::app()->baseUrl; ?>/themes/admin/js/flatui/bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="<?php echo Yii::app()->baseUrl; ?>/themes/admin/js/flatui/css/flat-ui.css" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/themes/admin/css/public.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/themes/admin/css/menugeneral.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/themes/admin/css/main.css" type="text/css" />		
		<script src="<?php echo Yii::app()->baseUrl; ?>/themes/admin/js/jQuery.js"></script>
		<script src="<?php echo Yii::app()->baseUrl; ?>/themes/admin/js/menu.js"></script>
		<!--[if lt IE 8]>
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
		<![endif]-->
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	</head>
	<body>
		<div id="bodycontainer">	
			<div id="header">
				<h1>金米旅游后台录入系统</h1>
			</div>
			<div id="navMenu">
				<div id="menuHeader">	
      				<span id="all" class='collapse' style="cursor : pointer;">菜单栏</span>
				</div>
				<div id="menuBodyer">
				<ul>
				<?php
					$this->widget('MenuTreeWidget',array('items'=>$menutree,));
				?>	
					</ul>
				</div>
			</div>
			<div id="maincontent">
				<?php echo $content; ?>
			</div>
			<div class="clear"></div>
			<div id="footer">
				<h1>底部</h1>
			</div>
		</div>
	<?php 
		echo CHtml::scriptFile(Yii::app()->baseUrl."/themes/admin/js/flatui/js/jquery-1.8.3.min.js");
		echo CHtml::scriptFile(Yii::app()->baseUrl."/themes/admin/js/flatui/js/jquery-ui-1.10.3.custom.min.js");
		echo CHtml::scriptFile(Yii::app()->baseUrl."/themes/admin/js/flatui/js/jquery.ui.touch-punch.min.js");
		echo CHtml::scriptFile(Yii::app()->baseUrl."/themes/admin/js/flatui/js/bootstrap.min.js");
		echo CHtml::scriptFile(Yii::app()->baseUrl."/themes/admin/js/flatui/js/bootstrap-select.js");
		echo CHtml::scriptFile(Yii::app()->baseUrl."/themes/admin/js/flatui/js/bootstrap-switch.js");
		echo CHtml::scriptFile(Yii::app()->baseUrl."/themes/admin/js/flatui/js/flatui-checkbox.js");
		echo CHtml::scriptFile(Yii::app()->baseUrl."/themes/admin/js/flatui/js/flatui-radio.js");
		echo CHtml::scriptFile(Yii::app()->baseUrl."/themes/admin/js/flatui/js/jquery.tagsinput.js");
		echo CHtml::scriptFile(Yii::app()->baseUrl."/themes/admin/js/flatui/js/jquery.stacktable.js");
		echo CHtml::scriptFile(Yii::app()->baseUrl."/themes/admin/js/flatui/js/application.js");
	?>
	</body>
</html>