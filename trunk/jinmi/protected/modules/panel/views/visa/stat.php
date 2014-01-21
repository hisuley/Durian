<?php
/**
 * Created by Suley.
 * @author: suley<dearsuley@gmail.com>
 * @date: 1/21/14
 * @time: 5:05 PM
 */

$this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        array(               // related city displayed as a link
            'label'=>'已完成订单',
            'type'=>'raw',
            'value'=>$model['complete'],
        ),
        array(               // related city displayed as a link
            'label'=>'进行中订单',
            'type'=>'raw',
            'value'=>$model['ongoing'],
        ),
        array(               // related city displayed as a link
            'label'=>'未支付订单',
            'type'=>'raw',
            'value'=>$model['is_not_paid'],
        ),
        array(               // related city displayed as a link
            'label'=>'未支付订单总额',
            'type'=>'raw',
            'value'=>$model['total_amount'],
        ),
        array(
            'label'=>'待送签订单',
            'type'=>'raw',
            'value'=>$model['not_sent'],
        )
    ),
));

?>