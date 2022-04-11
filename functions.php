<?php
if (!defined('ABSPATH')) {
    exit;
}
/**
 * Copyright 2021, https://github.com/paopao233
 * All right reserved.
 *
 * @author parklot
 * @date 2021-8月-9日 20:29
 * @license GPL v3 LICENSE
 */
date_default_timezone_set("PRC");
define('THEME_NAME', 'BaoLog');
define('THEME_VERSIONNAME', '0.4.2');
define('THEME_DOWNURL', 'https://www.guluqiu.cc');

include(get_template_directory() . '/inc/functions.php');
require_once dirname(__FILE__) . '/framework/baolog-framework.php';

/**
 * functions
 */

// 获取后台选项配置
function _lot($name, $default = false)
{
    $option_name = 'baolog_framework';

    // Get option settings from database
    $options = get_option($option_name);

    // Return specific option
    if (isset($options[$name])) {
        return $options[$name];
    }

    return $default;
}

//获取后台主题选项参数
$options = get_option('baolog_framework');

//禁用5.0编辑器
$is_gutenberg = $options['baolog-gutenberg'];
if ($is_gutenberg == 1) {
    add_filter('use_block_editor_for_post_type', '__return_false');
    remove_action('wp_enqueue_scripts', 'wp_common_block_scripts_and_styles');
}

//禁用文章自动保存功能
$is_autosave = $options['baolog-posts-autosave'];
if ($is_autosave == 1) {
    add_action('wp_print_scripts', 'fanly_no_autosave');
    function fanly_no_autosave()
    {
        wp_deregister_script('autosave');
    }
}

//禁用WordPress修订版本
$is_revisions_to_keep = $options['baolog-posts-revisions-to-keep'];
if ($is_revisions_to_keep == 1) {
    add_filter('wp_revisions_to_keep', 'fanly_wp_revisions_to_keep', 10, 2);
    function fanly_wp_revisions_to_keep($num, $post)
    {
        return 0;
    }
}


//添加菜单
add_action('after_setup_theme', 'baolog_setup');
function baolog_setup()
{
    // register_nav_menus(); 是注册所有的 不能有选择
    register_nav_menus(array(
        'menu_primary' => '主导航',

    ));
}

//导航相关
//更改li样式
function baolog_menu_classes($classes, $item, $args)
{
    if ($args->theme_location == 'menu_primary') { //这里的 main 是菜单id
        $classes[] = 'nav-item'; //这里的 nav-item 是要添加的class类
    }
    return $classes;
}

//更改li a样式
function baolog_menu_link_class($atts, $item, $args)
{
    //有二级的一级a标签的class名是 nav-link dropdown-toggle
    if ($args->theme_location == 'menu_primary') {//这里的 main 是菜单id

        //如果是子菜单的话
        if (!$item->has_children && $item->menu_item_parent > 0) {
            // 子菜单的a标签样式
            $atts['class'] = 'dropdown-item';
        } else {
            $atts['class'] = 'nav-link';
        }
    }

    return $atts;
}

add_filter('nav_menu_link_attributes', 'baolog_menu_link_class', 1, 3);
add_filter('nav_menu_css_class', 'baolog_menu_classes', 1, 3);

//walker 导航的二级才需要
class baolog_Walker_Nav_Menu extends Walker_Nav_Menu
{
    //walker开始前添加
    function start_lvl(&$output, $depth = 0, $args = array())
    {
        //更改ul样式
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
        //更改主菜单a的样式
    }


    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        //解决下拉！
        $item_html = '';
        parent::start_el($item_html, $item, $depth, $args);

        if ($item->is_dropdown && $depth === 0) {
            $item_html = str_replace('<a', '<a class="nav-link dropdown-toggle" data-toggle="dropdown"', $item_html);
        }

        $output .= $item_html;
    }

    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
        if ($element->current)
            $element->classes[] = 'active nav_active';

        $element->is_dropdown = !empty($children_elements[$element->ID]);

        if ($element->is_dropdown) {
            if ($depth === 0) {
                $element->classes[] = 'dropdown';
            } elseif ($depth === 1) {
                // Extra level of dropdown menu,
                // as seen in http://twitter.github.com/bootstrap/components.html#dropdowns
                $element->classes[] = 'dropdown-submenu';
            }
        }

        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}

