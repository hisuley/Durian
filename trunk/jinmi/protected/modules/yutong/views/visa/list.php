<div id="main">
<div id="vleft">

    <!--常用下载-->
    <ul class="titlelist">
        <li class="title"><span style="width: 52%"><b>·&nbsp;</b>常用下载</span>
            <span class="more"><a
                    href="/Visa/VisaAssociationList?VisaAssociationType=MaterialDownload&amp;ContinentId=5"
                    target="_blank">
                    更多&gt;&gt;
                </a></span>
        </li>
        <li class="item" title="单击下载"><a href="/Member" title="单击下载"><b>·&nbsp;</b>摩洛哥商务代送函</a>
        </li>
        <li class="item" title="单击下载"><a href="/Member" title="单击下载"><b>·&nbsp;</b>摩洛哥申请表</a>
        </li>
        <li class="item" title="单击下载"><a href="/Member" title="单击下载"><b>·&nbsp;</b>南非英文在职证明-探亲-男性</a>
        </li>
        <li class="item" title="单击下载"><a href="/Member" title="单击下载"><b>·&nbsp;</b>南非英文在职证明-探亲-女性</a>
        </li>
        <li class="item" title="单击下载"><a href="/Member" title="单击下载"><b>·&nbsp;</b>南非英文在职证明-商务-女性</a>
        </li>
        <li class="item" title="单击下载"><a href="/Member" title="单击下载"><b>·&nbsp;</b>南非英文在职证明-商务-男性</a>
        </li>
    </ul>

