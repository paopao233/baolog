<div class="footer text-muted text-center py-3">
    <div class="container">
        <div class="frend-link mb-2">
            友情链接：
            <?php wp_get_links('after=&orderby=name'); ?>
        </div>

        <div class="copy-right">
            Copyright © <?php bloginfo('name'); ?> (<?php echo get_option('home'); ?>)
            <?php
            $options = get_option('baolog_framework');
            echo $options['baolog-website-create'];
            ?>
            <a href="http://beian.miit.gov.cn/" target="_blank">
                <?php
                $options = get_option('baolog_framework');
                echo $options['baolog-beian'];
                ?></a>

        </div>

        <div class="loadtime">
            网页加载时间：<?php timer_stop(1); ?>/ms
        </div>
    </div>
</div>

<script src="<?php bloginfo('template_url'); ?>/js/jquery-3.1.0.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/popper.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/bootstrap.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/baolog.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/bootstrap-plugin.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/async.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/post-content.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/11.0.1.js" id="sozz"></script>
<script charset="utf-8" src="<?php bloginfo('template_url'); ?>/js/ab77b6ea7f3fbf79.js"></script>
<script>
    var debug = DEBUG = 0;
    var url_rewrite_on = 1;
    var fid = 0;
    var uid = 0;
    var gid = 0;
    xn.options.water_image_url = 'view/img/water-small.png';	// 水印图片 / watermark image
</script>
<script>
    jsearch_form = $('#search_form');
    jsearch_form.on('submit', function () {
        var keyword = jsearch_form.find('input[name="s"]').val();
        if ($.trim(keyword) == '') {
            $.alert('请输入关键词后再搜索...', 30, {size: 'sm'});
            return false;
        }
    });
</script>
<!--back to top-->
<script>
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
</script>
<!--点赞-->
<script type="text/javascript">
    //点赞如果没有登录
    $(document).on('click', '.js-haya-favorite-tip', function () {
        //不做验证
        var isLogin = <?php if (is_user_logged_in()) {
            echo 'true';
        } else {
            echo 'true';
        } ?>;

        if (!isLogin) {
            $.confirm('帖子喜欢提示', function () {
                //修改成自己的网站登录地址
                window.location = "/user-login.htm";
            }, {'body': '登录后才可以喜欢帖子！点击 <b class="text-primary">确定</b> 登录。'});
        } else {
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
        }
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
</script>


<div class="mpa-sc mpa-plugin-article-gatherer mpa-new mpa-rootsc" data-z="100" style="display: block;"
     id="mpa-rootsc-article-gatherer"></div>
<div class="mpa-sc mpa-plugin-image-gatherer mpa-new mpa-rootsc" data-z="100" style="display: block;"
     id="mpa-rootsc-image-gatherer"></div>
<div class="mpa-sc mpa-plugin-page-clipper mpa-new mpa-rootsc" data-z="100" style="display: block;"
     id="mpa-rootsc-page-clipper"></div>
<div class="mpa-sc mpa-plugin-text-gatherer mpa-new mpa-rootsc" data-z="100" style="display: block;"
     id="mpa-rootsc-text-gatherer"></div>
<div class="mpa-sc mpa-plugin-video-gatherer mpa-new mpa-rootsc" data-z="100" style="display: block;"
     id="mpa-rootsc-video-gatherer"></div>
<div class="mpa-sc mpa-plugin-side-function-panel mpa-new mpa-rootsc" data-z="110" style="display: block;"
     id="mpa-rootsc-side-function-panel"></div>
<div class="mpa-sc mpa-plugin-notifier mpa-new mpa-rootsc" data-z="120" style="display: block;"
     id="mpa-rootsc-notifier"></div>
<div class="mpa-sc mpa-plugin-notification-manager mpa-new mpa-rootsc" data-z="130" style="display: block;"
     id="mpa-rootsc-notification-manager"></div>
</body>
<div id="edge-translate-notifier-container" class="edge-translate-notifier-center"></div>
<grammarly-desktop-integration data-grammarly-shadow-root="true"></grammarly-desktop-integration>
<?php wp_footer(); ?>
</html>