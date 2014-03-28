<?php  
$client = new SoapClient("http://121.52.221.108/websend/MmsService?wsdl",Array('trace'=>True)); 
// 参数转为数组形式传递 
$aryPara = array('sender' => 'dantezhu', 
    'receiver' => 'dantezhu', 
    'title' => 'OZ评论消息提醒', 
    'msgInfo' => 'sss', 
    'messageType'=>0); 
// 调用远程函数 
$ret = $client->SendRTX($aryPara); 
var_dump($ret); 
echo $client->__getLastRequest(); 
?>