<?php if (!defined('ABSPATH')) {
    die;
} // Cannot access directly.
/**
 *
 * @package   Codestar Framework - WordPress Options Framework
 * @author    Codestar <info@codestarthemes.com>
 * @link      http://codestarframework.com
 * @copyright 2015-2021 Codestar
 *
 *
 * Plugin Name: Codestar Framework
 * Plugin URI: http://codestarframework.com/
 * Author: Codestar
 * Author URI: http://codestarthemes.com/
 * Version: 2.2.4
 * Description: A Simple and Lightweight WordPress Option Framework for Themes and Plugins
 * Text Domain: csf
 * Domain Path: /languages
 *
 */
require_once plugin_dir_path(__FILE__) . 'classes/setup.class.php';
// Check core class for avoid errors

// Check core class for avoid errors
if (class_exists('CSF')) {

    // Set a unique slug-like ID
    $prefix = 'baolog_framework';

    // Create options
    CSF::createOptions($prefix, array(
        'menu_title' => 'baolog主题选项',
        'menu_slug' => 'baolog-framework',
    ));

    // 全局设置
    CSF::createSection($prefix, array(
        'title' => '全局设置',
        'icon' => 'fa fa-home',
        'fields' => array(
            array(
                'type' => 'heading',
                'content' => '这里的全局记得填写好相关配置哦',
            ),
            // A Notice
            array(
                'type' => 'notice',
                'style' => 'success',
                'content' => '当前主题版本为V0.1,请关注作者https://github.com/paopao233',
            ),
            array(
                'id' => 'baolog-favicon',
                'type' => 'upload',
                'title' => '网站图标',
                'default' => get_stylesheet_directory_uri() . '/favicon.ico',
                'desc' => '默认是主题根目录的favicon.ico，可直接替换或者在这里重新上传',
                'help' => '默认是主题根目录的favicon.ico，可直接替换或者在这里重新上传',
                'subtitle' => '全站icon',
            ),
            array(
                'id' => 'baolog-description',
                'type' => 'text',
                'title' => '网站描述',
                'subtitle' => '针对SEO的描述 例如：又一个Wordpress网站',
                'default' => '又一个Wordpress网站',
                'help' => '可为空',
            ),
            array(
                'id' => 'baolog-keywords',
                'type' => 'text',
                'title' => '网站关键词',
                'subtitle' => '针对SEO的关键字 例如：线报主题,parklot,github,线报',
                'default' => '线报主题,parklot,github,线报',
                'help' => '请使用英文逗号隔开，可为空',
            ),
            // A text field
            array(
                'id' => 'baolog-beian',
                'type' => 'text',
                'title' => '备案号',
                'subtitle' => '显示在底部的备案号信息 例如：粤ICP备19024161号',
                'default' => '粤ICP备xxxxxxxx号',
                'help' => '可为空',
            ),
            array(
                'id' => 'baolog-website-create',
                'type' => 'text',
                'title' => '网站成立时间',
                'subtitle' => '显示在底部的网站成立时间 默认：2020-2021 ',
                'default' => '2020-2021',
                'help' => '可为空',
            ),

        )
    ));

    // 页面设置
    CSF::createSection($prefix, array(
        'title' => '页面设置',
        'icon' => 'fa fa-navicon',
        'fields' => array(
            // A textarea field
            array(
                'id' => 'baolog-page-support',
                'type' => 'text',
                'title' => '赞助网站页面地址',
                'desc' => '评论里面显示。默认是：' . get_option('home') . '/mod-support.html',
                'default' => get_option('home') . '/mod-support.html',
            ),
            array(
                'id' => 'baolog-page-login',
                'type' => 'text',
                'title' => '用户登录页面地址',
                'desc' => '文章里面的赞助网站页面链接，需要自己手动创建一个以登录为模板的页面。默认是：' . get_option('home') . '/login.html',
                'default' => get_option('home') . '/login.html',
            ),
            array(
                'id' => 'baolog-page-signup',
                'type' => 'text',
                'title' => '用户注册页面地址',
                'desc' => '显示在登录页面处的注册链接，需要自己手动创建一个以注册为模板的页面。默认是：' . get_option('home') . '/signup.html',
                'default' => get_option('home') . '/signup.html',
            ),
        )
    ));
    // 文章设置
    CSF::createSection($prefix, array(
        'title' => '文章设置',
        'icon' => 'fa fa-clipboard',
        'fields' => array(
            array(
                'id' => 'baolog-posts-update',
                'type' => 'switcher',
                'title' => '文章3天内未更新提示',
                'label'   => '是否开启?',
                'subtitle' => '显示在文章页面',
                'text_on'    => '开启',
                'text_off'   => '禁用',
                'text_width' => 100
            )

        )
    ));
    // 图片设置
    CSF::createSection($prefix, array(
        'title' => '图片设置',
        'icon' => 'fa fa-image',
        'fields' => array(
            array(
                'type' => 'heading',
                'content' => '主题图片相关的配置都会在这里',
            ),
            array(
                'type' => 'subheading',
                'content' => '页面相关图片配置',
            ),
            array(
                'id' => 'baolog-support-alipay',
                'type' => 'upload',
                'title' => '赞助我们-支付宝收款图片',
                'default' => get_stylesheet_directory_uri() . '/images/page/support/alipay.png',
                'desc' => '默认是作者的，需要自己更换',
                'help' => '显示在文章的赞助网站的自定义页面图片',
                'subtitle' => '显示在文章的赞助网站的自定义页面图片',
            ),
            array(
                'id' => 'baolog-support-wechat',
                'type' => 'upload',
                'title' => '赞助我们-微信收款图片',
                'default' => get_stylesheet_directory_uri() . '/images/page/support/wechat.png',
                'desc' => '默认是作者的，需要自己更换',
                'help' => '显示在文章的赞助网站的自定义页面图片',
                'subtitle' => '显示在文章的赞助网站的自定义页面图片',
            ),
            array(
                'type' => 'subheading',
                'content' => '侧栏相关图片配置',
            ),
            array(
                'id' => 'baolog-sidebar-app',
                'type' => 'upload',
                'title' => '安卓app',
                'default' => get_stylesheet_directory_uri() . '/images/app.png',
                'desc' => '默认是作者的，需要自己更换',
                'help' => '显示在侧栏的安卓app二维码',
                'subtitle' => '显示在侧栏的安卓app二维码',
            ),
            array(
                'id' => 'baolog-sidebar-wx',
                'type' => 'upload',
                'title' => '扫一扫关注微信公众号',
                'default' => get_stylesheet_directory_uri() . '/images/wx.png',
                'desc' => '默认是作者的，需要自己更换，可为空，为空不显示',
                'help' => '显示在侧栏的扫描公众号二维码',
                'subtitle' => '显示在侧栏的扫描公众号二维码',
            ),
            array(
                'id' => 'baolog-sidebar-miniapp',
                'type' => 'upload',
                'title' => '扫一扫打开微信小程序',
                'default' => get_stylesheet_directory_uri() . '/images/miniapp.png',
                'desc' => '默认是作者的，需要自己更换，可为空，为空不显示',
                'help' => '显示在文章的赞助网站的自定义页面图片',
                'subtitle' => '显示在侧栏的扫描微信小程序二维码',
            ),
            array(
                'id' => 'baolog-sidebar-qqapp',
                'type' => 'upload',
                'title' => '扫一扫打开QQ小程序',
                'default' => get_stylesheet_directory_uri() . '/images/qqapp.png',
                'desc' => '默认是作者的，需要自己更换，可为空，为空不显示',
                'help' => '显示在文章的赞助网站的自定义页面图片',
                'subtitle' => '显示在侧栏的扫描QQ小程序二维码',
            ),
        )
    ));
    // 首页设置
    CSF::createSection($prefix, array(
        'title' => '首页设置',
        'icon' => 'fa fa-window-maximize',
        'fields' => array(// A textarea field

        )
    ));

    //备份
    CSF::createSection($prefix, array(
        'title' => '备份',
        'desc' => '这里是备份',
        'icon' => 'fa fa-credit-card',
        'fields' => array(
            array(
                'type' => 'heading',
                'content' => '每次更新主题的时候，记得把相关配置导出备份哦~',
            ),
            array(
                'type' => 'backup',
            ),

        )
    ));

}
