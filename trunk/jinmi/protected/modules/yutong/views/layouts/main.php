<?php
Yii::app()->clientScript->registerCoreScript('jquery');
?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo CHtml::encode($this->pageTitle) . " - 宇通签证网"; ?></title>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/static/yutong/css/style.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/static/yutong/css/print.css"
          type="text/css" media="print"/>
    <script language="JavaScript" type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/My97DatePicker/WdatePicker.js"></script>
    <script type="text/javascript">
        $('document').ready(function () {
            $(document).click(function(){
               //$('#popupcountry:not(:hidden)').hide();
            });
            $('input[name="keyword"]').blur(function () {

            });
        });
    </script>
</head>
<body>
<script type="text/javascript">
    var isAuth = 'False' == 'True';

    /*显示顶部弹出层*/
    function showTpopup(ct, pt, negativeTop, iseb) {
        var cte = $(ct);
        var pte = $(pt);

        if (iseb != "N")
            cte.css({ "background-color": "white", color: "Black", "border-left": "1px solid black" });

        var tl = cte.offset().left;
        var tt = cte.offset().top + 31 - $(document).scrollTop();

        if (negativeTop != undefined) {
            tt = tt - negativeTop;
        }

        pte.css({ top: tt, left: tl }).show();
    }

    /*隐藏顶部弹出层*/
    function hideTpopup(ct, pt) {
        $(ct).hide();
        $(pt).css({ "background-color": "black", color: "white" });
    }

    /*隐藏所有头部弹出层*/
    function hideAllTpopup() {
        hideTpopup("#ulMyHy", "#liMyHy");
        hideTpopup("#ulMyMessage", "#liMyMessage");
        hideTpopup("#ulMyService", "#liMyService");
        $("#ulActive").hide();
        $("#ulVisaEntrance").hide();
    }

    $(function () {

        $("#liVisaEntrance").click(function () {
            hideAllTpopup();
            //showTpopup($(this), $("#ulVisaEntrance"),6,"N");
            //showTpopup($(this), $("#ulVisaEntrance"),18,"N");
            var tThis = $(this);
            var tTop = tThis.parent("span").offset().top + tThis.height() + 1;
            var tLeft = tThis.parent("span").offset().left - 26;
            $(".popupcountry").css({ "top": tTop, "left": tLeft }).toggle();
            return false;
        });



        $(document).click(function () {
            hideAllTpopup();
            //隐藏国家层
            if ($(".popupcountry").is(":visible") && !countryFocus) $(".popupcountry").hide();
            if ($(".popupcountryw").is(":visible") && !countryFocus) $(".popupcountryw").hide();
            countryFocus = false;
        });
        $(window).load(function () {


        });

    });
</script>
<!--begin 我的宇通-->
<ul id="ulMyHy" class="toppou">
    <li><a href="<?php echo $this->createUrl('order/list'); ?>">订单管理</a></li>
    <li><a href="<?php echo $this->createUrl('user/credit'); ?>">积分管理</a></li>
    <li><a href="<?php echo $this->createUrl('user/profile'); ?>">修改资料</a></li>

</ul>
<!--end 我的宇通-->
<!--begin 消息-->
<ul id="ulMyMessage" class="toppou">
    <li>
        <ul class="tlul">
            <li style="width: 20%;">消息</li>
            <li style="width: 67%;"><a href="Member">
                    查看消息</a></li>
            <li style="width: 10%;"><a href="javascript:" id="aMyMessage" style="text-decoration: underline;"
                                       title="关闭">X</a></li>
        </ul>
    </li>

</ul>

