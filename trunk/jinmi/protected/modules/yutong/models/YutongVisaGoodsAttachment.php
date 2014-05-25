<?php
/**
 * @project: trunk
 * @file: YutongVisaGoodsAttachment.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-4-3
 * @time: 上午12:05
 * @version: 1.0
 */

class YutongVisaGoodsAttachment extends CActiveRecord{
    public static function model($className = __CLASS__){
        return parent::model($className);
    }
    public function tableName(){
        return 'yutong_visa_goods_attachment';
    }
    public function rules(){
        return array(
          array('goods_id, attachment_title, attachment_desc, attachment_url, create_time', 'safe')
        );
    }
    public function beforeSave(){
        if($this->isNewRecord){
            $this->create_time = strtotime('now');
        }
        return parent::beforeSave();
    }
}
