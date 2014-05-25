<div id="main">
<div id="vleft">
    <ul class="opgui">
        <li class="lisd" id="lit1"><a href="javascript:">订单管理</a></li>
        <li class="lic" style="display: block;">
            <a href="<?php echo $this->createUrl('order/list'); ?>" id="order1" style="color: red;">订单进度查询</a><br>
        </li>
    </ul>
    <ul class="opgui">
        <li class="lisd" id="lit7"><a href="javascript:">账号管理</a></li>
        <li class="lic" style="display: list-item;">
            <a href="<?php echo $this->createUrl('user/profile'); ?>" id="member1">修改资料</a>
        </li>
    </ul>

</div>
<div id="vright">

<br>

<form action="/Order/BatchPayConfirm" id="OrderPay" method="get">
<ul class="ordertitle">
    <li style="width: 19%">订单号</li>
    <li style="width: 12%">签证国家</li>
    <li style="width: 14%">客人名称</li>
    <li style="width: 8%">下单人</li>
    <li style="width: 5%">人数</li>
    <li style="width: 8%">订单总额</li>
    <li style="width: 8%">支付状态</li>
    <li>处理状态</li>
    <li style="width: 12%;">跟进人</li>
</ul>
<div id="OrderList">
<?php
$data = $model->search('', array(), 'CActiveRecord');
foreach($data as $item){ ?>

    <ul class="orderitem">
        <li style="width: 19%;">
            <a href="<?php echo $this->createUrl('order/view', array('id'=>$item->id)); ?>" style="font-size:12px;"><?php echo YutongVisaOrder::generateOrderSnNumber($item); ?></a>
        </li>
        <li style="width: 12%"><?php echo $item->visa->country->name; ?></li>
        <li style="width: 14%" title="刘菁菁，帅薇"><?php echo YutongVisaOrder::joinCustomer($item->customers);?></li>
        <li style="width: 8%"><?php echo $item->user->realname;?></li>
        <li style="width: 5%"><?php echo $item->amount;?></li>
        <li style="width: 8%">￥<?php echo $item->price;?></li>
        <li style="width: 8%">&nbsp;
            未支付
        </li>
        <li>
            <label><?php echo YutongVisaOrder::translateStatus($item->status); ?></label>
        </li>
        <li style="width: 12%;">
            <?php echo isset($item->op->realname) ? $item->op->realname : '';?>&nbsp;                    </li>
    </ul>

<?php }
?>
</div>
<div class="page">
    <?php

    ?>
</div>
</form>
<link href="/Content/Css/country.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
    $(function () {
        var i = 1;
        var ii = false;
        $(".popupcountryw .tab li").each(function () {
            $(this).click(function () {
                var regionId = $(this).find("input").val();

                //如果当前层正显示
                if ($("#itemw" + regionId).is(":visible")) return;

                if (i == 1 && ii == true) return;

                i = 1;
                ii = true;

                $(".popupcountryw .tab li").each(function () {
                    $(this).css({ "background-color": "#CBDEFE", "border-bottom": "1px solid #91B3E6" });
                });
                $(this).css({ "background-color": "#FFFFFF", "border-bottom": "0px" });

                //隐藏所有Country层
                $(".popupcountryw .item").each(function () {
                    $(this).hide();
                });

                //如果洲对应的层已经加载则显示
                if ($("#itemw" + regionId).html() != null) {
                    i = 2;
                    $("#itemw" + regionId).show();
                }
                countryFocus = true; //true 表示单击国家层上时不隐藏国家层
            });
        });
    });
    function BandCountryForTextBox() {
        $("#CountryNamew").val(arguments[0]);
        //$("#NationCd").val(arguments[0]);
        $("#popupcountry2").hide();
        //BindDataToCountryDDL("#NationCd");
    }
