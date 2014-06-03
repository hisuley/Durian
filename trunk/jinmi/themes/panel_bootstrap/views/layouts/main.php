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
                array('label'=>'签证', 'icon'=>'globe', 'url'=>array('/panel/visa/list'),
                    'items'=>array(
                        array('label'=>'订单列表', 'url'=>array('/panel/visa/list')),
                        array('label'=>'创建订单', 'url'=>array('/panel/visa/new')),
                        '---',
                        array('label'=>'我的订单', 'url'=>array('/panel/visa/my')),
                        array('label'=>'历史订单', 'url'=>array('/panel/visa/history')),
                        array('label'=>'我的业绩', 'url'=>array('/panel/visa/stat')),
                        '---',
                        array('label'=>'生成送签表', 'url'=>array('/panel/visa/sentTable')),
                        array('label'=>'送签历史', 'url'=>array('/panel/visa/sentHistory')),
                        '---',
                        array('label'=>'我的业绩', 'url'=>array('/panel/visa/stat')),




                    )),
                array('label'=>'财务', 'icon'=>'info-sign', 'url'=>'#', 'visible'=>!PanelUser::checkAccessToFunction('finance'),'items'=>array(
                    array('label'=>'请款申请', 'url'=>array('/panel/finance/payRequest')),
                    array('label'=>'待审批请款', 'url'=>array('/panel/finance/requestList', 'status'=>Finance::STATUS_FIRST_APPLY, 'who'=>'me', 'type'=>Finance::TYPE_CUSTOMER)),
                    array('label'=>'请款历史', 'url'=>array('/panel/finance/requestList', 'status'=>Finance::STATUS_APPROVED, 'who'=>'me', 'type'=>Finance::TYPE_CUSTOMER)),
                    '---',
                    array('label'=>'收款申请', 'url'=>array('/panel/finance/collectionRequest')),
                    array('label'=>'待审批收款', 'url'=>array('/panel/finance/requestList', 'status'=>Finance::STATUS_FIRST_APPLY, 'who'=>'me', 'type'=>Finance::TYPE_ORDER)),
                    array('label'=>'收款历史', 'url'=>array('/panel/finance/requestList', 'status'=>Finance::STATUS_APPROVED, 'who'=>'me', 'type'=>Finance::TYPE_ORDER)),
                    '---',
                    array('label'=>'全部记录', 'url'=>array('/panel/finance/requestList', 'who'=>'me')),
                    /*
                    '---',
                    array('label'=>'申请列表', 'url'=>array('/panel/finance/requestList', array('who'=>'me'))),
                    array('label'=>'待审批申请', 'url'=>array('/panel/finance/waitingList')),
                    array('label'=>'我的统计', 'url'=>array('/panel/finance/stat', array('who'=>'me'))),
                    '---',
                    array('label'=>'财务记账', 'url'=>array('/panel/finance/new')),
                    '---',
                    array('label'=>'流水明细', 'url'=>array('/panel/finance/list')),
                    array('label'=>'财务报表', 'url'=>array('/panel/finance/report')),
                    array('label'=>'盈利分析', 'url'=>array('/panel/finance/profitAnalyse')),
                    array('label'=>'应收账款', 'url'=>array('/panel/finance/receiveList')),
                    */

                )),
                array('label'=>'财务', 'icon'=>'info-sign', 'url'=>'#', 'visible'=>PanelUser::checkAccessToFunction('finance'),  'items'=>array(
                    array('label'=>'收款申请', 'url'=>array('/panel/finance/collectionRequest')),
                    array('label'=>'请款申请', 'url'=>array('/panel/finance/payRequest')),
                    '---',
                    array('label'=>'申请列表', 'url'=>array('/panel/finance/requestList', 'status'=>Finance::STATUS_FIRST_APPLY)),
                    array('label'=>'历史记录', 'url'=>array('/panel/finance/requestList', 'status'=>Finance::STATUS_APPROVED)),
                    '---',
                    array('label'=>'全部记录', 'url'=>array('/panel/finance/requestList')),

                )),

                array('label'=>'统计报表', 'icon'=>'info-sign', 'url'=>'#', 'visible'=>PanelUser::checkAccessToFunction('stat'), 'items'=>array(
                    array('label'=>'收款报表', 'url'=>array('/panel/visa/statCollection'), 'visible'=>PanelUser::checkAccessToFunction('visa_stat')),
                    array('label'=>'请款报表', 'url'=>array('/panel/visa/statPay'), 'visible'=>PanelUser::checkAccessToFunction('visa_stat')),
                    array('label'=>'送签报表', 'url'=>array('/panel/visa/statSent'), 'visible'=>PanelUser::checkAccessToFunction('visa_stat')),
                    array('label'=>'运营报表', 'url'=>array('/panel/visa/statOperate'), 'visible'=>PanelUser::checkAccessToFunction('visa_stat')),
                    array('label'=>'预测报表', 'url'=>array('/panel/visa/statPredict'), 'visible'=>PanelUser::checkAccessToFunction('visa_stat')),

                )),

                array('label'=>'账号', 'icon'=>'info-sign', 'url'=>'#', 'visible'=>PanelUser::checkAccessToFunction('finance'), 'items'=>array(
                    array('label'=>'账号列表', 'url'=>array('/panel/finance/accountList')),
                    array('label'=>'新建账号', 'url'=>array('/panel/finance/accountNew')),
                    '---',
                    array('label'=>'流水明细', 'url'=>array('/panel/finance/transactionHistory', array('who'=>'me'))),
                    '---',
                    array('label'=>'账号内转账', 'url'=>array('/panel/finance/transfer')),

                )),
                array('label'=>'宇通', 'url'=>'#', 'icon'=>'fire', 'items'=>array(
                    array('label'=>'新增签证', 'url'=>array('/panel/yutong/newVisa')),
                    array('label'=>'签证列表', 'url'=>array('/panel/yutong/visaList')),
                    '---',
                    array('label'=>'订单列表', 'url'=>array('/panel/yutong/orderList')),
                    array('label'=>'历史订单', 'url'=>array('/panel/yutong/orderHistory')),
                    '---',
                    array('label'=>'资讯列表', 'url'=>array('/panel/yutong/articleList')),
                    array('label'=>'新增资讯', 'url'=>array('/panel/yutong/newArticle')),
                    '---',
                    array('label'=>'商户列表', 'url'=>array('/panel/yutong/merchantList')),
                    array('label'=>'开户申请', 'url'=>array('/panel/yutong/merchantRequest')),
                    '---',
                    array('label'=>'首页签证', 'url'=>array('/panel/yutong/indexVisa')),
                    array('label'=>'广告管理', 'url'=>array('/panel/yutong/adList')),
                )),
                array('label'=>'管理', 'url'=>"#", 'icon'=>'wrench', 'visible'=>!Yii::app()->user->isGuest, 'items'=>array(
                    array('label'=>'国家列表', 'url'=>array('/panel/address/list')),
                    array('label'=>'新增国家', 'url'=>array('/panel/address/new')),
                    '---',
                    array('label'=>'订单来源', 'url'=>array('/panel/orderSource/list')),
                    array('label'=>'新增来源', 'url'=>array('/panel/orderSource/new')),
                    '---',
                    array('label'=>'送签渠道', 'url'=>array('/panel/agency/list')),
                    array('label'=>'新增渠道', 'url'=>array('/panel/agency/new')),
                    '---',
                    array('label'=>'操作日志', 'url'=>array('/panel/history/log')),

                )),
                /*
                array('label'=>'用户管理', 'url'=>"#", 'icon'=>'user', 'visible'=>!Yii::app()->user->isGuest, 'items'=>array(
                    array('label'=>'用户列表', 'url'=>array('/panel/user/list')),
                    array('label'=>'新增账号', 'url'=>array('/panel/user/new'))

                )),*/

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
/*
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
));*/
?>
<style>
    .popover{width:300px;}
    input[type="radio"], input[type="checkbox"] {
        float: left;
    }
</style>
</body>
</html>