//自动给有二级的导航的li元素增加dropdown blog.guluqiu.cc
function menu_set_dropdown($sorted_menu_items, $args)
{
    $last_top = 0;
    foreach ($sorted_menu_items as $key => $obj) {
        // it is a top lv item?
        if (0 == $obj->menu_item_parent) {
            // set the key of the parent
            $last_top = $key;
        } else {
            $sorted_menu_items[$last_top]->classes['dropdown'] = 'dropdown';
        }
    }
    return $sorted_menu_items;
}

add_filter('wp_nav_menu_objects', 'menu_set_dropdown', 10, 2);

//导航相关结束

// 移除wp-block-library-css
add_action('wp_enqueue_scripts', 'remove_block_library_css', 100);
function remove_block_library_css()
{
    wp_dequeue_style('wp-block-library');
}

// 去掉Wordpress挂件
function disable_dashboard_widgets()
{
    remove_meta_box('dashboard_primary', 'dashboard', 'core');//wordpress博客
    remove_meta_box('dashboard_secondary', 'dashboard', 'core');//wordpress其它新闻
    remove_meta_box('dashboard_right_now', 'dashboard', 'core');//wordpress概况
}

// 去除后台显示底部文字
function my_admin_footer_text()
{
    return '';
}

//开启友情链接
add_filter('pre_option_link_manager_enabled', '__return_true');

//删除wp_head一些配置
//https://blog.csdn.net/xinyflove/article/details/76760922
function remove_admin_login_header()
{
    remove_action('wp_head', '_admin_bar_bump_cb');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'index_rel_link');
    remove_action('wp_head', 'parent_post_rel_link', 10, 0);
    remove_action('wp_head', 'start_post_rel_link', 10, 0);
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'rest_output_link_wp_head', 10);

}

add_action('get_header', 'remove_admin_login_header');

//移除wp_head的dns预处理
function remove_dns_prefetch($hints, $relation_type)
{
    if ('dns-prefetch' === $relation_type) {
        return array_diff(wp_dependencies_unique_hosts(), $hints);
    }
    return $hints;
}

add_filter('wp_resource_hints', 'remove_dns_prefetch', 10, 2);


//the_tags过滤器
// add custom class to tag blog.guluqiu.cc 标签自定义类名
// 几个固定标签样式 京东、红包、淘宝、优惠券、放水、白菜、苏宁
function add_class_the_tags($html)
{
    $postid = get_the_ID();
    $tags = wp_get_post_tags($postid); //this is the adjustment, all the rest is bhlarsen
    $class = '<a class="badge badge-pill mr-1 tag ';
    $badge = array("badge-dark ", "badge-danger ", "badge-primary ", "badge-warning ", "badge-success ", "badge-secondary ", "badge-info ");
    if ($tags != null) {
        //这里是文章的id
        foreach ($tags as $tag) {
            $name = $tag->name;
            //同篇文章中的标签也会得到这个class名 不知道怎么解决
            switch ($name) {
                case "优惠券":
                {
                    $class .= $badge[0];
                    break;
                }
                case "京东":
                {
                    $class .= $badge[1];
                    break;
                }
                case "红包":
                {
                    $class .= $badge[2];
                    break;
                }
                case "淘宝":
                {
                    $class .= $badge[3];
                    break;
                }
                case "白菜":
                {
                    $class .= $badge[4];
                    break;
                }
                case "苏宁":
                {
                    $class .= $badge[5];
                    break;
                }
                case "放水":
                {
                    $class .= $badge[6];
                    break;
                }
                default:
                {
                    $class .= $badge[rand(0, 6)];
                    break;
                }
            }
            break;
        }
    } else {
        //这里的post_id是页面文章的id
        $class .= $badge[rand(0, 6)];
    }
    $class .= '"';
    $html = str_replace("<a", $class, $html);
    return $html;
}

add_filter('the_tags', 'add_class_the_tags');


