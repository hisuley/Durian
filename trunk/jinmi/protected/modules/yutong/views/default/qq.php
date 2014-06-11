<?php
/**
 * @project: trunk
 * @file: qq.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-4-28
 * @time: 上午9:24
 * @version: 1.0
 */

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<style type="text/css">
    * { padding:0; margin:0; font-family:Microsoft YaHei,Simsun;}
    .main { height:102px; padding-top:175px; background-repeat:no-repeat;}
    .bg { background-image:url(data:image/png;base64,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);}
    .bg { *background-image:url(http://combo.b.qq.com/crm/wpa/release/3.3/wpa/views/b03.png)}
    .btn { position:absolute; display:block;}
    .btnText { top:250px; left:18px; display:block; width:84px; height:22px; font-size:12px; font-weight:normal; color:#000; text-align:center; text-decoration:none; line-height:22px;}
    .offlineBtnText { display:none;}
    .offline .onlineBtnText { display:none;}
    .offline .offlineBtnText { display:inline;}
    .closeBtn { top:0; right:6px; width:39px; height:26px;}
    .content .subTitle { height:18px; font-size:14px; font-weight:bold; color:#095996; line-height:18px; text-align:center; overflow-y:hidden;}
    .content .plainText { height:28px; margin-top:14px; padding:0 5px; font-size:12px; color:#2f6b99; line-height:14px; text-align:center; word-wrap:break-word; overflow-y:hidden;}
</style>
<div class="main bg" id="qq_chat_bdy">
    <a id="launchBtn" target="_blank" class="btnText onlineBtnText btn" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $serviceInfo['QQ']; ?>&site=qq&menu=yes">QQ交谈</a>
    <a id="launchBtnOffline" class="btnText offlineBtnText btn" href="javascript:;">QQ离线</a><a id="laterBtn" class="laterBtn btn" href="javascript:;"></a><a id="closeBtn" class="closeBtn btn" href="javascript:document.getElementById('qq_chat_bdy').style.display = 'none';"></a>
    <div class="content">
        <?php
            if($serviceInfo['is_guest']){ ?>
                <h2 id="subTitle" class="subTitle">请点此咨询</h2>
                <p id="plainText" class="plainText">时间：9:10-18:00</p></div>
            <?php }else{
                echo '<h2 id="subTitle" class="subTitle">我的客服</h2>';
                echo '<p id="plainText" class="plainText">姓名：'.$serviceInfo['realname'].'<br />电话：'.$serviceInfo['phone'].'</p></div>';
            }
        ?>
</div>
</body>
</html>