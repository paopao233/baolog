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
include(get_template_directory() . '/inc/func/theme_plus.php');
include(get_template_directory() . '/inc/func/page-func.php');

//引入自定义functions文件
/**
 * 全局变量
 */
$GLOBALS['theme_options'] = get_option('baolog_framework');

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