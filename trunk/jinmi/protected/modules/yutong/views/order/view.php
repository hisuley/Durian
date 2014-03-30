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


</div>
<div id="vright">

    <div class="order">

        <!--
            操作结果时，给出信息提示
        -->
        <table border="0" cellpadding="6" cellspacing="1">
            <tbody><tr>
                <td align="right" bgcolor="#D9E4F7">
                    <label>
                        国家：</label>
                </td>
                <td bgcolor="#E3ECFB">
                    缅甸
                </td>
                <td align="right" bgcolor="#D9E4F7">
                    <label>
                        签证类型：</label>
                </td>
                <td bgcolor="#E3ECFB">
                    旅游签证
                </td>
                <td align="right" bgcolor="#D9E4F7">
                    <label>
                        订单号：</label>
                </td>
                <td bgcolor="#E3ECFB">
                    Y1403281613381840
                </td>
            </tr>
            <tr>
                <td align="right" bgcolor="#D9E4F7">
                    <label>
                        姓名：</label>
                </td>
                <td bgcolor="#E3ECFB">
                    刘菁菁，帅薇
                </td>
                <td align="right" bgcolor="#D9E4F7">
                    <label>
                        人数：</label>
                </td>
                <td bgcolor="#E3ECFB">
                    2
                </td>
                <td align="right" bgcolor="#D9E4F7">
                    <label>
                        签证费单价：</label>
                </td>
                <td bgcolor="#E3ECFB">
                    ￥130
                </td>
            </tr>
            <tr>
                <td align="right" bgcolor="#D9E4F7">
                    <label>
                        预计出发日期：</label>
                </td>
                <td bgcolor="#E3ECFB">
                    2014-04-04
                </td>
                <td align="right" bgcolor="#D9E4F7">
                    <label>
                        保险费合计：</label>
                </td>
                <td bgcolor="#E3ECFB">
                    ￥0                </td>
                <td align="right" bgcolor="#D9E4F7">
                    <label>
                        签证费合计：</label>
                </td>
                <td bgcolor="#E3ECFB">
                    ￥260
                </td>
            </tr>
            <tr>
                <td align="right" bgcolor="#D9E4F7">
                    <label>
                        支付状态：</label>
                </td>
                <td bgcolor="#E3ECFB">
                    未支付                </td>
                <td align="right" bgcolor="#D9E4F7">
                    <label>
                        优惠金额：</label>
                </td>
                <td bgcolor="#E3ECFB">
                    ￥0
                </td>
                <td align="right" bgcolor="#D9E4F7">
                    <label>
                        订单总额：</label>
                </td>
                <td bgcolor="#E3ECFB">
                    ￥260
                </td>
            </tr>

            <tr>
                <td align="right" bgcolor="#D9E4F7">
                    <label>
                        跟进人：
                    </label>
                </td>
                <td bgcolor="#E3ECFB" colspan="5">
                    冼敏玲                </td>
            </tr>
            <tr>
                <td align="right" bgcolor="#D9E4F7">

                    <label>
                        特殊要求：</label>
                </td>
                <td bgcolor="#E3ECFB" colspan="5">

                </td>
            </tr>

            <tr>
                <td align="right" bgcolor="#D9E4F7">
                    <label>
                        护照返回地址：</label>
                </td>
                <td bgcolor="#E3ECFB" colspan="5">
                    <span>公司名：北京美景假期国际旅行社有限公司建国东路门市部 &nbsp;</span>
                    <span> 地址：北京市东城区东直门外东中街40号元嘉国际A座407&nbsp;(沐文生 收)&nbsp;010-56292115</span>
                </td>
            </tr>
            </tbody></table>
        <div class="orderno">
            <form action="/Order/EditExpressMailNO" id="editExpressMailNOFrm" method="post">                <ul class="orderse">
                    <li style="width: 33%; margin-left: 50px;">
                        <label>
                            快递公司：</label>
                        <input class="textbox validate[required]" id="ExpressDelivery" maxlength="50" name="ExpressDelivery" style="width:110px;" type="text" value=""></li>
                    <li>
                        <label>
                            快递单号：</label>
                        <input data-val="true" data-val-number="The field OrderId must be a number." data-val-required="The OrderId field is required." id="OrderId" name="OrderId" type="hidden" value="164118">
                        <input id="OrderNo" name="OrderNo" type="hidden" value="Y1403281613381840">
                        <input class="textbox validate[required]" id="ExpressMailNO" maxlength="50" name="ExpressMailNO" style="width:110px;" type="text" value="">
                        <input type="submit" class="smallbtn" value="确定">
                    </li>
                </ul>
            </form>        </div>
        <div class="orstep">
            <ul class="title">
                <li style="width: 50%">&gt;&gt; 第一步&nbsp;下单成功 </li>
                <li style="width: 15%">
                    <label>
                        操作人：冼敏玲</label></li>
                <li style="width: 35%">
                    <label>
                        操作时间：2014-3-28 16:21:35</label>
                </li>
            </ul>
            <ul class="main">
                <li style="width: 100%">
                    <label>
                        备 注：</label>
                    订单确认！
                </li>
            </ul>
        </div>
        <div class="ods">
            <form action="/Order/PayConfirm" method="get"><input data-val="true" data-val-number="The field OrderId must be a number." data-val-required="The OrderId field is required." id="orderId" name="orderId" type="hidden" value="164118">                <input type="button" class="smallbtn" onclick="javascript:location='/order/PayConfirm?orderNo=Y1403281613381840&amp;token=8551d939689765df';" value="支付">
                &nbsp;&nbsp;&nbsp;                <input type="button" class="smallbtn" value="返回" id="return">
            </form>        </div>
    </div>

</div>

</div>