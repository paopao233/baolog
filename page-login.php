<?php
/*
* @author parklot
* @link https://github.com/paopao233
 */
/**
 * Template Name: 登录页面
 **/

global $wpdb, $user_ID;

if (!$user_ID) { //判断用户是否登录
//这里添加登录表单代码
    get_header(); ?>

    <body mpa-version="7.16.12" mpa-extension-id="aidjohbjielfdhcaookdaolppglahebo"
          data-new-gr-c-s-check-loaded="14.990.0"
          data-gr-ext-installed="">
<!--header-->
<main id="body">
    <div class="container">
        <div class="divider"></div>

        <div class="row">
            <div class="col-lg-6 mx-auto">
                <!-- 输出结果 -->

                <!--登录卡片-->
                <div class="card">
                    <div class="card-header">
                        用户登录
                    </div>
                    <div class="card-body ajax_modal_body">
                        <form action="" method="post" id="form">
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon icon-user icon-fw"></i></span>
                                </div>
                                <input required type="text" class="form-control" placeholder="Email / 用户名" id="email"
                                       name="email">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon icon-lock icon-fw"></i></span>
                                </div>
                                <input required type="password" class="form-control" placeholder="密码" id="password"
                                       name="password">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-dark btn-block" id="submit"
                                        data-loading-text="正在提交...">登录
                                </button>
                            </div>

                            <div class="media">
                                <!--                                <div>-->
                                <!--                                    <a href="qq_login.htm" target="_blank" title="QQ 登录" class="small mr-1"><span class="icon-qq"></span> QQ登录</a>-->
                                <!--                                </div>-->
                                <div class="media-body text-right">

                                    <a href="<?php
                                    $options = get_option('baolog_framework');
                                    echo $options['baolog-page-signup'];
                                    ?>"
                                       class="text-muted"><small>用户注册</small></a>

                                </div>
                            </div>
                            <?php wp_nonce_field('ajax-login-nonce', 'security'); ?>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</main>

<!-- sidebar -->
<?php
get_sidebar();
?>
<script src="<?php bloginfo('template_url'); ?>/js/bbs.js"></script>

<!--footer-->
    <?php get_footer();

} else { //跳转到首页
    echo "<script type='text/javascript'>window.location='" . get_bloginfo('url') . "/wp-admin/'</script>";
}

