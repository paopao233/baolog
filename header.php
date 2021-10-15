<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
            echo "搜索结果";
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
    global $set;
    $options = get_option('baolog_framework');
    $keywords = $options['baolog-keywords'];
    $description = $options['baolog-description'];
    if (is_home()) {
        if ($description == null) {
            $description = get_bloginfo('description');
        }
    } else if (is_single() || is_page()) {
        global $post;
        global $baolog_post_meta;
        $baolog_post_meta = json_decode(get_post_meta($post->ID, 'baolog_post_meta', true), true);
        if (empty($baolog_post_meta['seo']['open'])) {
            $baolog_post_meta['seo']['open'] = 0;
        }
        if (empty($baolog_post_meta['closesidebar'])) {
            $baolog_post_meta['closesidebar'] = 0;
        }
        if (empty($baolog_post_meta['postrighttag']['open'])) {
            $baolog_post_meta['postrighttag']['open'] = 0;
        }
        if (empty($baolog_post_meta['catalog'])) {
            $baolog_post_meta['catalog'] = 0;
        }

        if ($baolog_post_meta['seo']['open'] == 1) {
            $description = $baolog_post_meta['seo']['description'];
            $keywords = $baolog_post_meta['seo']['keywords'];
        } else {
            $description = str_replace("\n", "", mb_strimwidth(strip_tags($post->post_content), 0, 200, "…", 'utf-8'));
            $tags = wp_get_post_tags($post->ID);
            foreach ($tags as $tag) {
                $keywords = $keywords . $tag->name . ", ";
            }
            $keywords = rtrim($keywords, ', ');
        }
    } elseif (is_tag()) {
        // 标签的description可以到后台 - 文章 - 标签，修改标签的描述
        $description = tag_description();
        $keywords = single_tag_title('', false);
    } elseif (is_category()) {
        $description = category_description();
        $keywords = single_tag_title('', false);
    }
    $description = trim(strip_tags($description));
    $keywords = trim(strip_tags($keywords));

    if (post_password_required() == false) {
        ?><meta name="keywords" content="<?php echo $keywords; ?>"/>
    <meta name="description" content="<?php echo $description; ?>"/>
    <?php
    }
    ?><meta name="renderer" content="webkit"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta http-equiv="Cache-Control" content="no-transform">
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <link rel="shortcut icon" href="<?php
    $options = get_option('baolog_framework');
    echo $options['baolog-favicon'];
    ?>">
    <link rel="icon" sizes="32x32" href="<?php
    $options = get_option('baolog_framework');
    echo $options['baolog-favicon'];
    ?>">
    <link rel="Bookmark" href="<?php
    $options = get_option('baolog_framework');
    echo $options['baolog-favicon'];
    ?>">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/ghboke/corepresscdn@master/static/lib/fontawesome5pro/css/all.min.css?v=5.6">
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/bootstrap.css">
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/baolog.css">
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/huux-notice.css" name="huux_notice">
    <?php wp_head(); ?>
    <style>
        table.nav_tag_list {
            margin-bottom: 0.2rem;
        }

        table.nav_tag_list td {
            padding: 0.3rem;
        }

        table.nav_tag_list td a {
            margin-right: 0.2rem;
        }

        .nav_tag_list .active {
            font-weight: normal
        }

        .tag_option {
            border: 1px solid #bbb;
            padding: 1px 10px;
            border-radius: 10px;
            text-decoration: none;
        }

        .tag_option:active,
        .tag_option.active {
            border: 1px solid #000;
            background: #000;
            color: #fff;
            text-decoration: none;
        }
    </style>
    <style type="text/css" data-model="huux_hlight">
        .huux_thread_hlight_style1 {
            color: #D9534D;
            font-weight: normal
        }

        .huux_thread_hlight_style2 {
            color: #F0AD4E;
            font-weight: normal
        }

        .huux_thread_hlight_style3 {
            color: #5BC0DE;
            font-weight: normal
        }

        .huux_thread_hlight_style4 {
            color: #5CB85C;
            font-weight: normal
        }

        .huux_thread_hlight_style5 {
            color: #337AB7;
            font-weight: normal
        }
    </style>

    <style class="mpa-style-fix ImageGatherer">
        .FotorFrame {
            position: fixed !important
        }
    </style>
    <style class="mpa-style-fix SideFunctionPanel">
        .weui-desktop-online-faq__wrp {
            top: 304px !important;
            bottom: unset !important
        }

        .weui-desktop-online-faq__wrp .weui-desktop-online-faq__switch {
            width: 38px !important
        }
    </style>

</head>

<!--刷新缓存-->
<?php flush(); ?>
<div class="header mb-3">
    <div class="container">
        <div class="jumbotron bg-white mb-0 text-center hidden-sm">
            <h1><a href="<?php echo get_option('home'); ?>"><?php bloginfo('name') ?></a></h1>
            <span class="text-grey"><?php
                $options = get_option('baolog_framework');
                echo $options['baolog-description'];
                ?></span>
        </div>
        <div class="d-sm-none d-block text-center mt-4">
            <h2><a href="<?php echo get_option('home'); ?>"><?php bloginfo('name') ?></a></h2>
        </div>
        <!--primary menu-->
        <nav class="row">
            <?php
            if (has_nav_menu('menu_primary')) {
                wp_nav_menu(array(
                        'theme_location' => 'menu_primary',
                        'container_class' => 'col-sm-8 px-0',
                        'menu_class' => 'nav sm-center',
                        'menu_id' => 'menu-primary-items',
                        'fallback_cb' => '', 'depth' => 2,
                        'walker' => new baolog_Walker_Nav_Menu())
                );
            } else {
                echo '<div class="col-sm-8 px-0">
						<ul class="nav sm-center">
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
            <div class="col-sm-4">
                <?php get_search_form(); ?>
            </div>
        </nav>
    </div>
</div>