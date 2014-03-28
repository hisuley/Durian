<?php
    Yii::app()->clientScript->registerCoreScript('jquery');
?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo CHtml::encode($this->pageTitle)."-".Yii::app()->name; ?></title>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/static/panel/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/static/panel/css/style.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/static/panel/css/print.css" type="text/css" media="print" />
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/static/panel/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-wrapper">
    <div class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                    <span class="sr-only">转换导航</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="<?php echo $this->createUrl('visa/list'); ?>" class="navbar-brand">Kimi Tourism</a>
            </div>
            <div class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => $this->menu,
                    'encodeLabel' => false,
                    'htmlOptions' => array(
                        'class' => 'nav navbar-nav', //You can customize this for your application
                    ),
                    'itemCssClass' => 'dropdown',
                    'submenuHtmlOptions' => array(
                        'class' => 'dropdown-menu'
                    )
                ));?>
                <ul class="nav navbar-nav navbar-right">

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo Yii::app()->user->username; ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $this->createUrl('default/changepass'); ?>">修改密码</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo $this->createUrl('default/logout'); ?>">退出</a></li>
                </ul>

                <form class="navbar-form navbar-right" role="search" type="GET" action="<?php echo $this->createUrl('visa/list'); ?>">
                    <div class="form-group">
                        <input type="text" name="customer_name" class="form-control" placeholder="输入客人姓名搜索">
                    </div>
                    <button type="submit" class="btn btn-default">搜索</button>
                </form>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <?php $this->widget('zii.widgets.CBreadcrumbs', array('links'=>$this->breadcrumbs, 'homeLink'=>CHtml::link('首页', $this->createUrl('visa/list')))); ?>
        <div class="left-column">
            <?php
                if(!empty($this->subMenu)){
                    $this->widget('zii.widgets.CMenu', array(
                        'items' => $this->subMenu,
                        'encodeLabel' => false,
                        'htmlOptions' => array(
                            'class' => 'sub-menu' //You can customize this for your application
                        )
                    ));
                }
            ?>
        </div>
        <div class="right-column">
            <?php
            foreach(Yii::app()->user->getFlashes() as $key => $message) {
                echo '<div class="alert alert-' . $key . '">' . $message . "</div>";
            }
            echo $content;
            ?>
        </div>
    </div>
</div>
</body>
</html>