<!--end 我的客服-->
<!--begin 签证-->
<ul id="ulVisaEntrance" class="visaentrance">
    <li><a href="Visa-ContinentId=1">
            <img src="/static/yutong/img/new_a2.jpg"
                 name="Image2" width="40" height="20" border="0"/></a></li>
    <li><a href="Visa-ContinentId=2">
            <img src="/static/yutong/img/new_a3.jpg"
                 name="Image2" width="40" height="20" border="0"/></a></li>
    <li><a href="Visa-ContinentId=3">
            <img src="/static/yutong/img/new_a4.jpg"
                 name="Image2" width="40" height="20" border="0"/></a></li>
    <li style="margin-right: 10px;"><a href="Visa-ContinentId=4">
            <img src="/static/yutong/img/new_a5.jpg"
                 name="Image2" width="52" height="20" border="0"/></a></li>
    <li><a href="Visa-ContinentId=5">
            <img src="/static/yutong/img/new_a6.jpg"
                 name="Image2" width="40" height="20" border="0"/></a></li>

</ul>
<!--end 签证-->
<!--begin 活动-->
<ul id="ulActive" class="visaentrance" style="width: 100px;">
    <li><a href="Integral/List">
            <img src="/static/yutong/img/new2_a5.jpg"
                 name="Image2" width="40" height="20" border="0"/></a></li>
    <li><a href="Train">
            <img src="/static/yutong/img/new2_a6.jpg"
                 name="Image2" width="40" height="20" border="0"/></a></li>
</ul>
<!--end 活动-->
<!--begin top-->
<!--begin float top-->
<div class="newtopfloat">
    <div class="newtop1">
        <div id="divMsgCount">
            <img src="/static/yutong/img/tip_h_big.png"
                 border="0" usemap="#Map2" width="110" height="80"/>

            <div id="divMsgItem">
            </div>
            <map name="Map2" id="Map2">
                <area shape="rect" coords="8,4,36,17" href="Member"
                      target="_blank" title="查看"/>
            </map>
        </div>
        <?php if (Yii::app()->user->isGuest) { ?>
            <ul class="nt1l">
                <li class="cici4" style="min-width: 250px;"><a href="<?php echo $this->createUrl('user/login'); ?>"
                                                               class="barLink4">
                        <b>·</b>&nbsp;登录</a>&nbsp;&nbsp; <a href="<?php echo $this->createUrl('user/register'); ?>"
                                                            class="barLink4">
                        <b>·</b>&nbsp;注册</a></li>
            </ul>
        <?php } else { ?>
            <ul class="nt1l">
                <li class="cici4" style="width:auto; ">欢迎您，<?php echo Yii::app()->user->username; ?><strong
                        style="color:White">(ID：<?php echo Yii::app()->user->id; ?>)</strong></li>
                <li class="cici4" style="width: 15%"><a href="<?php echo $this->createUrl('user/logout'); ?>"
                                                        class="barLink4">
                        <b>·</b>&nbsp;安全退出</a></li>
            </ul>
        <?php } ?>
        <ul class="nt1r" style="padding-left: 20px;">
            <li><a href="<?php echo $this->createUrl('order/list'); ?>" class="barLink4" id="liMyHy">我的宇通</a></li>

            <li><a href="OperateGuide-shi=1&rid=login1"
                   class="barLink4">使用帮助</a></li>
        </ul>
        <style>
            ul.nt1r li {
                float: right;
            }
        </style>
    </div>
</div>
<!--end float top-->
<div class="newtop">
    <div class="newtop2">
        <ul class="nt2l">
            <li><a href="<?php echo $this->createUrl('default/index'); ?>">
                    <img src="/static/yutong/img/logonew2_01.jpg"
                         width="292" height="86"
                         style="margin-top:1px;"/>
                    <span style="font-size:20px; font-weight:bold; text-align:center;">宇通签证同业采购平台</span>
                </a>
            </li>
        </ul>
        <div style="width: 50%; float: left; margin-top:15px; margin-left:80px;   height:28px;">


                <span style=" width:11%; float:left; "><a href="<?php echo $this->createUrl('default/index'); ?>">
                        <img src="/static/yutong/img/new2_a1.jpg"
                             name="Image2" width="44"
                             height="22" border="0"/></a></span>
                 <span style=" width:11%; float:left; ">
                    <div id="liVisaEntrance">
                        <img src="/static/yutong/img/new2_a2.jpg"
                             name="Image2" width="44"
                             height="22" border="0" style="cursor:pointer"/>
                    </div>
                </span>

        </div>
        <div style="float: left; width: 65%; margin-left:0px;">
                <span class="li" style=" width:100%; margin-left:60px; float:left;">
