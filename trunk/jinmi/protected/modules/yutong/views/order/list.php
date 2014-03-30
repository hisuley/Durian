<div id="main">
<div id="vleft">
    <ul class="opgui">
        <li class="lisd" id="lit1"><a href="javascript:">订单管理</a></li>
        <li class="lic" style="display: block;">
            <a href="/Order?me=1&amp;mid=order1" id="order1" style="color: red;">订单进度查询</a><br>

            <a href="/Seckill/MyBulk?me=1&amp;mid=order5" id="order5">我的抢购订单</a><br>

            <a href="/Order/OrderBillList?me=1&amp;mid=order2" id="order2">支付账单管理</a><br>
            <a href="/Order/ArrearageOrderList?me=1&amp;mid=order3" id="order3">未付款订单</a>
        </li>
    </ul>


    <ul class="opgui" id="dfdfdkdjj">
        <li class="lisd" id="lit2"><a href="javascript:">网站数据对接管理</a></li>
        <li class="lic" id="slslslId">
            <a href="/Order/FastsiteOrderList?me=2&amp;mid=fast1" id="fast1">网站订单管理</a>
            <br>
            <a href="/Fastsite/Account/152489?me=2&amp;mid=fast2" id="fast2">基本资料</a>
            <br>
            <a href="/Fastsite/Set/152489?me=2&amp;mid=fast3" id="fast3">网站设置</a>
            <br>
            <a href="/Fastsite/Style/152489?me=2&amp;mid=fast4" id="fast4">模板设置</a>
            <br>
            <a href="/Fastsite/NavSet/152489?me=2&amp;mid=fast5" id="fast5">导航设置</a>
            <br>
            <a href="/Fastsite/Index/152489?me=2&amp;mid=fast6" id="fast6">网站价格管理</a>
            <br>

            <a href="/Fastsite/CustomerService/152489?me=2&amp;mid=fast8" id="fast8">客服管理</a>
            <br>
            <a href="/Fastsite/Link/152489?me=2&amp;mid=fast9" id="fast9">友情链接</a>
            <br>
            <a href="/Fastsite/HomeAdv/152489?me=2&amp;mid=fast10" id="fast10">首页广告</a>
            <br>
            <a href="/Show/ListFastsitePay/152489?me=2&amp;mid=fast11" id="fast11">数据支付记录</a>
            <br>
            <a href="/Show/IsPayNews/152489?me=2&amp;mid=fast12" id="fast12">管理新闻</a><br>
            <a href="/Show/IsPayNews/152489?me=2&amp;mid=fast13" id="fast13">发布新闻</a></li>
    </ul>

    <ul class="opgui">
        <li class="lisd" id="lit6"><a href="javascript:">积分管理</a></li>
        <li class="lic">
            <a href="/Integral/ListRecord?me=6&amp;mid=integral1" id="integral1">积分兑换记录</a>
            <br>
            <a href="/Integral/ListIntegral?me=6&amp;mid=integral2" id="integral2">我的积分管理</a>
            <br>
            <a href="/Integral/List?me=6&amp;mid=integral3" id="integral3">使用积分</a>
        </li>
    </ul>
    <ul class="opgui">
        <li class="lisd" id="lit7"><a href="javascript:">账号管理</a></li>
        <li class="lic">
            <a href="/Member/Edit?me=7&amp;mid=member1" id="member1">修改资料</a> <br>
            <a href="/Member/EditPwd?me=7&amp;mid=member2" id="member2">修改密码</a> <br>
            <a href="/Member/CreateChild?me=7&amp;mid=member3" id="member3">创建子账号</a> <br>
            <a href="/Member/ManagementChildren?me=7&amp;mid=member4" id="member4">管理子账号</a></li>
    </ul>

    <br>


</div>
<div id="vright">

<br>

