<div id="main">
<div id="vleft">

    <!--常用下载-->
    <ul class="titlelist">
        <li class="title"><span style="width: 52%"><b>·&nbsp;</b>相关下载</span>
            <span class="more"></span>
        </li>
        <?php
            if(!empty($model->attachment)){
                foreach($model->attachment as $attachment){
                    echo '<li class="item" title="单击下载"><a href="'.$this->createUrl('visa/download', array('link'=>urlencode($attachment->attachment_url), 'name'=>urlencode($attachment->attachment_title))).'" title="单击下载" target="_blank"><b>·&nbsp;</b>'.$attachment->attachment_title.'</a></li>';
                }
            }
        ?>

    </ul>
    <br />

    <!--相关资讯-->
    <ul class="titlelist">
        <li class="title"><span style="width: 52%"><b>·&nbsp;</b>签证资讯</span>
            <span class="more"></span>
        </li>
        <?php
        if(!empty($model->country->related_article)){
            foreach($model->country->related_article as $article){
                echo '<li class="item" title="'.CHtml::encode($article->title).'"><a href="'.$this->createUrl('article/view', array('id'=>$article->id)).'" title="'.CHtml::encode($article->title).'" target="_blank"><b>·&nbsp;</b>'.CHtml::encode($article->title).'</a></li>';
            }
        }
        ?>

    </ul>
    <br>

</div>
<div id="vright">
<div><img src="/static/yutong/img/Nv/002.jpg"></div>
<script type="text/javascript">
    $(function(){
        //搜索国家
        $("#KeyWord").keyup(function () {
            var tThis = $(this);
            $("#likeSearch").remove();
            var valuess = tThis.val();

        }).focus(function(){
            countryFocus = true;
            var tThis = $(this);
            if(tThis.val()=="支持关键字和拼音模糊查询"){
                tThis.val("");
            }

            var tTop = tThis.parent("span").offset().top+tThis.height()+1;
            var tLeft = tThis.parent("span").offset().left;
            $(".popupcountry").css({ "top": tTop, "left": tLeft }).show();

            return false;
        });

    });
</script>
<form action="<?php echo $this->createUrl('visa/search'); ?>" id="searchFrm" method="get">    <ul class="findc">
        <li style="width: 15%;">
            <label>
                请输入国家名：</label></li>
        <li style="width: 400px;"><span>
            <input type="text" id="KeyWord" name="keyword" value="" class="textbox  validate[required]" style="width: 355px; color: #999999;padding:5px; font-size:larger" maxlength="50">
        </span></li>
        <li style="width: 15%;">
            <input type="submit" class="btn" value="查询">
        </li>
    </ul>
</form>        <div class="visa">
<table border="0" cellpadding="6" cellspacing="1">
<tbody><tr>
    <td align="right" bgcolor="#D9E4F7">
        <label>
            所属洲：</label>
    </td>
    <td bgcolor="#E3ECFB"><?php echo $model->country->parent->name; ?>
    </td>
    <td align="right" bgcolor="#D9E4F7">
        <label>
            国家：</label>
    </td>
    <td bgcolor="#E3ECFB"><?php echo $model->country->name; ?>
    </td>
    <td align="right" bgcolor="#D9E4F7">
        <label>
            签证类型：</label>
    </td>
    <td bgcolor="#E3ECFB"><?php echo empty($model->type->name) ? '未知' : $model->type->name; ?>
    </td>
</tr>
<tr>
    <td align="right" bgcolor="#D9E4F7" style="font-family: Arial, '宋体';">
        <label>
            有效期：</label>
    </td>
    <td bgcolor="#E3ECFB"  style="font-family: Arial, '宋体';"><?php echo $model->valid_period; ?>
    </td>
    <td align="right" bgcolor="#D9E4F7"  style="font-family: Arial, '宋体';">
        <label>
            停留期：</label>
    </td>
    <td bgcolor="#E3ECFB" style="font-family: Arial, '宋体';"><?php echo $model->stay_period; ?>
    </td>
    <td align="right" bgcolor="#D9E4F7"  style="font-family: Arial, '宋体';">
        <label>
            入境次数：</label>
    </td>
    <td bgcolor="#E3ECFB" style="font-family: Arial, '宋体';"><?php echo $model->entry_times; ?>
    </td>
