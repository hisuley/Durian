<?php
/**
 * Created by PhpStorm.
 * User: Suley
 * Date: 14-3-30
 * Time: 下午12:08
 */


class YutongUserAddress extends CActiveRecord{
    public static function model($className = __CLASS__){
        return parent::model($className);
    }
    public function tableName(){
        return "yutong_user_address";
    }

    public function relations(){
        return array(
            'user'=>array(self::BELONGS_TO, 'YutongUser', 'user_id'),
            'handler'=>array(self::BELONGS_TO, 'YutongUser', 'contact_handler')

        );
    }
    public function rules(){
        return array(
            array('contact_handler, id,user_id,company_name,contact_name,contact_email,contact_phone,contact_address,contact_qq,contact_sex,contact_province,update_time,create_time', 'safe')
        );
    }

    public function attributeLabels(){
        return array(
          'contact_name'=>'联系人',
            'company_name'=>'公司名',
            'contact_phone'=>'联系方式',
            'contact_address'=>'联系地址',
            'contact_email'=>'电子邮件',
            'contact_handler'=>'管理人'
        );
    }


}