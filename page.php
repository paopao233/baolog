<?php get_header(); ?>
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
                <?php the_content(); ?>
                 </div>
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

                  <!--share-->
                <div class="share px-2">
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
            
            
                <?php
                get_template_part('inc/component/content-modal');
                ?>


                </div>
                
                <!--返回首页-->
                <div class="back_index text-center num-font mb-4">
                    <a href="<?php echo get_option('home'); ?>" class="text-small" style="color: gray;">
                        << · Back Index ·>>
                    </a>
                </div>
           
            <div class="divider"></div>
            <?php comments_template(); ?>
        </div>
</main>

<!-- sidebar -->
<?php
get_sidebar();
?>
<!--footer-->
<?php get_footer(); ?>