/**
 * 数字分页函数
 * 因为wordpress默认仅仅提供简单分页
 * 所以要实现数字分页，需要自定义函数
 * @Param int $range 数字分页的宽度
 * @Return string|empty        输出分页的HTML代码
 */
function baolog_pagenavi($page = '', $range = 4)
{
    $code = 'class="page-link"';
    global $paged, $wp_query;
    if (!$max_page) {
        if ($page == '') {
            $max_page = $wp_query->max_num_pages;
        } else {
            $max_page = $page;
        }
    }
    if ($max_page > 1) {
        if (!$paged) {
            $paged = 1;
        }

        //上一页
        echo "<li class='page-item'>";
        previous_posts_link('◀');
        echo "</li>";

        if ($paged != 1) {
            echo "<li class='page-item'>";
            echo "<a href='" . get_pagenum_link(1) . "' class='page-link' title='跳转到首页'>1...</a>";
            echo "</li>";
        }
        if ($max_page > $range) {
            //多页的是这个
            if ($paged < $range) {
                for ($i = 1; $i <= ($range + 1); $i++) {
                    //active link
                    if ($i == $paged) {
                        echo "<li class='page-item active'>";
                    } else {
                        //not active link
                        echo "<li class='page-item'>";
                    };
                    echo "<a href='" . get_pagenum_link($i) . "'";
                    echo " class='page-link'";
                    echo ">$i</a>";
                    echo "</li>";
                }
            } elseif ($paged >= ($max_page - ceil(($range / 2)))) {
                for ($i = $max_page - $range; $i <= $max_page; $i++) {
                    //active link
                    if ($i == $paged) {
                        echo "<li class='page-item active'>";
                    } else {
                        //not active link
                        echo "<li class='page-item'>";
                    };
                    echo "<a href='" . get_pagenum_link($i) . "'";
                    echo " class='page-link'";
                    echo ">$i</a>";
                    echo "</li>";
                }
            } elseif ($paged >= $range && $paged < ($max_page - ceil(($range / 2)))) {
                for ($i = ($paged - ceil($range / 2)); $i <= ($paged + ceil(($range / 2))); $i++) {
                    //active link
                    if ($i == $paged) {
                        echo "<li class='page-item active'>";
                    } else {
                        //not active link
                        echo "<li class='page-item'>";
                    };
                    echo "<a href='" . get_pagenum_link($i) . "'";
                    echo " class='page-link'";
                    echo ">$i</a>";
                    echo "</li>";
                }
            }

        } else {
            //几页的是这个 可能3
            for ($i = 1; $i <= $max_page; $i++) {
                //active link
                if ($i == $paged) {
                    echo "<li class='page-item active'>";
                } else {
                    //not active link
                    echo "<li class='page-item'>";
                };
                echo "<a href='" . get_pagenum_link($i) . "'";
                echo " class='page-link'";
                echo ">$i</a>";
                echo "</li>";
            }
        }

        if ($paged != $max_page) {
            echo "<li class='page-item'>";
            echo "<a href='" . get_pagenum_link($max_page) . "' class='page-link' title='跳转到最后一页'>...$max_page</a>";
            echo "</li>";
        }

        //下一页
        echo "<li class='page-item'>";
        next_posts_link('▶');
        echo "</li>\n";

    }
}

//给上/下一页添加class blog.guluqiu.cc
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');
function posts_link_attributes()
{
    return 'class="page-link"';
}

/**
 * 文章相关
 */
/* 访问计数 */
//https://www.beizigen.com/1615.html
function bzg_set_post_views()
{
    global $post;
    if (!isset($post->ID) || !is_singular()) return;
    $cookie_name = 'views_' . $post->ID;
    if (isset($_COOKIE[$cookie_name])) return;
    $post_views = (int)get_post_meta($post->ID, 'views', true);
    if (empty($post_views)) {
        $post_views = 1;
    } else {
        $post_views = $post_views + 1;
    }
    update_post_meta($post->ID, 'views', $post_views);
    setcookie($cookie_name, 'yes', (current_time('timestamp') + 86400));
}

add_action('get_header', 'bzg_set_post_views');

