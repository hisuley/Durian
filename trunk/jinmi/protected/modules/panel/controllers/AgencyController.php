<?php

class AgencyController extends PanelController
{
    public $label = "送签旅行社";
    public $subMenu;
    public function getLabel($labelName){
        $label = array('list'=>'列表', 'delete'=>'删除', 'new'=>'新增', 'update'=>'编辑', 'export'=>'导出');
        return $label[$labelName];
    }
    public function beforeAction(){
        $this->subMenu = $this->getSubMenu();
        return parent::beforeAction();
    }
    private function getSubMenu(){
        return array(
            array(
                'label'=>'新送签',
                'url'=> array('agency/new')
            ),
            array(
                'label'=>'列表',
                'url'=> array('agency/list')
            )
        );
    }

    public function actionList()
    {
        $result = OrderSource::getAgencyList();
        $model = new OrderSource();
        $this->render('list', array('result'=>$result, 'model'=>$model));
    }
    public function actionDelete($id)
    {
        if(isset($id)){
            if(OrderSource::model()->deleteByPK($id)){
                Yii::app()->user->setFlash('success', Yii::t('panel', '删除记录成功！'));
                $this->redirect($this->createUrl('agency/list'));
            }
        }
    }
    public function actionUpdate($id){
        $model = OrderSource::model()->findByPk($id);
        if(!empty($_POST['OrderSource'])){
            $postData = $_POST['OrderSource'];
            $postData['type'] = OrderSource::TYPE_AGENCY;
            $model->attributes = $postData;
            if($model->save()){
                Yii::app()->user->setFlash('success', Yii::t('panel', '修改成功！'));
                $this->redirect($this->createUrl('agency/list'));
            }
        }else{
            $parentList = OrderSource::model()->findAll('type = 2 AND (parent_id IS NULL OR parent_id = 0) AND id != :id', array(':id'=>$id));
            $this->render('new', array('parentList'=>$parentList, 'model'=>$model));
        }
    }
    public function actionNew(){
        $model = new OrderSource;
        if(!empty($_POST['OrderSource'])){
            $_POST['OrderSource']['type'] = OrderSource::TYPE_AGENCY;
            if(isset($_POST['OrderSource']['parent_id']) && ($_POST['OrderSource']['parent_id'] != 0)){
                if(OrderSource::addNewSource($_POST['OrderSource'], $_POST['OrderSource']['parent_id'])){
                    Yii::app()->user->setFlash('success', Yii::t('panel', '添加成功！'));
                    $this->redirect($this->createUrl('agency/list'));
                }
            }else{
                if(OrderSource::addNewSource($_POST['OrderSource'])){
                    Yii::app()->user->setFlash('success', Yii::t('panel', '添加成功！'));
                    $this->redirect($this->createUrl('agency/list'));
                }
            }
        }else{
            $parentList = OrderSource::model()->findAll('type = 2 AND (parent_id IS NULL OR parent_id = 0)', array());
            $this->render('new', array('parentList'=>$parentList, 'model'=>$model));
        }
    }

    public function actionExport(){
        //Open a file pointer
        $fp = fopen('/tmp/export-way'.strtotime('now').rand(111,999).'.csv', 'w+');
        $models = OrderSource::model()->findAllByAttributes(array('type'=>OrderSource::TYPE_AGENCY));
        $agencyWayData = array();
        foreach($models as $key=>$model){
            $row = array(" ");
            fputcsv($fp, $row);
            $row = array("送签社", $model->name, "联系人", $model->contact_name);

            $tempAgencyWay = VisaTypeAgency::model()->findAllByAttributes(array('agency_id'=>$model->id));
            $agencyWayData[$key]['ways'] = array();
            if(!empty($tempAgencyWay)){
                $row = array("编号", "类型", "成本价", "预测出签");
                foreach($row as $tKey=>$tVal){
                    $row[$tKey] = iconv('utf-8', 'GBK//IGNORE', $tVal);
                }
                fputcsv($fp, $row);
                foreach($tempAgencyWay as $tKey=>$tVal){
                    $row = array(($tKey+1), $tVal->type->name, $tVal->price, $tVal->predict_date);
                    foreach($row as $ttKey=>$ttVal){
                        $row[$ttKey] = iconv('utf-8', 'GBK//IGNORE', $ttVal);
                    }
                    fputcsv($fp, $row);
                }
                $row = array("总计", count($tempAgencyWay));
                foreach($row as $tKey=>$tVal){
                    $row[$tKey] = iconv('utf-8', 'GBK//IGNORE', $tVal);
                }
                fputcsv($fp, $row);
            }
        }
        rewind($fp);
        Yii::app()->request->sendFile('签证渠道_'.date("Y年m月d日").'.csv',stream_get_contents($fp), 'text/csv; charset=GBK//IGNORE');
        fclose($fp);
    }

}