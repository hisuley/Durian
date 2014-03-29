<div id="main">

    <div class="table" style="height:600px;">

        <!--
            操作结果时，给出信息提示
        -->
        <div class="mleft">
            <form action="/Auth/LogOn" id="loginFrm" method="post">
                <ul class="mfrm" style=" height:600px;">
                    <li class="mnvd">会员专享服务，请先登录：</li>
                    <li>
                        <label>
                            登录名：</label><input class="input_public" id="Account" maxlength="50" name="Account"
                                               style="COLOR:#656565;" type="text" value="">
                    </li>
                    <li>
                        <label>
                            密&nbsp;&nbsp;码：</label><input class="input_public" id="Password" maxlength="18"
                                                          name="Password" style="width:146px;" type="password">
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
            <form action="/Member/Register" id="registerFrm" method="post">
                <ul class="mfrm mrgs" id="ulRegister" style=" height:600px;">
                    <li class="mnvd">新会员注册：</li>

                    <li>
                        <label class="mrl">
                            登录名（手机号）：</label>
                        <input class="input_error" id="LoginName" maxlength="11" name="LoginName" type="text" value="">

                    </li>
                    <li>
                        <label class="mrl">
                            确认（手机号）：</label>
                        <input class="input_public" id="LoginNameAgain" maxlength="11" name="LoginNameAgain" type="text"
                               value="">
                    </li>
                    <li>
                        <label class="mrl">
                            登录密码：</label>
                        <input class="input_public" id="RPassword" maxlength="8" name="RPassword" type="password">
                    </li>
                    <li>
                        <label class="mrl">
                            确认密码：</label>
                        <input class="input_public" id="RetypePassword" maxlength="8" name="RetypePassword"
                               type="password">
                    </li>
                    <li>
                        <label class="mrl">
                            公司名称：</label>
                        <input class="input_public" id="CompanyName" maxlength="50" name="CompanyName" type="text"
                               value=""></li>
                    <li>
                        <label class="mrl">
                            公司固话：</label>
                        <input class="input_public" id="Phone" maxlength="20" name="Phone" type="text" value="">
                    </li>
                    <li>
                        <label class="mrl">
                            联系人姓名：</label>
                        <input class="input_public" id="ContactName" maxlength="50" name="ContactName" type="text"
                               value="">
                    </li>
                    <li>
                        <label class="mrl">
                            QQ号码：</label>
                        <input class="input_public" id="QQ" maxlength="50" name="QQ" type="text" value="">
                    </li>
                    <li>
                        <label class="mrl">
                            联系人性别：</label>
                        <input checked="checked" id="Sex" name="Sex" type="radio" value="男">
                        男&nbsp;
                        <input id="Sex" name="Sex" type="radio" value="女">女
                    </li>
                    <li>
                        <label class="mrl">
                            省份-城市：</label>
                        <script type="text/javascript">
                            // 注意：使用省份层的文本框需要放入<span></span>标签
                            // 如：<span><input type='text'></span>
                            var pcVal;
                            $(function () {
                                $(window).load(function () {
                                    $.ajax({
                                        url: "/Member/ListProvince",
                                        type: "get",
                                        dataType: "html",
                                        success: function (data, textStatus) {
                                            $(data).appendTo($("body"));
                                        }, error: function () {

                                        }
                                    });
                                });

                                $("#Province_CityName").focus(function () {
                                    pcVal = $(this).val();
                                    showCountryLayer_t = true;

                                    var tThis = $(this);

                                    var tTop = tThis.parent("span").offset().top + tThis.height() + 5;
                                    var tLeft = tThis.parent("span").offset().left - 46;
                                    $(".multisel_t").css({ "top": tTop + 10, "left": tLeft }).show();
                                    //ieSixHandleSelect($(".multisel_t"));


                                    return false;
                                }).blur(function () {
                                    if ($("#Province_CityName").val() == null || $("#Province_CityName").val() == "") {
                                        $("#ProvinceId").val("");
                                        $("#CityId").val("");
                                    }
                                    if ('' != "" && !$(this).val() != pcVal) {
                                        $("#ProvinceId").val("");
                                        $("#CityId").val("");
                                    }
                                });
                                if ('' != "") {
                                    $("#Province_CityName").attr("readonly", true);
                                }
                            });
                            function BandCityForTextBox() {
                                remodeIfm();
                                $("#multisel_t").hide();     //隐藏省份
                                $("#deleteLayer_t").remove();      //隐藏城市
                                RemoveBorder();
                                var provinceText = $("#Province_CityName").val();
                                $("#Province_CityName").val(provinceText + "—" + arguments[0]);
                                $("#CityId").val(arguments[1]);

                            }
                            function BandProvinceForTextBox() {
                                remodeIfm();
                                $("#Province_CityName").val(arguments[0]);
                                $("#ProvinceId").val(arguments[1]);
                                $("#CityId").val("");

                            }
                        </script>
<span class="value"><input class="input_public" id="Province_CityName" maxlength="50" name="Province_CityName"
                           readonly="readonly" type="text" value="">
    <input id="ProvinceId" name="ProvinceId" type="hidden" value="">
    <input data-val="true" data-val-number="The field Int32 must be a number."
           data-val-required="The Int32 field is required." id="CityId" name="CityId" type="hidden" value="0">
</span></li>
                    <li>
                        <label class="mrl">
                            详细地址：</label>
                        <textarea class="input_public" cols="39" id="Address" name="Address" rows="2"
                                  style="height:52px;"></textarea>
                    </li>
                    <li>
                        <label class="mrl">
                            &nbsp;</label>
                        <input class="bigbtn" type="submit" value="同意服务条款并注册">&nbsp;&nbsp;
                        <a href="/Member/TermsOfService" target="_blank">点此阅读条款</a>
                        <br>
                        <br>
                    </li>


                </ul>
            </form>
        </div>
    </div>

</div>