<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo CHtml::encode($this->pageTitle); ?></title>
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/static/portal/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/static/portal/css/style.css">
  <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.9.1.js"></script>
  <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/static/portal/js/bootstrap.min.js"></script>
  <script src="http://eternicode.github.io/bootstrap-datepicker/bootstrap-datepicker/js/locales/bootstrap-datepicker.zh-CN.js" charset="UTF-8"></script>
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
  <![endif]-->
</head>
<body>
 <div class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
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
    <div class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
        <li class="dropdown">
        	<a href="#" class="dropdown-toggle" data-toggle="dropdown">签证订单<b class="caret"></b></a>
        	<ul class="dropdown-menu">
        		<li><a href="<?php echo $this->createUrl('visa/list', array('review'=>1)); ?>">审核订单</a></li>
        		<li><a href="<?php echo $this->createUrl('visa/list'); ?>">订单列表</a></li>
        		<li><a href="<?php echo $this->createUrl('visa/stats', array('review'=>1)); ?>">订单统计</a></li>
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
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">资料维护<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo $this->createUrl('address/list'); ?>">国家城市</a></li>
          </ul>
        </li>
      </ul>
       <ul class="nav navbar-nav navbar-right">
	     
	      <li class="dropdown">
	        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo Yii::app()->user->id; ?> <b class="caret"></b></a>
	        <ul class="dropdown-menu">
	          <li><a href="<?php echo $this->createUrl('default/changepass'); ?>">修改密码</a></li>
	          <li><a href="<?php echo $this->createUrl('default/profile'); ?>">个人资料</a></li>
	        </ul>
	      </li>
	       <li><a href="<?php echo $this->createUrl('default/logout'); ?>">退出</a></li>
	    </ul>
      <form class="navbar-form navbar-right" role="search" type="GET" action="<?php echo $this->createUrl('visa/search'); ?>">
	      <div class="form-group">
	        <input type="text" name="id" class="form-control" placeholder="输入订单号搜索">
	      </div>
	      <button type="submit" class="btn btn-default">搜索</button>
  	  </form>
  	 
    </div>
  </div>
 </div>
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
      <?php
      foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="alert alert-' . $key . '">' . $message . "</div>";
      }
			echo $content; ?>		
		</div>
	</div>
	
</div>
<div class="portal-footer">
	&copy;2013 金米旅游科技
</div>
</body>
</html>