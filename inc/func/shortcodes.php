<?php
/*
* @author parklot
* @content 短代码
* @link https://github.com/paopao233
 */
// 注册按钮
function wd_add_mce_button()
{
    // check user permissions
    if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) {
        return;
    }
    if ('true' == get_user_option('rich_editing')) {
        add_filter('mce_external_plugins', 'wd_add_tinymce_plugin');
        add_filter('mce_buttons', 'wd_register_mce_button');
    }
}

add_action('admin_head', 'wd_add_mce_button');
function wd_add_tinymce_plugin($plugin_array)
{
    $plugin_array['wd_mce_button'] = get_template_directory_uri() . '/js/mce-button.js';
    return $plugin_array;
}

function wd_register_mce_button($buttons)
{
    array_push($buttons, 'wd_mce_button');

    return $buttons;
}

// 解析短代码
/**
 * 面板类
 */
// 红色面板
add_shortcode('danger-callout', 'danger_callout_shortcode');
function danger_callout_shortcode($attr, $content = '')
{
    $out = '<div class="bd-callout bd-callout-danger">' . $content . '</div>';
    return $out;
}

// 蓝色面板
add_shortcode('info-callout', 'info_callout_shortcode');
function info_callout_shortcode($attr, $content = '')
{
    $out = '<div class="bd-callout bd-callout-info">' . $content . '</div>';
    return $out;
}

// 黄色面板
add_shortcode('warning-callout', 'warning_callout_shortcode');
function warning_callout_shortcode($attr, $content = '')
{
    $out = '<div class="bd-callout bd-callout-warning">' . $content . '</div>';
    return $out;
}

// 折叠面板 标题
add_shortcode('fold-title', 'fold_title_shortcode');
function fold_title_shortcode($attr, $content = '')
{
    $out = '<div class="fold-plane">
    <div class="fold-plane-title">' . $content . '</div>
    <div class="fold-plane-content" style="display: none;">';
    return $out;
}

// 折叠面板 内容
add_shortcode('fold-body', 'fold_body_shortcode');
function fold_body_shortcode($attr, $content = '')
{
    $out = $content . '</div></div>';
    return $out;
}

// note折叠 标题
add_shortcode('note-callout-title', 'note_callout_title_shortcode');
function note_callout_title_shortcode($attr, $content = '')
{
    $out = '<h4 class="card-title mt-4">' . $content . '</h4>
            <div class="alert alert-light-warning text-info mt-3 py-3">
            <ul class="mb-0 list-inline">';
    return $out;
}

// note折叠 内容
add_shortcode('note-callout-body', 'note_callout_body_shortcode');
function note_callout_body_shortcode($attr, $content = '')
{
    $out = '<li class="d-flex py-2">
            <i class="mdi mdi-arrow-right fs-4 me-2"></i>' . $content . '
            </li>';
    return $out;
}

// note折叠 底部
add_shortcode('note-callout-footer', 'note_callout_footer_shortcode');
function note_callout_footer_shortcode($attr, $content = '')
{
    $out = '</ul></div>';
    return $out;
}

/**
 * 按钮类
 */
// 普通按钮
add_shortcode('btn-primary', 'btn_primary_shortcode');
function btn_primary_shortcode($attr, $content = '')
{
    $out = '<button type="button" class="bt-shortcode btn btn-primary mr-3 mb-3">' . $content . '</button>';
    return $out;
}

// 灰色按钮
add_shortcode('btn-secondary', 'btn_secondary_shortcode');
function btn_secondary_shortcode($attr, $content = '')
{
    $out = '<button type="button" class="bt-shortcode btn btn-secondary mr-3 mb-3">' . $content . '</button>';
    return $out;
}

// 成功按钮
add_shortcode('btn-success', 'btn_success_shortcode');
function btn_success_shortcode($attr, $content = '')
{
    $out = '<button type="button" class="bt-shortcode btn btn-success mr-3 mb-3">' . $content . '</button>';
    return $out;
}

// 红色按钮
add_shortcode('btn-danger', 'btn_danger_shortcode');
function btn_danger_shortcode($attr, $content = '')
{
    $out = '<button type="button" class="bt-shortcode btn btn-danger mr-3 mb-3">' . $content . '</button>';
    return $out;
}

// 黄色按钮
add_shortcode('btn-warning', 'btn_warning_shortcode');
function btn_warning_shortcode($attr, $content = '')
{
    $out = '<button type="button" class="bt-shortcode btn btn-warning mr-3 mb-3">' . $content . '</button>';
    return $out;
}

// 信息按钮
add_shortcode('btn-info', 'btn_info_shortcode');
function btn_info_shortcode($attr, $content = '')
{
    $out = '<button type="button" class="bt-shortcode btn btn-info mr-3 mb-3">' . $content . '</button>';
    return $out;
}

// 轻盈按钮
add_shortcode('btn-light', 'btn_light_shortcode');
function btn_light_shortcode($attr, $content = '')
{
    $out = '<button type="button" class="bt-shortcode btn btn-light mr-3 mb-3">' . $content . '</button>';
    return $out;
}

// 黑色按钮
add_shortcode('btn-dark', 'btn_dark_shortcode');
function btn_dark_shortcode($attr, $content = '')
{
    $out = '<button type="button" class="bt-shortcode btn btn-dark mr-3 mb-3">' . $content . '</button>';
    return $out;
}

