<?php
/**
 * @project: trunk
 * @file: finance.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-5-4
 * @time: 上午11:10
 * @version: 1.0
 */
?>
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
                array('label'=>'首页', 'icon'=>'home', 'url'=>array('/panel/finance/index')),
                array('label'=>'财务中心', 'icon'=>'info-sign', 'url'=>'#', 'items'=>array(
                    array('label'=>'收款申请', 'url'=>array('/panel/finance/collectionRequest')),
                    array('label'=>'请款申请', 'url'=>array('/panel/finance/payRequest')),
                    '---',
                    array('label'=>'申请列表', 'url'=>array('/panel/finance/requestList', 'status'=>Finance::STATUS_FIRST_APPLY)),
                    array('label'=>'历史记录', 'url'=>array('/panel/finance/requestList', 'status'=>Finance::STATUS_APPROVED)),
                    '---',
                    array('label'=>'全部记录', 'url'=>array('/panel/finance/requestList')),

                )),
                array('label'=>'账号管理', 'icon'=>'info-sign', 'url'=>'#', 'items'=>array(
                    array('label'=>'账号列表', 'url'=>array('/panel/finance/accountList')),
                    array('label'=>'新建账号', 'url'=>array('/panel/finance/accountNew')),
                    '---',
                    array('label'=>'流水明细', 'url'=>array('/panel/finance/transactionHistory', array('who'=>'me'))),
                    '---',
                    array('label'=>'账号内转账', 'url'=>array('/panel/finance/transfer')),

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
<style>
    .popover{width:300px;}
</style>
</body>
</html>
