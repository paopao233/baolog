<?php
/*
* @author parklot
* @link https://github.com/paopao233
 */
get_header();
$the_post_category_name = get_the_category(get_the_ID())[0]->cat_name;
$the_post_category_link = get_category_link(get_the_category(get_the_ID())[0]->term_id);
$options = get_option('baolog_framework');
?>
<body>
<main id="body">
    <div class="container">
        <div class="divider"></div>
        <div class="breadcrumb bg-light d-none d-md-flex">
            <li class="breadcrumb-item"><i class="icon icon-home mr-2"></i><a href="<?php echo get_option('home'); ?>">首页</a>
            </li>
            <li class="breadcrumb-item"><a href="<?php echo $the_post_category_link;?>" title="<?php  echo $the_post_category_name; ?>"><?php  echo $the_post_category_name; ?></a></li>
      
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
                    <span class="mr-2"><i class="icon-edit"></i> <?php comments_popup_link('0 条评论', '1 条评论', '% 条评论', 'comment_a', '评论已关闭')
                    ; ?>
                    </span>
                    <span class="mr-2"><i class="icon-book"></i><a class="comment_a" href="<?php echo $the_post_category_link;?>" title="所属分类：<?php  echo $the_post_category_name; ?>"><?php  echo $the_post_category_name; ?></a>
                    </span>
                     <span>
                         <?php if(current_user_can( 'administrator')){echo '<i class="icon-edit"></i>';edit_post_link('编辑');}?>
                     </span>
                </div>
            </div>
            
            <div class="divider"></div>
            <div class="thread-content message break-all">
                <!--内容区-->
                <!--文章是否已经很久未更新-->
                <?php baolog_is_overdue() ?>
                <!--文章内容-->
                <?php the_content(); ?>
                <div class="mt-3 mb-3" style="max-width: 770px;height: auto;">
                    <?php baolog_advertisement("single-content-bottom"); ?>
                </div>
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
                get_template_part('component/content-modal');
                ?>

                </div>
                
               <?php if($options['baolog-posts-content-tips'] == 1):?>
               <div class="thread-content-tips">
                    <div class="alert alert-warning text-center small" role="alert">
                    <?php echo $options['baolog-posts-content-tips-change']; ?>
                    </div>
                </div>
                <?php endif; ?>
                
                 <!--返回首页-->
                <div class="back_index text-center num-font mb-4">
                    <a href="<?php echo get_option('home'); ?>" class="text-small" style="color: gray;">
                        << · Back Index ·>>
                    </a>
                </div>
            
            <div class="divider"></div>
            <div class="related-body">
                <h5 class="text-center font-weight-bold">相关文章</h5>
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

