<?php
/**
 * Created by PhpStorm.
 * User: suley
 * Date: 1/21/14
 * Time: 2:05 AM
 */

?>
<?php echo CHtml::link('添加', $this->createUrl('yutong/newVisa'), array('class'=>'alink-btn')); ?>
<?php
$data = $model->search(array('order'=>'t.id DESC', 'pagination'=>25), array(), 'CActiveDataProvider');
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
            'name'=>'country_id',
            'header'=>'国家',
            'value'=> 'Address::getCountryName($data->country_id)',
            'filter'=> Address::model()->findCountry()
        ),
        array(
            'name'=>'type',
            'header'=>'类型',
            'value'=> 'VisaType::getTypeName($data->type_id)',
            'filter'=> ''
        ),
        array(
            'name'=>'author_id',
            'header'=>'录入人',
            'value'=> 'User::getUserRealname($data->author_id)',
            'filter'=> CHtml::listData(User::model()->findAll('role != "merchant"'), 'id', 'realname')
        ),
        array(
            'name'=>'workdays',
            'header'=>'工作日',
            'filter'=>''
        ),


        array(
            'name'=>'market_price',
            'filter'=> ''
        ),
        array(
            'name'=>'price',
            'filter'=> ''
        ),
        array(
            'name'=>'valid_period',
            'filter'=> ''
        ),
        array(
            'name'=>'stay_period',
            'filter'=> ''
        ),

       array(
           'name'=>'entry_times',
           'filter'=> ''
       ),
        array(
            'name'=>'show_order',
            'filter'=> ''
        ),
        array(
            'class' => 'CButtonColumn',
            'header' => '操作',
            'updateButtonOptions'=>array(
                'url'=>'wjfiwef'
            ),
            'buttons'=>array(
              'update'=>array(
                  'url'=>'Yii::app()->createUrl("panel/yutong/updateVisa", array("id"=>$data->id))'
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
<style>
    .grid-view .filters input{width:80%;}
</style>