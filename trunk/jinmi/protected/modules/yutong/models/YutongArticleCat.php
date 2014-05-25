<?php
/**
 * @project: trunk
 * @file: YutongArticleCat.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-4-9
 * @time: 下午4:16
 * @version: 1.0
 */


class YutongArticleCat extends CActiveRecord{
    public static function model($className = __CLASS__){
        return parent::model($className);
    }
    public function tableName(){
        return "yutong_article_category";
    }
    public function relations(){
        return array(
          'articles'=>array(self::HAS_MANY, 'YutongArticle', 'cat_id')
        );
    }
}