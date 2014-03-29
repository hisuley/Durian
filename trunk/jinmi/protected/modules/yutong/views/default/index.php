<div class="newcontainer">


    <script type="text/javascript">
        <!---->
        var i = 0;
        var count = 1; //广告图片的总数
        $(function () {
            //$("#divHdTitle").css("opacity", 0.5);
            //var interval = setInterval("whileAdv()", 3000);
            // $("#ulImages").find("img").each(function () {
            //  $(this).mouseover(function () {
            //   clearInterval(interval);
            //}).mouseout(function () {
            //  interval = setInterval("whileAdv()", 3000);
            // });
            // });

            ////////////////
            ///编号
            ////////////////
            $("#ulCodes").find("li").each(function (j) {
                $(this).click(function () {
                    i = j;
                    whileAdv();
                });

            });
        });
        function whileAdv() {

            $("#ulImages").find("li").each(function (j) {
                if (i == j) {
                    $(this).show();
                    var title = $(this).find("img").attr("title");
                    $("#wordLayer").html(title);
                }
                else $(this).hide();

            });
            $("#ulCodes").find("li").each(function (j) {
                if (i == j) $(this).addClass("secli");
                else $(this).removeClass("secli");
            });
            i++;
            if (i > count) i = 0;

        }

    </script>
    <script type="text/javascript">
        //    $(function () {
        //                $("#div_opacity").click(function () {
        //                    //保险
        //                    var url = "/Insurance/IndexNew?ii=3&amp;Keyword=%E5%AE%89%E8%81%94%E4%BF%9D%E9%99%A9";
        //                    open(url);
        //                });
        //    });
    </script>
    <link href="/static/yutong/css/home-advs.css"
          rel="Stylesheet"/>
    <div id="div_opacity" style="height: 380px; width: 65%; position: absolute; cursor: pointer;
    filter: alpha(opacity=0); opacity: 0">


    </div>
    <div class="iactrc">
        <div class="iactr" style="">
            <ul id="ulImages">


                </li>

                <li style="background:url(/static/yutong/img/wordmap.jpg) center no-repeat; height:386px">


                </li>
            </ul>

        </div>
        <div class="iaccsd">
            <ul id="ulCodes" class="iaccs">

            </ul>
        </div>
    </div>
    <div class="hctop" style="z-index: 1; position: relative; overflow: hidden;">
        <div style="width: 976px; margin: 0 auto; padding-top: 4px;">

            <div class="nhlayer">
                <div class="nhlogin">
                    <ul>
                        <form action="<?php echo $this->createUrl('site/login'); ?>" id="loginFrm" method="post">
                            <li style="margin: 5px 0 0 5px;">
                                <img src="/static/yutong/img/new2_08.jpg"
                                     width="190" height="31"/>
                            </li>
                            <li>&nbsp;&nbsp;帐号:
                                <input type="text" id="HomeAccount" style="background: #f2f2f2; width: 140px; border: 1px solid #d9d9d9;
                                    font-size: 14px; padding: 2px" class="cici1" maxlength="18"
                                       name="LoginForm[username]"
                                       onfocus="this.select()"/></li>
                            <li>&nbsp;&nbsp;密码:
                                <input type="password" id="HomePassword" style="background: #f2f2f2; width: 140px;
                                    border: 1px solid #d9d9d9; font-size: 14px; padding: 2px" class="cici1"
                                       maxlength="18"
                                       value="" name="LoginForm[password]" onfocus="this.select()"/></li>

                            <li><span id="spCode" style="margin-left: 55px; color: Red;">&nbsp;</span></li>
                            <li>
                                <ul style="overflow: hidden;">
                                    <li class="sdflk" style="width: 40%;">
                                        <input id="btnSub" type="image" src="/static/yutong/img/new2_09.jpg"
                                            />
                                    </li>
                                    <li class="sdflk" style="line-height: 35px; width: 60%; _line-height: 20px;"><a
                                            href="<?php echo $this->createUrl('user/register'); ?>" class="barLink3">
                                            注册帐号</a>&nbsp;<a href="<?php echo $this->createUrl('user/findpass'); ?>"
                                                             class="barLink3">
                                            找回密码</a></li>
                                </ul>
                            </li>
                        </form>
                        <li>
                            <ul style="overflow: hidden;">
                                <!--奥运中国奖牌榜-->

                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>