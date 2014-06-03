/**
 * @project: trunk
 * @file:
 * @author: Suley Lu<dearsuley@gmail.com>
 * @date: 14-4-18
 * @time: 下午1:24
 * @version: 1.0
 */
$('document').ready(function(){
    /*
    $('#message-button').click(function(){
        $(this).popover('toggle');
    });*/
});
var suley_handler = function(){
   var op_list = {
       ajax_confirm_read:function(vid){
           $.ajax({
               type: "POST",
               url: ajax_read_url,
               data: {"id":vid},
               success:function(json){
                   json = eval('('+json+')');
                   if(json.type == "ok"){
                       var str = '#'+vid;
                       $(str).remove();
                       $('#message-button').find('span.badge').text(json.count);
                       if(json.count == 0){
                           $('#message-button').data('content', '暂无数据。');
                       }else{
                           $('#message-button').data('content', json.result);
                       }
                       //$('#message-button').popover('destroy');
                   }else{
                       console.log(json['type']);
                   }
               }

           });
           return false;
       }
   }
    return op_list;
}();
