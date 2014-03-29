/// <reference path="../../../Scripts/jquery-1.4.1.js" />
/*
*圆角边框
*
*CopyRight 2010 Ryan
*
*本插件是基于Jquery1.4.1开发出的弹出层新增圆角边框,可自适弹出层的宽\高
*
*Date 2010-11-23 9:53 20
*
*/

//是否需要弹出层，有滚动条事件
var isScroll = true;

//页面存在多个弹出层时，滚动条事件时，需要指定弹出层Id
var popupLayerId = "";

//创建横向边框、纵向边框
//参数一：弹出层的类名
//参数二：透明的百分比
//参数三：增加left
//参数四：增加top
function CreateBorder(nitfyNode, transparence, addLeft, addTop) {

    addLeft = addLeft == undefined ? 0 : addLeft;
    addTop = addTop == undefined ? 0 : addTop;

    var scrollH = $(document).scrollTop();
    var scrollL = $(document).scrollLeft();

    var popupNode = $(nitfyNode);
    var topVal = ($(window).height() - popupNode.height()) / 2 + scrollH + addTop;
    var leftVal = ($(window).width() - popupNode.width()) / 2 + scrollL+addLeft;

    //窗体的高度有限时使用
    //    if (topVal > 330) {
    //        topVal = 330;
    //    }
    if (topVal < 100) {
        topVal = 100;
    }
    popupNode.css("left", leftVal)
            .css("top", topVal);
    var popupW = popupNode.outerWidth();
    var popupH = popupNode.outerHeight();
    var popupL = leftVal;
    var popupT = topVal;


    var bodyNode = $("body");
    var vWidth = bodyNode.children(".create_vnode").width();

    if (vWidth != null) {
        return;
    }
    //创建左边框
    var leftBorder = $("<div></div>");
    leftBorder.addClass("create_v_left_node");
    leftBorder.css({ "height": popupH, "left": popupL - 10, "top": popupT });

    //创建上边框
    var topBorder = $("<div></div>");
    topBorder.addClass("create_h_top_node");
    topBorder.css({ "width": popupW, "left": popupL, "top": popupT - 10 });

    //创建右边框
    var rgihtBorder = $("<div></div>");
    rgihtBorder.addClass("create_v_right_node");
    rgihtBorder.css({ "height": popupH, "left": popupL + popupW, "top": popupT });

    //创建下边框
    var bottomBorder = $("<div></div>");
    bottomBorder.addClass("create_h_bottom_node");
    bottomBorder.css({ "width": popupW, "left": popupL, "top": popupT + popupH });

    var imgArray = new Array();
    imgArray[0] = leftBorder;
    imgArray[1] = topBorder;
    imgArray[2] = rgihtBorder;
    imgArray[3] = bottomBorder;

    //新增元素的公有属性
    for (var i = 0; i < imgArray.length; i++) {
        imgArray[i].css("opacity", transparence)
					   .appendTo(bodyNode); ;
    }

    CreateNitfy(popupW, popupH, popupL, popupT, transparence, bodyNode);



    popupNode.show();

    /**处理IE6下拉框总在最上面*/
    handleIeSixSelectC(popupNode);

    //彈出層時創建透明層，不讓用戶操作頁面上其它動作
    CreateTransparenceLayer(0.2);
}

/**处理IE6下拉框总在最上面*/
function handleIeSixSelectC(ele) {
    //判断Ie版本
    var browser = navigator.appName
    var b_version = navigator.appVersion
    var version = b_version.split(";");
    var trim_Version;
    try {
        trim_Version = version[1].replace(/[ ]/g, "");
    } catch (e) { }

    if (browser == "Microsoft Internet Explorer" && trim_Version == "MSIE6.0") {
        if ($("#ifarmecc").attr("frameborder") == 0) {
            $("#ifarmecc").remove()
        }
        var iframe = $("<iframe class='ifarme' id='ifarmecc' scrolling='no' frameborder='0'></iframe>");
        iframe.height($(ele).height()+20);
        iframe.width($(ele).width()+20);
        iframe.css({ "top": $(ele).offset().top-10, "left": $(ele).offset().left-10 });
        iframe.appendTo($("body"));
    }
}

//加载圆角
function CreateNitfy(popupW, popupH, popupL, popupT, transparence, bodyNode) {
    //上左圆角
    var popupTLNode = $("<div></div>");
    //上右圆角
    var popupTRNode = $("<div></div>");
    //下左圆角
    var popupBLNode = $("<div></div>");
    //下右圆角
    var popupBRNode = $("<div></div>");

    //给相应圆角新增样式，和算出高度
    popupTLNode.addClass("pop_dialog_top_left");
    popupTLNode.css({ "left": popupL - 10, "top": popupT - 10 });

    popupTRNode.addClass("pop_dialog_top_right");
    popupTRNode.css({ "left": popupL + popupW, "top": popupT - 10 });

    popupBLNode.addClass("pop_dialog_bottom_left");
    popupBLNode.css({ "left": popupL + popupW, "top": popupT + popupH });

    popupBRNode.addClass("pop_dialog_bottom_right");
    popupBRNode.css({ "left": popupL - 10, "top": popupT + popupH });

    var imgArray = new Array();
    imgArray[0] = popupTLNode;
    imgArray[1] = popupTRNode;
    imgArray[2] = popupBLNode;
    imgArray[3] = popupBRNode;

    //新增元素的公有属性
    for (var i = 0; i < imgArray.length; i++) {
        imgArray[i].css("width", "10px")
					   .css("height", "10px")
					   .css("position", "absolute")
					   .css("opacity", transparence)
					   .appendTo(bodyNode); ;
    }


}