</tr>
<tr>
    <td align="right" bgcolor="#D9E4F7"  style="font-family: Arial, '宋体';">
        <label>
            工作日：</label>
    </td>
    <td bgcolor="#E3ECFB" style="font-family: Arial, '宋体';"><?php echo $model->workdays; ?>
    </td>
    <td align="right" bgcolor="#D9E4F7">
        <label>
            市场价：</label>
    </td>
    <td bgcolor="#E3ECFB">
        ￥<?php echo $model->market_price; ?>
    </td>
    <td align="right" bgcolor="#D9E4F7">
        <label>
            会员价：</label>
    </td>
    <td bgcolor="#E3ECFB">
                        <span>
                            ￥<?php echo $model->price; ?></span>
    </td>
</tr>
<tr>
    <td align="right" bgcolor="#D9E4F7">
        <label>
            是否面试：</label>
    </td>
    <td bgcolor="#E3ECFB" colspan="5"><?php echo $model->need_interview; ?>


    </td>
</tr>

<tr>
    <td align="right" bgcolor="#D9E4F7">
        <label>
            领区划分：</label>
    </td>
    <td bgcolor="#E3ECFB" colspan="5"><?php echo $model->consular_district; ?>
    </td>
</tr>
<tr>
    <td colspan="6" bgcolor="#D9E4F7">
        <label style="margin-left: 45px">
            <strong>所需资料</strong></label>
    </td>
</tr>
<tr>
    <td height="400" colspan="6" valign="top" bgcolor="#E3ECFB">
        <?php echo $model->material; ?>
    </td>
</tr>
<tr>
    <td colspan="6" valign="top" align="right" bgcolor="#E3ECFB">
        更新负责人: <?php echo $model->author->username; ?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        更新时间: <?php echo date('Y-m-d H:i:s', $model->update_time); ?>
    </td>
</tr>
<tr>
    <td colspan="6" align="center" bgcolor="#E3ECFB">
        <a  class="smallbtn" href="<?php echo $this->createUrl('order/new', array('id'=>$model->id)); ?>" id="createOrder">下单</a>
    </td>
</tr>
</tbody></table>
</div>
<div class="visa" style="background-color:#E3ECFB;">
    <div style=" border:1px solid #B9CEF0; border-top:0px; background-color:#D2DEF4;">
        <h2 style=" margin:0px; padding-left:25px; line-height:32px; display:inline-block;">特别提示（必读）</h2></div>
    <table border="0" cellpadding="6" cellspacing="1" style="background-color:#E3ECFB; padding-left:5px; padding-bottom:10px;">
        <tbody><tr>
            <td>
                免责声明
                <br>1.您的签证申请是否成功，完全由该国的签证官根据您递交的申请材料独立判断，本公司不得以任何方式的干预或交涉；本公司重申，在任何情况下，本公司都不承担由签证申请结果而导致被追溯任何赔偿的责任和义务。
                <br>2. "工作日"为使馆签发签证时，正常情况下的处理时间；若遇特殊原因如政治干涉、假期、领馆内部人员调整、领馆工作延迟、签证纸缺货，签证打印机故障等，则可能会产生延迟出签的情况；本网相关的处理时间信息仅供参考，非法定承诺，且上述天数计算未包含可能给申请人邮递签证的路途时间，敬请留意；对申请人根据签证预计日期提示，而进行的后续旅程安排所造成的可能经济损失，本公司不承担任何责任。
                <br>3.有关签证资料上公布的签证有效期和停留天数，仅做参考而非法定承诺，一切均以签证官签发的签证内容，为唯一依据。
                <br>4.使馆保留要求申请人补资料或要求申请人前往使馆面试的权利。
                <br>5.请您拿到签证及护照后，再出机票或与付费给酒店，避免不必要的损失，本司不承担任何由此而产生的损失。
                <br>6.交由本公司操作，即代表您已经同意以上声明。
            </td>
        </tr>
        </tbody></table>
