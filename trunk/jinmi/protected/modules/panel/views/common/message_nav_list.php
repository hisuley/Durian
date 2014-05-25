<?php
/**
 * @project: trunk
 * @file: message_nav_list.php
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-4-18
 * @time: 下午1:08
 * @version: 1.0
 */
$msgStr = '暂无消息';
if(!empty($messages)){
    $msgStr = '';
    foreach($messages as $message){
        $msgStr .= "<p class='msg-nav-list' id='".$message->id."'>";
        $msgStr .= "<span><a class='read-message-close' href='#' onclick='suley_handler.ajax_confirm_read(".$message->id.")'>X</a><a target='_blank' href='#'>";
        $msgStr .= empty($message->fuser->realname) ? '系统' : $message->fuser->realname;
        $msgStr .= "</a> 发来 <a target='_blank' href='#'>消息</a>：</span>";
        $msgStr .= $message->content;
        $msgStr .= "</p>";
    }
}
//echo CJavaScript::encode($msgStr);
echo $msgStr;
