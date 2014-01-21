<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/static/panel/css/login.css">
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/static/panel/js/login.js"></script>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Kimi Tourism Business Support System</h1>
    </div>
    <div class="wrapper">
      <?php echo $content; ?>
    </div>
</div>
</body>
</html>