function bzg_post_views($post_ID = '')
{
    global $post;
    $post_id = $post_ID;
    if (!$post_id) $post_id = $post->ID;
    if (!$post_id) return;
    $post_views = (int)get_post_meta($post_id, 'views', true);
    if (empty($post_views)) $post_views = 0;
    return $post_views;
}

//文章活动时间倒计时
function countdown($atts, $content = null)
{
    extract(shortcode_atts(array("time" => ''), $atts));
    date_default_timezone_set('PRC');
    $endtime = strtotime($time);
    $nowtime = time();
    global $endtimes;
    $endtimes = str_replace(array("-", " ", ":"), ",", $time);
    if ($endtime > $nowtime) {
        return '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                    <div id="countdown" class="flex-row justify-content-center text-center">
                    <span id="time">内容正在加载中...</span>
                                        <strong> 
                                        <span id="day"></span>
                                        <span id="hour"></span>
                                        <span id="min"></span>
                                        <span id="sec"></span>
                                        </strong>
                                        </div>
                </div>
                ';
    } else {
        return '<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                    <div id="countdown" class="flex-row justify-content-center text-center">
                                        <span id="time"><strong>当前活动已经过期了哦</strong></span>
                     </div>
                </div>';
    }
}

function countdown_js()
{
    global $endtimes;
    echo '<script>window.setInterval(function(){ShowCountDown(' . $endtimes . ');}, interval);</script>' . "\n";
}

add_shortcode('countdown', 'countdown');
add_action('wp_footer', 'countdown_js');
wp_register_script('countdown_js', get_template_directory_uri() . '/js/countdownjs.js', array(), '1.0', false);
wp_enqueue_script('countdown_js');


// 文章关键词seo keywords优化
function wp_keywords()
{
    global $s, $post;
    $keywords = '';
    if (is_single()) {  //如果是文章页，关键词则是：标签+分类ID
        if (get_the_tags($post->ID)) {
            foreach (get_the_tags($post->ID) as $tag) {
                $keywords .= $tag->name . ', ';
            }
        }
        foreach (get_the_category($post->ID) as $category) {
            $keywords .= $category->cat_name . ', ';
        }
        $keywords = substr_replace($keywords, '', -2);
    } elseif (is_home()) {
        $keywords = rebirth_option('site_meta_keywords');  //主页关键词设置
    } elseif (is_tag()) {  //标签页关键词设置
        $keywords = single_tag_title('', false);
    } elseif (is_category()) {//分类页关键词设置
        $keywords = single_cat_title('', false);
    } elseif (is_search()) {//搜索页关键词设置
        $keywords = esc_html($s, 1);
    } else {//默认页关键词设置
        $keywords = trim(wp_title('', false));
    }
    if ($keywords) {  //输出关键词
        return $keywords;
    }

    return "";
}

//like
add_action('wp_ajax_nopriv_specs_zan', 'specs_zan');
add_action('wp_ajax_specs_zan', 'specs_zan');
function specs_zan()
{
    global $wpdb, $post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if ($action == 'ding') {
        $specs_raters = get_post_meta($id, 'specs_zan', true);
        $expire = time() + 99999999;
        $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; // make cookies work with localhost
        setcookie('specs_zan_' . $id, $id, $expire, '/', $domain, false);
        if (!$specs_raters || !is_numeric($specs_raters)) {
            update_post_meta($id, 'specs_zan', 1);
        } else {
            update_post_meta($id, 'specs_zan', ($specs_raters + 1));
        }
        echo get_post_meta($id, 'specs_zan', true);
    }
    die;
}

//Gravatar缓存头像
//[推荐]七牛镜像源 https://dn-qiniu-avatar.qbox.me/avatar/
//[推荐]WP-China-Yes 镜像源 https://gravatar.wp-china-yes.net/avatar/
//[推荐]极客族 https://sdn.geekzu.org/avatar/
function baolog_get_avatar($avatar)
{
    $avatar = str_replace(array("www.gravatar.com", "0.gravatar.com", "1.gravatar.com", "2.gravatar.com", "secure.gravatar.com"),
        "dn-qiniu-avatar.qbox.me", $avatar);
    return $avatar;
}