<form action="<?php echo $this->createUrl('visa/search'); ?>" method="get">
    <ul class="tsetxt">
        <li class="li1">
            <img src="/static/yutong/img/new2_34_c.jpg"
                 width="33" height="34"/></li>
        <li class="li2"><span>
                                <input name="keyword" type="text" class="cici3" id="KeyWordMaster"
                                       style="width: 324px;COLOR:#656565;
                                border: 0px;margin-top:7px;  background-color: #E3F0FB; height: 15px;"
                                       value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>" placeholder="请选择或者直接输入国家"/>
                            </span></li>
        <li class="li3">
            <img src="/static/yutong/img/new2_36_c.jpg"
                 width="6" height="34"/></li>
    </ul>
    <ul class="tsetbtn">
        <li>
            <input name="search" id="search" type="image" src="/static/yutong/img/newssss.png"
                /></li>
    </ul>
</form>                </span>
        </div>
    </div>
</div>
<!--end top-->
<!--begin main-->
<?php echo $content; ?>
<!--end main-->
<!--begin foot-->
<div class="newfoot">
    <div style=" float:left; width:100%">
        <p class="cici3" style="display:none;">
            <a href="<?php echo $this->createUrl('site/help', array('view' => 'about')); ?>">关于宇通网</a> &nbsp;&nbsp;|
            &nbsp;&nbsp;
            <a href="<?php echo $this->createUrl('site/help', array('view' => 'opinion')); ?>">意见反馈</a> &nbsp;&nbsp;|
            &nbsp;&nbsp;<a
                href="<?php echo $this->createUrl('site/help', array('view' => 'coorperate')); ?>">商务合作</a>
            &nbsp;&nbsp;|&nbsp;&nbsp; <a
                href="<?php echo $this->createUrl('site/help', array('view' => 'recuirment')); ?>"
                target="_blank">招聘信息</a>&nbsp;&nbsp;| &nbsp;&nbsp;<a
                href="<?php echo $this->createUrl('site/help', array('view' => 'copyright')); ?>"
                >版权声明</a>
            &nbsp;&nbsp;| &nbsp;&nbsp;<a
                href="<?php echo $this->createUrl('site/help', array('view' => 'use_guide')); ?>"

                title="网站使用指南下载">使用指南</a>
        </p>

        <p class="cici1">
            联系地址：北京市东城区东中街元嘉国际A座407
        </p>

        <p class="cici1">
            <a href="#"
                >宇通</a>-<a
                href="#"
                >宇通网</a>-<a
                href="#"
                >宇通签证</a>-<a
                href="#"
                >宇通签证网</a>
        </p>

        <p class="cici1">

            <a href="#"
               target="_blank">京ICP备12050675号-2</a>

        </p>


        <p class="cici1">
            版权所有 &copy; 2014-2015 <a
                href="#"
                ><strong>宇通网</strong></a>
        </p>
        <p>
            <script language="javascript" type="text/javascript" src="http://js.users.51.la/17048844.js"></script>
        <noscript><a href="http://www.51.la/?17048844" target="_blank"><img alt="&#x6211;&#x8981;&#x5566;&#x514D;&#x8D39;&#x7EDF;&#x8BA1;" src="http://img.users.51.la/17048844.asp" style="border:none" /></a></noscript>
        </p>
    </div>
    <div style=" float:left; width:30%">

    </div>
</div>
<!--end foot-->
<link href="/static/yutong/css/country.css-type=2.css"
      rel="stylesheet" type="text/css"/>