<div style="overflow: hidden; margin-bottom: 3px;">
    <form action="/Order/CreateBill" id="frmCreateBill" method="get" target="_blank"><input type="button"
                                                                                            class="smallbtn_1"
                                                                                            value="财务支付" id="CreateBill"
                                                                                            name="CreateBill">
    </form>
    <input type="button" class="smallbtn_1" value="本人支付" id="PayOut" name="PayOut">
    <label class="required" style="margin-left: 10px;">（勾选订单后点击生成账单，支持多选）</label>
</div>
<form action="/Order/BatchPayConfirm" id="OrderPay" method="get">
<ul class="ordertitle">
    <li style="padding-left: 5px; padding-top: 3px; width: 3%">
        <input id="All" name="All" style="position: relative; top: -3px;" type="checkbox" value="true"><input name="All"
                                                                                                              type="hidden"
                                                                                                              value="false">
    </li>
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
<ul class="orderitem">
    <li style="padding-left: 5px; padding-top: 3px; width: 3%">
        <input type="checkbox" style="position: relative; top: -3px;" name="Id" id="Id" value="123584">
        <input id="OrderNo" name="OrderNo" type="hidden" value="Y1403281613381840"></li>
    <li style="width: 19%;">
        <a href="/order/Order?orderNo=Y1403281613381840&amp;token=0ef0d8f1c0658c2a" style="font-size:12px;">Y1403281613381840</a>
    </li>
    <li style="width: 12%">缅甸</li>
    <li style="width: 14%" title="刘菁菁，帅薇">刘菁菁，帅薇&nbsp;</li>
    <li style="width: 8%">&nbsp;沐文生</li>
    <li style="width: 5%">2</li>
    <li style="width: 8%">￥260</li>
    <li style="width: 8%">&nbsp;
        未支付
    </li>
    <li>
        <label>订单确认</label>
    </li>
    <li style="width: 12%;">
        冼敏玲&nbsp;                    </li>
</ul>
<ul class="orderitem">
    <li style="padding-left: 5px; padding-top: 3px; width: 3%">
        <input type="checkbox" style="position: relative; top: -3px;" name="Id" id="Id" value="123030">
        <input id="OrderNo" name="OrderNo" type="hidden" value="Y1403261347001067"></li>
    <li style="width: 19%;">
        <a href="/order/Order?orderNo=Y1403261347001067&amp;token=10b4c5e089808fef" style="font-size:12px;">Y1403261347001067</a>
    </li>
    <li style="width: 12%">越南</li>
    <li style="width: 14%" title="马磊（出签生效）">马磊（出签生效）&nbsp;</li>
    <li style="width: 8%">&nbsp;沐文生</li>
    <li style="width: 5%">1</li>
    <li style="width: 8%">￥370</li>
    <li style="width: 8%">&nbsp;
        未支付
    </li>
    <li>
        <label>已出结果</label><br>
        <label style="color: Green;">获得签证</label>
    </li>
    <li style="width: 12%;">
        冼敏玲&nbsp;                    </li>
</ul>
<ul class="orderitem">
    <li style="padding-left: 5px; padding-top: 3px; width: 3%">
        <input type="checkbox" style="position: relative; top: -3px;" name="Id" id="Id" value="123028">
        <input id="OrderNo" name="OrderNo" type="hidden" value="Y1403261344264140"></li>
    <li style="width: 19%;">
        <a href="/order/Order?orderNo=Y1403261344264140&amp;token=fca7cffd7bfebe77" style="font-size:12px;">Y1403261344264140</a>
    </li>
    <li style="width: 12%">缅甸</li>
    <li style="width: 14%" title="何青泉">何青泉&nbsp;</li>
    <li style="width: 8%">&nbsp;沐文生</li>
    <li style="width: 5%">1</li>
    <li style="width: 8%">￥130</li>
    <li style="width: 8%">&nbsp;
        未支付
    </li>
    <li>
        <label>已经送签</label>
    </li>
    <li style="width: 12%;">
        冼敏玲&nbsp;                    </li>
