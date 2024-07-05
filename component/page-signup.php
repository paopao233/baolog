<?php
/**
 * Template Name: BaoLog-注册页面
 **/
global $wpdb, $user_ID;

if (!$user_ID) { //判断用户是否登录
//这里添加登录表单代码
    get_header(); ?>

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
                                <input type="email" class="form-control" placeholder="请输入邮箱" name="email" id="email"
                                       required="">
                            </div>


                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon icon-user icon-fw"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="用户名长度为4到16位（字母，数字，下划线，减号）" name="username"
                                       id="username">
                            </div>


                            <div class="media">
                                <div class="media-body">
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon icon-lock icon-fw"></i></span>
                                        </div>
                                        <input type="password" class="form-control" placeholder="密码长度为6-20且必须包含数字和英文" name="password"
                                               id="password">
                                    </div>
                                </div>
                            </div>

                            <div class="media">
                                <div class="media-body">
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon icon-lock icon-fw"></i></span>
                                        </div>
                                        <input type="password" class="form-control" placeholder="请再次输入密码"
                                               name="confirmPassword"
                                               id="confirmPassword">
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
<?php get_sidebar();
      get_footer();
?>
<script src="<?php bloginfo('template_url'); ?>/js/lang.js"></script>
<script type="text/javascript">
    jQuery('form#signup').on('submit', function (e) {
        e.preventDefault();
        var newUserName = jQuery('form#signup #username').val();
        var newUserEmail = jQuery('form#signup #email').val();
        var newUserPassword = jQuery('form#signup #password').val();
        var newUserConfirmPassword = jQuery('form#signup #confirmPassword').val();
        
        if(<?php echo get_option('users_can_register'); ?> == 1){
            jQuery.ajax({
            type: "POST",
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            data: {
                action: "register_user_front_end",
                new_user_name: newUserName,
                new_user_email: newUserEmail,
                new_user_password: newUserPassword,
                new_user_confirm_password: newUserConfirmPassword,
            },
            success: function (data) {
                var res = JSON.parse(data);
                if (res.status === true) {
                    $.alert('注册成功，请点击用户登录链接进行登录', 30, {size: 'sm'});
                } else if(res.message == "The email format is incorrect"){
                    $.alert('邮箱格式错误，请输入正确的邮箱', 30, {size: 'sm'});
                } else if (res.message == "User Name and Email are mandatory") {
                    $.alert('邮箱和用户名是必须的', 30, {size: 'sm'});
                } else if (res.message == "User name already exixts.") {
                    $.alert('该用户已经存在，请更换邮箱或者用户名~', 30, {size: 'sm'});
                } else if (res.message == "not allow everyone to sign up") {
                    $.alert('该站点不允许注册哦~', 30, {size: 'sm'});
                } else if (res.message == "The two passwords are inconsistent") {
                    $.alert('两次密码不一致，请检查后再次输入', 30, {size: 'sm'});
                } else if (res.message == "The password format is incorrect") {
                    $.alert('密码必须包含字母和数字，长度要求在6到20位', 30, {size: 'sm'});
                } else if (res.message == "The username format is incorrect") {
                    $.alert('用户名长度必须为4到16位（可选字母、数字、下划线、减号）', 30, {size: 'sm'});
                } else {
                    $.alert('注册失败，出现未知的错误~', 30, {size: 'sm'});
                }
            },
            error: function (results) {
                console.log(results)
            }
        });
        } else {
            $.alert('该站点当前暂不接受新用户注册', 30, {size: 'sm'});
        }
   
    });
</script>

 <?php 

} else { //跳转到首页
    echo "<script type='text/javascript'>window.location='" . get_bloginfo('url') . "/wp-admin/'</script>";
}