</div>
</div>
<link rel="stylesheet" type="text/css" href="/Content/CSS/validationEngine.jquery.css">
<script src="/Scripts/jquery.validationEngine-zh.js" type="text/javascript"></script>
<script src="/Scripts/jquery.validationEngine.js" type="text/javascript"></script>
<script src="/Content/CircularAngle/JS/CircularAngle.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/Content/CircularAngle/CSS/CircularAngle.css">
<script type="text/javascript">
    $(function () {
        $("#divErrorBox").css({"font-size":"12px","padding":"5px","margin-top":"5px"});
        /*跳转到注册页*/
        $("#register").click(function () {
            location = "/Member/Register";
        });

        $("#Password").focus(function(){
            $("#liCode").show();
            if($.trim($("#vacode").html())!=""){
                return false;
            }else{
                $.ajax({
                    url : "/ValidationCode/AjaxGetCode",
                    dataType:"html",
                    success:function(data, status) {
                        $("#vacode").html(data);

                    },error: function(XMLHttpRequest, textStatus, errorThrown){
                        alert("错误：" + textStatus+errorThrown);
                    }
                });
            }
        });

        /*绑定登录名*/
        $("#Account").val('');

        /*关闭所需资料弹出层*/
        $("#lblCloseNeedAddress").click(function () {
            HidePopup($("#login"));
        });

        if("0"=="2"){
            $("#divErrorBox").css({"margin-left":"10px","width":"400px"});
            $(".fberrorbox").css({"margin-left":"10px","width":"400px"});
            stepLogin();
        }


    });

    /*弹出登录层*/
    function stepLogin(){
        popupLayerId = "login";
        CreateBorder($('#login'), 0.5);
    }
    /*刷新验证码*/
    function refreshCode(){
        $.ajax({
            url : "/ValidationCode/AjaxGetCode",
            dataType:"html",
            success:function(data, status) {
                $("#vacode").html(data);
            },error: function(XMLHttpRequest, textStatus, errorThrown){
                alert("错误：" + textStatus+errorThrown);
            }
        });
    }

</script>
<!--用户地址-->
<div class="popupLayer" style="width: 700px; height: 420px;" id="login">
    <p class="closep">
        <label class="close">
            <a href="#" title="关闭" id="lblCloseNeedAddress">关闭</a>
        </label>
    </p>
    <div style="height: 100%;">
        <div class="table" style="height: 355px; padding-top: 0; overflow: hidden;">
            <div style="float: left; width: 65%; height: 300px; margin-top: 10px; border-right: 1px solid #ccdffd;">
                <div class="hm" style="width: 95%">
                    欢迎您登录宇通签证采购平台
                </div>

                <!--
                    操作结果时，给出信息提示
                -->
                <form action="/Auth/LogOn" id="cloginFrm" method="post"><input id="RequestUrl" name="RequestUrl" type="hidden" value="http://b.tigerwing.cn/Visa/Visa/31?ContinentId=5&amp;Keyword=南非">                    <ul class="login" style="width: 95%">
                        <li>
                            <label>
                                登录名：</label><input class="textbox validate[required]" id="Account" maxlength="50" name="Account" style="width:200px" type="text" value="">
                        </li>
                        <li>
                            <label>
                                登录密码：</label><input class="textbox validate[required,length[6,18]]" id="Password" maxlength="18" name="Password" style="width:200px" type="password">&nbsp;&nbsp;<a href="/Member/FindPwd" style="text-decoration:underline">忘记密码</a>
                        </li>
                        <li id="liCode" style="display:none;">
                            <label>
                                验证码：</label><input class="textbox validate[required]" id="Code" maxlength="4" name="Code" style="width:125px" type="text" value="">&nbsp;
                            <!--验证码-->
                            <span id="vacode" style="position: relative; top: 8px;"></span>&nbsp;看不清楚,<a href="javascript:refreshCode()" style="text-decoration: underline">点击这里
                            </a></li>
                        <li>
                            <label>
                                &nbsp;</label><input checked="checked" class="textbox" id="AutoLogOn" name="AutoLogOn" style=" position:relative;top:2px" type="checkbox" value="true"><input name="AutoLogOn" type="hidden" value="false">&nbsp;自动登录
                        </li>
                        <li style="margin-left:80px;">
                            <input class="btn" type="submit" value=" 登 录 ">
                        </li>
                    </ul>
                </form>            </div>
            <div style="float: left; width: 33%; height: 100%;">
                <ul class="guide" style="width: 95%;">
                    <li>
                        <label>
                            您还不是宇通签证采购平台用户？</label>
                    </li>
                    <li style="text-align: center;height:100%;">
                        <input type="button" value="注 册" id="register" class="btn">
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


</div>