<?php
/**
 * Copyright 2021, https://github.com/paopao233
 * All right reserved.
 *
 * @author parklot
 * @date 2021-8月-9日 20:29
 * @license GPL v3 LICENSE
 */
?>
<?php
/**
 * 自定义引入
 */
//引入 Content functions
include(get_template_directory() . '/inc/func/shortcodes.php');
include(get_template_directory() . '/inc/func/page-func.php');
//引入自定义functions文件
//注册js
/**
 * 全局变量
 */
$GLOBALS['theme_options'] = get_option('baolog_framework');

function _park($name, $default = false)
{
    $option_name = 'baolog_framework';

    $options = get_option($option_name);

    // Return specific option
    if (isset($options[$name])) {
        return $options[$name];
    }

    return $default;
}

/**
 * 广告位
 */
function baolog_advertisement($position)
{
    $ad_result = 'baolog-ad-';
    if ($position == null) {
        echo "位置错误";
        return;
    }
    echo $GLOBALS['theme_options'][$ad_result.=$position];
}

/**
 * 用户相关
 * 
 */
//自定义默认头像
add_filter('avatar_defaults', 'mytheme_default_avatar');
function mytheme_default_avatar($avatar_defaults)
{
    //$new_avatar_url = get_template_directory_uri() . '/assets/images/default_avatar.png';
    $new_avatar_url = 'https://cn.gravatar.com/avatar/642a9efe79c22c568dc852c8774b8abf';
    $avatar_defaults[$new_avatar_url] = 'Default Avatar';
    return $avatar_defaults;
}

/**
 * 内容相关 
 */
//给外链加上nofollow及新窗口打开
if(!function_exists('cn_nf_url_parse')){
    function cn_nf_url_parse( $content ) {
        $regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>";
        if(preg_match_all("/$regexp/siU", $content, $matches, PREG_SET_ORDER)) {
            if( !empty($matches) ) {

                $srcUrl = get_option('siteurl');
                for ($i=0; $i < count($matches); $i++)
                {

                    $tag = $matches[$i][0];
                    $tag2 = $matches[$i][0];
                    $url = $matches[$i][0];

                    $noFollow = '';

                    $pattern = '/target\s*=\s*"\s*_blank\s*"/';
                    preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
                    if( count($match) < 1 )
                        $noFollow .= ' target="_blank" ';

                    $pattern = '/rel\s*=\s*"\s*[n|d]ofollow\s*"/';
                    preg_match($pattern, $tag2, $match, PREG_OFFSET_CAPTURE);
                    if( count($match) < 1 )
                        $noFollow .= ' rel="nofollow" ';

                    $pos = strpos($url,$srcUrl);
                    if ($pos === false) {
                        $tag = rtrim ($tag,'>');
                        $tag .= $noFollow.'>';
                        $content = str_replace($tag2,$tag,$content);
                    }
                }
            }
        }
        $content = str_replace(']]>', ']]>', $content);
        return $content;
    }
}
add_filter( 'the_content', 'cn_nf_url_parse');

//===============================================
// 去除分类category
if(_lot('baolog-category-close')){
    // Refresh rules on activation/deactivation/category changes
    register_activation_hook(__FILE__, 'no_category_base_refresh_rules');
    add_action('created_category', 'no_category_base_refresh_rules');
    add_action('edited_category', 'no_category_base_refresh_rules');
    add_action('delete_category', 'no_category_base_refresh_rules');
    function no_category_base_refresh_rules() {
        global $wp_rewrite;
        $wp_rewrite -> flush_rules();
    }

    register_deactivation_hook(__FILE__, 'no_category_base_deactivate');
    function no_category_base_deactivate() {
        remove_filter('category_rewrite_rules', 'no_category_base_rewrite_rules');
        // We don't want to insert our custom rules again
        no_category_base_refresh_rules();
    }

// Remove category base
    add_action('init', 'no_category_base_permastruct');
    function no_category_base_permastruct() {
        global $wp_rewrite, $wp_version;
        if (version_compare($wp_version, '3.4', '<')) {
            // For pre-3.4 support
            $wp_rewrite -> extra_permastructs['category'][0] = '%category%';
        } else {
            $wp_rewrite -> extra_permastructs['category']['struct'] = '%category%';
        }
    }

// Add our custom category rewrite rules
    add_filter('category_rewrite_rules', 'no_category_base_rewrite_rules');
    function no_category_base_rewrite_rules($category_rewrite) {
        //var_dump($category_rewrite); // For Debugging

        $category_rewrite = array();
        $categories = get_categories(array('hide_empty' => false));
        foreach ($categories as $category) {
            $category_nicename = $category -> slug;
            if ($category -> parent == $category -> cat_ID)// recursive recursion
                $category -> parent = 0;
            elseif ($category -> parent != 0)
                $category_nicename = get_category_parents($category -> parent, false, '/', true) . $category_nicename;
            $category_rewrite['(' . $category_nicename . ')/(?:feed/)?(feed|rdf|rss|rss2|atom)/?$'] = 'index.php?category_name=$matches[1]&feed=$matches[2]';
            $category_rewrite['(' . $category_nicename . ')/page/?([0-9]{1,})/?$'] = 'index.php?category_name=$matches[1]&paged=$matches[2]';
            $category_rewrite['(' . $category_nicename . ')/?$'] = 'index.php?category_name=$matches[1]';
        }
        // Redirect support from Old Category Base
        global $wp_rewrite;
        $old_category_base = get_option('category_base') ? get_option('category_base') : 'category';
        $old_category_base = trim($old_category_base, '/');
        $category_rewrite[$old_category_base . '/(.*)$'] = 'index.php?category_redirect=$matches[1]';

        //var_dump($category_rewrite); // For Debugging
        return $category_rewrite;
    }


// Add 'category_redirect' query variable
    add_filter('query_vars', 'no_category_base_query_vars');
    function no_category_base_query_vars($public_query_vars) {
        $public_query_vars[] = 'category_redirect';
        return $public_query_vars;
    }

// Redirect if 'category_redirect' is set
    add_filter('request', 'no_category_base_request');
    function no_category_base_request($query_vars) {
        //print_r($query_vars); // For Debugging
        if (isset($query_vars['category_redirect'])) {
            $catlink = trailingslashit(get_option('home')) . user_trailingslashit($query_vars['category_redirect'], 'category');
            status_header(301);
            header("Location: $catlink");
            exit();
        }
        return $query_vars;
    }
}