</ul>
<ul class="orderitem">
    <li style="padding-left: 5px; padding-top: 3px; width: 3%">
        <input type="checkbox" style="position: relative; top: -3px;" name="Id" id="Id" value="122491">
        <input id="OrderNo" name="OrderNo" type="hidden" value="Y1403241514231671"></li>
    <li style="width: 19%;">
        <a href="/order/Order?orderNo=Y1403241514231671&amp;token=7542714f903d20dd" style="font-size:12px;">Y1403241514231671</a>
    </li>
    <li style="width: 12%">印尼</li>
    <li style="width: 14%" title="房丽民">房丽民&nbsp;</li>
    <li style="width: 8%">&nbsp;沐文生</li>
    <li style="width: 5%">1</li>
    <li style="width: 8%">￥410</li>
    <li style="width: 8%">&nbsp;
        未支付
    </li>
    <li>
        <label>已出结果</label><br>
        <label style="color: Green;">获得签证</label>
    </li>
    <li style="width: 12%;">
        冼敏玲&nbsp;                    </li>
</ul>
<ul class="orderitem">
    <li style="padding-left: 5px; padding-top: 3px; width: 3%">
        <input type="checkbox" style="position: relative; top: -3px;" name="Id" id="Id" value="122418">
        <input id="OrderNo" name="OrderNo" type="hidden" value="Y1403241207181427"></li>
    <li style="width: 19%;">
        <a href="/order/Order?orderNo=Y1403241207181427&amp;token=f58f5f7d14dc0a42" style="font-size:12px;">Y1403241207181427</a>
    </li>
    <li style="width: 12%">越南</li>
    <li style="width: 14%" title="魏冠平 （出签生效）">魏冠平 （出签生效）&nbsp;</li>
    <li style="width: 8%">&nbsp;沐文生</li>
    <li style="width: 5%">1</li>
    <li style="width: 8%">￥370</li>
    <li style="width: 8%">&nbsp;
        未支付
    </li>
    <li>
        <label>已出结果</label><br>
        <label style="color: Green;">获得签证</label>
    </li>
    <li style="width: 12%;">
        冼敏玲&nbsp;                    </li>
</ul>
<ul class="orderitem">
    <li style="padding-left: 5px; padding-top: 3px; width: 3%">
        <input type="checkbox" style="position: relative; top: -3px;" name="Id" id="Id" value="121973">
        <input id="OrderNo" name="OrderNo" type="hidden" value="Y1403210421121670"></li>
    <li style="width: 19%;">
        <a href="/order/Order?orderNo=Y1403210421121670&amp;token=b6680cfd1d0805b4" style="font-size:12px;">Y1403210421121670</a>
    </li>
    <li style="width: 12%">越南</li>
    <li style="width: 14%" title="刘静，徐旭辉  （4月1日生效）">刘静，徐旭辉 ...&nbsp;</li>
    <li style="width: 8%">&nbsp;沐文生</li>
    <li style="width: 5%">2</li>
    <li style="width: 8%">￥740</li>
    <li style="width: 8%">&nbsp;
        未支付
    </li>
    <li>
        <label>已出结果</label><br>
        <label style="color: Green;">获得签证</label>
    </li>
    <li style="width: 12%;">
        冼敏玲&nbsp;                    </li>
</ul>
<ul class="orderitem">
    <li style="padding-left: 5px; padding-top: 3px; width: 3%">
        <input type="checkbox" style="position: relative; top: -3px;" name="Id" id="Id" value="121972">
        <input id="OrderNo" name="OrderNo" type="hidden" value="Y1403210420161523"></li>
    <li style="width: 19%;">
        <a href="/order/Order?orderNo=Y1403210420161523&amp;token=b6bbd72de4ea535d" style="font-size:12px;">Y1403210420161523</a>
    </li>
    <li style="width: 12%">缅甸</li>
    <li style="width: 14%" title="管永杰，罗会文，曹晟智，任玉，郭毅萌">管永杰，罗会文...&nbsp;</li>
    <li style="width: 8%">&nbsp;沐文生</li>
    <li style="width: 5%">5</li>
    <li style="width: 8%">￥650</li>
    <li style="width: 8%">&nbsp;
        未支付
    </li>
    <li>
        <label>已出结果</label><br>
        <label style="color: Green;">获得签证</label>
    </li>
    <li style="width: 12%;">
        冼敏玲&nbsp;                    </li>
