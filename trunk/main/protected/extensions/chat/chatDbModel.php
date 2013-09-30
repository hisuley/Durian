<?php

class ChatDbModel extends CActiveRecord {

    public function tableName() {
        return "chat";
    }

    /**
      post a message in database.
     */
    public function postMessage($message, $from_user, $to_user) {


        $filtered_message = trim($message);
        if ($filtered_message != "") {
            $this->chat_message = trim(htmlspecialchars($filtered_message));
            $this->chat_created = time();
            $this->chat_to_user = $to_user;
            $this->chat_from_user = $from_user;
            
            return $this->save();
            
        }
        else
            return false;
    }
    
    /**
      getting messages from database.
     */
    
    public function getMessages($active_user) {
        if(Yii::app()->user->name!='Guest')
            $from_user=Yii::app()->user->name;
        else
            $from_user=$_COOKIE['PHPSESSID'];

        $this->updateAll(array('is_read'=>1), 'chat_from_user=? AND chat_to_user=?', array($active_user, $from_user));
        $arr=$this->findAll('(chat_from_user=? OR chat_to_user=?) AND chat_created>?', array($from_user, $from_user, time()-3600));
        $temp=array();
        
        foreach($arr as $k=>$v)
        {
            $group_key1=$v['chat_from_user'].'#'.$v['chat_to_user'];
            $group_key2=$v['chat_to_user'].'#'.$v['chat_from_user'];

            if(!array_key_exists($group_key1, $temp) && !array_key_exists($group_key2, $temp))
                $this->setMessageArr($temp, $group_key1, $v);
            elseif(array_key_exists($group_key1, $temp))
                $this->setMessageArr($temp, $group_key1, $v);
            else
                $this->setMessageArr($temp, $group_key2, $v);
        }

        return $temp;
    }
    private function setMessageArr(&$msg, $k, $v)
    {
        $temp['chat_from_user']=$v['chat_from_user'];
        $temp['chat_to_user']=$v['chat_to_user'];
        $temp['chat_message']=$v['chat_message'];
        $temp['chat_created']=date('Y:m:d H:i:s', $v['chat_created']);
        $temp['is_read']=$v['is_read'];

        if(!isset($msg[$k]))
            $msg[$k]=array();

        array_push($msg[$k], $temp);
    }
}

?>
