<?php
/*
* @author parklot
* @link https://github.com/paopao233
 */
get_header(); ?>
    <body mpa-version="7.16.12" mpa-extension-id="aidjohbjielfdhcaookdaolppglahebo" data-new-gr-c-s-check-loaded="14.990.0"
          data-gr-ext-installed="">
<!--header-->
<main id="body">
    <div class="container">
        <div class="divider"></div>
        <!--文章内容区-->
        <div class="post-body">
            <!--首页-->
            <div class="text-center bg-light py-2">
                "<span class="text-danger"> <?php single_tag_title(); ?> </span>" 的相关活动线报
            </div>
            <!--blog posts-->
            <ul class="list-group post-list mt-3">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <li class="list-group-item px-0">
                        <div class="subject break-all">
                            <h2><a class="mr-1" href="<?php the_permalink(); ?>""
                                title="<?php the_title(); ?>" target="_blank" rel="bookmark"><?php the_title(); ?></a>
                            </h2>
                            <?php the_tags('', '', ''); ?>
                        </div>
                        <span class="num-font text-muted" style="flex-shrink: 0;"><?php the_time('Y-m-d H:i') ?>
							</span>
                    </li>
                <?php endwhile; ?>

            </ul>
        <!--分页-->
            <ul class="pagination justify-content-center mt-md-5 mt-3 num-font">
                <?php baolog_pagenavi(); ?>
            </ul>
        <?php endif; ?>

        </div>


    </div>
</main>

<!-- sidebar -->
<?php
get_sidebar();
?>
<!--footer-->
<?php get_footer(); ?>