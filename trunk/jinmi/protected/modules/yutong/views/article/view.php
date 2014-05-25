<?php
/**
 * @project: trunk
 * @file: view.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-4-9
 * @time: 下午1:08
 * @version: 1.0
 */

?>

<div id="main">
    <div id="vleft">
        <ul class="titlelist">
            <li class="title"><span><b>·&nbsp;</b>签证资讯</span> </li>
            <?php
                if(!empty($models)){
                    foreach($models as $item){
                        echo ' <li class="item"><b>·&nbsp;</b><a href="'.$this->createUrl('article/view', array('id'=>$item->id)).'">'.CHtml::encode($item->title).'</a></li>';
                    }
                }
            ?>
        </ul>
    </div>
    <div id="vright">
        <div class="infodetail">
            <div class="title">
                <b style="font-size: large"><?php echo $model->title; ?></b>
            </div>
            <div style="line-height: 20px;">
               <?php echo ($model->content); ?>
            </div>
            <div class="foot">
                <span>更新人：<?php echo $model->updater->realname; ?></span> <span>更新时间：<?php echo date('Y-m-d H:i:s', $model->update_time); ?></span>
            </div>
        </div>
    </div>
</div>