<script type="text/javascript">
    $(function () {
        //搜索国家
        $("#KeyWordMaster").keyup(function () {
            var tThis = $(this);
            $("#likeSearch").remove();
            var valuess = tThis.val();
        }).focus(function () {
            countryFocus = true;
            var tThis = $(this);
            if (tThis.val() == "支持关键字和拼音模糊查询") {
                tThis.val("");
            }

            var tTop = tThis.parent("span").offset().top + tThis.height() + 1;
            var tLeft = tThis.parent("span").offset().left;
            $(".popupcountry").css({ "top": tTop, "left": tLeft }).show();

            return false;
        });

    });
</script>
<script type="text/javascript">
    $(function () {
        var i = 1;
        var ii = false;
        $(".popupcountry .tab li").each(function () {
            $(this).click(function () {
                var regionId = $(this).find("input").val();

                //如果当前层正显示
                if ($("#item" + regionId).is(":visible")) return;

                if (i == 1 && ii == true) return;

                i = 1;
                ii = true;

                $(".popupcountry .tab li").each(function () {
                    $(this).css({ "background-color": "#CBDEFE", "border-bottom": "1px solid #91B3E6" });
                });
                $(this).css({ "background-color": "#FFFFFF", "border-bottom": "0px" });

                //隐藏所有Country层
                $(".popupcountry .item").each(function () {
                    $(this).hide();
                });

                //如果洲对应的层已经加载则显示
                if ($("#item" + regionId).html() != null) {
                    i = 2;
                    $("#item" + regionId).show();
                }

                countryFocus = true; //true 表示单击国家层上时不隐藏国家层
            });
        });
    });
</script>
<div class="popupcountry" id="popupcountry" style="z-index: 903">
<div class="tab">
    <ul>
        <li style='background-color:#FFFFFF;border-bottom:0px; width:79px;'>
            亚洲
            <input id="RegionId" name="RegionId" type="hidden" value="1"/>
        </li>
        <li style=' width:80px;'>
            欧洲
            <input id="RegionId" name="RegionId" type="hidden" value="2"/>
        </li>
        <li style=' width:80px;'>
            美洲
            <input id="RegionId" name="RegionId" type="hidden" value="3"/>
        </li>
        <li style=' width:80px;'>
            澳洲
            <input id="RegionId" name="RegionId" type="hidden" value="4"/>
        </li>
        <li style=' width:80px;'>
            非洲
            <input id="RegionId" name="RegionId" type="hidden" value="5"/>
        </li>
        <li style="border-right: 0px; width: 91px;">
            中东
            <input id="RegionId" name="RegionId" type="hidden" value="6"/>
        </li>
    </ul>
</div>
<div class="item" id="item1" style="display:show">
    <ul>
        <li class="borderbottom" style="line-height:28px;">
            <span style="font-weight: bolder; color: Red;">热门：</span>
        </li>
        <li class="borderbottom" style="line-height:28px;">
            <a href="<?php echo $this->createUrl('visa/list', array('country_id'=>1)); ?>"><span style="font-weight: bolder;
                                color: Red;">所有国家</span></a>
        </li>
        <li class="borderbottom" style="line-height:28px;">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/日本"
               style="font-weight:bolder;color:Red; ">
                <span style="color: Red;">日本</span> </a>
        </li>
        <li class="borderbottom" style="line-height:28px;">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/韩国"

               style="font-weight:bolder;color:Red; ">
                <span style="color: Red;">韩国</span> </a>
        </li>
        <li class="borderbottom" style="line-height:28px;">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/新加坡"
               style="font-weight:bolder;color:Red; ">
                <span style="color: Red;">新加坡</span> </a>
        </li>
        <li class="borderbottom" style="line-height:28px;">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/马来西亚"

               style="font-weight:bolder;color:Red; ">
                <span style="color: Red;">马来西亚</span> </a>
        </li>

        <li class="borderbottom" style="line-height:28px;">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/泰国"
               style="font-weight:bolder;color:Red; ">
                <span style="color: Red;">泰国</span> </a>
        </li>


        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/越南"
                >越南</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/柬埔寨"
                >柬埔寨</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/菲律宾"
                >菲律宾</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/老挝"
                >老挝</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/缅甸"
                >缅甸</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/印度"
                >印度</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/印尼"
                >印尼</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/尼泊尔"
                >尼泊尔</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/孟加拉国"
                >孟加拉国</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/斯里兰卡"
                >斯里兰卡</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/台湾"
                >入台证</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/蒙古"
                >蒙古</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/朝鲜"
                >朝鲜</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/汶莱"
                >汶莱</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/哈萨克斯坦"
                >哈萨克斯坦</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/塔吉克斯坦"
                >塔吉克斯坦</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/土库曼斯坦"
                >土库曼斯坦</a></li>
        <li class="borderbottom" style="width:80px;">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/乌兹别克斯坦"
                >乌兹别克斯坦</a></li>
        <li class="borderbottom" style="width:80px;">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/吉尔吉斯斯坦"
                >吉尔吉斯斯坦</a></li>


    </ul>