add_filter('get_avatar', 'baolog_get_avatar', 10, 3);


/**
 * 获取阅读数最多的文章： $day代表几天前的文章 比如-1day是一天内
 * 只返回前15条
 */
function baolog_get_most_viewed($limit, $day)
{

    $options = get_option('baolog_framework');
    $is_blank = $options['baolog-posts-blank'];
    $target = '_self';
    $args = array(
        'posts_per_page' => $limit,
        'order' => 'DESC',
        'post_status' => 'publish',
        'orderby' => 'meta_value_num',
        'meta_key' => 'views',
        'date_query' => array(
            array(
                'after' => '-' . $day . 'day',
            )
        ),
    );

    $str = implode('&', $args);
    if ($day == 1) {
        $postlist = wp_cache_get('day_hot_post_' . md5($str), 'baolog');
        if (false === $postlist) {
            $postlist = get_posts($args);
            wp_cache_set('day_hot_post_' . md5($str), $postlist, 'baolog', 86400);
        }
    } else if ($day == 7) {
        $postlist = wp_cache_get('week_hot_post_' . md5($str), 'baolog');
        if (false === $postlist) {
            $postlist = get_posts($args);
            wp_cache_set('week_hot_post_' . md5($str), $postlist, 'baolog', 86400);
        }
    }

    if ($postlist != null) {
        echo '<ul class="list-group post-list mt-3">';
        foreach ($postlist as $post) {
            echo '<li class="list-group-item px-0">
                 <div class="subject break-all">
                            <h2><a class="mr-1" href="' . get_permalink($post->ID) . '" target="' . $target . '"  rel="bookmark"  
                            title="' . $post->post_title . '">' . wp_trim_words($post->post_title, 25) . '</a></h2>';
            //标签

            echo get_the_tag_list('', '', '', $post->ID);

            echo '</div>';
            //日期
            echo '<span class="num-font text-muted" style="flex-shrink: 0;">'
                . date('Y-m-d H:i', strtotime($post->post_date)) .
                '</span></li>';

        }
        echo '</ul>';
    } else {
        echo '<h5 class="mt-5" style="text-align: center;">没有查询到该模块的文章哦~ </h5>';
    }

    wp_reset_postdata();//
}

// 关闭顶部管理员登录工具
add_filter('show_admin_bar', '__return_false');

// 修改后台底部信息
function footerText () {
	return '感谢使用<a href="https://cn.wordpress.org/">WordPress</a>进行创作。当前使用<a href="https://github.com/paopao233/baolog">'.THEME_NAME.'</a>主题，版本为V'.THEME_VERSIONNAME.'。官方博客：<a href="'.THEME_DOWNURL.'">线报主题</a>';
}
add_filter('admin_footer_text', 'footerText', 9999);

// 页面链接添加html后缀(需要后台链接中开启伪静态才可以
function html_page_permalink()
{
    global $wp_rewrite;
    if (!strpos($wp_rewrite->get_page_permastruct(), '.html')) {
        $wp_rewrite->page_structure = $wp_rewrite->page_structure . '.html';
    }
}

add_action('init', 'html_page_permalink', -1);


//获取首页文章 包括置顶文章
//https://wordpress.stackexchange.com/questions/104127/display-all-sticky-post-before-regular-post/104136
function balolog_get_the_posts()
{
    $today = date('Y-m-d');
    $options = get_option('baolog_framework');
    $is_blank = $options['baolog-posts-blank'];//跳转方式
    $is_open_posts_today = $options['baolog-home-todayUpdate'];//今日更新
    $target = '_self';
    if ($is_blank == 1) {
        $target = '_blank';
    }

    //加入了一个判断 解决了显示两次置顶文章的问题
    while (have_posts()) {
        the_post();
        echo '<li class="list-group-item px-0">
                            <div class="subject break-all">
                                <h2>';
        if (($today == get_the_time('Y-m-d')) && !$is_open_posts_today) echo '<span class="font-weight-bold" style="color: red;">[&nbsp;今日更新&nbsp;]&nbsp;</span>';
        if (is_sticky()) echo '<span class="font-weight-bold">[&nbsp;置顶&nbsp;]&nbsp;</span>';
        echo '<a class="mr-1" href="';
        the_permalink();
        echo '"title="';
        the_title();
        echo '" target="' . $target . '"rel="bookmark">';
        if (is_sticky()) echo '<span class="huux_thread_hlight_style1">';
        echo wp_trim_words(get_the_title(), 25);//限制标题字数
        echo '</a></h2>';
        the_tags('', '', '');
        echo '</div><span class="num-font text-muted" style="flex-shrink: 0;';
        if (($today == get_the_time('Y-m-d')) && !$is_open_posts_today) echo 'color:red !important;';
        echo '">';
        the_time('Y-m-d H:i');
        echo '</span></li>';
    }
}

