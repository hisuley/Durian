<?php
/**
 * Created by PhpStorm.
 * User: Suley
 * Date: 14-3-30
 * Time: 上午11:44
 */


class YutongVisaGoods extends CActiveRecord{
    public $status, $author_id, $country_id, $type_id, $workdays, $market_price, $price, $valid_period, $stay_period, $entry_times, $need_interview, $consular_discrict, $material_text, $update_time, $create_time;
    public $keyword, $all_country_id;
    public static function model($className = __CLASS__){
        return parent::model($className);
    }
    public function tableName(){
        return "yutong_visa_goods";
    }

    public function beforeDelete(){
        $orderCount = YutongVisaOrder::model()->countByAttributes(array('goods_id'=>$this->id));
        if($orderCount > 0){
            throw new CHttpException(403, '该签证下还有订单，无法删除！');
        }
        return parent::beforeDelete();
    }

    public function afterSave(){
        if(!$this->isNewRecord){
            $oldFilesIds = array();
            if(!empty($_POST['YutongVisaGoodsAttachmentOldFiles'])){
                foreach($_POST['YutongVisaGoodsAttachmentOldFiles'] as $key=>$val){
                    $model = YutongVisaGoodsAttachment::model()->findByPk($val['id']);
                    $model->attributes = $val;
                    $model->save();
                    array_push($oldFilesIds, $model->id);
                }
            }
            $criteria = new CDbCriteria;
            $criteria->addCondition('goods_id = '.$this->id);
            $criteria->addNotInCondition('id', $oldFilesIds);
            YutongVisaGoodsAttachment::model()->deleteAll($criteria);
        }


        if(!empty($_FILES['YutongVisaGoodsAttachmentFile']['name'])){
            foreach($_FILES['YutongVisaGoodsAttachmentFile']['name'] as $key=>$val){
                if(!empty($val)){
                    $image = CUploadedFile::getInstanceByName('YutongVisaGoodsAttachmentFile['.$key.']');
                    $fileName = $this->id."_".md5($image->name)."_".rand(99,283535).".".$image->getExtensionName();
                    $name = Yii::getPathOfAlias('webroot').'/upload/yutong/material/'.$fileName;
                    if($image->saveAs($name)){
                        $attachmentModel = new YutongVisaGoodsAttachment;
                        $attachmentAttr = array(
                            'goods_id'=>$this->id,
                            'attachment_url'=> '/material/'.$fileName,
                            'attachment_title'=>$_POST['YutongVisaGoodsAttachment'][$key]['attachment_title'],
                            'attachment_desc'=>$_POST['YutongVisaGoodsAttachment'][$key]['attachment_desc']);
                        $attachmentModel->attributes = $attachmentAttr;
                        $attachmentModel->save();
                    }
                }

            }
        }

        return parent::afterSave();
    }


    public function beforeSave(){

        if($this->isNewRecord){
            $this->create_time = strtotime('now');
        }
        $this->update_time = strtotime('now');
        return parent::beforeSave();
    }

    public function relations(){
        return array(
           'author'=> array(self::BELONGS_TO, 'YutongUser', 'author_id'),
           'country'=> array(self::BELONGS_TO, 'YutongCountry', 'country_id'),
           'type'=> array(self::BELONGS_TO, 'YutongType', 'type_id'),
           'attachment'=> array(self::HAS_MANY, 'YutongVisaGoodsAttachment', 'goods_id')
        );
    }
    public function rules(){
        return array(
            array('status, author_id, country_id, type_id, workdays, market_price, price, valid_period, stay_period, entry_times, need_interview, consular_district, material, show_order, update_time, create_time', 'safe')
        );
    }

    public function search($params = array('order'=>'t.show_order ASC', 'pagination'=>25), $condition = array(), $returnType = 'CActiveRecord'){
        $criteria = new CDbCriteria;
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) :false;
        if(isset($keyword)){
            $criteria->compare('country.name', $keyword, true);
        }elseif(isset($country_id)){

        }
        $criteria->compare('t.country_id', $this->country_id);
        if(!empty($this->all_country_id)){
            Yii::import('application.modules.panel.models.Address');
            $criteria->addInCondition('t.country_id', Address::getSubData($this->all_country_id));
        }
        $criteria->compare('author_id', $this->author_id);
        $criteria->with = array('country', 'author', 'type');
        if($returnType == 'CActiveRecord'){
            return self::model()->findAll($criteria);
        }
            return new CActiveDataProvider('YutongVisaGoods', array(
                'criteria' => $criteria,
                'sort' => array(
                   'defaultOrder'=>$params['order']
                ),
                'pagination' => array(
                    'pageSize'=>25
                )
            ));


    }

    public function attributeLabels(){
        return array(
          'show_order'=>'排序','status' => '状态', 'author_id'=>'负责人', 'country_id'=>'国家', 'type_id'=>'签证类型', 'workdays'=>'工作日', 'market_price'=>'市场价', 'price'=>'价格', 'valid_period'=>'有效期', 'stay_period'=>'停留期', 'entry_times' => '入境次数', 'need_interview'=>'面试要求', 'consular_district'=>'领区划分', 'material'=>'所需材料', 'update_time'=>'更新时间', 'create_time'=>'录入时间'

        );
    }

}