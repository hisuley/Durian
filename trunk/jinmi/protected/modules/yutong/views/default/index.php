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
                <div class="nhlogin" style="height:300px;">

                        <ul>
                            <div style="z-index: 10; position: absolute; margin: -12px 0px 0px 163px;">
                                <img src="http://b.tigerwing.cn/Content/Images/Home/offer_icon.png" width="82" height="82">
                            </div>
                            <li style="margin: 0 0 20px 0; width: 250px; margin-left: -15px; background-color: #edf4fe;">
                                <img src="http://b.tigerwing.cn/Content/Images/Home/top_offer.jpg" width="134" height="35">
                            </li>

                            <li style="float: left; width: 30%; background: #efefef; border-bottom: 2px solid #cccccc;
                                font-weight: bold; color: Black; text-align: center; font-size: 12px; padding: 2px 0 2px 0;">
                                国家</li>
                            <li style="float: left; width: 45%; background: #efefef; border-bottom: 2px solid #cccccc;
                                margin: 0 2px 0 2px; font-weight: bold; color: Black; text-align: center; font-size: 12px;
                                padding: 2px 0 2px 0;">签证种类</li>
                            <li style="float: left; width: 20%; background: #efefef; border-bottom: 2px solid #cccccc;
                                font-weight: bold; color: Black; text-align: center; font-size: 12px; padding: 2px 0 2px 0;">
                                特价</li>
                            <?php
                            if(!empty($indexVisaModels)){
                                foreach($indexVisaModels as $visa){
                                    ?>

                                    <a href="<?php echo $this->createUrl('visa/view', array('id'=>$visa->id)); ?>">
                                        <li style="float: left; line-height: 15px; width: 30%; font-size: 12px; padding: 2px 0 2px 5px;">
                                            <?php echo $visa->country->name; ?></li>
                                        <li style="float: left; line-height: 15px; width: 45%; margin: 0 2px 0 2px; font-size: 12px;
                                    padding: 2px 0 2px 0;"><?php echo $visa->type->name; ?></li>
                                        <li style="float: left; text-align: center; line-height: 15px; width: 20%; color: Red;
                                    font-size: 12px; padding: 2px 0 2px 0;">￥<?php echo intval($visa->price); ?></li>
                                    </a>

                                <?php }
                            }
                            ?>

                            <li>
                                <ul style="overflow: hidden;">
                                    <!--奥运中国奖牌榜-->

                                </ul>
                            </li>
                            <?php if(!Yii::app()->user->isGuest){ ?>
                                <table style="margin: 0 0 0 10px;">
                                    <tbody><tr style="line-height: 25px;">

                                        <td style="color: #1f5b9a; width: 100px;">
                                            <a href="<?php echo $this->createUrl('order/list'); ?>" style="color: #ff6600; border-bottom-style:double; border-bottom-width:1px; text-decoration: none;">
                                                <span style="color: #1f5b9a;">待送签：</span><?php $stat = YutongUser::getMyStat();echo $stat['not_sent']; ?></a>
                                        </td>
                                        <td style="color: #1f5b9a; width: 100px;">
                                            <a href="<?php echo $this->createUrl('order/list'); ?>" style="color: #ff6600; border-bottom-style:double; border-bottom-width:1px; text-decoration: none;">
                                                <span style="color: #1f5b9a;">待付款：</span><?php echo $stat['not_paid']; ?></a>
                                        </td>
                                    </tr>
                                    </tbody></table>
                            <?php } ?>
                        </ul>

                </div>
            </div>

            <div class="nhlayer" style="float:left;width:480px;">
                <div class="nhlogin" style="width:450px;background: url('http://www.yutongvisa.com/static/yutong/img/promote.jpg') no-repeat;">
                    <h3>为什么选择宇通签证网</h3>
                    <ul>
                        <li>
                            <h4>更专业</h4>
                            <p>提供全球超过100个国家、近1000个签证产品</p>
                        </li>
                        <li>
                            <h4>更低价</h4>
                            <p>全网最低，低价量大，让利同行，良性循环。</p>
                        </li>
                        <li>
                            <h4>更安全</h4>
                            <p>订单全程状态跟踪，随查随看，安全便捷。</p>
                        </li>
                    </ul>

                </div>
            </div>

        </div>
    </div>

</div>