</ul>
<ul class="orderitem">
    <li style="padding-left: 5px; padding-top: 3px; width: 3%">
        <input type="checkbox" style="position: relative; top: -3px;" name="Id" id="Id" value="121842">
        <input id="OrderNo" name="OrderNo" type="hidden" value="Y1403201442052119"></li>
    <li style="width: 19%;">
        <a href="/order/Order?orderNo=Y1403201442052119&amp;token=2a7cd17e13cd9992" style="font-size:12px;">Y1403201442052119</a>
    </li>
    <li style="width: 12%">柬埔寨</li>
    <li style="width: 14%" title="孙荣喜，郭志峰（先缅甸后柬埔寨）">孙荣喜，郭志峰...&nbsp;</li>
    <li style="width: 8%">&nbsp;沐文生</li>
    <li style="width: 5%">2</li>
    <li style="width: 8%">￥420</li>
    <li style="width: 8%">&nbsp;
        未支付
    </li>
    <li>
        <label>已出结果</label><br>
        <label style="color: Green;">获得签证</label>
    </li>
    <li style="width: 12%;">
        冼敏玲&nbsp;                    </li>
</ul>
<ul class="orderitem">
    <li style="padding-left: 5px; padding-top: 3px; width: 3%">
        <input type="checkbox" style="position: relative; top: -3px;" name="Id" id="Id" value="121841">
        <input id="OrderNo" name="OrderNo" type="hidden" value="Y1403201441241567"></li>
    <li style="width: 19%;">
        <a href="/order/Order?orderNo=Y1403201441241567&amp;token=65607fdc2d73fc28" style="font-size:12px;">Y1403201441241567</a>
    </li>
    <li style="width: 12%">缅甸</li>
    <li style="width: 14%" title="郭志峰，孙荣喜 （先缅甸后柬埔寨）">郭志峰，孙荣喜...&nbsp;</li>
    <li style="width: 8%">&nbsp;沐文生</li>
    <li style="width: 5%">2</li>
    <li style="width: 8%">￥260</li>
    <li style="width: 8%">&nbsp;
        未支付
    </li>
    <li>
        <label>已出结果</label><br>
        <label style="color: Green;">获得签证</label>
    </li>
    <li style="width: 12%;">
        冼敏玲&nbsp;                    </li>
</ul>
<ul class="orderitem">
    <li style="padding-left: 5px; padding-top: 3px; width: 3%">
        <input type="checkbox" style="position: relative; top: -3px;" name="Id" id="Id" value="121721">
        <input id="OrderNo" name="OrderNo" type="hidden" value="Y1403191908522091"></li>
    <li style="width: 19%;">
        <a href="/order/Order?orderNo=Y1403191908522091&amp;token=658a938dd3164850" style="font-size:12px;">Y1403191908522091</a>
    </li>
    <li style="width: 12%">缅甸</li>
    <li style="width: 14%" title="刘小露，范思冲">刘小露，范思冲&nbsp;</li>
    <li style="width: 8%">&nbsp;沐文生</li>
    <li style="width: 5%">2</li>
    <li style="width: 8%">￥260</li>
    <li style="width: 8%">&nbsp;
        未支付
    </li>
    <li>
        <label>已出结果</label><br>
        <label style="color: Green;">获得签证</label>
    </li>
    <li style="width: 12%;">
        冼敏玲&nbsp;                    </li>
