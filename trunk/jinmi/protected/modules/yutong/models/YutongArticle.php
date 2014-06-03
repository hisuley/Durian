<?php
/**
 * @project: trunk
 * @file: YutongArticle.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-4-8
 * @time: 下午12:45
 * @version: 1.0
 */


class YutongArticle extends CActiveRecord{
    public static function model($className = __CLASS__){
        return parent::model($className);
    }
    public function tableName(){
        return "yutong_visa_article";
    }
    public function rules(){
        return array(
            array('title, content', 'required'),
            array('title', 'length', 'min'=>6, 'max'=>80),
            array('content', 'length', 'min'=>8, 'max'=>10000),
            array('tags, related_country_id, user_id, continent_id', 'safe'),
        );
    }
    public function beforeSave(){
        if($this->isNewRecord){
            $this->create_time = strtotime('now');
        }
        $this->update_time = strtotime('now');
        $this->update_user = Yii::app()->user->id;
        return parent::beforeSave();
    }
    public function relations(){
        return array(
            'author'=>array(self::BELONGS_TO, 'YutongUser', 'user_id'),
            'updater'=>array(self::BELONGS_TO, 'YutongUser', 'update_user'),
            'related_country'=>array(self::BELONGS_TO, 'YutongCountry', 'related_country_id')
        );
    }
    public function attributeLabels(){
        return array(
          'title'=>'标题',
          'related_country'=>'关联国家',
          'related_country_id'=>'关联国家',
          'continent_id'=>'州',
          'user_id'=>'录入人',
          'update_user'=>'更新人',
          'content'=>'内容',
          'create_time'=>'录入时间',
          'update_time'=>'更新时间'
        );
    }
    public function search(){
        $criteria = new CDbCriteria;
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('related_country_id', $this->related_country_id);
        return new CActiveDataProvider('YutongArticle',
          array(
              'criteria'=>$criteria
          )
        );
    }
}