</div>
<div class="item" id="item2" style="display:none">
    <ul>
        <li class="borderbottom" style="line-height:28px;">
            <span style="font-weight: bolder; color: Red;">热门：</span>
        </li>
        <li class="borderbottom" style="line-height:28px;">
            <a href="<?php echo $this->createUrl('visa/list', array('country_id'=>52)); ?>"><span style="font-weight: bolder;
                                color: Red;">所有国家</span></a>
        </li>
        <li class="borderbottom" style="line-height:28px;">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/英国"
               style="font-weight:bolder;color:Red; ">
                <span style="color: Red;">英国</span> </a>
        </li>
        <li class="borderbottom" style="line-height:28px;">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/意大利"

               style="font-weight:bolder;color:Red; ">
                <span style="color: Red;">意大利</span> </a>
        </li>
        <li class="borderbottom" style="line-height:28px;">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/法国"
               style="font-weight:bolder;color:Red; ">
                <span style="color: Red;">法国</span> </a>
        </li>
        <li class="borderbottom" style="line-height:28px;">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/德国"
               style="font-weight:bolder;color:Red; ">
                <span style="color: Red;">德国</span> </a>
        </li>
        <li class="borderbottom" style="line-height:28px;">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/西班牙"

               style="font-weight:bolder;color:Red; ">
                <span style="color: Red;">西班牙</span> </a>
        </li>
        <li class="borderbottom" style="">
            AB
        </li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/爱尔兰"
                >爱尔兰</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/奥地利"
                >奥地利</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/阿塞拜疆"
                >阿塞拜疆</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/白俄罗斯"
                >白俄罗斯</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/保加利亚"
                >保加利亚</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/比利时"
                >比利时</a></li>
        <li class="borderbottom" style="">
            BDEF
        </li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/波兰"
                >波兰</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/丹麦"
                >丹麦</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/德国"
                >德国</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/俄罗斯"
                >俄罗斯</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/法国"
                >法国</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/芬兰"
                >芬兰</a></li>
        <li class="borderbottom" style="">
            GHJKL
        </li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/格鲁吉亚"
                >格鲁吉亚</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/荷兰"
                >荷兰</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/捷克"
                >捷克</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/克罗地亚"
                >克罗地亚</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/立陶宛"
                >立陶宛</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/罗马尼亚"
                >罗马尼亚</a></li>
        <li class="borderbottom" style="">
            MNPR
        </li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/马耳他"
                >马耳他</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/马其顿"
                >马其顿</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/挪威"
                >挪威</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/葡萄牙"
                >葡萄牙</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/瑞士"
                >瑞士</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/瑞典"
                >瑞典</a></li>
        <li class="borderbottom" style="">
            SWX
        </li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/塞浦路斯"
                >塞浦路斯</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/斯洛文尼亚"
                >斯洛文尼亚</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/乌克兰"
                >乌克兰</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/西班牙"
                >西班牙</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/希腊"
                >希腊</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/匈牙利"
                >匈牙利</a></li>
        <li class="borderbottom" style="">
            XY
        </li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/亚美尼亚"
                >亚美尼亚</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/意大利"
                >意大利</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/英国"
                >英国</a></li>
    </ul>
