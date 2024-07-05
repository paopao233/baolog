<?php
/*
* @author parklot
* @link https://github.com/paopao233
* Template Name: tougao
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
                    <span class="mr-2"><i
                                class="icon-edit"></i> <?php comments_popup_link('0 条评论', '1 条评论', '% 条评论', 'comment_a', '评论已关闭'); ?>
                    </span>
                    <span class="mr-2"><i class="icon-book"></i><a class="comment_a"
                                                                   href="<?php echo $the_post_category_link; ?>"
                                                                   title="所属分类：<?php echo $the_post_category_name; ?>"><?php echo $the_post_category_name; ?></a>
                    </span>
                    <span>
                         <?php if (current_user_can('administrator')) {
                             echo '<i class="icon-edit"></i>';
                             edit_post_link('编辑');
                         } ?>
                     </span>
                </div>
            </div>

            <div class="divider"></div>
            <div class="thread-content message break-all">
                <!--内容区-->
                <!--文章内容-->
                <?php the_content(); ?>
                <form method="post" action="<?php echo $_SERVER["REQUEST_URI"];
                $current_user = wp_get_current_user(); ?>" class="row">
                <div class="t1 tt col-sm-4">
                    <div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="icon icon-user icon-fw"></i></span>
						</div>
						<input class="form-control" type="text" size="40" placeholder="昵称*"
                           value="<?php if (0 != $current_user->ID) echo $current_user->user_login; ?>" name="tougao_authorname" ;id="tougao_authorname" tabindex="1" />
					</div>                                  
                </div>
                <div class="t2 tt col-sm-4">
                    <div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="icon icon-envelope icon-fw"></i></span>
						</div>
				       <input class="form-control" type="text" size="40" placeholder="您的邮箱*"
                           value="<?php if (0 != $current_user->ID) echo $current_user->user_email; ?>" name="tougao_authoremail"
                           id="tougao_authoremail" tabindex="2"/>
					</div>    
                </div>
                <div class="t3 tt col-sm-4">
                     <div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="icon icon-link icon-fw"></i></span>
						</div>
		                 <input class="form-control" type="text" size="40" placeholder="您的网站"
                           value="<?php if (0 != $current_user->ID) echo $current_user->user_url; ?>" name="tougao_site"
                           id="tougao_site" tabindex="4"/>
			    	</div>    
                </div>
                <div class="t4 tt col-sm-4">
                    <div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="icon icon-font icon-fw"></i></span>
						</div>
                          <input class="form-control" type="text" size="40" value="" name="tougao_title" id="tougao_title" tabindex="3" placeholder="文章标题*（6到50字之间）"/>
			    	</div>
                </div>
                <div class="t5 tt col-sm-4">
                    <div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="icon icon-flag icon-fw"></i></span>
						</div>
                         <input class="form-control" type="text" size="40" value="" name="tougao_tags" id="tougao_tags" tabindex="5" placeholder="文章标签*（以英文逗号分开"/>
			    	</div>
                </div>
                <div class="t6 tt col-sm-4">
                    <!--文章分类*(必选)-->
                    <div class="form-group input-group">
            			<div class="input-group-prepend">
							<span class="input-group-text"><i class="icon icon-reorder icon-fw"></i></span>
						</div>
                            <?php wp_dropdown_categories('show_count=0&hierarchical=1&hide_empty=0&class=form-control'); ?>
                        
                    </div>
                </div>
                    <div class="clear"></div>
                    <div id="postform">
                        <textarea rows="15" cols="70" class="form-control col-sm-12" id="tougao_content"
                                  name="tougao_content" tabindex="6" placeholder="请输入文章内容...注意文章是带格式化的。"></textarea>
                        <p>字数限制：50到1000字之间</p>
                    </div>
                    <div class="col-sm-12" id="submit_post">
                        <input type="hidden" value="send" name="tougao_form"/>
                        <input class="btn btn-danger pull-right" type="submit" name="submit" value="投稿文章" tabindex="7"/>
                        <input class="btn btn-outline-secondary pull-right" type="reset" name="reset" value="重填内容" tabindex="8"/>
                    </div>
                </form>
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

                	<button class="btn btn-outline-secondary"
                            title="当前有 <?php if (get_post_meta($post->ID, 'specs_zan', true)) {
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
                    <a website="<?php
                    $options = get_option('baolog_framework');
                    echo $options['baolog-page-support'];
                    ?>" class="btn btn-outline-danger support-us">赞助网站</a>
                </div>

                <?php
                get_template_part('component/content-modal');
                ?>

            </div>
            
            <!--返回首页-->
            <div class="back_index text-center num-font mb-4">
                <a href="<?php echo get_option('home'); ?>" class="text-small" style="color: gray;">
                    << · Back Index ·>>
                </a>
            </div>

            <!--评论页面 -->
            <?php
            //上面出现的相关文章混乱了当前文章id 需要重置一下postid
            wp_reset_postdata();
            comments_template(); ?>
        </div>
</main>
<script type="text/javascript" src="<?php echo home_url(); ?>/wp-includes/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        selector: '#tougao_content',
        menubar: false,
        //toolbar: false,
    });
</script>
<!-- sidebar -->
<?php
get_sidebar();
?>
<!--footer-->
<?php get_footer(); ?>

