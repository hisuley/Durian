/*endDate结束时间,ele显示时间的标签*/
function ShowTimes() {
    
    var beginDate = arguments[0]; // 开始时间
    var endDate = arguments[1]; //结束时间
    var dateId = arguments[2]; //显示时间span的Id
    var ne = document.getElementById(dateId); //显示时间span

    beginDate = beginDate.replace(/\-/g, "/");
    endDate = endDate.replace(/\-/g, "/");
    
    var beginTime = new Date(beginDate);
    var endTime = new Date(endDate);

    if (beginTime > new Date() && endTime > new Date()) {
        LeaveTime = beginTime - new Date();
        LeaveDays = Math.floor(LeaveTime / (1000 * 60 * 60 * 24)); //天
        LeaveHours = Math.floor(LeaveTime / (1000 * 60 * 60) % 24); //时
        LeaveMinutes = Math.floor(LeaveTime / (1000 * 60) % 60); //分
        LeaveSeconds = Math.floor(LeaveTime / 1000 % 60); //秒
        var c = new Date();
        var q = ((c.getMilliseconds()) % 1000);

        ne.innerHTML = "<font color=red>" + LeaveDays + "</font>天 <font color=red>" + LeaveHours + "</font>时 <font color=red>" + LeaveMinutes + "</font>分 <font color=red>" + LeaveSeconds + "</font>秒 <font color=red>" + q + "</font>" +"后开始";
        return;
    }
    if (endTime < new Date()) {
        ne.innerHTML = "结束";
        return;
    }


    LeaveTime = endTime - new Date();
    LeaveDays = Math.floor(LeaveTime / (1000 * 60 * 60 * 24)); //天
    LeaveHours = Math.floor(LeaveTime / (1000 * 60 * 60) % 24); //时
    LeaveMinutes = Math.floor(LeaveTime / (1000 * 60) % 60); //分
    LeaveSeconds = Math.floor(LeaveTime / 1000 % 60); //秒
    var c = new Date();
    var q = ((c.getMilliseconds()) % 1000);

    ne.innerHTML = "<font color=red>" + LeaveDays + "</font>天 <font color=red>" + LeaveHours + "</font>时 <font color=red>" + LeaveMinutes + "</font>分 <font color=red>" + LeaveSeconds + "</font>秒 <font color=red>" + q + "</font>" + "后结束";

}

/**秒杀活动开始时间倒计时**/
function seckillBeginCountdown() {
    var beginDate = arguments[0]; // 开始时间
    var divId = arguments[1]; //倒计时div Id
    var ne = document.getElementById(divId); //显示时间divId

    beginDate = beginDate.replace(/\-/g, "/");
    var beginTime = new Date(beginDate);

    if (beginTime < new Date()) {
        ne.style.display = "none";
        return;
    } 


    LeaveTime = beginTime - new Date();
    LeaveDays = Math.floor(LeaveTime / (1000 * 60 * 60 * 24)); //天
    LeaveHours = Math.floor(LeaveTime / (1000 * 60 * 60) % 24); //时
    LeaveMinutes = Math.floor(LeaveTime / (1000 * 60) % 60); //分
    LeaveSeconds = Math.floor(LeaveTime / 1000 % 60); //秒
    var c = new Date();
    var q = ((c.getMilliseconds()) % 1000);

    ne.innerHTML ="十万优惠回馈活动倒计时 "+ "<font color=red>" + LeaveDays + "</font>天 <font color=red>" + LeaveHours + "</font>时 <font color=red>" + LeaveMinutes + "</font>分 <font color=red>" + LeaveSeconds + "</font>秒 <font color=red>" + q + "</font>";

}

