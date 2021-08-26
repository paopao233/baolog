<?php
/*
* @author parklot
* @link https://github.com/paopao233
 */
/*
Template Name: 首页一天内热门文章
*/
get_header(); ?>
<body mpa-version="7.16.12" mpa-extension-id="aidjohbjielfdhcaookdaolppglahebo" data-new-gr-c-s-check-loaded="14.990.0"
      data-gr-ext-installed="">
<!--header-->
<main id="body">
    <div class="container">
        <div class="divider"></div>

        <div class="post-body">
            <!--首页导航 需要自己添加进去-->
            <?php
            if (has_nav_menu('menu_index')){
                wp_nav_menu(array(
                        'theme_location' => 'menu_index',
                        'container_class' => 'menu_index',
                        'menu_class' => 'nav justify-content-center',
                        'menu_id' => 'menu-idex-items',
                        'fallback_cb' => '', 'depth' => 0
                ));
            }else{
                echo '<ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link" href="'.get_option('home').'">最新线报</a>
                </li>';
                echo '<li class="nav-item">
                    <a class="nav-link active" href="'.get_option('home').'/wp-admin/nav-menus.php">
                                在后台添加导航</a>
							</li>';
                echo '<li class="nav-item">
                    <a class="nav-link" href="'.get_option('home').'/wp-admin/nav-menus.php">
                                我是首页导航</a>
							</li>';
                echo '</ul>';
            }
            ?>
            <!--获取一天内热门文章-->
            <?php if (baolog_get_most_viewed(15, 1) != ''){

            }else{
                echo "没有文章显示了~";
            }
            ?>
        </div>

    </div>
</main>

<!-- sidebar -->
<?php
get_sidebar();
?>
<!--footer-->
<?php get_footer(); ?>