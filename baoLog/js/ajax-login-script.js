jQuery(document).ready(function ($) {

    // Perform AJAX login on form submit
    $('form#form').on('submit', function (e) {
        var username = $('form#form #email').val();
        var password = $('form#form #password').val();
        if (username==""||password==""){
            $.alert('用户名和密码不能未空~', 30, {size: 'sm'});
            return;
        }else{
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_login_object.ajaxurl,
                data: {
                    'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
                    'username': username,
                    'password': password,
                    'security': $('form#form #security').val()
                },
                success: function (data) {
                    console.log(data)
                    if (data.loggedin == true) {
                        $.alert('登录成功，正在跳转中~', 30, {size: 'sm'});
                        document.location.href = data.portal;
                    }else{
                        $.alert('登录失败，请检查您的用户名或者密码~', 30, {size: 'sm'});
                    }
                },error:function (res){
                    console.log("登录失败")
                }
            });
        }

        e.preventDefault();
    });

});
