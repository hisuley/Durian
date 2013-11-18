<?php
/**
 * Created by Kimi Tourism.
 * @author Suley<luzhang@jmlvyou.com>
 * @time 13-11-18
 * @version 1.0
 * @copyright 
 **/

?>
<div class="panel panel-danger">
    <div class="panel-heading"><?php echo $code; ?>错误</div>
    <div class="panel-body">
        <?php echo CHtml::encode($message); ?>
    </div>
</div>