<?php
/**
 * Created by Suley.
 * @author: suley<dearsuley@gmail.com>
 * @date: 2/26/14
 * @time: 1:10 PM
 */

?>

<div class="row"><h2 style="text-align: center;c">送签交接凭证</h2></div>
<div class="row" style="margin-bottom:10px;">
    <strong>交接：</strong>
    <span style="display:inline-block;width:200px;"><?php echo isset($data->agency_source->name) ? $data->agency_source->name : '没有填写'; ?></span>
    <strong>交接日期：</strong>
    <?php echo date('Y-m-d', $data->sent_time); ?>
</div>

<div class="row">
    <table class="table table-bordered">
        <tr>
            <td style="width:100px;">国家：</td>
            <td><?php echo $data->country_source->name; ?></td>
            <td style="width:100px;">类型：</td>
            <td><?php echo $data->order_type->name; ?></td>
        </tr>
        <tr>
            <td style="width:100px;">人数：</td>
            <td colspan="3"><?php echo $data->amount; ?></td>
        </tr>
        <tr>
            <td style="width:100px;">客人姓名：</td>
            <td colspan="3">
                <?php foreach($data->customer as $customer){
                    echo $customer->name."、";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td style="width:100px;">送签人：</td>
            <td><?php echo User::getUserRealname($data->sent_id); ?></td>
            <td style="width:100px;">接收人：</td>
            <td></td>
        </tr>
        <tr>
            <td style="width:100px;">备注：</td>
            <td colspan="3">
                <?php
                echo $data->sent_comment;
                ?>
            </td>
        </tr>
    </table>
</div>
<div class="row" style="width:100%;border-bottom:2px dotted black;margin-top:20px;">

</div>
