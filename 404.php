<?php
/*
* @author parklot
* @link https://github.com/paopao233
 */
get_header(); ?>
    <body mpa-version="7.16.12" mpa-extension-id="aidjohbjielfdhcaookdaolppglahebo"
          data-new-gr-c-s-check-loaded="14.990.0"
          data-gr-ext-installed="">
<!--header-->
<main id="body">
    <div class="container">
        <div class="divider"></div>
        <!-- 适用浏览器：360、FireFox、Chrome、Safari、Opera、傲游、搜狗、世界之窗. 不支持IE8及以下浏览器。-->
        <div class="post-body mb-5">
            <div class="col-md-12 text-center mt-5">
                <h1>404</h1>
                <h2>未找到对应的页面</h2>
            </div>
        </div>
        <!--按钮 -->
        <div  class="center-404">
            <button text="<?php echo get_option('home'); ?>" id="backHome"
                   onclick="backHome()"  type="button"
                    class="btn btn-secondary btn-lg btn-block">返回首页
            </button>
        </div>
    </div>
</main>


<script>
function backHome(){
    var ele = document.getElementById("backHome");
    var title = ele.getAttribute("text")
    window.location=title;
}
</script>


<!--footer-->
<?php get_footer(); ?>