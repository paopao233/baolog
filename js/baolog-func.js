//----------------------content function
//fold
$(".fold-plane-title").click(function(a) {
    $(this).hasClass("fold-plane-title-zk") ? ($(this).removeClass("fold-plane-title-zk"), $(this).next().slideUp()) : ($(this).addClass("fold-plane-title-zk"), $(this).next().slideDown())
});
//like
$(document).on('click', '.haya-favoriter', function (e) {
            var post_id = $(".js-haya-favorite-tip").attr("data-id");
            if ($(this).hasClass('done')) {
                $.alert('您已赞过本博客啦~', 30, {size: 'sm'});
                return false;
          
            } else if (getCookie('specs_zan_' + post_id) != '') {
                $.alert('您过本博客啦~', 30, {size: 'sm'});
                return false;
            } else {
                $(this).addClass('done');
                var id = $(this).data("id"),
                    action = $(this).data('action'),
                    rateHolder = $(this).children('.count');
                var ajax_data = {
                    action: "specs_zan",
                    um_id: id,
                    um_action: action
                };
                $.post("/wp-admin/admin-ajax.php", ajax_data,
                    function (data) {
                        $(rateHolder).html(data);
                    });
                $.alert('感谢喜欢~', 30, {size: 'sm'});
                return false;

        };
        
        $(document).on("click", ".js-haya-favorite-tip",
            function () {
                $(this).postLike();
            });
});

//获取cookie
function getCookie(cookieName) {
    var cookieValue = "";
    if (document.cookie && document.cookie != '') {
        var cookies = document.cookie.split(';');
        for (var i = 0; i < cookies.length; i++) {
            var cookie = cookies[i];
            if (cookie.substring(0, cookieName.length + 2).trim() == cookieName.trim() + "=") {
                cookieValue = cookie.substring(cookieName.length + 2, cookie.length);
                break;
            }
        }
    }
    return cookieValue;
}

//top function
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


