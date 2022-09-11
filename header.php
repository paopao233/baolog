<?php
$options = get_option('baolog_framework');
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="content-language" content="zh-CN">
    <meta name="robots" Content="index,follow"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit"/>
    <meta http-equiv="Cache-Control" content="no-transform">
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <title><?php if (is_home()) {
            bloginfo('name');
            echo " - ";
            bloginfo('description');
        } else if (is_category()) {
            single_cat_title();
            echo " - ";
            bloginfo('name');
        } else if (is_single()) {
            single_post_title();
            echo " - ";
            bloginfo('name');
        } else if (is_search()) {
            echo '"' . get_search_query() . '"的搜索结果';
            echo " - ";
            bloginfo('name');
        } else if (is_404()) {
            echo "页面未找到";
        } else if (is_tag()) {
            single_tag_title();
            echo " - ";
            bloginfo('name');
        } else {
            wp_title('', true);
            echo " - ";
            bloginfo('name');
        } ?></title>
    <?php
    $keywords = $options['baolog-keywords'];
    $description = $options['baolog-description'];
    if (is_home()) {
        if ($description == null) {
            $description = get_bloginfo('description');
        }
    } else if (is_single()) {
        global $post;
        $post_excerpt = get_post_meta($post->ID, 'description', true);
        $keywords = get_post_meta($post->ID, 'keywords', true);
        if ($post_excerpt != "") {
            $description = $post_excerpt;
        } else {
            $description = str_replace("\n", "", mb_strimwidth(strip_tags($post->post_content), 0, 200, "…", 'utf-8'));
        }

        if ($keywords == '') {
            $tags = wp_get_post_tags($post->ID);
            foreach ($tags as $tag) {
                $keywords = $keywords . $tag->name . ", ";
            }
            $keywords = rtrim($keywords, ', ');
        }
    } else if (is_tag()) {
        // 标签的description可以到后台 - 文章 - 标签，修改标签的描述
        $description = tag_description();
        $keywords = single_tag_title('', false);
        if ($description == '') {
            $description = "这是" . $keywords . "的标签页面描述";
        }

    } else if (is_category()) {
        $description = category_description();
        $keywords = single_tag_title('', false);
        if ($description == '') {
            $description = "这是" . $keywords . "的目录页面描述";
        }
    } else if (is_page()) {
        global $post;
        $keywords = get_post_meta($post->ID, 'keywords', true);
        $description = get_post_meta($post->ID, 'description', true);
        $page_title = explode(" &#8211; ", wp_get_document_title());
        if ($description == '') {
            $description = "这是" . $page_title[0] . "的页面描述";
        }
        if ($keywords == '') {
            $keywords = $page_title[0];
        }
    }

    $description = trim(strip_tags($description));
    $keywords = trim(strip_tags($keywords));

    if (post_password_required() == false) { ?>
        <meta name="description" content="<?php echo $description; ?>"/>
        <meta name="keywords" content="<?php echo $keywords; ?>"/>
    <?php } else { ?>
        <meta name="keywords" content="加密页面"/>
        <meta name="description" content="这是一个加密页面，请输入密码后再查看~"/>
    <?php } ?>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <link rel="icon" sizes="32x32" href="<?php
    echo $options['baolog-favicon'];
    ?>">
    <link rel="Bookmark" href="<?php
    echo $options['baolog-favicon'];
    ?>">

    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen"/>
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/bootstrap.css">
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/baolog.css">
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/huux-notice.css" name="huux_notice">
    <?php wp_head(); ?>
</head>

<!--刷新缓存-->
<?php flush(); ?>
<div class="header mb-3">
    <div class="container">
        <?php if (_lot('baolog-native-nav')) {
            echo '<div class="jumbotron bg-white mb-0 text-center hidden-sm">';
        } else {
            echo '<div class="jumbotron d-lg-block d-none bg-white mb-0 text-center ">';
        }
        ?>
        <h1><a href="<?php echo get_option('home'); ?>"><?php bloginfo('name') ?></a></h1>
        <span class="text-grey"><?php
            $options = get_option('baolog_framework');
            echo $options['baolog-description'];
            ?></span>
    </div>
    <?php
    if (_lot('baolog-native-nav')) {
        echo '<div class="d-sm-none d-block text-center mt-4 navbar-logo-brand"><h2><a href="';
        echo get_option('home') . '">';
        echo bloginfo('name') . '</a></h2></div>';
    }
    ?>

    <!--primary menu-->
    <?php
    if (!_lot('baolog-native-nav')) {
        echo '<nav class="row navbar navbar-expand-lg">';
        echo '<button class="navbar-toggler border-0 pl-0" type="button" data-toggle="collapse"
                data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="iconfont icon-bars"></span></button>';
        echo '<div class="d-lg-none d-block text-center mt-4 navbar-logo-brand"><h2><a href="';
        echo get_option('home') . '">';
        echo bloginfo('name') . '</a></h2></div>';
    } else {
        echo '<nav class="row">';
    }

    if (has_nav_menu('menu_primary')) {
        if (_lot('baolog-native-nav')) {
            wp_nav_menu(array(
                    'theme_location' => 'menu_primary',
                    'container_class' => 'col-sm-8 px-0',
                    'menu_class' => 'nav sm-center',
                    'menu_id' => 'menu-primary-items',
                    'fallback_cb' => '', 'depth' => 2,
                    'walker' => new baolog_Walker_Nav_Menu())
            );
        } else {
            wp_nav_menu(array(
                    'theme_location' => 'menu_primary',
                    'container_class' => 'col-md-8 px-0 collapse navbar-collapse',
                    'container_id' => 'navbarContent',
                    'menu_class' => 'nav sm-center',
                    'menu_id' => 'menu-primary-items',
                    'fallback_cb' => '', 'depth' => 2,
                    'walker' => new baolog_Walker_Nav_Menu())

            );
        }

    } else {
        if (_lot('baolog-native-nav')) {
            echo '<div class="col-sm-8 px-0">';
        } else {
            echo '<div class="col-md-8 px-0 collapse navbar-collapse" id="navbarContent">';
        }
        echo '<ul class="nav sm-center">
							<li class="nav-item">
								<a class="nav-link" href="' . get_option('home') . '"> 
								首页 </a>
							</li>';
        echo '<li class="nav-item">
								<a class="nav-link" href="' . get_option('home') . '/wp-admin/nav-menus.php">
                                请到后台添加导航(我是主导航)</a>
							</li>';
        echo '</ul></div>';
    }
    ?>

    <!--搜索-->
    <?php
    if (!_lot('baolog-native-nav')) {
        echo '<button class="navbar-toggler border-0 px-1 ml-auto" type="button" data-toggle="collapse"
                data-target="#navbarSearch"
                aria-controls="navbarSearch" aria-expanded="false" aria-label="Search navigation">
            <span class="iconfont icon-search"></span></button>';
        echo '<div class="col-md-auto collapse navbar-collapse navbar-collapse-search" id="navbarSearch">';
    } else {
        echo '<div class="col-sm-4">';
    }
    ?>
    <?php get_search_form(); ?>
</div>
</nav>
</div>
</div>