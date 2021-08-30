<?php
/*
* @author parklot
* @link https://github.com/paopao233
 */
get_header(); ?>
<body>
<main id="body">
    <div class="container">
        <div class="divider"></div>

        <div class="breadcrumb bg-light d-none d-md-flex">
            <li class="breadcrumb-item"><a href="<?php echo get_option('home'); ?>"><i class="icon icon-home mr-2"></i>首页</a>
            </li>
            <li class="breadcrumb-item"><?php the_title(); ?> </li>
        </div>
        <div class="thread-body">
            <div class="thread-top text-center my-4">
                <h1 class="title font-weight-bold mb-3">
                    <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                </h1>
                <div class="text-muted text-small">
                    <span class="mr-2">
                        <!--获取头像-->
                    <?php
                    the_post();
                    echo get_avatar(get_the_author_meta('ID'), $args['96'], '', 'avatar', array('class' => 'avatar-1 mr-1'));
                    rewind_posts();
                    ?>
                        <!--获取作者名-->
                    <?php echo get_the_author_meta('display_name', $post->post_author) ?></span>
                    <span class="mr-2"><i class="icon-clock-o"></i> <?php the_time('Y-m-d H:i') ?></span>
                    <span class="mr-2"><i class="icon-eye"></i> <?php echo bzg_post_views(); ?>次浏览</span>
                    <span><i class="icon-edit"></i> <?php comments_popup_link('0 条评论', '1 条评论', '% 条评论', 'comment_a', '评论已关闭'); ?></span>
                </div>
            </div>
            <div class="divider"></div>
            <div class="thread-content message break-all">
                <!--内容区-->
                <?php baolog_is_overdue() ?>
                <?php the_content(); ?>
                <div class="thread-footer plugin d-flex justify-content-center my-4">
                    <!--点赞-->
                    <div class="haya-favoriter px-2">
	<span class="btn-group haya-favoriter-info" role="group">
					<button  class="btn btn-outline-secondary js-haya-favorite-tip" href="javascript:;"
                            data-action="ding" data-id="<?php the_ID(); ?>">
				<i class="icon <?php if (isset($_COOKIE['specs_zan_' . $post->ID])) echo 'icon-star done'; else echo 'icon-star-o'; ?>"
                   aria-label="喜欢本帖"></i>
				<span class="haya-favorite-btn">喜欢</span>

		<button class="btn btn-outline-secondary" title="当前有 <?php if (get_post_meta($post->ID, 'specs_zan', true)) {
            echo get_post_meta($post->ID, 'specs_zan', true);
        } else {
            echo '0';
        } ?>人喜欢本贴"

			<span class="haya-favorite-user-count"><?php if (get_post_meta($post->ID, 'specs_zan', true)) {
                    echo get_post_meta($post->ID, 'specs_zan', true);
                } else {
                    echo '0';
                } ?></span>
		</button>
	</span>
                    </div>

                    <div class="support-author">
                        <!--要启用主题的时候就得自动建立page -->
                        <a href="<?php
                        $options = get_option( 'baolog_framework' );
                        echo $options['baolog-page-support'];
                        ?>" data-modal-title="赞助我们" data-modal-size="md"
                           class="btn btn-outline-danger support-us" >赞助网站</a>
                    </div>
                </div>
                <div class="haya-favoriter">
                    <div class="text-center d-none haya-favorite-show-users">
                        <div class="text-left m-0 p-0 col-md-6 mx-auto">
                            <div class="modal-content">
                                <div class="modal-header small">
                                    <b>收藏的用户（<span class="haya-favorite-user-count">0</span>）</b>

                                    <span class="close small p-3 haya-favorite-close js-haya-favorite-show-users"
                                          data-dismiss="dodal">X</span>
                                </div>

                                <div class="modal-body p-3">
                                    <div class="text-muted haya-favorite-users small break-all">
                                        <div class="text-muted">正在加载信息~</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--返回首页-->
                <div class="back_index text-center num-font mb-4">
                    <a href="<?php echo get_option('home'); ?>" class="text-small" style="color: gray;">
                        << · Back Index ·>>
                    </a>
                </div>
            </div>
            <div class="divider"></div>
            <div class="related-body">
                <h5 class="text-center font-weight-bold">相关线报</h5>
                <ul class="related-list list-unstyled d-flex flex-wrap my-3">
                    <?php
                    if (is_single()) :
                        global $post;
                        $categories = get_the_category();
                        foreach ($categories as $category) :
                            ?>
                            <?php
                            global $count;
                            $posts = get_posts('numberposts=10&category=' . $category->term_id . '&exclude=' . get_the_ID());
                            foreach ($posts as $post) : $count++
                                ?>
                                <li>
                                    <span><?php echo $count ?></span>
                                    <a rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </li>
                            <?php endforeach; ?>

                        <?php
                        endforeach; endif; ?>
                </ul>
            </div>
            <div class="divider"></div>
            <!--评论页面 -->
            <?php
            //上面出现的相关文章混乱了当前文章id 需要重置一下postid
            wp_reset_postdata();
            comments_template(); ?>


        </div>