//===============================================


// 文章外链转内链并转入跳转页面，只有内容的外链 2022/3/31------------------------------
// https://www.jianzhanmi.com/wordpress/wp-35.html
if(_lot('baolog-open-goto')){
    
    add_filter('the_content','goto_url',999);
    function goto_url($content){
        preg_match_all('/href="(.*?)"/',$content,$matches);
        if($matches){
            foreach($matches[1] as $val){
                if( strpos($val,home_url())===false&&strpos($val,"javascript:void(0)")===false )
                    $content=str_replace("href=\"$val\"", "rel=\"nofollow\" target=\"_blank\" href=\"" . get_bloginfo('home'). "/goto.html?url=" .$val. "\"",$content);
            }
        }
        return $content;
    }

}


//文章页底部小提示



//给文章添加一个noopener noreferrer值 预防跨站攻击
function bzg_targeted_link_rel($rel, $link_html) {
	$site_url = parse_url(site_url());
	preg_match('/href=[\'\"](https?:\/\/.*)[\'\"]/i', $link_html, $matchs);
	if(empty($matchs[1])) return '';
	$target_url = parse_url($matchs[1]);
	
	if($target_url['host'] == $site_url['host']) {
		return '';
	}
	return $rel;
}
/**
 * wp后台相关
 */
 
//删除自带小工具
function unregister_default_widgets()
{
    unregister_widget("WP_Widget_Pages");
    unregister_widget("WP_Widget_Calendar");
    unregister_widget("WP_Widget_Archives");
    unregister_widget("WP_Widget_Links");
    unregister_widget("WP_Widget_Meta");
    unregister_widget("WP_Widget_Search");
    unregister_widget("WP_Widget_Categories");
    unregister_widget("WP_Widget_Recent_Posts");
    unregister_widget("WP_Nav_Menu_Widget");
}
add_action("widgets_init", "unregister_default_widgets", 11);

//admin css
add_filter('login_headerurl', create_function(false,"return get_bloginfo('siteurl');"));
add_filter('login_headertitle', create_function(false,"return get_bloginfo('description');"));
function nowspark_login_head() {
    echo '<style type="text/css">body.login #login h1 a {background:url(https://cn.gravatar.com/avatar/642a9efe79c22c568dc852c8774b8abf) no-repeat 0 0 transparent;}</style>';
}
add_action("login_head", "nowspark_login_head");

/**
 * SEO
 */
 
/**
* WordPress发布文章/页面时自动添加默认的自定义字段
* https://www.wpdaxue.com/add-custom-field-automatically-post-page-publish.html
*/
add_action('publish_page', 'add_custom_field_automatically');//发布页面时
add_action('publish_post', 'add_custom_field_automatically');//发布文章时
function add_custom_field_automatically($post_ID) {
    global $wpdb;
    if(!wp_is_post_revision($post_ID)) {
        add_post_meta($post_ID, 'description', '', true);
        add_post_meta($post_ID, 'keywords', '', true);
    }
}

add_filter('wp_targeted_link_rel', 'bzg_targeted_link_rel', 10, 2);


// define the do_robots ---------------------------------------------------------------------
add_filter( 'robots_txt', 'add_robots_rewrite', 10, 2 );
function add_robots_rewrite( $output, $public ) {
    $output = "User-agent: *\n";
    $output .= "Disallow: /wp-admin/\n";
    $output .= "Disallow: /goto.php?*\n";
    $output .= "Allow: /wp-admin/admin-ajax.php\n";
    
    $output .= "Sitemap: ". get_option('home')."/wp-sitemap.xml\n";
    return $output; 
}