<div id="main">
<div id="vleft">

    <!--常用下载-->
    <ul class="titlelist">
        <li class="title"><span style="width: 52%"><b>·&nbsp;</b>常用下载</span>
            <span class="more"><a
                    href="#"
                    target="_blank">
                    更多&gt;&gt;
                </a></span>
        </li>
        <?php
        if(!empty($attachmentModels)){
            foreach($attachmentModels as $attachment){
                echo '<li class="item" title="单击下载"><a href="'.$this->createUrl('visa/download', array('link'=>urlencode($attachment->attachment_url), 'name'=>urlencode($attachment->attachment_title))).'" title="单击下载" target="_blank"><b>·&nbsp;</b>'.$attachment->attachment_title.'</a></li>';
            }
        }
        ?>
    </ul>
    <br />
    <!-- 签证资讯 -->
    <ul class="titlelist">
        <li class="title"><span><b>·&nbsp;</b>签证资讯</span> </li>
        <?php
        if(!empty($articleModels)){
            foreach($articleModels as $item){
                echo ' <li class="item"><b>·&nbsp;</b><a href="'.$this->createUrl('article/view', array('id'=>$item->id)).'">'.CHtml::encode($item->title).'</a></li>';
            }
        }
        ?>
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
            if (tThis.val() == "支持关键字和拼音模糊查询") {
                tThis.val(" ");
            }
        }).focus(function () {
            countryFocus = true;
            var tThis = $(this);
            if (tThis.val() == "支持关键字和拼音模糊查询") {
                tThis.val(" ");
            }

            var tTop = tThis.parent("span").offset().top + tThis.height() + 1;
            var tLeft = tThis.parent("span").offset().left;
            $(".popupcountry").css({ "top": tTop, "left": tLeft }).show();

            return false;
        });

    });
</script>
<form action="<?php echo $this->createUrl('visa/search'); ?>" id="searchFrm" method="get">
    <ul class="findc">
        <li style="width: 15%;">
            <label>
                请输入国家名：</label></li>
        <li style="width: 400px;"><span>
            <input type="text" id="KeyWord" name="keyword" value="支持关键字和拼音模糊查询" class="textbox  validate[required]"
                   style="width: 355px; color: #999999;padding:5px; font-size:larger" maxlength="50">
        </span></li>
        <li style="width: 15%;">
            <input type="submit" class="btn" value="查询">
        </li>
    </ul>
</form>
<ul class="visatitle1">
    <li style="padding-left: 5px; width: 11%; "><strong style="color:White; font-size:14px;">国家</strong></li>
    <li style="width: 16%"><strong style="color:White; font-size:14px;">签证种类</strong></li>
    <li style="width: 10%;"><strong style="color:White; font-size:14px;">工作日</strong></li>
    <li style="width: 11%"><strong style="color:White; font-size:14px;">市场价</strong></li>
    <li style="width: 11%"><strong style="color:White; font-size:14px;">同行价</strong></li>
    <li style="width: 8%;"><strong style="color:White; font-size:14px;">有效期</strong></li>
    <li style="width: 8%;"><strong style="color:White; font-size:14px;">停留期</strong></li>
    <li style="width: 9%;"><strong style="color:White; font-size:14px;">入境次数</strong></li>
    <li style="width: 7%;"><strong style="color:White; font-size:14px;">资料</strong></li>
    <li style="width: 7%;"><strong style="color:White; font-size:14px;">下单</strong></li>
</ul>

<?php
$search = $model->search(array('order'=>'t.show_order ASC'), array(), 'CActiveDataProvider');
$data = $search->getData();

foreach($data as $item){ ?>
    <ul class="visaitem1">
        <li style="padding-left: 5px; width: 11%"><?php echo $item->country->name; ?></li>
        <li style="width: 18%">
            <?php echo empty($item->type->name) ? '未知': $item->type->name; ?>
        </li>
        <li style="font-family:Arial, '宋体'; width:7%"><?php echo $item->workdays; ?></li>
        <li style="width:11%">￥<?php echo $item->market_price; ?></li>
        <li style="width:12%">￥<?php echo $item->price; ?></li>
        <li style="font-family:Arial, '宋体';width: 8%;" ><?php echo $item->valid_period; ?>&nbsp;</li>
        <li style="font-family:Arial, '宋体';width: 6%;"><?php echo $item->stay_period; ?>&nbsp;</li>
        <li style="font-family:Arial, '宋体';width: 11%; text-align:center;"><?php echo $item->entry_times; ?>&nbsp;</li>
        <li style="width: 6%;margin-right:3px;">
            <a href="<?php echo $this->createUrl('visa/view', array('id'=>$item->id)); ?>" style="text-decoration:underline"
               target="_blank">详细</a>
        </li>
        <li style="width: 7%;height:30px;">
            <a href="<?php echo $this->createUrl('order/new', array('id'=>$item->id)); ?>"><img src="/static/yutong/img/hy_btnorder3.jpg" style="border:0;"></a>
        </li>
    </ul>
<?php
}
?>

<div class="page">
    <?php
        $this->widget('CLinkPager', array('pages'=>$search->pagination));
    ?>

</div>
</div>


</div>
</div>
