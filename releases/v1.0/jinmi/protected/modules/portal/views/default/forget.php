<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Login Form</title>
  <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/portal-login.css">
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
  <section class="container">
    <div class="login">
      <h1>金米旅游后台系统</h1>
      <form method="post" action="index.html">
        <p><input type="text" name="login" value="" placeholder="输入您的用户名"></p>
        <p><input type="password" name="password" value="" placeholder="密码"></p>
        <p class="remember_me">
          <label>
            <input type="checkbox" name="remember_me" id="remember_me">
            30天内有效
          </label>
        </p>
        <p class="submit"><input type="submit" name="commit" value="登陆"></p>
      </form>
    </div>

    <div class="login-help">
      <p>忘记密码? <a href="index.html">进入重置密码页面</a>.</p>
    </div>
  </section>
</body>
</html>