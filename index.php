<?php get_header(); ?>
    <body mpa-version="7.16.12" mpa-extension-id="aidjohbjielfdhcaookdaolppglahebo"
          data-new-gr-c-s-check-loaded="14.990.0"
          data-gr-ext-installed="">
<!--header-->
<main id="body">
    <div class="container">
        <div class="divider"></div>
        <!--文章内容区-->
        <div class="post-body">
            <!--首页导航-->
            <?php
            $options = get_option('baolog_framework');
            $is_open = $options['baolog-index-menu'];
            if ($is_open == true){
                if (has_nav_menu('menu_index')) {
                    wp_nav_menu(array(
                        'theme_location' => 'menu_index',
                        'container_class' => 'menu_index',
                        'menu_class' => 'nav justify-content-center',
                        'menu_id' => 'menu-idex-items',
                        'fallback_cb' => '', 'depth' => 0
                    ));
                } else {
                    echo '<ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link" href="' . get_option('home') . '">最新线报</a>
                </li>';
                    echo '<li class="nav-item">
                    <a class="nav-link active" href="' . get_option('home') . '/wp-admin/nav-menus.php">
                                在后台添加导航</a>
							</li>';
                    echo '<li class="nav-item">
                    <a class="nav-link" href="' . get_option('home') . '/wp-admin/nav-menus.php">
                                我是首页导航</a>
							</li>';
                    echo '</ul>';
                }
            }
            ?>
            <!--blog posts-->
            <ul class="list-group post-list mt-3">
            <!-- 获取文章-->
            <?php balolog_get_the_posts();?>

            </ul>
            <!--分页-->
            <ul class="pagination justify-content-center mt-md-5 mt-3 num-font">
                <?php baolog_pagenavi(); ?>
            </ul>


        </div>


    </div>
</main>

<!-- sidebar -->
<?php
get_sidebar();
?>
<!--footer-->
<?php get_footer(); ?>