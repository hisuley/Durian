<div id="main">

    <div class="table" style="height:600px;">

        <!--
            操作结果时，给出信息提示
        -->
        <div class="mleft">
            <form action="<?php echo $this->createUrl('user/login'); ?>" id="loginFrm" method="post">
                <ul class="mfrm" style=" height:600px;">
                    <li class="mnvd">会员专享服务，请先登录：</li>
                    <li>
                        <label>
                            登录名：</label><input class="input_public" id="Account" maxlength="50" name="LoginForm[username]"
                                               style="COLOR:#656565;" type="text" value="">
                    </li>
                    <li>
                        <label>
                            密&nbsp;&nbsp;码：</label><input class="input_public" id="Password" maxlength="18"
                                                          name="LoginForm[password]" style="width:146px;" type="password">
                    </li>

                    <li><span id="spCode" style="margin-left:50px; color:Red;">&nbsp;</span></li>
                    <li>
                        <label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><input checked="checked"
                                                                                           class="textbox"
                                                                                           data-val="true"
                                                                                           data-val-required="The AutoLogOn field is required."
                                                                                           id="AutoLogOn"
                                                                                           name="AutoLogOn"
                                                                                           style=" position:relative;top:2px"
                                                                                           type="checkbox" value="true"><input
                            name="AutoLogOn" type="hidden" value="false">&nbsp;自动登录
                    </li>
                    <li class="libtn">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input class="btn" type="submit" value=" 登 录 ">&nbsp;&nbsp;<a href="/Member/FindPwd"
                                                                                      style="text-decoration:underline">忘记密码</a>
                    </li>
                    <li class="ldes">如果您还不是会员，请您使用一分钟时间填写右侧的内容，便可享受多项会员服务。
                        <br>
                        <img src="/static/yutong/img/register.jpg">
                    </li>
                </ul>
            </form>
        </div>
        <div class="mright">
            <form action="<?php echo $this->createUrl('user/register'); ?>" id="registerFrm" method="post">
                <ul class="mfrm mrgs" id="ulRegister" style=" height:600px;">
                    <li class="mnvd">新会员注册：</li>
                    <li><p>标记<strong class="required">*</strong>的为必填项。</p></li>
                    <li>
                        <label class="mrl">
                            登录名（手机号）：</label>
                        <input class="input_error" autocomplete="off" id="LoginName" maxlength="11" name="YutongUser[username]" type="text" value="">
                        <span class="required">*</span>

                    </li>
                    <li>
                        <label class="mrl">
                            登录密码：</label>
                        <input class="input_public" autocomplete="off" id="RPassword" maxlength="80" name="YutongUser[password]" type="password">
                        <span class="required">*</span>
                    </li>
                    <li>
                        <label class="mrl">
                            确认密码：</label>
                        <input class="input_public" id="RetypePassword" maxlength="80" name="YutongUser[password2]"
                               type="password">
                        <span class="required">*</span>
                    </li>
                    <li>
                        <label class="mrl">
                            公司名称：</label>
                        <input class="input_public" id="CompanyName" maxlength="50" name="YutongUserAddress[company_name]" type="text"
                               value=""></li>
                    <li>
                        <label class="mrl">
                            联系人姓名：</label>
                        <input class="input_public" id="ContactName" maxlength="50" name="YutongUserAddress[contact_name]" type="text"
                               value="">
                    </li>
                    <li>
                        <label class="mrl">
                            联系方式：</label>
                        <input class="input_public" id="Phone" maxlength="20" name="YutongUserAddress[contact_phone]" type="text" value="">
                    </li>
                    <li>
                        <label class="mrl">
                            QQ号码：</label>
                        <input class="input_public" id="QQ" maxlength="50" name="YutongUserAddress[contact_qq]" type="text" value="">
                    </li>
                    <li>
                        <label class="mrl">
                            省份-城市：</label>

<span class="value"><input class="input_public" id="Province_CityName" maxlength="50" name="YutongUserAddress[contact_province]"
                           type="text" value="">
</span></li>
                    <li>
                        <label class="mrl">
                            详细地址：</label>
                        <textarea class="input_public" cols="39" id="Address" name="YutongUserAddress[contact_address]" rows="2"
                                  style="height:52px;"></textarea>
                    </li>
                    <li>
                        <label class="mrl">
                            &nbsp;</label>
                        <input class="bigbtn" type="submit" value="同意服务条款并注册">&nbsp;&nbsp;
                        <br>
                        <br>
                    </li>


                </ul>
            </form>
        </div>
    </div>

</div>