//评论开启@人 回复
function baolog_comment_add_at($comment_text, $comment = '')
{
    if ($comment->comment_parent > 0 & $comment->user_id == 1) {
        $comment_text = '<span class="badge badge-dark atwho">@ ' . get_comment_author($comment->comment_parent) . '</span> ' . $comment_text . '';
    }
    if ($comment->comment_parent > 0 & $comment->user_id != 1) {
        $comment_text = '<span class="badge badge-dark atwho">@ ' . get_comment_author($comment->comment_parent) . '</span> ' . $comment_text;
    }
    return $comment_text;
}

add_filter('comment_text', 'baolog_comment_add_at', 20, 2);

//返回本文章多少条评论
function baolog_comments_counts($postid = 0, $which = 0)
{
    $comments = get_comments('status=approve&type=comment&post_id=' . $postid); //获取文章的所有评论
    if ($comments) {
        $i = 0;
        $j = 0;
        $commentusers = array();
        foreach ($comments as $comment) {
            ++$i;
            if ($i == 1) {
                $commentusers[] = $comment->comment_author_email;
                ++$j;
            }
            if (!in_array($comment->comment_author_email, $commentusers)) {
                $commentusers[] = $comment->comment_author_email;
                ++$j;
            }
        }
        $output = array($j, $i);
        $which = ($which == 0) ? 0 : 1;
        return $output[$which]; //返回评论人数
    }
    return 0; //没有评论返回 0
}

// 移除默认评论框下的三个输入框
add_filter('comment_form_default_fields', 'remove_website_field');
function remove_website_field($fields)
{

    if (isset($fields['url'])||isset($fields['author'])||isset($fields['email']) ) {
        unset($fields['email']);
        // unset($fields['cookies']);|| isset($fields['cookies'])
        unset($fields['url']);
        unset($fields['author']);
    }
    return $fields;
}

// 更改“在此浏览器中保存我的显示名称、邮箱地址和网站地址，以便下次评论时使用。”提示
add_filter( 'comment_form_default_fields', 'tu_filter_comment_fields', 20 );
function tu_filter_comment_fields( $fields ) {
    $commenter = wp_get_current_commenter();

    $consent   = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';

    $fields['cookies'] = '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' . '<label for="wp-comment-cookies-consent" style="color: gray;">在此网站保存评论信息，已方便下次评论。</label></p>';

    return $fields;
}

// Remove the logout link in comment form
add_filter('comment_form_logged_in', '__return_empty_string');

//TODO 禁止解析html的评论内容

//取消评论转义
remove_filter('comment_text', 'wptexturize');

//屏蔽纯英文评论和纯日文
function refused_english_comments($incoming_comment)
{
    $pattern = '/[一-龥]/u';
    // 禁止全英文评论
    if (!preg_match($pattern, $incoming_comment['comment_content'])) {
        wp_die("您的评论中必须包含汉字!");
    }
    $pattern = '/[あ-んア-ン]/u';
    // 禁止日文评论
    if (preg_match($pattern, $incoming_comment['comment_content'])) {
        wp_die("评论禁止包含日文!");
    }
    return ($incoming_comment);
}

add_filter('preprocess_comment', 'refused_english_comments');

