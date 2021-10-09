$(document).ready(function () {
    //首先将#back-to-top隐藏
    //当滚动条的位置处于距顶部600像素以下时，跳转链接出现，否则消失
    $(function () {
        $(window).scroll(function () {
            if ($(window).scrollTop() > 200) {
                $("#gotop").fadeIn(500);
                document.getElementById("gotop").style = "display: list-item;"
            } else {
                $("#gotop").fadeOut(500);
            }
        });
        //当点击跳转链接后，回到页面顶部位置
        $("#gotop").click(function () {
            $('body,html').animate({scrollTop: 0}, 500);
            return false;
        });
    });
});