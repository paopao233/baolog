<?php
/*
* @author parklot
* @content 短代码
* @link https://github.com/paopao233
 */
//注册按钮
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

//解析短代码
/**
 * 面板类
 */
//红色面板
add_shortcode('danger-callout', 'danger_callout_shortcode');
function danger_callout_shortcode($attr, $content = '')
{
    $out = '<div class="bd-callout bd-callout-danger">' . $content . '</div>';
    return $out;
}

//蓝色面板
add_shortcode('info-callout', 'info_callout_shortcode');
function info_callout_shortcode($attr, $content = '')
{
    $out = '<div class="bd-callout bd-callout-info">' . $content . '</div>';
    return $out;
}

//黄色面板
add_shortcode('warning-callout', 'warning_callout_shortcode');
function warning_callout_shortcode($attr, $content = '')
{
    $out = '<div class="bd-callout bd-callout-warning">' . $content . '</div>';
    return $out;
}

//折叠面板 标题
add_shortcode('fold-title', 'fold_title_shortcode');
function fold_title_shortcode($attr, $content = '')
{
    $out = '<div class="fold-plane">
    <div class="fold-plane-title">' . $content . '</div>
    <div class="fold-plane-content" style="display: none;">';
    return $out;
}

//折叠面板 内容
add_shortcode('fold-body', 'fold_body_shortcode');
function fold_body_shortcode($attr, $content = '')
{
    $out = $content . '</div></div>';
    return $out;
}

//note折叠 标题
add_shortcode('note-callout-title', 'note_callout_title_shortcode');
function note_callout_title_shortcode($attr, $content = '')
{
    $out = '<h4 class="card-title mt-4">' . $content . '</h4>
            <div class="alert alert-light-warning text-info mt-3 py-3">
            <ul class="mb-0 list-inline">';
    return $out;
}

//note折叠 内容
add_shortcode('note-callout-body', 'note_callout_body_shortcode');
function note_callout_body_shortcode($attr, $content = '')
{
    $out = '<li class="d-flex py-2">
            <i class="mdi mdi-arrow-right fs-4 me-2"></i>' . $content . '
            </li>';
    return $out;
}

//note折叠 底部
add_shortcode('note-callout-footer', 'note_callout_footer_shortcode');
function note_callout_footer_shortcode($attr, $content = '')
{
    $out = '</ul></div>';
    return $out;
}

/**
 * 按钮类
 */
//普通按钮
add_shortcode('btn-primary', 'btn_primary_shortcode');
function btn_primary_shortcode($attr, $content = '')
{
    $out = '<button type="button" class="btn btn-primary mr-3 mt-3">' . $content . '</button>';
    return $out;
}

//灰色按钮
add_shortcode('btn-secondary', 'btn_secondary_shortcode');
function btn_secondary_shortcode($attr, $content = '')
{
    $out = '<button type="button" class="btn btn-secondary mr-3 mt-3">' . $content . '</button>';
    return $out;
}

//成功按钮
add_shortcode('btn-success', 'btn_success_shortcode');
function btn_success_shortcode($attr, $content = '')
{
    $out = '<button type="button" class="btn btn-success mr-3 mt-3">' . $content . '</button>';
    return $out;
}

//红色按钮
add_shortcode('btn-danger', 'btn_danger_shortcode');
function btn_danger_shortcode($attr, $content = '')
{
    $out = '<button type="button" class="btn btn-danger mr-3 mt-3">' . $content . '</button>';
    return $out;
}

//黄色按钮
add_shortcode('btn-warning', 'btn_warning_shortcode');
function btn_warning_shortcode($attr, $content = '')
{
    $out = '<button type="button" class="btn btn-warning mr-3 mt-3">' . $content . '</button>';
    return $out;
}

//信息按钮
add_shortcode('btn-info', 'btn_info_shortcode');
function btn_info_shortcode($attr, $content = '')
{
    $out = '<button type="button" class="btn btn-info mr-3 mt-3">' . $content . '</button>';
    return $out;
}

//轻盈按钮
add_shortcode('btn-light', 'btn_light_shortcode');
function btn_light_shortcode($attr, $content = '')
{
    $out = '<button type="button" class="btn btn-light mr-3 mt-3">' . $content . '</button>';
    return $out;
}
//黑色按钮
add_shortcode('btn-dark', 'btn_dark_shortcode');
function btn_dark_shortcode($attr, $content = '')
{
    $out = '<button type="button" class="btn btn-dark mr-3 mt-3">' . $content . '</button>';
    return $out;
}
//链接按钮
add_shortcode('btn-link', 'btn_link_shortcode');
function btn_link_shortcode($attr, $content = '')
{
    $out = '<button type="button" class="btn btn-link mr-3 mt-3">' . $content . '</button>';
    return $out;
}
//通栏普通按钮
add_shortcode('btn-lg-primary', 'btn_lg_primary_shortcode');
function btn_lg_primary_shortcode($attr, $content = '')
{
    $out = '<button type="button" class="btn btn-primary btn-lg btn-block mr-3 mt-3">'.$content.'</button>';
    return $out;
}
//通栏灰色按钮
add_shortcode('btn-lg-secondary', 'btn_lg_secondary_shortcode');
function btn_lg_secondary_shortcode($attr, $content = '')
{
    $out = '<button type="button" class="btn btn-secondary btn-lg btn-block mr-3 mt-3">'.$content.'</button>';
    return $out;
}
