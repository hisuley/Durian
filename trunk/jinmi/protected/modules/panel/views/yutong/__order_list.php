<?php
/**
 * Created by PhpStorm.
 * User: suley
 * Date: 1/21/14
 * Time: 2:05 AM
 */

?>
<?php
$data = $model->search(array('order'=>' id DESC', 'pagination'=>25),'CActiveDataProvider', false);
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $data,
    'filter'=> $model,
    'ajaxUpdate' => false,
    'afterAjaxUpdate' => 'reinstallDatePicker', // (#1)
    'pager' => array(
        'maxButtonCount' => '7',
        'pageSize' => 25,
    ),
    'enableHistory'=>true,
    'summaryText' => '显示第{start}条至{end}条记录|共{count}条记录',
    'template' => '{pager}{summary}{items}{pager}',
    'columns' => array(
        array(
            'class' => 'CCheckBoxColumn',
            'selectableRows' => 2,
            'value' => $model->id,
        ),
        array(
            'name'=>'id',
            'filterHtmlOptions'=>array('width'=>'70px'),
            'footer'=>'总计'
        ),

        array(
            'name'=>'visa.country.name',
            'header'=>'国家',
            //'value'=> 'Address::getCountryName($data->visa->country_id)',
            'filter'=> Address::model()->findCountry()
        ),

        array(
          'name'=>'visa.customers.name',
           'header'=>'客户姓名',
          'value'=>'YutongVisaOrder::joinCustomer($data->customers, true)'

        ),
        array(
          'name'=>'user.realname',
          'header'=>'下单人'
        ),
        array(
          'name'=>'amount'
        ),
        array(
          'name'=>'price'
        ),
        array(
          'name'=>'is_pay',
          'value'=>'empty($data->is_pay) ?  "未支付" : "已付款"'
        ),
        array(
          'name'=>'status',
          'value'=>'YutongVisaOrder::translateStatus($data->status)'
        ),
        array(
            'class' => 'CButtonColumn',
            'header' => '操作',
            'updateButtonOptions'=>array(
                'url'=>'wjfiwef'
            ),
            'buttons'=>array(
                'update'=>array(
                    'url'=>'Yii::app()->createUrl("panel/yutong/updateOrder", array("id"=>$data->id))'
                ),
                'view'=>array(
                    'url'=>'Yii::app()->createUrl("yutong/visa/view", array("id"=>$data->id))'
                )
            ),
            'deleteConfirmation' => '您确定要删除该订单？'
        ),
    )
));
// (#5)
Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
    $('#end_time').datepicker();
    $('#datepicker_for_create_time').datepicker();
}
");
?>