//自定义评论内容的样式
//http://wanlimm.com/77201505264102.html
function aurelius_comment($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment; ?>

    <div class="card mt-3" id="gb_89" id="li-comment<?php comment_ID(); ?>">
        <div class="card-body">
            <div class="card-user-info comment_card_user_info">
                <div class="d-flex align-items-center">
                    <?php if (function_exists('get_avatar') && get_option('show_avatars')) {
                        echo get_avatar($comment, 48, '', '', array('class' => 'avatar-1 mr-2'));
                    } ?>
                    <span><?php printf(__('%s'), get_comment_author_link()); ?></span>
                </div>
                <span><?php echo get_comment_time('Y-m-d H:i'); ?></span>
                <?php comment_reply_link(array_merge($args, array('reply_text' => '回复', 'depth' => $depth, 'max_depth' => $args['max_depth'])))
                ?>

            </div>
            <div class="card-text mt-3">
                <div class="gb-question">
                    <?php if ($comment->comment_approved == '0') : ?>
                        <em style="color: red">你的评论正在审核，稍后会显示出来！</em><br/>
                    <?php endif; ?>
                    <?php comment_text(); ?>

                </div>
            </div>

        </div>
    </div>
<?php }


//自定义提交评论按钮的样式
// define the comment_form_submit_button callback
//https://wordpress.stackexchange.com/questions/225477/how-to-wrap-submit-button-of-comment-form-with-div
function filter_comment_form_submit_button($submit_button, $args)
{
    // make filter magic happen here...
    $submit_before = '<div class="comment_card_submit" style="
    display: flex;
    justify-content: space-between;"> 
   <div class=""></div>';
    $submit_after = '</div>';
    return $submit_before . $submit_button . $submit_after;
}


add_filter('comment_form_submit_button', 'filter_comment_form_submit_button', 10, 2);

// 登录页面 ajax登录
//https://gist.github.com/cristianstan/10273612
function ajax_login_init()
{

    wp_register_script('ajax-login-script', get_template_directory_uri() . '/js/ajax-login-script.js');
    // wp_enqueue_script('ajax-login-script');

    wp_localize_script('ajax-login-script', 'ajax_login_object', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'redirecturl' => home_url(),
        'loadingmessage' => __('Sending user info, please wait...')
    ));

    // Enable the user with no privileges to run ajax_login() in AJAX
    add_action('wp_ajax_nopriv_ajaxlogin', 'ajax_login');
}

// Execute the action only if the user isn't logged in
if (!is_user_logged_in()) {
    add_action('init', 'ajax_login_init');
}


function ajax_login()
{

    // First check the nonce, if it fails the function will break
    check_ajax_referer('ajax-login-nonce', 'security');

    // Nonce is checked, get the POST data and sign user on
    $info = array();
    $info['user_login'] = $_POST['username'];
    $info['user_password'] = $_POST['password'];
    $info['remember'] = true;

    $user_signon = wp_signon($info, false);
    if (!is_wp_error($user_signon)) {
        wp_set_current_user($user_signon->ID);
        wp_set_auth_cookie($user_signon->ID);
        echo json_encode(array('loggedin' => true, 'message' => __('login success '),
            'portal' => __("/wp-admin/")));
    } else {
        echo json_encode(array('loggedin' => false, 'message' => __('login fail')));
    }

    die();
}