</div>
<div class="item" id="item3" style="display:none">
    <ul>
        <li class="borderbottom" style="line-height:28px;">
            <span style="font-weight: bolder; color: Red;">热门：</span>
        </li>
        <li class="borderbottom" style="line-height:28px;">
            <a href="<?php echo $this->createUrl('visa/list', array('country_id'=>55)); ?>"><span style="font-weight: bolder;
                                color: Red;">所有国家</span></a>
        </li>
        <li class="borderbottom" style="line-height:28px;">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/美国"
               style="font-weight:bolder;color:Red; ">
                <span style="color: Red;">美国</span> </a>
        </li>
        <li class="borderbottom" style="line-height:28px;">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/加拿大"

               style="font-weight:bolder;color:Red; ">
                <span style="color: Red;">加拿大</span> </a>
        </li>
        <li class="borderbottom" style="line-height:28px;">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/巴西"
               style="font-weight:bolder;color:Red; ">
                <span style="color: Red;">巴西</span> </a>
        </li>
        <li class="borderbottom" style="line-height:28px;">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/墨西哥"

               style="font-weight:bolder;color:Red; ">
                <span style="color: Red;">墨西哥</span> </a>
        </li>
        <li class="borderbottom" style="line-height:28px;">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/哥伦比亚"

               style="font-weight:bolder;color:Red; ">
                <span style="color: Red;">哥伦比亚</span> </a>
        </li>
        <li class="borderbottom" style="">
            AB
        </li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/阿根廷"
                >阿根廷</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/巴哈马"
                >巴哈马</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/巴拿马"
                >巴拿马</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/巴西"
                >巴西</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/秘鲁"
                >秘鲁</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/玻利维亚"
                >玻利维亚</a></li>
        <li class="borderbottom" style="">
            DEGHJ
        </li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/多米尼克"
                >多米尼克</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/厄瓜多尔"
                >厄瓜多尔</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/哥伦比亚"
                >哥伦比亚</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/古巴"
                >古巴</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/海地"
                >海地</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/加拿大"
                >加拿大</a></li>
        <li class="borderbottom" style="">
            MWY
        </li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/美国"
                >美国</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/秘鲁"
                >秘鲁</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/墨西哥"
                >墨西哥</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/委内瑞拉"
                >委内瑞拉</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/乌拉圭"
                >乌拉圭</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/牙买加"
                >牙买加</a></li>
        <li class="borderbottom" style="">
            Z
        </li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/智利"
                >智利</a></li>
    </ul>
</div>
<div class="item" id="item4" style="display:none">
    <ul>
        <li class="borderbottom" style="line-height:28px;">
            <span style="font-weight: bolder; color: Red;">热门：</span>
        </li>
        <li class="borderbottom" style="line-height:28px;">
            <a href="<?php echo $this->createUrl('visa/list', array('country_id'=>56)); ?>"><span style="font-weight: bolder;
                                color: Red;">所有国家</span></a>
        </li>
        <li class="borderbottom" style="line-height:28px;">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/新西兰"

               style="font-weight:bolder;color:Red; ">
                <span style="color: Red;">新西兰</span> </a>
        </li>
        <li class="borderbottom" style="line-height:28px;">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/澳大利亚"

               style="font-weight:bolder;color:Red; ">
                <span style="color: Red;">澳大利亚</span> </a>
        </li>
        <li class="borderbottom" style="line-height:28px;">
            <span style="height:29px;float:left;">&nbsp;</span> <a
                href="http://www.jmlvyou.com/yutong/visa/search/keyword/ "
                style="font-weight:bolder;color:Red; ">
                <span style="color: Red;"> </span> </a>
        </li>
        <li class="borderbottom" style="line-height:28px;">
            <span style="height:29px;float:left;">&nbsp;</span> <a
                href="http://www.jmlvyou.com/yutong/visa/search/keyword/ "
                style="font-weight:bolder;color:Red; ">
                <span style="color: Red;"> </span> </a>
        </li>
        <li class="borderbottom" style="line-height:28px;">
            <span style="height:29px;float:left;">&nbsp;</span> <a
                href="http://www.jmlvyou.com/yutong/visa/search/keyword/ "
                style="font-weight:bolder;color:Red; ">
                <span style="color: Red;"> </span> </a>
        </li>
        <li class="borderbottom" style="">
            ABX
        </li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/澳大利亚"
                >澳大利亚</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/巴布亚新几内亚"
                >巴布亚新几内亚</a>
        </li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/新西兰"
                >新西兰</a></li>
    </ul>
