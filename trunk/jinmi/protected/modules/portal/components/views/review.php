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

if ($progress == 'order_success') {
    ?>
    <div class="row">
        <form class="review-form form-inline" role="form"
              action="<?php echo Yii::app()->createUrl('portal/visa/review', array('id' => $params->id)); ?>" style="">
            <div class="form-group memo-box" style="margin-left:10px;">
                <input type="text" name="OfflineOrderReviewHistory[memo]" class="form-control input-sm"
                       placeholder="请输入备注">
            </div>
            <div class="radio">
                <label for="" class="radio-inline">
                    <input type="hidden" name="OfflineOrderReviewHistory[type]" value="operate_verify"/>
                    <input type="radio" name="OfflineOrderReviewHistory[opinion]" value="accept" checked="checked"> 同意
                </label>
            </div>
            <div class="radio">
                <label for="" class="radio-inline">
                    <input type="radio" name="OfflineOrderReviewHistory[opinion]" value="refuse"> 拒绝
                </label>
            </div>
            <div class="form-group reason-box" style="margin-left:10px;display:none;">
                <input type="text" name="OfflineOrderReviewHistory[response]" class="form-control input-sm"
                       placeholder="请输入拒绝原因">
            </div>
            <button type="submit" class="btn btn-default btn-primary" style="margin-left:20px;">确定</button>
        </form>
    </div>

<?
} elseif ($progress == 'operate_verify') {
    ?>
    <div class="row">
        <form class="review-form form-inline" role="form"
              action="<?php echo Yii::app()->createUrl('portal/visa/review', array('id' => $params->id)); ?>" style="">
            <div class="form-group memo-box" style="margin-left:10px;">
                <input type="text" name="OfflineOrderReviewHistory[memo]" class="form-control input-sm"
                       placeholder="请输入备注">
            </div>
            <div class="radio">
                <label for="" class="radio-inline">
                    <input type="hidden" name="OfflineOrderReviewHistory[type]" value="finance_verify"/>
                    <input type="radio" name="OfflineOrderReviewHistory[opinion]" value="accept" checked="checked"> 同意
                </label>
            </div>
            <div class="radio">
                <label for="" class="radio-inline">
                    <input type="radio" name="OfflineOrderReviewHistory[opinion]" value="refuse"> 拒绝
                </label>
            </div>
            <div class="form-group reason-box" style="margin-left:10px;min-width:50%;display:none;">
                <input type="text" name="OfflineOrderReviewHistory[response]" class="form-control input-sm"
                       placeholder="请输入拒绝原因">
            </div>
            <button type="submit" class="btn btn-default btn-primary" style="margin-left:20px;">确定</button>
        </form>
    </div>

<?
} elseif ($progress == 'finance_verify') {
    ?>
    <div class="row">
        <form class="review-form form-inline" role="form"
              action="<?php echo Yii::app()->createUrl('portal/visa/review', array('id' => $params->id)); ?>" style="">
            <div class="radio">
                <label for="" class="radio-inline">
                    <input type="hidden" name="OfflineOrderReviewHistory[type]"
                           value="<?php echo OfflineOrderReviewHistory::TYPE_SEND_VISA; ?>"/>
                    <input type="radio" name="OfflineOrderReviewHistory[opinion]" value="agree" checked="checked"> 送签
                </label>
            </div>
            <div class="radio">
                <label for="" class="radio-inline">
                    <input type="radio" name="OfflineOrderReviewHistory[opinion]" value="refuse"> 退回
                </label>
            </div>
            <div class="form-group reason-box" style="margin-left:10px;display:none;">
                <input type="text" name="OfflineOrderReviewHistory[response]" class="form-control input-sm"
                       placeholder="请输入退回原因">
            </div>
            <button type="submit" class="btn btn-default btn-primary" style="margin-left:20px;">确定</button>
        </form>
    </div>
<?php
} elseif ($progress == 'send_visa') {

    ?>
    <div class="row">
        <form class="review-form form-inline" role="form"
              action="<?php echo Yii::app()->createUrl('portal/visa/review', array('id' => $params->id)); ?>" style="">
            <div class="form-group memo-box" style="margin-left:10px;">
                <input type="text" name="OfflineOrderReviewHistory[memo]" class="form-control input-sm"
                       placeholder="请输入备注">
            </div>
            <div class="radio">
                <label for="" class="radio-inline">
                    <input type="hidden" name="OfflineOrderReviewHistory[type]"
                           value="<?php echo OfflineOrderReviewHistory::TYPE_VISA_RESULT; ?>"/>
                    <input type="radio" name="OfflineOrderReviewHistory[opinion]" value="agree" checked="checked"> 出签
                </label>
            </div>
            <div class="radio">
                <label for="" class="radio-inline">
                    <input type="radio" name="OfflineOrderReviewHistory[opinion]" value="refuse"> 拒签
                </label>
            </div>
            <div class="form-group reason-box" style="margin-left:10px;display:none;">
                <input type="text" name="OfflineOrderReviewHistory[response]" class="form-control input-sm"
                       placeholder="请输入拒签原因">
            </div>
            <button type="submit" class="btn btn-default btn-primary" style="margin-left:20px;">确定</button>
        </form>
    </div>

<?php


} elseif ($progress == OfflineOrder::STATUS_ACCEPT) {

    ?>
    <div class="row">
        <form class="review-form form-inline" role="form"
              action="<?php echo Yii::app()->createUrl('portal/visa/review', array('id' => $params->id)); ?>" style="">
            <div class="form-group memo-box" style="margin-left:10px;">
                <input type="text" name="OfflineOrderReviewHistory[memo]" value="" class="form-control input-sm"
                       placeholder="请输入快递号">
            </div>
            <div class="radio">
                <label for="" class="radio-inline">
                    <input type="hidden" name="OfflineOrderReviewHistory[type]"
                           value="<?php echo OfflineOrderReviewHistory::TYPE_VISA_RETURN; ?>"/>
                    <input type="radio" name="OfflineOrderReviewHistory[opinion]" value="agree" checked="checked"> 送回
                </label>
            </div>
            <button type="submit" class="btn btn-default btn-primary" style="margin-left:20px;">确定</button>
        </form>
    </div>

<?php
} elseif ($progress == OfflineOrder::STATUS_VISA_RETURN) {
    ?>
    <div class="row">
        <form class="review-form form-inline" role="form"
              action="<?php echo Yii::app()->createUrl('portal/visa/review', array('id' => $params->id)); ?>" style="">

            <div class="radio">
                <label for="" class="radio-inline">
                    <input type="hidden" name="OfflineOrderReviewHistory[type]"
                           value="<?php echo OfflineOrderReviewHistory::TYPE_COMPLETE; ?>"/>
                    <input type="radio" name="OfflineOrderReviewHistory[opinion]" value="agree" checked="checked"> 结束
                </label>
            </div>
            <button type="submit" class="btn btn-default btn-primary" style="margin-left:20px;">确定</button>
        </form>
    </div>

<?php


} elseif ($progress == OfflineOrder::STATUS_REJECT) {
    ?>
    <div class="alert alert-danger">
        该项目已经被拒签
    </div>
<?php
}elseif ($progress == OfflineOrder::STATUS_COMPLETE) {
?>
<div class="alert alert-success">
    已经出签
</div>
<?php
}
?>

<script type="text/javascript">
    $(document).ready(function () {
        $('form.review-form').bind('submit', function () {
            $.ajax({
                type: "POST",
                url: $(this).prop('action'),
                data: $(this).serialize(),
                success: function (e) {
                    console.log(e);
                    if (e == 'saved') {
                        var messageText = "<div class='alert alert-success'>操作成功！<a href='#'>刷新</a>页面。</div>";
                        $('div.review-panel').after(messageText);
                        $('div.review-panel').remove();
                        window.location.reload();
                    } else if (e == 'save failed') {
                        var messageText = "操作失败！";
                        $('div.review-panel').append(messageText);
                    }
                }
            });
            return false;
        });
        $('input[name="OfflineOrderReviewHistory[opinion]"]').click(function () {
            if ($('input[name="OfflineOrderReviewHistory[opinion]"]:checked').prop('value') == 'refuse') {
                $('div.reason-box').show('normal');
            } else {
                $('div.reason-box').hide('normal');
            }
        });
    });
</script>