</ul>
<ul class="orderitem">
    <li style="padding-left: 5px; padding-top: 3px; width: 3%">
        <input type="checkbox" style="position: relative; top: -3px;" name="Id" id="Id" value="121673">
        <input id="OrderNo" name="OrderNo" type="hidden" value="Y1403191706542508"></li>
    <li style="width: 19%;">
        <a href="/order/Order?orderNo=Y1403191706542508&amp;token=eb342a9fce5d2170" style="font-size:12px;">Y1403191706542508</a>
    </li>
    <li style="width: 12%">菲律宾</li>
    <li style="width: 14%" title="傅霜露">傅霜露&nbsp;</li>
    <li style="width: 8%">&nbsp;沐文生</li>
    <li style="width: 5%">1</li>
    <li style="width: 8%">￥310</li>
    <li style="width: 8%">&nbsp;
        未支付
    </li>
    <li>
        <label>已经送签</label>
    </li>
    <li style="width: 12%;">
        冼敏玲&nbsp;                    </li>
</ul>
<ul class="orderitem">
    <li style="padding-left: 5px; padding-top: 3px; width: 3%">
        <input type="checkbox" style="position: relative; top: -3px;" name="Id" id="Id" value="121672">
        <input id="OrderNo" name="OrderNo" type="hidden" value="Y1403191706091373"></li>
    <li style="width: 19%;">
        <a href="/order/Order?orderNo=Y1403191706091373&amp;token=1766c1ced4c22589" style="font-size:12px;">Y1403191706091373</a>
    </li>
    <li style="width: 12%">缅甸</li>
    <li style="width: 14%" title="魏峰（取消），韦高伟">魏峰（取消），韦高伟&nbsp;</li>
    <li style="width: 8%">&nbsp;沐文生</li>
    <li style="width: 5%">2</li>
    <li style="width: 8%">￥130</li>
    <li style="width: 8%">&nbsp;
        未支付
    </li>
    <li>
        <label>已出结果</label><br>
        <label style="color: Green;">获得签证</label>
    </li>
    <li style="width: 12%;">
        冼敏玲&nbsp;                    </li>
</ul>
<ul class="orderitem">
    <li style="padding-left: 5px; padding-top: 3px; width: 3%">
        <input type="checkbox" style="position: relative; top: -3px;" name="Id" id="Id" value="121671">
        <input id="OrderNo" name="OrderNo" type="hidden" value="Y1403191705126200"></li>
    <li style="width: 19%;">
        <a href="/order/Order?orderNo=Y1403191705126200&amp;token=02b71868778cb557" style="font-size:12px;">Y1403191705126200</a>
    </li>
    <li style="width: 12%">越南</li>
    <li style="width: 14%" title="郑家鑫（出签生效）">郑家鑫（出签生效）&nbsp;</li>
    <li style="width: 8%">&nbsp;沐文生</li>
    <li style="width: 5%">1</li>
    <li style="width: 8%">￥370</li>
    <li style="width: 8%">&nbsp;
        未支付
    </li>
    <li>
        <label>已出结果</label><br>
        <label style="color: Green;">获得签证</label>
    </li>
    <li style="width: 12%;">
        冼敏玲&nbsp;                    </li>
</ul>
<ul class="orderitem">
    <li style="padding-left: 5px; padding-top: 3px; width: 3%">
        <input type="checkbox" style="position: relative; top: -3px;" name="Id" id="Id" value="121441">
        <input id="OrderNo" name="OrderNo" type="hidden" value="Y1403181835288897"></li>
    <li style="width: 19%;">
        <a href="/order/Order?orderNo=Y1403181835288897&amp;token=313369f157ad7d49" style="font-size:12px;">Y1403181835288897</a>
    </li>
    <li style="width: 12%">亚美尼亚</li>
    <li style="width: 14%" title="杨波">杨波&nbsp;</li>
    <li style="width: 8%">&nbsp;沐文生</li>
    <li style="width: 5%">1</li>
    <li style="width: 8%">￥300</li>
    <li style="width: 8%">&nbsp;
        未支付
    </li>
    <li>
        <label>已经送签</label>
    </li>
    <li style="width: 12%;">
        冼敏玲&nbsp;                    </li>
