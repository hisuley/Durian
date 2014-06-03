<?php
/**
 * @project: trunk
 * @file: list.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-4-14
 * @time: 下午12:58
 * @version: 1.0
 */
$data = $model->search();
$this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped',
    'dataProvider'=>$data,
    'template'=>"{items}",
    'columns'=>array(
        array('name'=>'id', 'header'=>'#'),
        array('name'=>'username', 'header'=>'用户名'),
        array('name'=>'address.company_name', 'header'=>'公司'),
        array('name'=>'address.contact_name', 'header'=>'联系人'),
        array('name'=>'initial_password', 'header'=>'初始密码'),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'buttons'=>array(
              'view'=>array('visible'=>'false'),
              'update'=>array(
                  'url'=>'Yii::app()->createUrl("yutong/merchantUpdate", array("id"=>$data->id))'
              ),
              'delete'=>array(
                  'url'=>'Yii::app()->createUrl("yutong/merchantDelete", array("id"=>$data->id))'
              )
            ),
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
    ),
));

?>

