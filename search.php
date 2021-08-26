<?php get_header(); ?>
<body>
<main id="body">
    <div class="container">
        <div class="divider"></div>
        <div>
            <form action="<?php echo home_url('/'); ?>" id="form" method="get">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="关键词" name="s" value="<?php the_search_query(); ?>">
                    <div class="input-group-append">
                        <button class="btn btn-danger" type="submit" id="submit">搜索</button>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-check-inline">
                        <input class="form-check-input" type="radio" name="range" value="1" checked> 主题贴
                    </label>
                </div>
            </form>

            <ul class="nav nav-tabs">
                <li class="nav-item">
			<span class="nav-link active">主题列表</span>
                </li>

            </ul>
            <ul class="list-group post-list mt-3">
                <style type="text/css" data-model="huux_hlight">.huux_thread_hlight_style1{color: #D9534D;font-weight:normal}.huux_thread_hlight_style2{color: #ee9a22;font-weight:normal}  .huux_thread_hlight_style3{color: #318aa4;font-weight:normal}  .huux_thread_hlight_style4{color: #5CB85C;font-weight:normal}  .huux_thread_hlight_style5{color: #337AB7;font-weight:normal}</style>
               <!--search posts-->
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <li class="list-group-item px-0">
                    <div class="subject break-all">
                       <!--标题-->
                        <h2><a class="mr-1" href="<?php the_permalink(); ?>""
                            title="<?php the_title(); ?>" target="_blank" rel="bookmark"><?php the_title(); ?></a></h2>
                        <!--标签-->
                        <?php the_tags('', '', ''); ?>
                    </div>
                    <!--时间-->
                    <span class="num-font text-muted" style="flex-shrink: 0;">
							<?php the_time('Y-m-d H:i') ?></span>
                </li>
                <?php endwhile; ?>

            </ul>
            <!--分页-->
            <ul class="pagination justify-content-center mt-md-5 mt-3 num-font">
                <?php baolog_pagenavi(); ?>
            </ul>
            <?php else : ?>
                <div class="subject break-all">
                   <h2>没有找到有关<span style="font-size: 15px" class="text-danger text-sm"><?php the_search_query(); ?></span>的主题哦~</h2>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-lg-3 hidden-sm hidden-md">

        </div>


    </div>
</main>

<!-- sidebar -->
<?php
get_sidebar();
?>
<!--footer-->
<?php get_footer(); ?>

<script>
    jsearch_form = $('#form');
    jsearch_form.on('submit', function() {
        var keyword = jsearch_form.find('input[name="s"]').val();
        if($.trim(keyword) == '') {
            $.alert('请输入关键词后再搜索...',30,{size:'sm'});
            return false;
        }

    });
</script>




