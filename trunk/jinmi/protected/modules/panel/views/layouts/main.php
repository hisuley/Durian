<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/static/panel/css/style.css">
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/static/panel/js/common.js"></script>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Kimi Tourism Business Support System</h1>
        <div class="header-menu-container">
            <?php
            $this->widget('zii.widgets.CMenu', array(
                'items' => $this->menu,
                'encodeLabel' => false,
                'htmlOptions' => array(
                    'class' => 'header-menu' //You can customize this for your application
                )
            ));?>
        </div>
    </div>
    <div class="wrapper">
        <?php $this->widget('zii.widgets.CBreadcrumbs', array('links'=>$this->breadcrumbs,)); ?>
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