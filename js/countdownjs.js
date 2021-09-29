function getAdd(time) {
    if (time < 10) {
        return "0" + time;
    } else {
        return time;
    }
}

var interval = 1000;

function ShowCountDown(year, month, day, hourd, minuted) {
    var now = new Date();
    var endDate = new Date(year, month - 1, day, hourd, minuted);
    var leftTime = endDate.getTime() - now.getTime();
    var leftsecond = parseInt(leftTime / 1000);
    var day = Math.floor(leftsecond / (60 * 60 * 24));
    day = day < 0 ? 0 : day;
    var hour = Math.floor((leftsecond - day * 24 * 60 * 60) / 3600);
    hour = hour < 0 ? 0 : hour;
    var minute = Math.floor((leftsecond - day * 24 * 60 * 60 - hour * 3600) / 60);
    minute = minute < 0 ? 0 : minute;
    var second = Math.floor(leftsecond - day * 24 * 60 * 60 - hour * 3600 - minute * 60);
    second = second < 0 ? 0 : second;
    var getDay = getAdd(day);
    var getHour = getAdd(hour);
    var getMinute = getAdd(minute);
    var getSecond = getAdd(second);
    if (endDate > now) {
        document.getElementById('time').innerHTML = '距离本次活动结束时间还剩下：';
        document.getElementById('day').innerHTML = getDay + '天';
        document.getElementById('hour').innerHTML = getHour + '时';
        document.getElementById('min').innerHTML = getMinute + '分';
        document.getElementById('sec').innerHTML = getSecond + '秒';
    } else {
        document.getElementById('countdown').innerHTML = '本次活动已经结束了哦~'
    }
}