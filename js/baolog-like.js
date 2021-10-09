//点赞如果没有登录
$(document).on('click', '.js-haya-favorite-tip', function () {

        $.fn.postLike = function () {
            var post_id = $(".js-haya-favorite-tip").attr("data-id");
            if ($(this).hasClass('done')) {
                $.alert('您已赞过本博客啦~', 30, {size: 'sm'});
                return false;
            } else if (getCookie('specs_zan_' + post_id) != '') {
                $.alert('您已赞过本博客啦~', 30, {size: 'sm'});
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
            }

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