</main>

<!-- sidebar -->
<?php
get_sidebar();
?>
<!--footer-->
<?php get_footer(); ?>

<style>
    /*.enlargeImg_wrapper {*/
    /*    display: none;*/
    /*    position: fixed;*/
    /*    z-index: 999;*/
    /*    top: 0;*/
    /*    right: 0;*/
    /*    bottom: 0;*/
    /*    left: 0;*/
    /*    background-repeat: no-repeat;*/
    /*    background-attachment: fixed;*/
    /*    background-position: center;*/
    /*    background-color: rgba(52, 52, 52, 0.8)*/
    /*}*/

    /*.message img:hover {*/
    /*    cursor: zoom-in*/
    /*}*/

    /*.enlargeImg_wrapper:hover {*/
    /*    cursor: zoom-out*/
    /*}*/
</style>
<script>
    var jform = $('#quick_reply_form');
    var jsubmit = $('#submit');
    jform.on('submit', function () {
        jform.reset();
        jsubmit.button('loading');
        var postdata = jform.serialize();
        $.xpost(jform.attr('action'), postdata, function (code, message) {
            if (code == 0) {
                var s = '<ul>' + message + '</ul>';
                var jli = $(s).find('li');
                //jli.insertBefore($('.comment-list > .post').last());
                $('.comment-list').append(jli);
                $('.comment-top').show();
                jsubmit.button('reset');
                $('#message').val('');

                // 楼层 +1
                /* 			var jfloor = $('#newfloor');
                            jfloor.html(xn.intval(jfloor.html()) + 1); */

                // 回复数 +1
                var jposts = $('.posts');
                jposts.html(xn.intval(jposts.html()) + 1);

            } else if (code < 0) {
                $.alert(message);
                jsubmit.button('reset');
            } else {
                jform.find('[name="' + code + '"]').alert(message).focus();
                jsubmit.button('reset');
            }
        });
        return false;
    });
    $('.post_reply').on('click', function () {
        var jthis = $(this);
        var tid = jthis.data('tid');
        var pid = jthis.data('pid');
        var jmessage = $('#message');
        var jli = jthis.closest('.post');
        var jpostlist = jli.closest('.postlist');
        var jadvanced_reply = $('#advanced_reply');
        var jform = $('#quick_reply_form');
        if (jli.hasClass('quote')) {
            jli.removeClass('quote');
            jform.find('input[name="quotepid"]').val(0);
            jadvanced_reply.attr('href', xn.url('post-create-' + tid));
        } else {
            jpostlist.find('.post').removeClass('quote');
            jli.addClass('quote');
            var s = jmessage.val();
            jform.find('input[name="quotepid"]').val(pid);
            jadvanced_reply.attr('href', xn.url('post-create-' + tid + '-0-' + pid));
        }
        jmessage.focus();
        return false;
    });
    $(".message img").on('click', function () {
        $(this).after("<div class='enlargeImg_wrapper'></div>");
        var imgSrc = $(this).attr('src');
        $(".enlargeImg_wrapper").css("background-image", "url(" + imgSrc + ")");
        $('.enlargeImg_wrapper').fadeIn(200);
    })
    $('.message').on('click', '.enlargeImg_wrapper', function () {
        $('.enlargeImg_wrapper').fadeOut(200).remove();
    })
</script>