//注册
//https://gist.github.com/vishalbasnet23/1937b45be0ea73784cc5
add_action('wp_ajax_register_user_front_end', 'register_user_front_end', 0);
add_action('wp_ajax_nopriv_register_user_front_end', 'register_user_front_end');
function register_user_front_end()
{
    //注册环节
    $is_allow_sign_up = get_option('users_can_register');
    if ($is_allow_sign_up) {
        //用户提交的数据
        $new_user_name = stripcslashes($_POST['new_user_name']);
        $new_user_email = stripcslashes($_POST['new_user_email']);
        $new_user_password = $_POST['new_user_password'];
        $new_user_confirm_password = $_POST['new_user_confirm_password'];
        $user_nice_name = strtolower($_POST['new_user_email']);

        //校验邮箱是否正确
        $emailIsMatched = preg_match('~\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*~', $new_user_email);
        if ($emailIsMatched !== 1) {
            $notice_key = 'The email format is incorrect';
            echo json_encode(array('status' => false, 'message' => $notice_key));
            die;
        }

        //校验用户名 4到16位（字母，数字，下划线，减号）
        $usernameMatched = preg_match('~^[a-zA-Z0-9_-]{4,16}$~', $new_user_name);
        if ($usernameMatched !== 1) {
            $notice_key = 'The username format is incorrect';
            echo json_encode(array('status' => false, 'message' => $notice_key));
            die;
        }

        //判断用户密码是否两次都一样
        if ($new_user_password !== $new_user_confirm_password) {
            $notice_key = 'The two passwords are inconsistent';
            echo json_encode(array('status' => false, 'message' => $notice_key));
            die;
        }


        //判断用户密码强度 6到20位字符必须包含字母和数字
        $passwordIsMatched = preg_match('~^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]{6,20})$~', $new_user_password);
        if ($passwordIsMatched !== 1) {
            $notice_key = 'The password format is incorrect';
            echo json_encode(array('status' => false, 'message' => $notice_key));
            die;
        }

        $user_data = array(
            'user_login' => $new_user_name,
            'user_email' => $new_user_email,
            'user_pass' => $new_user_password,
            'user_nicename' => $user_nice_name,
            'display_name' => $new_user_name,
            //默认角色
            'role' => get_option('default_role'),
        );
        $user_id = wp_insert_user($user_data);
        if (!is_wp_error($user_id)) {
            $notice_key = 'we have Created an account for you.';
            echo json_encode(array('status' => true, 'message' => $notice_key));
        } else {
            if (isset($user_id->errors['empty_user_login'])) {
                $notice_key = 'User Name and Email are mandatory';
                echo json_encode(array('status' => false, 'message' => $notice_key));
            } elseif (isset($user_id->errors['existing_user_login'])) {
                $notice_key = 'User name already exixts.';
                echo json_encode(array('status' => false, 'message' => $notice_key));
            } else {
                $notice_key = 'Error Occured please fill up the sign up form carefully.';
                echo json_encode(array('status' => false, 'message' => $notice_key));
            }
        }
    } else {
        $notice_key = 'not allow everyone to sign up';
        echo json_encode(array('status' => false, 'message' => $notice_key));
    }
    die;
}

//文章久未更新
//https://blog.csdn.net/spc007spc/article/details/105782968
function baolog_is_overdue()
{
    //获取是否开启此功能
    $options = get_option('baolog_framework');
    $is_open = $options['baolog-posts-update'];
    //获取文章时间
    $u_time = get_the_time('U');
    $u_modified_time = get_the_modified_time('U');

    $updated_date = date('Y-m-d H:i', $u_modified_time);
    //两个时间相减 等到了整天 算一天
    $days = date_diff(date_create(date('Ymd', $u_modified_time)), date_create(date('Ymd', time())));
    if ($is_open == 1) {
        if ($days->days >= 3) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
            echo '温馨提示：<br>本文最后更新时间<strong>';
            echo $updated_date;
            echo '</strong>，已超过<strong>';
            echo $days->days;
            echo '</strong>天没有更新，若内容或图片失效，请留言反馈。</div>';

        }
    }

}


//自定义底部代码 支持html 不支持javascript
function baolog_wp_footer_custom()
{
    $options = get_option('baolog_framework');
    $custom_footer = $options['baolog-footer-custom'];
    echo $custom_footer;
}

add_action('wp_footer', 'baolog_wp_footer_custom', 100);

//自定义统计代码
function baolog_wp_footer_analysis()
{
    $options = get_option('baolog_framework');
    $custom_footer = $options['baolog-footer-analysis'];
    echo $custom_footer;
}

add_action('wp_footer', 'baolog_wp_footer_analysis', 100);


/**
 *
 * 侧栏相关配置
 */
//检查是否需要关闭侧栏的app悬浮
function baolog_check_sidebar_switcher($option)
{
    $options = get_option('baolog_framework');
    $isCLose = $options[$option];

    if ($isCLose != 1) {
        echo "hide ";
    }
    echo $isCLose;
}