</script>
<div class="popupcountryw" id="popupcountry2" style="z-index: 903">
<div class="tab">
    <ul>
        <li style="background-color:#FFFFFF;border-bottom:0px; width:80px;">
            亚洲
            <input id="RegionId" name="RegionId" type="hidden" value="1">
        </li>
        <li style=" width:81px;">
            欧洲
            <input id="RegionId" name="RegionId" type="hidden" value="2">
        </li>
        <li style=" width:81px;">
            美洲
            <input id="RegionId" name="RegionId" type="hidden" value="3">
        </li>
        <li style=" width:81px;">
            澳洲
            <input id="RegionId" name="RegionId" type="hidden" value="4">
        </li>
        <li style=" width:81px;">
            非洲
            <input id="RegionId" name="RegionId" type="hidden" value="5">
        </li>
        <li style="border-right: 0px; width: 80px;">
            中东
            <input id="RegionId" name="RegionId" type="hidden" value="6">
        </li>
    </ul>
</div>
<div class="item" id="itemw1" style="display:show">
    <ul>
        <li class="borderbottom" style="text-align:left; line-height:28px;">
            <a href="javascript:BandCountryForTextBox('热门：')">
                                    <span
                                        style="width: 14px;float:left;font-size:10px; color:Red;line-height: 1.2;margin-right:2px;">
                                        <br>
                                        </span><span style="float:left;"></span></a><a
                href="javascript:BandCountryForTextBox('热门：')">热门：</a>

        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('所有国家')">
                所有国家</a>
        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('泰国')">
                泰国</a>
        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('马来西亚')">
                马来西亚</a>
        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('新加坡')">
                新加坡</a>
        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('越南')">
                越南</a>
        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('日本')">
                日本</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('差额费用')">差额费用</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('朝鲜')">朝鲜</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('菲律宾')">菲律宾</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('归国报告书')">归国报告书</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('韩国')">韩国</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('哈萨克斯坦')">哈萨克斯坦</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('柬埔寨')">柬埔寨</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('吉尔吉斯')">吉尔吉斯</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('老挝')">老挝</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('马来西亚')">马来西亚</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('毛里求斯')">毛里求斯</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('蒙古')">蒙古</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('孟加拉国')">孟加拉国</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('缅甸')">缅甸</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('尼泊尔')">尼泊尔</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('日本')">日本</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('斯里兰卡')">斯里兰卡</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('台胞证')">台胞证</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('泰国')">泰国</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('台湾省')">台湾省</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('塔吉克斯坦')">塔吉克斯坦</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('土库曼斯坦')">土库曼斯坦</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('汶莱')">汶莱</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('乌兹别克')">乌兹别克</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('新加坡')">新加坡</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('洗照片')">洗照片</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('印度')">印度</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('印尼')">印尼</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('越南')">越南</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('中国')">中国</a>
        </li>
    </ul>
</div>
<div class="item" id="itemw2" style="display:none">
    <ul>
        <li class="borderbottom" style="text-align:left; line-height:28px;">
            <a href="javascript:BandCountryForTextBox('热门：')">
                                    <span
                                        style="width: 14px;float:left;font-size:10px; color:Red;line-height: 1.2;margin-right:2px;">
                                        <br>
                                        </span><span style="float:left;"></span></a><a
                href="javascript:BandCountryForTextBox('热门：')">热门：</a>

        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('所有国家')">
                所有国家</a>
        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('英国')">
                英国</a>
        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('意大利')">
                意大利</a>
        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('法国')">
                法国</a>
        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('德国')">
                德国</a>
        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('西班牙')">
                西班牙</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('爱尔兰')">爱尔兰</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('奥地利')">奥地利</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('阿塞拜疆')">阿塞拜疆</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('白俄罗斯')">白俄罗斯</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('保加利亚')">保加利亚</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('比利时')">比利时</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('波兰')">波兰</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('丹麦')">丹麦</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('德国')">德国</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('俄罗斯')">俄罗斯</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('法国')">法国</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('芬兰')">芬兰</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('格鲁吉亚')">格鲁吉亚</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('荷兰')">荷兰</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('捷克')">捷克</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('克罗地亚')">克罗地亚</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('立陶宛')">立陶宛</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('罗马尼亚')">罗马尼亚</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('马耳他')">马耳他</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('马其顿')">马其顿</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('挪威')">挪威</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('葡萄牙')">葡萄牙</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('瑞士')">瑞士</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('瑞典')">瑞典</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('塞浦路斯')">塞浦路斯</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('斯洛文尼亚')">斯洛文尼亚</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('乌克兰')">乌克兰</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('西班牙')">西班牙</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('希腊')">希腊</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('匈牙利')">匈牙利</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('亚美尼亚')">亚美尼亚</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('意大利')">意大利</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('英国')">英国</a>
        </li>
    </ul>
