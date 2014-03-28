<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo CHtml::encode($this->pageTitle)."-".Yii::app()->name; ?></title>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/portal-login.css">
    <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
<section class="container">
    <div class="login">
        <h1>金米旅游后台系统</h1>
        <?php
        foreach(Yii::app()->user->getFlashes() as $key => $message){
            echo "<p class='alert-".$key."'>".$message."</p>";
        }
        ?>
        <?php echo $content; ?>

    </div>

    <div class="login-help">
        <p>忘记密码? <a href="index.html">进入重置密码页面</a>.</p>
    </div>
</section>
</body>
</html>