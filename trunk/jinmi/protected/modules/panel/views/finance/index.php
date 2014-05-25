<?php
/**
 * @project: trunk
 * @file: index.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-5-4
 * @time: 下午2:19
 * @version: 1.0
 */

?>
<div style="margin-left:50px;">
    <div class="row">
        未支付订单金额：<?php echo $stat['unpay_order_price']; ?>
    </div>
    <div class="row">
        未支付订单数量：<?php echo $stat['unpay_order']; ?>
    </div>
    <div class="row">
        未请款订单金额：<?php echo $stat['unpayout_order_price']; ?>
    </div>
    <div class="row">
        未请款订单数量：<?php echo $stat['unpayout_order']; ?>
    </div>
</div>