</div>
<div class="item" id="itemw3" style="display:none">
    <ul>
        <li class="borderbottom" style="text-align:left; line-height:28px;">
            <a href="javascript:BandCountryForTextBox('热门：')">
                                    <span
                                        style="width: 14px;float:left;font-size:10px; color:Red;line-height: 1.2;margin-right:2px;">
                                        <br>
                                        </span><span style="float:left;"></span></a><a
                href="javascript:BandCountryForTextBox('热门：')">热门：</a>

        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('所有国家')">
                所有国家</a>
        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('美国')">
                美国</a>
        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('加拿大')">
                加拿大</a>
        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('巴西')">
                巴西</a>
        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('墨西哥')">
                墨西哥</a>
        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('哥伦比亚')">
                哥伦比亚</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('阿根廷')">阿根廷</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('巴哈马')">巴哈马</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('巴拿马')">巴拿马</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('巴西')">巴西</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('秘鲁')">秘鲁</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('玻利维亚')">玻利维亚</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('多米尼克')">多米尼克</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('厄瓜多尔')">厄瓜多尔</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('哥伦比亚')">哥伦比亚</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('古巴')">古巴</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('海地')">海地</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('加拿大')">加拿大</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('美国')">美国</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('秘鲁')">秘鲁</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('墨西哥')">墨西哥</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('委内瑞拉')">委内瑞拉</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('乌拉圭')">乌拉圭</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('牙买加')">牙买加</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('智利')">智利</a>
        </li>
    </ul>
</div>
<div class="item" id="itemw4" style="display:none">
    <ul>
        <li class="borderbottom" style="text-align:left; line-height:28px;">
            <a href="javascript:BandCountryForTextBox('热门：')">
                                    <span
                                        style="width: 14px;float:left;font-size:10px; color:Red;line-height: 1.2;margin-right:2px;">
                                        <br>
                                        </span><span style="float:left;"></span></a><a
                href="javascript:BandCountryForTextBox('热门：')">热门：</a>

        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('所有国家')">
                所有国家</a>
        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('新西兰')">
                新西兰</a>
        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('澳大利亚')">
                澳大利亚</a>
        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <span style="height:29px;float:left;">&nbsp;</span> <a href="javascript:BandCountryForTextBox(' ')">
            </a>
        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <span style="height:29px;float:left;">&nbsp;</span> <a href="javascript:BandCountryForTextBox(' ')">
            </a>
        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <span style="height:29px;float:left;">&nbsp;</span> <a href="javascript:BandCountryForTextBox(' ')">
            </a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('澳大利亚')">澳大利亚</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('巴布亚新几内亚')">巴布亚新几内亚</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('新西兰')">新西兰</a>
        </li>
    </ul>
