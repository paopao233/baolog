<?php
/**
 * Template Name: 注册页面
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
                <!--注册卡片-->
                <div class="card">
                    <div class="card-header">
                        用户注册
                    </div>
                    <div class="card-body">
                        <form action="" method="post" id="signup">

                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon icon-envelope icon-fw"></i></span>
                                </div>
                                <input type="email" class="form-control" placeholder="Email" name="email" id="email"
                                       required="">
                            </div>


                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon icon-user icon-fw"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="用户名" name="username" id="username">
                            </div>


                            <div class="media">
                                <div class="media-body">
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon icon-lock icon-fw"></i></span>
                                        </div>
                                        <input type="password" class="form-control" placeholder="密码" name="password"
                                               id="password">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-dark btn-block" id="submit"
                                        data-loading-text="正在提交...">下一步
                                </button>
                            </div>


                            <div class="media">
                                <div>

                                </div>
                                <div class="media-body text-right">

                                    <a href="<?php
                                    $options = get_option('baolog_framework');
                                    echo $options['baolog-page-login'];
                                    ?>" class="text-muted"><small>用户登录</small></a>

                                </div>
                            </div>

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
<script type="text/javascript">
    jQuery('form#signup').on('submit', function (e) {
        e.preventDefault();
        var newUserName = jQuery('form#signup #username').val();
        var newUserEmail = jQuery('form#signup #email').val();
        var newUserPassword = jQuery('form#signup #password').val();
        jQuery.ajax({
            type: "POST",
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            data: {
                action: "register_user_front_end",
                new_user_name: newUserName,
                new_user_email: newUserEmail,
                new_user_password: newUserPassword
            },
            success: function (data) {
                var res = JSON.parse(data);
                if (res.status === true) {
                    window.alert("注册成功，请点击用户登录链接进行登录~");
                }else if (res.message=="User Name and Email are mandatory"){
                    alert("邮箱和用户名是必须的~");
                }else if (res.message=="User name already exixts."){
                    alert("该用户已经存在，请更换邮箱或者用户名~");
                }else{
                    alert("注册失败，出现未知的错误~")
                }
            },
            error: function (results) {
                console.log(results)
            }
        });
    });
</script>
<!--footer-->
    <?php get_footer();

} else { //跳转到首页
    echo "<script type='text/javascript'>window.location='" . get_bloginfo('url') . "/wp-admin/'</script>";
}

