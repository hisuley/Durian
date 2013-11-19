<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php echo CHtml::encode($this->pageTitle); ?></title>
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/static/portal/css/bootstrap.min.css">
 
   <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/static/portal/css/style.css">
  <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.9.1.js"></script>
  <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/static/portal/js/bootstrap.min.js"></script>s
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
 <header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="<?php echo $this->createUrl('default/index'); ?>" class="navbar-brand">金米旅游</a>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
        <li class="dropdown">
        	<a href="#" class="dropdown-toggle" data-toggle="dropdown">签证订单<b class="caret"></b></a>
        	<ul class="dropdown-menu">
        		<li><a href="#">审核订单</a></li>
        		<li><a href="#">订单列表</a></li>
        		<li><a href="#">订单统计</a></li>
        	</ul>
        </li>
        <li class="dropdown">
        	<a href="#" class="dropdown-toggle" data-toggle="dropdown">财务管理<b class="caret"></b></a>
        	<ul class="dropdown-menu">
        		<li><a href="#">审核订单</a></li>
        		<li><a href="#">订单列表</a></li>
        		<li><a href="#">订单统计</a></li>
        	</ul>
        </li>
      </ul>
       <ul class="nav navbar-nav navbar-right">
	     
	      <li class="dropdown">
	        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo Yii::app()->user->id; ?> <b class="caret"></b></a>
	        <ul class="dropdown-menu">
	          <li><a href="#">修改密码</a></li>
	          <li><a href="#">个人资料</a></li>
	        </ul>
	      </li>
	       <li><a href="<?php echo $this->createUrl('logout'); ?>">退出</a></li>
	    </ul>
      <form class="navbar-form navbar-right" role="search" type="GET" action="<?php echo $this->createUrl('visa/search'); ?>">
	      <div class="form-group">
	        <input type="text" name="id" class="form-control" placeholder="输入订单号搜索">
	      </div>
	      <button type="submit" class="btn btn-default">搜索</button>
  	  </form>
  	 
    </nav>
  </div>
 </header>
<div class="container portal-container">
	<div class="row">
		<div class="col-md-2">
			<ul class="nav nav-pills nav-stacked">
  				<li><a href="<?php echo $this->createUrl('visa/new'); ?>">添加订单</a></li>
  				<li><a href="<?php echo $this->createUrl('visa/list', array('review'=>1)); ?>">审核订单<span class="badge">2</span></a></li>
  				<li><a href="<?php echo $this->createUrl('visa/list'); ?>">订单列表</a></li>
			</ul>
		</div>
		<div class="col-md-10">
			<?php echo $content; ?>		
		</div>
	</div>
	
</div>
<footer class="portal-footer">
	&copy;2013 金米旅游科技
</footer>
</body>
</html>