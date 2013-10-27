<?php
/**
 * Created by Kimi Tourism.
 * @author Suley<luzhang@jmlvyou.com>
 * @time 13-10-11
 * @version 1.0
 * @copyright 
 **/

?>

<?php

if($progress == 'order_success'){
    ?>
    <div class="row">
        <form class="review-form form-inline" role="form" action="<?php echo Yii::app()->createUrl('portal/visa/review/'.$params->id); ?>" style="">
            <div class="radio">
                <label for="" class="radio-inline">
                    <input type="hidden" name="OfflineOrderReviewHistory[type]" value="operate_verify"/>
                    <input type="radio" name="OfflineOrderReviewHistory[opinion]" value="accept" checked="checked">  同意
                </label>
            </div>
            <div class="radio">
                <label for="" class="radio-inline">
                    <input type="radio" name="OfflineOrderReviewHistory[opinion]" value="refuse">  拒绝
                </label>
            </div>
            <div class="form-group reason-box" style="margin-left:10px;min-width:50%;display:none;">
                <input type="text" name="OfflineOrderReviewHistory[response]" class="form-control input-sm" placeholder="请输入拒绝原因">
            </div>
            <button type="submit" class="btn btn-default btn-primary" style="margin-left:20px;">确定</button>
        </form>
    </div>

<?
}elseif($progress == 'operate_verify' ){
    ?>
    <div class="row">
        <form class="review-form form-inline" role="form" action="<?php echo Yii::app()->createUrl('visa/review/'.$params->id); ?>" style="">
            <div class="radio">
                <label for="" class="radio-inline">
                    <input type="hidden" name="OfflineOrderReviewHistory[type]" value="operate_verify"/>
                    <input type="radio" name="OfflineOrderReviewHistory[opinion]" value="accept" checked="checked">  同意
                </label>
            </div>
            <div class="radio">
                <label for="" class="radio-inline">
                    <input type="radio" name="OfflineOrderReviewHistory[opinion]" value="refuse">  拒绝
                </label>
            </div>
            <div class="form-group reason-box" style="margin-left:10px;min-width:50%;display:none;">
                <input type="text" name="OfflineOrderReviewHistory[response]" class="form-control input-sm" placeholder="请输入拒绝原因">
            </div>
            <button type="submit" class="btn btn-default btn-primary" style="margin-left:20px;">确定</button>
        </form>
    </div>

<?
}elseif($progress == 'finance_verify'){
    ?>
    <div class="row">
        <form class="review-form form-inline" role="form"  action="<?php echo Yii::app()->createUrl('visa/review/'.$params->id); ?>"  style="">
            <div class="radio">
                <label for="" class="radio-inline">
                    <input type="hidden" name="OfflineOrderReviewHistory[type]" value="finance_verify"/>
                    <input type="radio" name="OfflineOrderReviewHistory[opinion]" value="agree" checked="checked">  同意
                </label>
            </div>
            <div class="radio">
                <label for="" class="radio-inline">
                    <input type="radio" name="OfflineOrderReviewHistory[opinion]" value="refuse">  拒绝
                </label>
            </div>
            <div class="form-group reason-box" style="margin-left:10px;min-width:50%;display:none;">
                <input type="text" name="OfflineOrderReviewHistory[response]"  class="form-control input-sm" placeholder="请输入拒绝原因">
            </div>
            <button type="submit" class="btn btn-default btn-primary" style="margin-left:20px;">确定</button>
        </form>
    </div>
    <?php
}

?>

<script type="text/javascript">
    $(document).ready(function(){
        $('form.review-form').bind('submit', function(){
            $.ajax({
               type: "POST",
               url: $(this).prop('action'),
               data: $(this).serialize(),
               success: function(e){
                   console.log(e);
                   if(e == 'saved'){
                       var messageText = "<div class='alert alert-success'>操作成功！<a href='#'>刷新</a>页面。</div>";
                       $('div.review-panel').after(messageText);
                       $('div.review-panel').remove();
                   }else if(e == 'save failed'){
                       var messageText = "操作失败！";
                       $('div.review-panel').append(messageText);
                   }
               }
            });
           return false;
        });
        $('input[name="OfflineOrderReviewHistory[opinion]"]').click(function(){
            if($('input[name="OfflineOrderReviewHistory[opinion]"]:checked').prop('value') == 'refuse'){
                $('div.reason-box').show('normal');
            }else{
                $('div.reason-box').hide('normal');
            }
        });
    });
</script>

