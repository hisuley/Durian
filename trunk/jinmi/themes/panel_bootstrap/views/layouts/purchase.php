<?php
/**
 * @project: trunk
 * @file: purchase.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-5-4
 * @time: 上午11:34
 * @version: 1.0
 */

?>

<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh_CN" lang="zh_CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="zh_CN" />
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <?php Yii::app()->bootstrap->register(); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/main.js"></script>
    <script type="text/javascript">
        var ajax_read_url = "<?php echo $this->createUrl('message/ajax'); ?>";
    </script>
</head>

<body>

<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    'brand'=>"宇通业务处理平台",
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'encodeLabel'=>false,
            'items'=>array(
                array('label'=>'首页', 'icon'=>'home', 'url'=>array('/panel/default/index')),

                array('label'=>'采购管理', 'url'=>"#", 'icon'=>'wrench', 'visible'=>!Yii::app()->user->isGuest, 'items'=>array(
                    array('label'=>'国家列表', 'url'=>array('/panel/address/list')),
                    array('label'=>'新增国家', 'url'=>array('/panel/address/new')),
                    '---',
                    array('label'=>'订单来源', 'url'=>array('/panel/orderSource/list')),
                    array('label'=>'新增来源', 'url'=>array('/panel/orderSource/new')),
                    '---',
                    array('label'=>'送签渠道', 'url'=>array('/panel/agency/list')),
                    array('label'=>'新增渠道', 'url'=>array('/panel/agency/new')),

                )),
                array('label'=>Yii::app()->controller->widget('bootstrap.widgets.TbButton', array(
                        'label'=>'<i class="icon-envelope"></i>&nbsp;'.$this->widget('bootstrap.widgets.TbBadge', array(
                                'type'=>'success', // 'success', 'warning', 'important', 'info' or 'inverse'
                                'label'=>PanelMessage::getMessageCount(),
                            ), true),
                        'type'=>'link',
                        'encodeLabel'=>false,
                        'htmlOptions'=>array('id'=>'message-button', 'data-trigger'=>'manual', 'encode'=>false,'data-title'=>'消息列表', 'data-content'=>$this->renderPartial("application.modules.panel.views.common.message_nav_list", array('messages'=>PanelMessage::model()->findAllByAttributes(array('to_user'=>Yii::app()->user->id, 'is_read'=>PanelMessage::IS_READ_FALSE), array('order'=>'id DESC'))), true), 'style'=>'margin:0px;'),
                    ), true),  'encodeLabel'=>false,'linkOptions'=>array('encode'=>false)),

            ),
        ),
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>array(
                array('label'=>'个人中心('.Yii::app()->user->name.')', 'url'=>"#", 'visible'=>!Yii::app()->user->isGuest, 'items'=>array(
                    array('label'=>'修改密码', 'url'=>array('/panel/default/changepass')),
                    array('label'=>'个人资料', 'url'=>array('/panel/user/profile')),
                    '---',
                    array('label'=>'业绩统计', 'url'=>array('/panel/user/stat')),
                    '---',
                    array('label'=>'注销 ('.Yii::app()->user->name.')', 'url'=>array('/panel/default/logout'), 'visible'=>!Yii::app()->user->isGuest)

                )),

            ),
        ),
    ),
)); ?>

<div class="<?php if(isset($this->fluid)){ echo 'container-fluid';}else{ echo 'container';} ?>" id="page">

    <?php if(isset($this->breadcrumbs)):?>
        <?php
        array_push($this->breadcrumbs, $this->pageTitle);
        $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
        )); ?><!-- breadcrumbs -->
    <?php endif?>
    <?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
        ),
    )); ?>
    <?php echo $content; ?>

    <div class="clear"></div>
    <hr />
    <div id="footer">
        Copyright &copy; <?php echo date('Y'); ?> by Kimi Tourism. All Rights Reserved.
        <br/>
        Powered by <a href="http://suley.net">Suley Lu</a>
        <div class="clear"></div>
    </div><!-- footer -->

</div><!-- page -->
<?php
$this->widget('ext.stickyPage.StickyPage', array(
    'height' => '300px',  // height of containter
    'width' => '300px',  // width of containter
    'data' => array(
        // **message**: message to be shown
        // **x**: x-coordinate
        // **y**: y-coordinate
        // **degree**: rotation angle
        // **footer**: bottom text like date
        // **height**: height of single stick-note
        // **width**: width of single stick-note
        array('message' => 'Happy New Year! ', 'x' => 130, 'y' => 100, 'footer' => '10/5/2014', 'height' => '400px'),
    ),
));
?>
<style>
    .popover{width:300px;}
</style>
</body>
</html>