// 链接按钮
add_shortcode('btn-link', 'btn_link_shortcode');
function btn_link_shortcode($attr, $content = '')
{
    $out = '<button type="button" class="bt-shortcode btn btn-link mr-3 mb-3">' . $content . '</button>';
    return $out;
}

// 通栏普通按钮
add_shortcode('btn-lg-primary', 'btn_lg_primary_shortcode');
function btn_lg_primary_shortcode($attr, $content = '')
{
    $out = '<button type="button" class="bt-shortcode btn btn-primary btn-lg btn-block mr-3  mb-3">' . $content . '</button>';
    return $out;
}

// 通栏灰色按钮
add_shortcode('btn-lg-secondary', 'btn_lg_secondary_shortcode');
function btn_lg_secondary_shortcode($attr, $content = '')
{
    $out = '<button type="button" class="bt-shortcode btn btn-secondary btn-lg btn-block mr-3 mb-3">' . $content . '</button>';
    return $out;
}

// 未登录提示卡片  即登录可见
add_shortcode('hide', 'loginvisible');
function loginvisible($atts, $content = null)
{
    if (is_user_logged_in() && !is_null($content) && !is_feed()) {
        return $content;
    }
    $out = '
            <div class="post-hidden-tips">
            <div class="hidden-blur-poster" style="background-image: url(https://s6.jpg.cm/2022/04/10/LjdUg2.png);"></div>
            <div class="hidden-tips-text">登录查看隐藏内容</div>
            </div>';

    return $out;
}

// 回复可见
add_shortcode('reply', 'reply_to_read');
function reply_to_read($atts, $content = null)
{
    $out = '
            <div class="post-hidden-tips">
            <div class="hidden-blur-poster" style="background-image: url(https://s6.jpg.cm/2022/04/10/LjdUg2.png);"></div>
            <div class="hidden-tips-text">此处内容需要<a style="color: #000; font-weight: 600;" href="' . get_permalink() . '#respond" title="评论本文">&nbsp评论本文</a>&nbsp后刷新本页才能查看.</div>
            </div>';
    extract(shortcode_atts(array("notice" => $out), $atts));
    $email = null;
    $user_ID = (int)wp_get_current_user()->ID;
    if ($user_ID > 0) {
        $email = get_userdata($user_ID)->user_email; //如果用户已登录,从登录信息中获取email
    } else if (isset($_COOKIE['comment_author_email_' . COOKIEHASH])) {
        $email = str_replace('%40', '@', $_COOKIE['comment_author_email_' . COOKIEHASH]); //如果用户未登录但电脑上有本站的Cookie信息，从Cookie里读取email
    } else {
        return $notice; //无法获取email，直接返回提示信息
    }
    if (empty($email)) {
        return $notice;
    }
    // 已做缓存 https://m.wpjam.com/article/wordpress-transients-api/
    // 6个小时查询一次
    global $wpdb;
    $post_id = get_the_ID(); //文章的ID
    $reply_to_read = get_transient('reply_to_read_' . $email . '_' . $post_id); // 缓存每个人的查询
    $query = "SELECT `comment_ID` FROM {$wpdb->comments} WHERE `comment_post_ID`={$post_id} and `comment_approved`='1' and `comment_author_email`='{$email}' LIMIT 1";
    if ($reply_to_read) {
        return $content;
    } else {
        if ($wpdb->get_results($query)) {
            set_transient('$reply_to_read'. $email . '_' . $post_id, true, 60 * 60 * 6);
            return $content; //查询到对应的已经审核通过的评论则返回内容
        } else {
            return $notice; //否则返回提示信息
        }

    }

}

// 公众号关注填写关键词 blog.guluqiu.cc
add_shortcode('gzh2v', 'baolog_secret_content');
function baolog_secret_content($atts, $content=null){
    extract(shortcode_atts(array('key'=>null,'keyword'=>null), $atts));
    if(isset($_POST['secret_key']) && $_POST['secret_key']==$key){
        return $content;
    } else {
        return
            '
            <div class="gzhhide">
            <div class="hidden-blur-poster" style="background-image: url(https://s6.jpg.cm/2022/04/10/LjdUg2.png);"></div>
            <div ><img class="gzhcode" style="vertical-align: revert" src="'._lot('baolog-opt-accordion-shortcodes')['baolog-shortcodes-gzhgz-qrcode'].'" width="130" height="130" alt="线报主题"></div>
            <div class="gzhtitle">此内容为隐藏内容，输入密码后可见！<i class="fa icon icon-lock"></i><span></span></div>
            <div class="gzh-content">请打开微信扫描右边的二维码回复关键字“<span><b>'.$keyword.'</b></span>”获取密码，也可以微信直接搜索"<b>'._lot('baolog-opt-accordion-shortcodes')['baolog-shortcodes-gzhgz-name'].'</b>"关注微信公众号获取密码。</div>
            <div class="gzhbox"><form action="'.get_permalink().'" method="post">
            <input id="pwbox" type="text" size="20" name="secret_key" placeholder="请输入从公众号获取到的密码">
            <button type="submit">查看隐藏内容</button></form></div></div>';
    }
}

