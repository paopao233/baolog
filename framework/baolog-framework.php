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
        'ajax_save' => false,
        'menu_title' => '' . THEME_NAME . '选项',
        'menu_slug' => 'baolog-framework',
    ));
    // 主题说明
    CSF::createSection($prefix, array(
        'title' => '主题说明',
        'icon' => 'fa fa-bell',
        'description' => '<div class="groups_title"><h3>欢迎使用BaoLog线报主题，当前主题版本为V' . THEME_VERSIONNAME . '</h3><p>亲爱的用户你好呀！感谢您支持我的作品，一套优秀的作品离不开大家的共同维护和支持！本主题是开源作品，请阅读以下几点。</p><p>1. 使用本主题时，请保留主题的底部作者信息，尊重作者劳动成果。</p><p>2. 主题将会开发Pro版本，请将你的想法告诉我，内测用户将免费使用。</p><br><h3>主题交流群</h3><p>1. 作者 Q Q ：1319082534</p><p>2. 线报主题用户交流QQ群：781506134(一群)，205747169（二群），759201452（站长交流群）</p><br><h3>主题在线文档</h3><p>1. <a href="https://www.yuque.com/parklot/pcod7h">线报主题使用文档</a> （
       目前正在一点点完善）</p><p>2. <a href="https://www.guluqiu.cc/archives/125.html">主题博文</a> </p><br><h3>关注作者</h3><p>1. 官方博客：<a href="https://baolog.loveasd.com">baolog.loveasd.com</a></p><p>2. GITHUB：<a href="https://github.com/paopao233/baolog">欢迎STAR</a></p><p>3. 作者QQ: 1319082534</p><p>4. 赞助我们：<a href="https://www.guluqiu.cc/donation.html">快来赞助我们呀</a></p></div>',
        'fields' => array()

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
            array(
                'type' => 'notice',
                'style' => 'success',
                'content' => '当前主题版本为V' . THEME_VERSIONNAME . ',请关注作者https://github.com/paopao233查看更新内容。加入QQ群一起探讨：781506134(一群)，205747169（二群），759201452（站长交流群）',
            ),
            array(
                'id' => 'baolog-favicon',
                'type' => 'upload',
                'title' => '网站图标',
                'default' => get_stylesheet_directory_uri() . '/favicon.ico',
                'desc' => '默认是主题根目录的favicon.ico，可直接替换或者在这里重新上传',
                'help' => '默认是主题根目录的favicon.ico，可直接替换或者在这里重新上传',
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
            array(
                'id' => 'baolog-posts-blank',
                'type' => 'switcher',
                'title' => '首页文章新标签打开方式',
                'subtitle' => '默认是当前标签载入文章',
                'text_off' => '已禁用',
                'text_on' => '已启用',
                'text_width' => 140
            ),
            array(
                'id' => 'baolog-gutenberg',
                'type' => 'switcher',
                'title' => '关闭古腾堡编辑器',
                'desc' => '关闭新版的文章编辑器',
                'subtitle' => '默认是开启古腾堡编辑器的，如果要禁用，需要自己在这里点开启此功能！',
                'text_off' => '已禁用',
                'text_on' => '已启用',
                'text_width' => 140,
            ),
            array(
                'id' => 'baolog-close-comment',
                'type' => 'switcher',
                'title' => '关闭全站评论',
                'desc' => '关闭全站的评论',
                'subtitle' => '评论默认是开启的',
                'text_off' => '已禁用',
                'text_on' => '已启用',
                'text_width' => 140,
            ),
            array(
                'id' => 'baolog-open-goto',
                'type' => 'switcher',
                'title' => '开启内链转外链跳转',
                'desc' => '在点击文章的链接时，主题会默认将外链转为内链。如：guluqiu.cc/goto.html?url=xxx。需要自己建立一个以goto为模板的页面, 链接地址必须为：xxx.com/goto.html',
                'subtitle' => '默认是没有跳转功能的',
                'text_off' => '已禁用',
                'text_on' => '已启用',
                'text_width' => 140,
            ),
            array(
                'id' => 'baolog-category-close',
                'type' => 'switcher',
                'title' => '开启去除URL中/category',
                'desc' => '开启/关闭这个功能后都得对现有的分类目录进行更新，否则会查找不到新的目录地址。',
                'subtitle' => '默认是没有开启的',
                'text_off' => '已禁用',
                'text_on' => '已启用',
                'text_width' => 140,
            )
        )
    ));

    // 首页设置
    CSF::createSection($prefix, array(
        'title' => '首页设置',
        'icon' => 'fa fa-window-maximize',
        'fields' => array(// A textarea field
            array(
                'type' => 'heading',
                'content' => '这里是有关首页的设置',
            ), array(
                'id' => 'baolog-subtitle',
                'type' => 'text',
                'title' => '网站描述',
                'subtitle' => '只显示在首页的副标题 例如：baolog主题真的是太好用啦！',
                'default' => '又一个Wordpress网站',
                'help' => '可为空',
            ), array(
                'id' => 'baolog-home-todayUpdate',
                'type' => 'switcher',
                'title' => '关闭文章&nbsp[今日更新]&nbsp提示',
                'desc' => '这个功能是在首页的文章那里，如果你的文章是今日更新的，那么就会显示一个[今日更新]文字。注意：如果服务器时间与北京时间不对，该功能将会失效。',
                'subtitle' => '主题默认是显示[今日更新]的提示的',
                'text_off' => '已禁用',
                'text_on' => '已启用',
                'text_width' => 140,
            ), array(
                'id' => 'baolog-home-one-layout',
                'type' => 'switcher',
                'title' => '开启首页单模块布局',
                'desc' => '本主题首页默认是有三个模块的，即[&nbsp最新线报、24小时热门、一周热门&nbsp]。开启此功能则不显示这三个模块，只显示最新的文章。',
                'text_off' => '已禁用',
                'text_on' => '已启用',
                'text_width' => 140,
            ),
        )
    ));

    // 页面设置
    CSF::createSection($prefix, array(
        'title' => '页面设置',
        'icon' => 'fa fa-navicon',
        'fields' => array(
            array(
                'type' => 'heading',
                'content' => '有关页面的设置',
            ),
            array(
                'type' => 'subheading',
                'content' => '页面配置，不是文章页面，单纯的页面的相关配置',
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
                'type' => 'heading',
                'content' => '有关文章页面的设置',
            ),
            array(
                'type' => 'subheading',
                'content' => '文章页面配置',
            ),
            array(
                'id' => 'baolog-posts-update',
                'type' => 'switcher',
                'title' => '开启文章3天内未更新提示',
                'subtitle' => '显示在文章页面',
                'text_off' => '已禁用',
                'text_on' => '已启用',
                'text_width' => 140
            ), array(
                'id' => 'baolog-posts-autosave',
                'type' => 'switcher',
                'title' => '禁用文章自动保存功能',
                'desc' => '编辑文章时，会自动保存草稿，如果嫌弃这个太累赘可以禁用！',
                'subtitle' => '默认是禁用',
                'text_off' => '已禁用',
                'text_on' => '已启用',
                'text_width' => 140,

            ),
            array(
                'id' => 'baolog-posts-revisions-to-keep',
                'type' => 'switcher',
                'title' => '禁用文章保存修订版本功能',
                'desc' => '当我们发布一个新文章时，以前的版本会保留着，如果觉得这个是累赘，可以禁用掉',
                'subtitle' => '默认是禁用',
                'text_off' => '已禁用',
                'text_on' => '已启用',
                'text_width' => 140,

            ),
            array(
                'id' => 'baolog-posts-content-tips',
                'type' => 'switcher',
                'title' => '开启文章内容来源提示',
                'subtitle' => '在文章页面下面的内容来源提示，暂不支持自定义，默认是禁用',
                'text_off' => '已禁用',
                'text_on' => '已启用',
                'text_width' => 140
            ),
            array(
                'id' => 'baolog-posts-content-tips-change',
                'type' => 'text',
                'title' => '文章页面底部来源提示内容',
                'desc' => '显示在文章的底部，默认内容是：本条线报内容来自互联网，所推荐内容不代表本站立场，请自行鉴别。必须是开启该功能修改才会生效。',
                'default' => '本条线报内容来自互联网，所推荐内容不代表本站立场，请自行鉴别。',
            ),
            array(
                'id' => 'baolog-opt-accordion-shortcodes',
                'type' => 'accordion',
                'title' => '短代码相关设置',
                'accordions' => array(
                    array(
                        'title' => '关注公众号相关配置',
                        'fields' => array(
                            array(
                                'id' => 'baolog-shortcodes-gzhgz-name',
                                'type' => 'text',
                                'title' => '公众号名字',
                                'default' => '万物天空',
                                'desc' => '请输入要关注获取密码的公众号，默认为博主的',
                            ),
                            array(
                                'id' => 'baolog-shortcodes-gzhgz-qrcode',
                                'type' => 'upload',
                                'title' => '公众号二维码',
                                'default' => get_stylesheet_directory_uri() . '/assets/images/gzhgz-qrcode.jpg',
                                'desc' => '请输入公众号的图片地址，默认为博主的。可以直接输入网址。',
                            ),
                        )
                    ),

                )
            ),


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
                'default' => get_stylesheet_directory_uri() . '/assets/images/page/support/alipay.png',
                'desc' => '默认是作者的，需要自己更换',
                'help' => '显示在文章的赞助网站的自定义页面图片',
                'subtitle' => '显示在文章的赞助网站的自定义页面图片',
            ),
            array(
                'id' => 'baolog-support-wechat',
                'type' => 'upload',
                'title' => '赞助我们-微信收款图片',
                'default' => get_stylesheet_directory_uri() . '/assets/images/page/support/wechat.png',
                'desc' => '默认是作者的，需要自己更换',
                'help' => '显示在文章的赞助网站的自定义页面图片',
                'subtitle' => '显示在文章的赞助网站的自定义页面图片',
            ),
            array(
                'type' => 'subheading',
                'content' => '侧栏相关图片配置',
            ),
            array(
                'id' => 'baolog-sidebar-app-switcher',
                'type' => 'switcher',
                'title' => '开启侧栏的app悬浮',
                'desc' => '关闭侧栏app悬浮以后，下面安卓app无论有没有图片都是不会显示的。',
                'subtitle' => '默认是关闭',
                'text_off' => '已禁用',
                'text_on' => '已启用',
                'text_width' => 140,
            ),
            array(
                'id' => 'baolog-sidebar-app',
                'type' => 'upload',
                'title' => '安卓app',
                'default' => get_stylesheet_directory_uri() . '/assets/images/app.png',
                'desc' => '默认是作者的，需要自己更换',
                'help' => '显示在侧栏的安卓app二维码',
                'subtitle' => '显示在侧栏的安卓app二维码',
            ),
            array(
                'id' => 'baolog-sidebar-qrcode-switcher',
                'type' => 'switcher',
                'title' => '开启侧栏的二维码悬浮',
                'desc' => '关闭侧栏的二维码悬浮以后，下面二维码图片无论有没有图片都是不会显示的。',
                'subtitle' => '默认是关闭',
                'text_off' => '已禁用',
                'text_on' => '已启用',
                'text_width' => 140,
            ),
            array(
                'id' => 'baolog-sidebar-wx',
                'type' => 'upload',
                'title' => '扫一扫关注微信公众号',
                'default' => get_stylesheet_directory_uri() . '/assets/images/wx.png',
                'desc' => '默认是作者的，需要自己更换，可为空，为空不显示',
                'help' => '显示在侧栏的扫描公众号二维码',
                'subtitle' => '显示在侧栏的扫描公众号二维码',
            ),
            array(
                'id' => 'baolog-sidebar-miniapp',
                'type' => 'upload',
                'title' => '扫一扫打开微信小程序',
                'default' => get_stylesheet_directory_uri() . '/assets/images/miniapp.png',
                'desc' => '默认是作者的，需要自己更换，可为空，为空不显示',
                'help' => '显示在文章的赞助网站的自定义页面图片',
                'subtitle' => '显示在侧栏的扫描微信小程序二维码',
            ),
            array(
                'id' => 'baolog-sidebar-qqapp',
                'type' => 'upload',
                'title' => '扫一扫打开QQ小程序',
                'default' => get_stylesheet_directory_uri() . '/assets/images/qqapp.png',
                'desc' => '默认是作者的，需要自己更换，可为空，为空不显示',
                'help' => '显示在文章的赞助网站的自定义页面图片',
                'subtitle' => '显示在侧栏的扫描QQ小程序二维码',
            ),
        )
    ));

    //广告设置
    CSF::createSection($prefix, array(
        'title' => '广告设置',
        'icon' => 'fa fa-bandcamp',
        'fields' => array(
            array(
                'type' => 'heading',
                'content' => '这里是有关全站广告位的设置，需要自己写好html和css样式，否侧会错位。',
            ),
            array(
                'type' => 'subheading',
                'content' => '全局广告',
            ),
            array(
                'id' => 'baolog-ad-global-right',
                'type' => 'code_editor',
                'sanitize' => false,
                'title' => '右下角固定广告',
                'desc' => '例如： &lt;a href="#" target="_blank"&gt;&lt;img style="width: 100%;" src="#"&gt;&lt;/a&gt;',
                'subtitle' => '自定义广告代码，可以放html代码，可放联盟广告',
                'help' => '为空则不显示',
            ),
            array(
                'type' => 'subheading',
                'content' => '文章广告',
            ),
            array(
                'id' => 'baolog-ad-single-content-bottom',
                'type' => 'code_editor',
                'sanitize' => false,
                'title' => '文章内容底部固定广告',
                'desc' => '例如： &lt;a href="#" target="_blank"&gt;&lt;img style="width: 100%;" src="#"&gt;&lt;/a&gt;',
                'subtitle' => '自定义广告代码，可以放html代码，可放联盟广告',
                'help' => '为空则不显示',
            ),
            array(
                'type' => 'subheading',
                'content' => '搜索页面广告',
            ),
            array(
                'id' => 'baolog-ad-search-bottom',
                'type' => 'code_editor',
                'sanitize' => false,
                'title' => '搜索页面内容底部广告',
                'desc' => '例如： &lt;a href="#" target="_blank"&gt;&lt;img style="width: 100%;" src="#"&gt;&lt;/a&gt;',
                'subtitle' => '自定义广告代码，可以放html代码，可放联盟广告',
                'help' => '为空则不显示',
            ),

        )
    ));

    //自定义代码
    CSF::createSection($prefix, array(
        'title' => '自定义代码',
        'icon' => 'fa fa-code',
        'fields' => array(
            array(
                'type' => 'heading',
                'content' => '这里是有关全站的自定义代码设置区域。',
            ),
            array(
                'id' => 'baolog-footer-custom',
                'type' => 'code_editor',
                'sanitize' => false,
                'title' => '自定义footer',
                'desc' => '例如：&lt;p type="text/javascript"&gt;This is inserted at the footer&lt;/p&gt;',
                'subtitle' => '显示在底部的链接，支持html代码，同样支持javascript',
                'help' => '为空则不显示',
            ), array(
                'id' => 'baolog-footer-analysis',
                'type' => 'code_editor',
                'sanitize' => false,
                'settings' => array(
                    'theme' => 'mbo',
                    'mode' => 'javascript',
                ),
                'title' => '统计代码',
                'desc' => '例如：&lt;script&gt;我是统计代码~&lt;/script&gt;',
                'subtitle' => '自定义统计代码,可用百度统计,CNZZ...',
                'help' => '为空则不显示',
            ),
            //加一个自定义CSS
        )
    ));

    //备份
    CSF::createSection($prefix, array(
        'title' => '主题配置备份',
        'desc' => '这里是对主题配置的一个备份',
        'icon' => 'fa fa-credit-card',
        'fields' => array(
            array(
                'type' => 'heading',
                'content' => '每次更新主题的时候，记得把相关配置导出备份哦~或者直接复制下面的代码，更新完以后再import就好了。',
            ),
            array(
                'type' => 'backup',
            ),

        )
    ));

}
