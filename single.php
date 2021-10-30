<?php
/*
* @author parklot
* @link https://github.com/paopao233
 */
get_header();
$the_post_category_name = get_the_category(get_the_ID())[0]->cat_name;
$the_post_category_link = get_category_link(get_the_category(get_the_ID())[0]->term_id);
?>
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
                    <?php the_post();
                    echo get_avatar(get_the_author_meta('ID'), $args['96'], '', 'avatar', array('class' => 'avatar-1 mr-1'));
                    rewind_posts();
                    ?>
                    <?php echo get_the_author_meta('display_name', $post->post_author) ?></span>
                    <span class="mr-2"><i class="icon-clock-o"></i> <?php the_time('Y-m-d H:i') ?></span>
                    <span class="mr-2"><i class="icon-eye"></i> <?php echo bzg_post_views(); ?>次浏览</span>
                    <span class="mr-2"><i class="icon-edit"></i> <?php comments_popup_link('0 条评论', '1 条评论', '% 条评论', 'comment_a', '评论已关闭'); ?></span>
                    <span><i class="icon-book"></i><a class="comment_a" href="<?php echo $the_post_category_link;?>" title="所属分类：<?php  echo $the_post_category_name; ?>"><?php  echo $the_post_category_name; ?></a> </span>
                </div>
            </div>
            <div class="divider"></div>
            <div class="thread-content message break-all">
                <!--内容区-->
                <!--文章是否已经很久未更新-->
                <?php baolog_is_overdue() ?>
                <!--活动过期时间-->

                <!--文章内容-->
                <?php the_content(); ?>
                <div class="mt-3 mb-3" style="max-width: 770px;height: auto;">
                    <?php baolog_advertisement("single-content-bottom"); ?>
                </div>
                <div class="thread-footer plugin d-flex justify-content-center my-4">
                    <!--like-->
                    <div class="haya-favoriter px-2">
	<span class="btn-group haya-favoriter-info" role="group">
					<button class="btn btn-outline-secondary js-haya-favorite-tip" href="javascript:;"
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
                    <!--share-->
                    <div class="share px-2">
                        <!--要启用主题的时候就得自动建立page -->
                        <a href="#" data-toggle="modal" data-target="#shareModal"
                           class="btn btn-outline-info share-post">分享文章</a>
                    </div>
                    <!--support-->
                    <div class="support-author px-2">
                        <a  website="<?php
                        $options = get_option('baolog_framework');
                        echo $options['baolog-page-support'];
                        ?>" class="btn btn-outline-danger support-us">赞助网站</a>



                    </div>
                </div>

                <!-- share Modal -->
                <div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModal"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content share-modal">
                            <div class="modal-header" style="border-bottom:none;">
                                <h5 class="modal-title" id="shareModalLabel">选择分享的方式</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!--share style-->
                                <div class="px-2 d-flex justify-content-around ">
                                    <a href="#" class="share-logo icon-wx" title="分享到微信" data-toggle="modal" data-target="#wxModalCenter"></a>
                                    <a href="http://v.t.sina.com.cn/share/share.php?url=<?php the_permalink(); ?>&title=<?php echo the_title();echo ' | ';echo bloginfo('name'); ?>&content=utf-8" rel=”nofollow” class="share-logo icon-wb" title="分享到微博" target="_blank"></a>
                                    <a href="https://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php the_permalink(); ?>&title=<?php echo the_title();echo ' | ';echo bloginfo('name'); ?>&content=utf-8" class="share-logo icon-qqzone" title="分享到QQ空间" target="_blank"></a>
                                    <a href="https://connect.qq.com/widget/shareqq/index.html?url=<?php the_permalink(); ?>&title=<?php echo the_title();?>" class="share-logo icon-qq-1" title="分享到QQ" target="_blank"></a>
                                </div>
                            </div>
                            <div class="modal-footer" style="border-top:none;">
                            </div>
                        </div>
                    </div>
                </div>

                <!--wx-share-modal-->
                <div class="modal fade" id="wxModalCenter" tabindex="-1" role="dialog" aria-labelledby="wxModalCenter" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content share-modal">
                            <div class="modal-header" style="border-bottom:none;">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="wxModal">
                                    <div class="d-flex flex-column">
                                        <p class="d-flex justify-content-center mb-3 font-weight-bold">本文章的二维码</p>
                                        <div class="d-flex justify-content-center  px-2">
                                            <img class="w-75 h-75" src="http://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php the_permalink(); ?>" alt="<?php the_title(); ?>"/>
                                        </div>
                                        <p class="d-flex justify-content-center mt-3 font-weight-ligh">用手机扫码打开本页</p>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer" style="border-top:none">

                            </div>
                        </div>
                    </div>
                </div>

                <!--support-modal-->
                <div class="modal fade" id="supportModalCenter" tabindex="-1" role="dialog" aria-labelledby="supportModalCenter" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered " role="document">
                        <div class="modal-content share-modal">
                            <div class="modal-header" style="border-bottom:none;">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="nav flex-column nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">支付宝</a>
                                            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">微信</a>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab"><img src="<?php
                                                $options = get_option( 'baolog_framework' );
                                                echo $options['baolog-support-alipay'];
                                                ?>"></div>
                                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab"><img src="<?php
                                                $options = get_option( 'baolog_framework' );
                                                echo $options['baolog-support-wechat'];
                                                ?>"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer" style="border-top:none">
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

<script>
    $('.share-logo').click(function (){
        $('#shareModal').modal('hide')
    })
    $('#wxModalCenter').on('hidden.bs.modal', function (e) {
        $('#shareModal').modal('show')
    })
    $(".support-author").click(function(){
        $("#supportModalCenter").modal({

        });
    });
</script>