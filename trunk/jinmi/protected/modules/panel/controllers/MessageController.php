<?php
/**
 * @project: trunk
 * @file: MessageController.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-4-9
 * @time: 下午1:44
 * @version: 1.0
 */

class MessageController extends Controller{
    public function actionInbox(){

    }

    public function actionAjax(){
        $replyJSON = array('type'=>'error', 'msg'=>'无法删除');
        if($_POST['id']){
                if(PanelMessage::readMessage($_POST['id'])){
                    $replyJSON['type'] = 'ok';
                    $replyJSON['msg'] = '删除成功！';
                    $replyJSON['count'] = PanelMessage::getMessageCount();
                    $replyJSON['result'] = $this->renderPartial("application.modules.panel.views.common.message_nav_list", array('messages'=>PanelMessage::model()->findAllByAttributes(array('to_user'=>Yii::app()->user->id, 'is_read'=>PanelMessage::IS_READ_FALSE), array('order'=>'id DESC'))), true);
            }
        }
        echo json_encode($replyJSON);
    }
}