</ul>
<ul class="orderitem">
    <li style="padding-left: 5px; padding-top: 3px; width: 3%">
        <input type="checkbox" style="position: relative; top: -3px;" name="Id" id="Id" value="120727">
        <input id="OrderNo" name="OrderNo" type="hidden" value="Y1403141652198206"></li>
    <li style="width: 19%;">
        <a href="/order/Order?orderNo=Y1403141652198206&amp;token=f8ae9cac331e3c4c" style="font-size:12px;">Y1403141652198206</a>
    </li>
    <li style="width: 12%">缅甸</li>
    <li style="width: 14%" title="林杰，王娟">林杰，王娟&nbsp;</li>
    <li style="width: 8%">&nbsp;沐文生</li>
    <li style="width: 5%">2</li>
    <li style="width: 8%">￥260</li>
    <li style="width: 8%">&nbsp;
        未支付
    </li>
    <li>
        <label>已出结果</label><br>
        <label style="color: Green;">获得签证</label>
    </li>
    <li style="width: 12%;">
        冼敏玲&nbsp;                    </li>
</ul>
<ul class="orderitem">
    <li style="padding-left: 5px; padding-top: 3px; width: 3%">
        <input type="checkbox" style="position: relative; top: -3px;" name="Id" id="Id" value="119698">
        <input id="OrderNo" name="OrderNo" type="hidden" value="Y1403111135555615"></li>
    <li style="width: 19%;">
        <a href="/order/Order?orderNo=Y1403111135555615&amp;token=e64a925ea164a68a" style="font-size:12px;">Y1403111135555615</a>
    </li>
    <li style="width: 12%">缅甸</li>
    <li style="width: 14%" title="马健">马健&nbsp;</li>
    <li style="width: 8%">&nbsp;沐文生</li>
    <li style="width: 5%">1</li>
    <li style="width: 8%">￥130</li>
    <li style="width: 8%">&nbsp;
        未支付
    </li>
    <li>
        <label>订单确认</label>
    </li>
    <li style="width: 12%;">
        冼敏玲&nbsp;                    </li>
</ul>
<ul class="orderitem">
    <li style="padding-left: 5px; padding-top: 3px; width: 3%">
        <input type="checkbox" style="position: relative; top: -3px;" name="Id" id="Id" value="119390">
        <input id="OrderNo" name="OrderNo" type="hidden" value="Y1403101218471587"></li>
    <li style="width: 19%;">
        <a href="/order/Order?orderNo=Y1403101218471587&amp;token=427539d3ea4d1d0c" style="font-size:12px;">Y1403101218471587</a>
    </li>
    <li style="width: 12%">缅甸</li>
    <li style="width: 14%" title="李威，任广峰，王智强，赵冬临">李威，任广峰，...&nbsp;</li>
    <li style="width: 8%">&nbsp;沐文生</li>
    <li style="width: 5%">4</li>
    <li style="width: 8%">￥520</li>
    <li style="width: 8%">&nbsp;
        未支付
    </li>
    <li>
        <label>已出结果</label><br>
        <label style="color: Green;">获得签证</label>
    </li>
    <li style="width: 12%;">
        冼敏玲&nbsp;                    </li>
</ul>
<ul class="orderitem">
    <li style="padding-left: 5px; padding-top: 3px; width: 3%">
        <input type="checkbox" style="position: relative; top: -3px;" name="Id" id="Id" value="119389">
        <input id="OrderNo" name="OrderNo" type="hidden" value="Y1403101217203178"></li>
    <li style="width: 19%;">
        <a href="/order/Order?orderNo=Y1403101217203178&amp;token=74e9ef403f2db3ff" style="font-size:12px;">Y1403101217203178</a>
    </li>
    <li style="width: 12%">越南</li>
    <li style="width: 14%" title="严静 （4月10日生效）">严静 （4月1...&nbsp;</li>
    <li style="width: 8%">&nbsp;沐文生</li>
    <li style="width: 5%">1</li>
    <li style="width: 8%">￥370</li>
    <li style="width: 8%">&nbsp;
        未支付
    </li>
    <li>
        <label>已寄回</label>
    </li>
    <li style="width: 12%;">
        冼敏玲&nbsp;                    </li>