</div>
<div class="item" id="item5" style="display:none">
<ul>
    <li class="borderbottom" style="line-height:28px;">
        <span style="font-weight: bolder; color: Red;">热门：</span>
    </li>
    <li class="borderbottom" style="line-height:28px;">
        <a href="<?php echo $this->createUrl('visa/list', array('country_id'=>51)); ?>"><span style="font-weight: bolder;
                                color: Red;">所有国家</span></a>
    </li>
    <li class="borderbottom" style="line-height:28px;">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/南非"
           style="font-weight:bolder;color:Red; ">
            <span style="color: Red;">南非</span> </a>
    </li>
    <li class="borderbottom" style="line-height:28px;">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/肯尼亚"

           style="font-weight:bolder;color:Red; ">
            <span style="color: Red;">肯尼亚</span> </a>
    </li>
    <li class="borderbottom" style="line-height:28px;">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/刚果布"

           style="font-weight:bolder;color:Red; ">
            <span style="color: Red;">刚果布</span> </a>
    </li>
    <li class="borderbottom" style="line-height:28px;">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/南苏丹"

           style="font-weight:bolder;color:Red; ">
            <span style="color: Red;">南苏丹</span> </a>
    </li>
    <li class="borderbottom" style="line-height:28px;">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/喀麦隆"

           style="font-weight:bolder;color:Red; ">
            <span style="color: Red;">喀麦隆</span> </a>
    </li>
    <li class="borderbottom" style="">
        AB
    </li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/阿尔及利亚"
            >阿尔及利亚</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/埃及"
            >埃及</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/埃塞俄比亚"
            >埃塞俄比亚</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/安哥拉"
            >安哥拉</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/贝宁"
            >贝宁</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/博茨瓦纳"
            >博茨瓦纳</a></li>
    <li class="borderbottom" style="">
        BCDFG
    </li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/布隆迪"
            >布隆迪</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/赤道几内亚"
            >赤道几内亚</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/多哥"
            >多哥</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/佛得角"
            >佛得角</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/刚果布"
            >刚果布</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/刚果金"
            >刚果金</a></li>
    <li class="borderbottom" style="">
        JK
    </li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/加纳"
            >加纳</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/加蓬"
            >加蓬</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/津巴布韦"
            >津巴布韦</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/几内亚"
            >几内亚</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/几内亚比绍"
            >几内亚比绍</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/喀麦隆"
            >喀麦隆</a></li>
    <li class="borderbottom" style="">
        KL
    </li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/科摩罗"
            >科摩罗</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/肯尼亚"
            >肯尼亚</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/科特迪瓦"
            >科特迪瓦</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/莱索托"
            >莱索托</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/利比里亚"
            >利比里亚</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/利比亚"
            >利比亚</a></li>
    <li class="borderbottom" style="">
        LM
    </li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/卢旺达"
            >卢旺达</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/马达加斯加"
            >马达加斯加</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/马拉维"
            >马拉维</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/马里"
            >马里</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/毛里塔尼亚"
            >毛里塔尼亚</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/摩洛哥"
            >摩洛哥</a></li>
    <li class="borderbottom" style="">
        MN
    </li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/莫桑比克"
            >莫桑比克</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/纳米比亚"
            >纳米比亚</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/南非"
            >南非</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/南苏丹"
            >南苏丹</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/尼日尔"
            >尼日尔</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/尼日利亚"
            >尼日利亚</a></li>
    <li class="borderbottom" style="">
        STW
    </li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/塞拉利昂"
            >塞拉利昂</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/塞内加尔"
            >塞内加尔</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/苏丹"
            >苏丹</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/坦桑尼亚"
            >坦桑尼亚</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/突尼斯"
            >突尼斯</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/瓦努阿图"
            >瓦努阿图</a></li>
    <li class="borderbottom" style="">
        WZ
    </li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/乌干达"
            >乌干达</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/赞比亚"
            >赞比亚</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/乍得"
            >乍得</a></li>
    <li class="borderbottom" style="">
        <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/中非"
            >中非</a></li>
