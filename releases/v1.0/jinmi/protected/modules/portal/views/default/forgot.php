<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>忘记密码</title>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/portal-login.css">
    <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
<section class="container">
    <div class="login">
        <h1>金米旅游后台系统</h1>
        <form method="post" action="<?php echo $this->createUrl('default/forgot'); ?>">
            <p><input type="text" name="LoginForm[username]" value="" placeholder="输入您的用户名"></p>
            <p><input type="text" name="LoginForm[email]" value="" placeholder="您注册的email地址"></p>
            <p class="submit"><input type="submit" name="commit" value="发送"></p>
        </form>
    </div>

    <div class="login-help">
        <p>系统将会发送密码重置链接发送到您的邮箱，登陆之后请尽快修改密码。</p>
    </div>
</section>
</body>
</html>