</ul>
<ul class="orderitem">
    <li style="padding-left: 5px; padding-top: 3px; width: 3%">
        <input type="checkbox" style="position: relative; top: -3px;" name="Id" id="Id" value="119387">
        <input id="OrderNo" name="OrderNo" type="hidden" value="Y1403101216292354"></li>
    <li style="width: 19%;">
        <a href="/order/Order?orderNo=Y1403101216292354&amp;token=daee654e576017b5" style="font-size:12px;">Y1403101216292354</a>
    </li>
    <li style="width: 12%">巴基斯坦</li>
    <li style="width: 14%" title="全强">全强&nbsp;</li>
    <li style="width: 8%">&nbsp;沐文生</li>
    <li style="width: 5%">1</li>
    <li style="width: 8%">￥1250</li>
    <li style="width: 8%">&nbsp;
        未支付
    </li>
    <li>
        <label>订单确认</label>
    </li>
    <li style="width: 12%;">
        冼敏玲&nbsp;                    </li>
</ul>
<ul class="orderitem">
    <li style="padding-left: 5px; padding-top: 3px; width: 3%">
        <input type="checkbox" style="position: relative; top: -3px;" name="Id" id="Id" value="118861">
        <input id="OrderNo" name="OrderNo" type="hidden" value="Y1403061843232028"></li>
    <li style="width: 19%;">
        <a href="/order/Order?orderNo=Y1403061843232028&amp;token=5da1d2063edaf08b" style="font-size:12px;">Y1403061843232028</a>
    </li>
    <li style="width: 12%">缅甸</li>
    <li style="width: 14%" title="郑伟">郑伟&nbsp;</li>
    <li style="width: 8%">&nbsp;沐文生</li>
    <li style="width: 5%">1</li>
    <li style="width: 8%">￥130</li>
    <li style="width: 8%">&nbsp;
        未支付
    </li>
    <li>
        <label>已寄回</label>
    </li>
    <li style="width: 12%;">
        冼敏玲&nbsp;                    </li>
</ul>
<ul class="orderitem">
    <li style="padding-left: 5px; padding-top: 3px; width: 3%">
        <input type="checkbox" style="position: relative; top: -3px;" name="Id" id="Id" value="118643">
        <input id="OrderNo" name="OrderNo" type="hidden" value="Y1403061054581013"></li>
    <li style="width: 19%;">
        <a href="/order/Order?orderNo=Y1403061054581013&amp;token=812e3cad2e61e705" style="font-size:12px;">Y1403061054581013</a>
    </li>
    <li style="width: 12%">柬埔寨</li>
    <li style="width: 14%" title="李艳（缅甸+柬埔寨电子+越南）">李艳（缅甸+柬...&nbsp;</li>
    <li style="width: 8%">&nbsp;沐文生</li>
    <li style="width: 5%">1</li>
    <li style="width: 8%">￥220</li>
    <li style="width: 8%">&nbsp;
        未支付
    </li>
    <li>
        <label>已寄回</label>
    </li>
    <li style="width: 12%;">
        冼敏玲&nbsp;                    </li>
</ul>
<ul class="orderitem">
    <li style="padding-left: 5px; padding-top: 3px; width: 3%">
        <input type="checkbox" style="position: relative; top: -3px;" name="Id" id="Id" value="118585">
        <input id="OrderNo" name="OrderNo" type="hidden" value="Y1403052210408204"></li>
    <li style="width: 19%;">
        <a href="/order/Order?orderNo=Y1403052210408204&amp;token=7c2dd7baf0b472fd" style="font-size:12px;">Y1403052210408204</a>
    </li>
    <li style="width: 12%">缅甸</li>
    <li style="width: 14%" title="李艳（先缅甸+柬埔寨+越南）">李艳（先缅甸+...&nbsp;</li>
    <li style="width: 8%">&nbsp;沐文生</li>
    <li style="width: 5%">1</li>
    <li style="width: 8%">￥130</li>
    <li style="width: 8%">&nbsp;
        未支付
    </li>
    <li>
        <label>已寄回</label>
    </li>
    <li style="width: 12%;">
        冼敏玲&nbsp;                    </li>