</div>
<div id="vright">
<script type="text/javascript">
    $(function () {
        //搜索国家
        $("#KeyWord").keyup(function () {
            var tThis = $(this);
            $("#likeSearch").remove();
            var valuess = tThis.val();
            var url = "/Country/AjaxSearch" + "?code=" + encodeURI(valuess);
            $.ajax({
                url: url,
                dataType: 'html',
                success: function (data) {
                    $(".popupcountry").hide();
                    $("#popupcountry").hide();
                    $(data).appendTo($("body"));
                    $("#likeSearch").hide();
                    var tTop = tThis.parent("span").offset().top + tThis.height() + 1;
                    var tLeft = tThis.parent("span").offset().left;
                    $("#likeSearch").css({ "top": tTop, "left": tLeft, "width": "365px" });
                    $("#likeSearch").show();
                }, error: function () {
                    alert("error");
                }
            });
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
<form action="/Visa" id="searchFrm" method="get">
    <ul class="findc">
        <li style="width: 15%;">
            <label>
                请输入国家名：</label></li>
        <li style="width: 400px;"><span>
            <input type="text" id="KeyWord" name="KeyWord" value="支持关键字和拼音模糊查询" class="textbox  validate[required]"
                   style="width: 355px; color: #999999;padding:5px; font-size:larger" maxlength="50">
        </span></li>
        <li style="width: 15%;">
            <input type="submit" class="btn" value="查询">
        </li>
    </ul>
</form>
<ul class="visatitle1">
    <li style="padding-left: 5px; width: 11%; "><strong style="color:White; font-size:14px;">国家</strong></li>
    <li style="width: 19%"><strong style="color:White; font-size:14px;">签证种类</strong></li>
    <li><strong style="color:White; font-size:14px;">工作日</strong></li>
    <li style="width: 9%"><strong style="color:White; font-size:14px;">市场价</strong></li>
    <li style="width: 8%;"><strong style="color:White; font-size:14px;">有效期</strong></li>
    <li style="width: 8%;"><strong style="color:White; font-size:14px;">停留期</strong></li>
    <li style="width: 9%;"><strong style="color:White; font-size:14px;">入境次数</strong></li>
    <li style="width: 7%;"><strong style="color:White; font-size:14px;">资料</strong></li>
    <li style="width: 8%;"><strong style="color:White; font-size:14px;">下单</strong></li>
</ul>
<ul class="visaitem1">
    <li title="南非" style="padding-left: 5px; width: 11%">南非</li>
    <li title="旅游签证" style="width: 19%">
        旅游签证(上海领区)
    </li>
    <li title="15-20">&nbsp;15-20</li>
    <li style="width: 9%">￥1300</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 8%;" title="按申请">按申请</li>
    <li style="width: 9%; text-align:center;">领馆批</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/31?ContinentId=5&amp;Keyword=%E5%8D%97%E9%9D%9E" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="南非" style="padding-left: 5px; width: 11%">南非</li>
    <li title="探亲访友签证" style="width: 19%">
        探亲访友签证(上海领区)
    </li>
    <li title="15-20">&nbsp;15-20</li>
    <li style="width: 9%">￥1300</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 8%;" title="按申请">按申请</li>
    <li style="width: 9%; text-align:center;">领馆批</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/278?ContinentId=5&amp;Keyword=%E5%8D%97%E9%9D%9E" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="南非" style="padding-left: 5px; width: 11%">南非</li>
    <li title="商务签证" style="width: 19%">
        商务签证(上海领区)
    </li>
    <li title="15-20">&nbsp;15-20</li>
    <li style="width: 9%">￥1300</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 8%;" title="按申请">按申请</li>
    <li style="width: 9%; text-align:center;">使馆批</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/222?ContinentId=5&amp;Keyword=%E5%8D%97%E9%9D%9E" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="加纳" style="padding-left: 5px; width: 11%">加纳</li>
    <li title="商务签证" style="width: 19%">
        商务签证(不限城市)
    </li>
    <li title="5-7">&nbsp;5-7</li>
    <li style="width: 9%">￥1200</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/97?ContinentId=5&amp;Keyword=%E5%8A%A0%E7%BA%B3" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="马里" style="padding-left: 5px; width: 11%">马里</li>
    <li title="商务签证" style="width: 19%">
        商务签证(不限城市)
    </li>
    <li title="5-7">&nbsp;5-7</li>
    <li style="width: 9%">￥900</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/598?ContinentId=5&amp;Keyword=%E9%A9%AC%E9%87%8C" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="多哥" style="padding-left: 5px; width: 11%">多哥</li>
    <li title="包签" style="width: 19%">
        包签(不限城市)
    </li>
    <li title="1">&nbsp;1</li>
    <li style="width: 9%">￥2200</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/315?ContinentId=5&amp;Keyword=%E5%A4%9A%E5%93%A5" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="苏丹" style="padding-left: 5px; width: 11%">苏丹</li>
    <li title="包签" style="width: 19%">
        包签(不限城市)
    </li>
    <li title="3-5">&nbsp;3-5</li>
    <li style="width: 9%">￥1700</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/283?ContinentId=5&amp;Keyword=%E8%8B%8F%E4%B8%B9" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="苏丹" style="padding-left: 5px; width: 11%">苏丹</li>
    <li title="商务签证" style="width: 19%">
        商务签证(不限城市)
    </li>
    <li title="3">&nbsp;3</li>
    <li style="width: 9%">￥900</li>
    <li style="width: 8%;" title="2个月">2个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/219?ContinentId=5&amp;Keyword=%E8%8B%8F%E4%B8%B9" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="乍得" style="padding-left: 5px; width: 11%">乍得</li>
    <li title="商务签证" style="width: 19%">
        商务签证(不限城市)
    </li>
    <li title="5">&nbsp;5</li>
    <li style="width: 9%">￥1400</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/454?ContinentId=5&amp;Keyword=%E4%B9%8D%E5%BE%97" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="乍得" style="padding-left: 5px; width: 11%">乍得</li>
    <li title="包签" style="width: 19%">
        包签(不限城市)
    </li>
    <li title="3-5">&nbsp;3-5</li>
    <li style="width: 9%">￥2200</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/316?ContinentId=5&amp;Keyword=%E4%B9%8D%E5%BE%97" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="加蓬" style="padding-left: 5px; width: 11%">加蓬</li>
    <li title="商务签证" style="width: 19%">
        商务签证(不限城市)
    </li>
    <li title="15-20">&nbsp;15-20</li>
    <li style="width: 9%">￥1100</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/402?ContinentId=5&amp;Keyword=%E5%8A%A0%E8%93%AC" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="中非" style="padding-left: 5px; width: 11%">中非</li>
    <li title="商务包签证" style="width: 19%">
        商务包签证(不限城市)
    </li>
    <li title="3-5">&nbsp;3-5</li>
    <li style="width: 9%">￥2500</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/470?ContinentId=5&amp;Keyword=%E4%B8%AD%E9%9D%9E" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="肯尼亚" style="padding-left: 5px; width: 11%">肯尼亚</li>
    <li title="旅游加急" style="width: 19%">
        旅游加急(不限城市)
    </li>
    <li title="3-4">&nbsp;3-4</li>
    <li style="width: 9%">￥1700</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/35?ContinentId=5&amp;Keyword=%E8%82%AF%E5%B0%BC%E4%BA%9A" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="肯尼亚" style="padding-left: 5px; width: 11%">肯尼亚</li>
    <li title="旅游签证" style="width: 19%">
        旅游签证(不限城市)
    </li>
    <li title="10-12">&nbsp;10-12</li>
    <li style="width: 9%">￥950</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/38?ContinentId=5&amp;Keyword=%E8%82%AF%E5%B0%BC%E4%BA%9A" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="喀麦隆" style="padding-left: 5px; width: 11%">喀麦隆</li>
    <li title="包签" style="width: 19%">
        包签(不限城市)
    </li>
    <li title="3-5">&nbsp;3-5</li>
    <li style="width: 9%">￥2600</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/182?ContinentId=5&amp;Keyword=%E5%96%80%E9%BA%A6%E9%9A%86" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="突尼斯" style="padding-left: 5px; width: 11%">突尼斯</li>
    <li title="商务签证" style="width: 19%">
        商务签证(不限城市)
    </li>
    <li title="15-20">&nbsp;15-20</li>
    <li style="width: 9%">￥1500</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 8%;" title="使馆批">使馆批</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/435?ContinentId=5&amp;Keyword=%E7%AA%81%E5%B0%BC%E6%96%AF" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="突尼斯" style="padding-left: 5px; width: 11%">突尼斯</li>
    <li title="过境签" style="width: 19%">
        过境签(不限城市)
    </li>
    <li title="10">&nbsp;10</li>
    <li style="width: 9%">￥1500</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 8%;" title="使馆批">使馆批</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/490?ContinentId=5&amp;Keyword=%E7%AA%81%E5%B0%BC%E6%96%AF" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="莱索托" style="padding-left: 5px; width: 11%">莱索托</li>
    <li title="商务签证" style="width: 19%">
        商务签证(不限城市)
    </li>
    <li title="7-10">&nbsp;7-10</li>
    <li style="width: 9%">￥1800</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/89?ContinentId=5&amp;Keyword=%E8%8E%B1%E7%B4%A2%E6%89%98" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="南苏丹" style="padding-left: 5px; width: 11%">南苏丹</li>
    <li title="商务签证" style="width: 19%">
        商务签证(不限城市)
    </li>
    <li title="5-6">&nbsp;5-6</li>
    <li style="width: 9%">￥1300</li>
    <li style="width: 8%;" title="2个月">2个月</li>
    <li style="width: 8%;" title="2个月">2个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/367?ContinentId=5&amp;Keyword=%E5%8D%97%E8%8B%8F%E4%B8%B9" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="刚果金" style="padding-left: 5px; width: 11%">刚果金</li>
    <li title="商务包签证" style="width: 19%">
        商务包签证(不限城市)
    </li>
    <li title="5-7">&nbsp;5-7</li>
    <li style="width: 9%">￥2700</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/303?ContinentId=5&amp;Keyword=%E5%88%9A%E6%9E%9C%E9%87%91" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="安哥拉" style="padding-left: 5px; width: 11%">安哥拉</li>
    <li title="商务签证" style="width: 19%">
        商务签证(不限城市)
    </li>
    <li title="20-30">&nbsp;20-30</li>
    <li style="width: 9%">￥1550</li>
    <li style="width: 8%;" title="2个月">2个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/74?ContinentId=5&amp;Keyword=%E5%AE%89%E5%93%A5%E6%8B%89" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="马拉维" style="padding-left: 5px; width: 11%">马拉维</li>
    <li title="商务签证" style="width: 19%">
        商务签证(不限城市)
    </li>
    <li title="5">&nbsp;5</li>
    <li style="width: 9%">￥1800</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/24?ContinentId=5&amp;Keyword=%E9%A9%AC%E6%8B%89%E7%BB%B4" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="马拉维" style="padding-left: 5px; width: 11%">马拉维</li>
    <li title="包签" style="width: 19%">
        包签(不限城市)
    </li>
    <li title="7-10">&nbsp;7-10</li>
    <li style="width: 9%">￥2500</li>
    <li style="width: 8%;" title="30天">30天</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/286?ContinentId=5&amp;Keyword=%E9%A9%AC%E6%8B%89%E7%BB%B4" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="乌干达" style="padding-left: 5px; width: 11%">乌干达</li>
    <li title="商务包签证" style="width: 19%">
        商务包签证(不限城市)
    </li>
    <li title="7-10">&nbsp;7-10</li>
    <li style="width: 9%">￥2450</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/297?ContinentId=5&amp;Keyword=%E4%B9%8C%E5%B9%B2%E8%BE%BE" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="乌干达" style="padding-left: 5px; width: 11%">乌干达</li>
    <li title="旅游签证" style="width: 19%">
        旅游签证(不限城市)
    </li>
    <li title="7-10">&nbsp;7-10</li>
    <li style="width: 9%">￥2100</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/368?ContinentId=5&amp;Keyword=%E4%B9%8C%E5%B9%B2%E8%BE%BE" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="利比亚" style="padding-left: 5px; width: 11%">利比亚</li>
    <li title="商务签证" style="width: 19%">
        商务签证(不限城市)
    </li>
    <li title="4">&nbsp;4</li>
    <li style="width: 9%">￥1100</li>
    <li style="width: 8%;" title="45天">45天</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/412?ContinentId=5&amp;Keyword=%E5%88%A9%E6%AF%94%E4%BA%9A" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="几内亚" style="padding-left: 5px; width: 11%">几内亚</li>
    <li title="包签" style="width: 19%">
        包签(不限城市)
    </li>
    <li title="3-5">&nbsp;3-5</li>
    <li style="width: 9%">￥2000</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/299?ContinentId=5&amp;Keyword=%E5%87%A0%E5%86%85%E4%BA%9A" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="佛得角" style="padding-left: 5px; width: 11%">佛得角</li>
    <li title="商务签证" style="width: 19%">
        商务签证(不限城市)
    </li>
    <li title="5-10">&nbsp;5-10</li>
    <li style="width: 9%">￥1050</li>
    <li style="width: 8%;" title="4个月">4个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/385?ContinentId=5&amp;Keyword=%E4%BD%9B%E5%BE%97%E8%A7%92" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="卢旺达" style="padding-left: 5px; width: 11%">卢旺达</li>
    <li title="包签" style="width: 19%">
        包签(不限城市)
    </li>
    <li title="5-10">&nbsp;5-10</li>
    <li style="width: 9%">￥2500</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/458?ContinentId=5&amp;Keyword=%E5%8D%A2%E6%97%BA%E8%BE%BE" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="卢旺达" style="padding-left: 5px; width: 11%">卢旺达</li>
    <li title="商务签证" style="width: 19%">
        商务签证(不限城市)
    </li>
    <li title="5-10">&nbsp;5-10</li>
    <li style="width: 9%">￥1000</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/409?ContinentId=5&amp;Keyword=%E5%8D%A2%E6%97%BA%E8%BE%BE" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="赞比亚" style="padding-left: 5px; width: 11%">赞比亚</li>
    <li title="商务包签证" style="width: 19%">
        商务包签证(不限城市)
    </li>
    <li title="5-7">&nbsp;5-7</li>
    <li style="width: 9%">￥950</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/135?ContinentId=5&amp;Keyword=%E8%B5%9E%E6%AF%94%E4%BA%9A" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="刚果布" style="padding-left: 5px; width: 11%">刚果布</li>
    <li title="包签" style="width: 19%">
        包签(不限城市)
    </li>
    <li title="3-5">&nbsp;3-5</li>
    <li style="width: 9%">￥2400</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/310?ContinentId=5&amp;Keyword=%E5%88%9A%E6%9E%9C%E5%B8%83" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="布隆迪" style="padding-left: 5px; width: 11%">布隆迪</li>
    <li title="包签" style="width: 19%">
        包签(不限城市)
    </li>
    <li title="3-5">&nbsp;3-5</li>
    <li style="width: 9%">￥2800</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/471?ContinentId=5&amp;Keyword=%E5%B8%83%E9%9A%86%E8%BF%AA" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="布隆迪" style="padding-left: 5px; width: 11%">布隆迪</li>
    <li title="商务签证" style="width: 19%">
        商务签证(不限城市)
    </li>
    <li title="5-7">&nbsp;5-7</li>
    <li style="width: 9%">￥1000</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/482?ContinentId=5&amp;Keyword=%E5%B8%83%E9%9A%86%E8%BF%AA" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="科摩罗" style="padding-left: 5px; width: 11%">科摩罗</li>
    <li title="旅游签证" style="width: 19%">
        旅游签证(不限城市)
    </li>
    <li title="5-7">&nbsp;5-7</li>
    <li style="width: 9%">￥900</li>
    <li style="width: 8%;" title="使馆批">使馆批</li>
    <li style="width: 8%;" title="使馆批">使馆批</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/472?ContinentId=5&amp;Keyword=%E7%A7%91%E6%91%A9%E7%BD%97" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="科摩罗" style="padding-left: 5px; width: 11%">科摩罗</li>
    <li title="商务签证" style="width: 19%">
        商务签证(不限城市)
    </li>
    <li title="5-7">&nbsp;5-7</li>
    <li style="width: 9%">￥1000</li>
    <li style="width: 8%;" title="1-3个月">1-3个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">多次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/473?ContinentId=5&amp;Keyword=%E7%A7%91%E6%91%A9%E7%BD%97" style="text-decoration:underline"
           target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="纳米比亚" style="padding-left: 5px; width: 11%">纳米比亚</li>
    <li title="包签" style="width: 19%">
        包签(不限城市)
    </li>
    <li title="10-15">&nbsp;10-15</li>
    <li style="width: 9%">￥3000</li>
    <li style="width: 8%;" title="1-3个月">1-3个月</li>
    <li style="width: 8%;" title="海关批">海关批</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/366?ContinentId=5&amp;Keyword=%E7%BA%B3%E7%B1%B3%E6%AF%94%E4%BA%9A"
           style="text-decoration:underline" target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="纳米比亚" style="padding-left: 5px; width: 11%">纳米比亚</li>
    <li title="商务签证" style="width: 19%">
        商务签证(不限城市)
    </li>
    <li title="5-10">&nbsp;5-10</li>
    <li style="width: 9%">￥1500</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/401?ContinentId=5&amp;Keyword=%E7%BA%B3%E7%B1%B3%E6%AF%94%E4%BA%9A"
           style="text-decoration:underline" target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="坦桑尼亚" style="padding-left: 5px; width: 11%">坦桑尼亚</li>
    <li title="包签" style="width: 19%">
        包签(不限城市)
    </li>
    <li title="10-15">&nbsp;10-15</li>
    <li style="width: 9%">￥1000</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/189?ContinentId=5&amp;Keyword=%E5%9D%A6%E6%A1%91%E5%B0%BC%E4%BA%9A"
           style="text-decoration:underline" target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="坦桑尼亚" style="padding-left: 5px; width: 11%">坦桑尼亚</li>
    <li title="加急处理" style="width: 19%">
        加急处理(不限城市)
    </li>
    <li title="3-4">&nbsp;3-4</li>
    <li style="width: 9%">￥1400</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/533?ContinentId=5&amp;Keyword=%E5%9D%A6%E6%A1%91%E5%B0%BC%E4%BA%9A"
           style="text-decoration:underline" target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="莫桑比克" style="padding-left: 5px; width: 11%">莫桑比克</li>
    <li title="包签" style="width: 19%">
        包签(不限城市)
    </li>
    <li title="10-15">&nbsp;10-15</li>
    <li style="width: 9%">￥2100</li>
    <li style="width: 8%;" title="2个月">2个月</li>
    <li style="width: 8%;" title="7-14天">7-14天</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/187?ContinentId=5&amp;Keyword=%E8%8E%AB%E6%A1%91%E6%AF%94%E5%85%8B"
           style="text-decoration:underline" target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="塞拉利昂" style="padding-left: 5px; width: 11%">塞拉利昂</li>
    <li title="商务签证" style="width: 19%">
        商务签证(不限城市)
    </li>
    <li title="7-10">&nbsp;7-10</li>
    <li style="width: 9%">￥1750</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/313?ContinentId=5&amp;Keyword=%E5%A1%9E%E6%8B%89%E5%88%A9%E6%98%82"
           style="text-decoration:underline" target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="塞拉利昂" style="padding-left: 5px; width: 11%">塞拉利昂</li>
    <li title="包签" style="width: 19%">
        包签(不限城市)
    </li>
    <li title="7-10">&nbsp;7-10</li>
    <li style="width: 9%">￥2200</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/509?ContinentId=5&amp;Keyword=%E5%A1%9E%E6%8B%89%E5%88%A9%E6%98%82"
           style="text-decoration:underline" target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="利比里亚" style="padding-left: 5px; width: 11%">利比里亚</li>
    <li title="包签" style="width: 19%">
        包签(不限城市)
    </li>
    <li title="5">&nbsp;5</li>
    <li style="width: 9%">￥1800</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/284?ContinentId=5&amp;Keyword=%E5%88%A9%E6%AF%94%E9%87%8C%E4%BA%9A"
           style="text-decoration:underline" target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="津巴布韦" style="padding-left: 5px; width: 11%">津巴布韦</li>
    <li title="商务签证" style="width: 19%">
        商务签证(不限城市)
    </li>
    <li title="10">&nbsp;10</li>
    <li style="width: 9%">￥1000</li>
    <li style="width: 8%;" title="6个月">6个月</li>
    <li style="width: 8%;" title="海关批">海关批</li>
    <li style="width: 9%; text-align:center;">海关批</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/468?ContinentId=5&amp;Keyword=%E6%B4%A5%E5%B7%B4%E5%B8%83%E9%9F%A6"
           style="text-decoration:underline" target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="瓦努阿图" style="padding-left: 5px; width: 11%">瓦努阿图</li>
    <li title="旅游签证" style="width: 19%">
        旅游签证(不限城市)
    </li>
    <li title="7-10">&nbsp;7-10</li>
    <li style="width: 9%">￥1200</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/403?ContinentId=5&amp;Keyword=%E7%93%A6%E5%8A%AA%E9%98%BF%E5%9B%BE"
           style="text-decoration:underline" target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="尼日利亚" style="padding-left: 5px; width: 11%">尼日利亚</li>
    <li title="商务包签证" style="width: 19%">
        商务包签证(不限城市)
    </li>
    <li title="7-8">&nbsp;7-8</li>
    <li style="width: 9%">￥5100</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/72?ContinentId=5&amp;Keyword=%E5%B0%BC%E6%97%A5%E5%88%A9%E4%BA%9A"
           style="text-decoration:underline" target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="毛里塔尼亚" style="padding-left: 5px; width: 11%">毛里塔尼亚</li>
    <li title="商务签证" style="width: 19%">
        商务签证(不限城市)
    </li>
    <li title="5">&nbsp;5</li>
    <li style="width: 9%">￥1500</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/489?ContinentId=5&amp;Keyword=%E6%AF%9B%E9%87%8C%E5%A1%94%E5%B0%BC%E4%BA%9A"
           style="text-decoration:underline" target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="阿尔及利亚" style="padding-left: 5px; width: 11%">阿尔及利亚</li>
    <li title="商务加急" style="width: 19%">
        商务加急(不限城市)
    </li>
    <li title="10-15">&nbsp;10-15</li>
    <li style="width: 9%">￥1150</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/453?ContinentId=5&amp;Keyword=%E9%98%BF%E5%B0%94%E5%8F%8A%E5%88%A9%E4%BA%9A"
           style="text-decoration:underline" target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<ul class="visaitem1">
    <li title="阿尔及利亚" style="padding-left: 5px; width: 11%">阿尔及利亚</li>
    <li title="商务签证" style="width: 19%">
        商务签证(不限城市)
    </li>
    <li title="20-25">&nbsp;20-25</li>
    <li style="width: 9%">￥900</li>
    <li style="width: 8%;" title="3个月">3个月</li>
    <li style="width: 8%;" title="1个月">1个月</li>
    <li style="width: 9%; text-align:center;">单次</li>
    <li style="width: 7%;margin-right:3px;">
        <a href="/Visa/Visa/78?ContinentId=5&amp;Keyword=%E9%98%BF%E5%B0%94%E5%8F%8A%E5%88%A9%E4%BA%9A"
           style="text-decoration:underline" target="_blank">详细</a>
    </li>
    <li style="width: 7%;height:30px;">
        <a href="/Member"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
    </li>
</ul>
<div class="page">
    <label style="margin-right:-3px;">上一页</label>
    <label class="selectedpage" style="margin-left:0px;">1</label>
    <a href="/Visa?ContinentId=5&amp;PageIndex=2">2</a><a href="/Visa?ContinentId=5&amp;PageIndex=2"
                                                          style="position:relative;top:-2px;">下一页</a></div>
</div>


</div>
</div>
