<?php
/**
 * @project: trunk
 * @file: PanelMessage.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-4-9
 * @time: 上午10:41
 * @version: 1.0
 */


class PanelMessage extends CActiveRecord{
    const TYPE_WARNING = 'warning';
    const TYPE_GLOBAL = 'global';
    const TYPE_NOTICE = 'notice';
    public static $typeTranslate = array(
      self::TYPE_GLOBAL => '全局通知',
      self::TYPE_WARNING => '警告',
      self::TYPE_NOTICE => '通知'
    );
    const IS_READ_TRUE = 1;
    const IS_READ_FALSE = 0;
    public static function model($className = __CLASS__){
        return parent::model($className);
    }

    public function relations(){
        return array(
          'fuser'=>array(self::BELONGS_TO, 'PanelUser', 'from_user'),
          'tuser'=>array(self::BELONGS_TO, 'PanelUser', 'to_user'),
        );
    }

    public function tableName(){
        return "panel_message";
    }
    public function addMessage($title, $content, $type, $to_user = 0, $from_user = 0){
        if(array_key_exists($type, self::$typeTranslate)){
            if($type != self::TYPE_GLOBAL && empty($to_user)){
                throw new CHttpException(400, '非全局消息需要填写指定用户！PanelMessage_addMessage');
            }
            if(self::TYPE_GLOBAL == $type){
                $userList = PanelUser::model()->findAll('role != "merchant"');
                foreach($userList as $singleUser){
                    $tempModel = new PanelMessage();
                    $tempModel->title = $title;
                    $tempModel->content = $content;
                    $tempModel->to_user = $singleUser->id;
                    $tempModel->is_read = PanelMessage::IS_READ_FALSE;
                    $tempModel->save();
                }
            }elseif(self::TYPE_NOTICE){
                $tempModel = new PanelMessage;
                $tempModel->title = $title;
                $tempModel->content = $content;
                $tempModel->to_user = $to_user;
                $tempModel->is_read = PanelMessage::IS_READ_FALSE;
                $tempModel->from_user = $from_user;
                $tempModel->save();
            }

        }else{
            throw new CHttpException(400, '不存在该消息类型！PanelMessage_addMessage');
        }

    }
    public static function readMessage($id){
        if(self::model()->updateByPk($id, array('is_read'=>self::IS_READ_TRUE))){
            return true;
        }
        return false;
    }

    public static function getMessageCount(){
        $userId = Yii::app()->user->id;
        $count = PanelMessage::model()->countByAttributes(array('to_user'=>$userId, 'is_read'=>PanelMessage::IS_READ_FALSE));
        return $count;
    }
}