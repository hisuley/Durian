$().ready(function(){
var collapseAll = true;

$('#all').click(function(){
var items=$('li>span');
if (collapseAll) {
$('span#all').removeClass('collapse').addClass('explode'); //attr('',"img/explode.png");
collapseAll = !collapseAll;  //加减号转变
for (var i = 0; i <items.length; i++) {
$(items[i]).removeClass('collapse').addClass('explode');
collapseExplode(items[i], "explode");
}
}else{
$('span#all').removeClass('explode').addClass('collapse');//attr('src',"img/collapse.png");
collapseAll = !collapseAll;
for (var i = 0; i < items.length; i++) {
$(items[i]).removeClass('explode').addClass('collapse');
collapseExplode(items[i], "collapse");
}	
}
});

$('li>span').click(function(){
$(this).attr('class') == "explode" ? $(this).removeClass('explode').addClass('collapse') : $(this).removeClass('collapse').addClass('explode');	
collapseExplode(this,null);
});


function collapseExplode(obj , status){
if($(obj)[0].tagName.toLowerCase() == "span"){
if(status == "explode")
$(obj).parent().find('ul').css({"display": "block"});
if(status == "collapse")
$(obj).parent().find('ul').css({"display": "none"});
if(status == null){
var n=$(obj).parent().find('ul').get(0);
if($(obj).attr('class') == "explode")
{$(n).css({"display" : "block"});}else{
$(n).css({"display" : "none"});}
}
}
}	
});