//隐藏弹出层
function HidePopup(popupNode) {

    //隐藏弹出层
    $(popupNode).hide();
    $("#ifarmecc").remove();
    RemoveBorder();
}
//删除边框
function RemoveBorder() {
    //删除圆角
    $(".pop_dialog_top_left").remove();
    $(".pop_dialog_top_right").remove();
    $(".pop_dialog_bottom_left").remove();
    $(".pop_dialog_bottom_right").remove();

    //删除侧条
    $(".create_h_top_node").remove();
    $(".create_v_left_node").remove();
    $(".create_h_bottom_node").remove();
    $(".create_v_right_node").remove();

    //remove 透明層
    RemoveTransparenceLayer();
}
//预留
function StrToNum(str) {
    var index = str.indexOf('p');
    if (index == -1) {
        return parseInt(str);
    } else {
        return parseInt(str.substring(0, index));
    }
}

//compare the popup div of height
//if the height no equal .when reset border
function ComparePopupHeight(popupDiv, popupH) {
    var popupChH = popupDiv.height();
    if (popupH != popupChH) {
        RemoveBorder();
        CreateBorder(popupDiv, publicPrams.transparence);
    }
}

//彈出層時創建透明層，不讓用戶操作頁面上其它動作
function CreateTransparenceLayer(transparence) {
    var lucencyLayer = $("<div class='transparencelayer'></div>");

    lucencyLayer.css("opacity", transparence).
        height($(document).height() + $(window).scrollTop()).
        width($(document).width() + $(window).scrollLeft()).
        appendTo($("body"));

}

//remove 透明層
function RemoveTransparenceLayer() {
    $(".transparencelayer").remove();
}
function reCalc() {
    var popupNode = $(".popupLayer");
    try {
        if ($(".popupLayer").length > 0) {
            popupNode = $("#" + popupLayerId);
        }
    } catch (e) {

    }
    var leftBorder = $(".create_v_left_node");
    var topBorder = $(".create_h_top_node");
    var rgihtBorder = $(".create_v_right_node");
    var bottomBorder = $(".create_h_bottom_node");
    var popupTLNode = $(".pop_dialog_top_left");
    var popupTRNode = $(".pop_dialog_top_right");
    var popupBLNode = $(".pop_dialog_bottom_left");
    var popupBRNode = $(".pop_dialog_bottom_right");

    var topVal = ($(window).height() - popupNode.height()) / 2;
    var leftVal = ($(window).width() - popupNode.width()) / 2;

    if (topVal > 330) {
        topVal = 330;
    }
    if (topVal < 0) {
        topVal = 10;
    }

    //改变浮动层的坐标
    popupNode.offset({ top: topVal + $(document).scrollTop(), left: leftVal + $(document).scrollLeft() });

    var popupW = popupNode.outerWidth();
    var popupH = popupNode.outerHeight();
    var popupL = leftVal + $(document).scrollLeft();
    var popupT = topVal + $(document).scrollTop();

    leftBorder.offset({ left: popupL - 10, top: popupT });
    topBorder.offset({ left: popupL, top: popupT - 10 });
    rgihtBorder.offset({ left: popupL + popupW, top: popupT });
    bottomBorder.offset({ left: popupL, top: popupT + popupH });

    popupTLNode.offset({ left: popupL - 10, top: popupT - 10 });
    popupTRNode.offset({ left: popupL + popupW, top: popupT - 10 });
    popupBLNode.offset({ left: popupL + popupW, top: popupT + popupH });
    popupBRNode.offset({ left: popupL - 10, top: popupT + popupH });

    if (popupBRNode.is(":visible")) {
        /**处理IE6下拉框总在最上面*/
        handleIeSixSelectC(popupNode);
    }
}
$(function () {

    $(window).scroll(function () {
        if (isScroll) {
            if (!isMsIESix()) {
                reCalc();
            }
        }
    });

});

/**是否是ie6浏览器*/
function isMsIESix() {
    //判断Ie版本
    var browser = navigator.appName
    var b_version = navigator.appVersion
    var version = b_version.split(";");
    var trim_Version;
    try {
        trim_Version = version[1].replace(/[ ]/g, "");
    } catch (e) { }

    if (browser == "Microsoft Internet Explorer" && trim_Version == "MSIE6.0") {
        return true;
    }
    else {
        return false;
    }
}

/**处理ie6下拉框浮动在最上方,挡信弹出层*/
function ieSixHandleSelect(handlePopup) {
    if (isMsIESix()) {
        var iframe = $("<iframe class='ifarme' id='handleIe6Iframe' scrolling='no' frameborder='0'></iframe>");
        iframe.height(handlePopup.height());
        iframe.width(handlePopup.width());
        iframe.css({ "top": handlePopup.offset().top, "left": handlePopup.offset().left });
        iframe.appendTo($("body"));
    }
}

/**删除挡ie6下拉框浮动Iframe*/
function remodeIfm() {
    if (isMsIESix()) {
        $("#handleIe6Iframe").remove();
    }
}

