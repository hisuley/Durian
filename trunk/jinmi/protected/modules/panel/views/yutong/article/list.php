<?php
/**
 * @project: trunk
 * @file: list.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-4-9
 * @time: 上午2:17
 * @version: 1.0
 */
$data = $model->search();
$this->widget('bootstrap.widgets.TbButton', array(
   'buttonType'=>'link',
    'label'=>'添加资讯',
    'url'=>$this->createUrl('yutong/newArticle'),
    'type'=>'primary'
));
$this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped condensed',
    'dataProvider'=>$data,
    'template'=>"{items}",
    'columns'=>array(
        array('name'=>'id', 'header'=>'编号'),
        array('name'=>'title'),
        array('name'=>'author.username', 'header'=>'作者'),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'buttons'=>array(
                'update'=>array(
                    'url'=>'Yii::app()->createUrl("panel/yutong/updateArticle", array("id"=>$data->id))'
                ),
            ),
            'htmlOptions'=>array('style'=>'width: 50px'),
        ),
    ),
));

?>