</ul>
</div>
<div class="item" id="item6" style="display:none">
    <ul>
        <li class="borderbottom" style="line-height:28px;">
            <span style="font-weight: bolder; color: Red;">热门：</span>
        </li>
        <li class="borderbottom" style="line-height:28px;">
            <a href="<?php echo $this->createUrl('visa/list', array('country_id'=>1)); ?>"><span style="font-weight: bolder;
                                color: Red;">所有国家</span></a>
        </li>
        <li class="borderbottom" style="line-height:28px;">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/伊朗"
               style="font-weight:bolder;color:Red; ">
                <span style="color: Red;">伊朗</span> </a>
        </li>
        <li class="borderbottom" style="line-height:28px;">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/土耳其"

               style="font-weight:bolder;color:Red; ">
                <span style="color: Red;">土耳其</span> </a>
        </li>
        <li class="borderbottom" style="line-height:28px;">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/以色列"

               style="font-weight:bolder;color:Red; ">
                <span style="color: Red;">以色列</span> </a>
        </li>
        <li class="borderbottom" style="line-height:28px;">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/沙特"
               style="font-weight:bolder;color:Red; ">
                <span style="color: Red;">沙特</span> </a>
        </li>
        <li class="borderbottom" style="line-height:28px;">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/阿联酋"

               style="font-weight:bolder;color:Red; ">
                <span style="color: Red;">阿联酋</span> </a>
        </li>
        <li class="borderbottom" style="">
            ABK
        </li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/阿曼"
                >阿曼</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/阿富汗"
                >阿富汗</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/阿联酋迪拜"
                >阿联酋迪拜</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/巴林"
                >巴林</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/巴基斯坦"
                >巴基斯坦</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/卡塔尔"
                >卡塔尔</a></li>
        <li class="borderbottom" style="">
            KLSTXY
        </li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/科威特"
                >科威特</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/黎巴嫩"
                >黎巴嫩</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/沙特"
                >沙特</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/土耳其"
                >土耳其</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/叙利亚"
                >叙利亚</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/也门"
                >也门</a></li>
        <li class="borderbottom" style="">
            Y
        </li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/伊朗"
                >伊朗</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/以色列"
                >以色列</a></li>
        <li class="borderbottom" style="">
            <a href="http://www.jmlvyou.com/yutong/visa/search/keyword/约旦"
                >约旦</a></li>
    </ul>
</div>
</div>
<iframe width="121" height="277" scrolling="no" frameborder="0" allowtransparency="true" src="<?php echo $this->createUrl('default/qqFrame', array('userId'=>Yii::app()->user->id)); ?>" style="display: block; position: fixed; z-index: 2147483646 !important; left: auto; right: 8px; margin-left: 0px; top: 200px;  margin-top: 0px;">

</iframe>
</body>
</html>