</div>
<div class="item" id="itemw5" style="display:none">
    <ul>
        <li class="borderbottom" style="text-align:left; line-height:28px;">
            <a href="javascript:BandCountryForTextBox('热门：')">
                                    <span
                                        style="width: 14px;float:left;font-size:10px; color:Red;line-height: 1.2;margin-right:2px;">
                                        <br>
                                        </span><span style="float:left;"></span></a><a
                href="javascript:BandCountryForTextBox('热门：')">热门：</a>

        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('所有国家')">
                所有国家</a>
        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('南非')">
                南非</a>
        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('肯尼亚')">
                肯尼亚</a>
        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('刚果布')">
                刚果布</a>
        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('南苏丹')">
                南苏丹</a>
        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('喀麦隆')">
                喀麦隆</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('阿尔及利亚')">阿尔及利亚</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('埃及')">埃及</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('埃塞俄比亚')">埃塞俄比亚</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('安哥拉')">安哥拉</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('贝宁')">贝宁</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('博茨瓦纳')">博茨瓦纳</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('布隆迪')">布隆迪</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('赤道几内亚')">赤道几内亚</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('多哥')">多哥</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('佛得角')">佛得角</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('刚果布')">刚果布</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('刚果金')">刚果金</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('加纳')">加纳</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('加蓬')">加蓬</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('津巴布韦')">津巴布韦</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('几内亚')">几内亚</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('几内亚比绍')">几内亚比绍</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('喀麦隆')">喀麦隆</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('科摩罗')">科摩罗</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('肯尼亚')">肯尼亚</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('科特迪瓦')">科特迪瓦</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('莱索托')">莱索托</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('利比里亚')">利比里亚</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('利比亚')">利比亚</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('卢旺达')">卢旺达</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('马达加斯加')">马达加斯加</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('马拉维')">马拉维</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('马里')">马里</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('毛里塔尼亚')">毛里塔尼亚</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('摩洛哥')">摩洛哥</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('莫桑比克')">莫桑比克</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('纳米比亚')">纳米比亚</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('南非')">南非</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('南苏丹')">南苏丹</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('尼日尔')">尼日尔</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('尼日利亚')">尼日利亚</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('塞拉利昂')">塞拉利昂</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('塞内加尔')">塞内加尔</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('苏丹')">苏丹</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('坦桑尼亚')">坦桑尼亚</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('突尼斯')">突尼斯</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('瓦努阿图')">瓦努阿图</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('乌干达')">乌干达</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('赞比亚')">赞比亚</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('乍得')">乍得</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('中非')">中非</a>
        </li>
    </ul>
</div>
<div class="item" id="itemw6" style="display:none">
    <ul>
        <li class="borderbottom" style="text-align:left; line-height:28px;">
            <a href="javascript:BandCountryForTextBox('热门：')">
                                    <span
                                        style="width: 14px;float:left;font-size:10px; color:Red;line-height: 1.2;margin-right:2px;">
                                        <br>
                                        </span><span style="float:left;"></span></a><a
                href="javascript:BandCountryForTextBox('热门：')">热门：</a>

        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('所有国家')">
                所有国家</a>
        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('伊朗')">
                伊朗</a>
        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('土耳其')">
                土耳其</a>
        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('以色列')">
                以色列</a>
        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('沙特')">
                沙特</a>
        </li>
        <li class="borderbottom" style=" line-height:28px;">
            <a href="javascript:BandCountryForTextBox('阿联酋')">
                阿联酋</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('阿曼')">阿曼</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('阿富汗')">阿富汗</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('阿联酋迪拜')">阿联酋迪拜</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('巴林')">巴林</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('巴基斯坦')">巴基斯坦</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('卡塔尔')">卡塔尔</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('科威特')">科威特</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('黎巴嫩')">黎巴嫩</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('沙特')">沙特</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('土耳其')">土耳其</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('叙利亚')">叙利亚</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('也门')">也门</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('伊朗')">伊朗</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('以色列')">以色列</a>
        </li>
        <li class="borderbottom" style=" ">
            <a href="javascript:BandCountryForTextBox('约旦')">约旦</a>
        </li>
    </ul>
</div>


</div>

</div>

</div>