</ul>
<ul class="orderitem">
    <li style="padding-left: 5px; padding-top: 3px; width: 3%">
        <input type="checkbox" style="position: relative; top: -3px;" name="Id" id="Id" value="118584">
        <input id="OrderNo" name="OrderNo" type="hidden" value="Y1403052209541366"></li>
    <li style="width: 19%;">
        <a href="/order/Order?orderNo=Y1403052209541366&amp;token=532042cc9760ea1f" style="font-size:12px;">Y1403052209541366</a>
    </li>
    <li style="width: 12%">越南</li>
    <li style="width: 14%" title="李艳 （出签生效）（先缅甸+柬埔寨+越南）">李艳 （出签生...&nbsp;</li>
    <li style="width: 8%">&nbsp;沐文生</li>
    <li style="width: 5%">1</li>
    <li style="width: 8%">￥370</li>
    <li style="width: 8%">&nbsp;
        未支付
    </li>
    <li>
        <label>已寄回</label>
    </li>
    <li style="width: 12%;">
        冼敏玲&nbsp;                    </li>
</ul>
<ul class="orderitem">
    <li style="padding-left: 5px; padding-top: 3px; width: 3%">
        <input type="checkbox" style="position: relative; top: -3px;" name="Id" id="Id" value="118583">
        <input id="OrderNo" name="OrderNo" type="hidden" value="Y1403052208451011"></li>
    <li style="width: 19%;">
        <a href="/order/Order?orderNo=Y1403052208451011&amp;token=206bfb1c298eceec" style="font-size:12px;">Y1403052208451011</a>
    </li>
    <li style="width: 12%">缅甸</li>
    <li style="width: 14%" title="韩涛，刁昕，夏青，田永强">韩涛，刁昕，夏...&nbsp;</li>
    <li style="width: 8%">&nbsp;沐文生</li>
    <li style="width: 5%">4</li>
    <li style="width: 8%">￥520</li>
    <li style="width: 8%">&nbsp;
        未支付
    </li>
    <li>
        <label>已寄回</label>
    </li>
    <li style="width: 12%;">
        冼敏玲&nbsp;                    </li>
</ul>
<ul class="orderitem">
    <li style="padding-left: 5px; padding-top: 3px; width: 3%">
        &nbsp;&nbsp;&nbsp;                    </li>
    <li style="width: 19%;">
        <a href="/order/Order?orderNo=Y1403051257291597&amp;token=a958d4815d86c391" style="font-size:12px;">Y1403051257291597</a>
    </li>
    <li style="width: 12%">缅甸</li>
    <li style="width: 14%" title="毛青，刘琦">毛青，刘琦&nbsp;</li>
    <li style="width: 8%">&nbsp;沐文生</li>
    <li style="width: 5%">2</li>
    <li style="width: 8%">￥260</li>
    <li style="width: 8%">&nbsp;
        已支付
    </li>
    <li>
        <label>已寄回</label>
    </li>
    <li style="width: 12%;">
        冼敏玲&nbsp;                    </li>
</ul>
</div>
<div class="page">
    <label style="margin-right:-3px;">上一页</label>
    <label class="selectedpage" style="margin-left:0px;">1</label>
    <a href="/order?PageIndex=2">2</a><a href="/order?PageIndex=3">3</a><a href="/order?PageIndex=4">4</a><a
        href="/order?PageIndex=5">5</a><a href="/order?PageIndex=6">6</a><a href="/order?PageIndex=7">7</a><a
        href="/order?PageIndex=8">8</a><a href="/order?PageIndex=9">9</a><a href="/order?PageIndex=2"
                                                                            style="position:relative;top:-2px;">下一页</a>
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