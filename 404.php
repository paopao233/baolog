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
        <div class="post-body">
            <!--动画-->
            <div id="svgContainer"></div>
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

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/bodymovin.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/data.js"></script>
<script>
function backHome(){
    var ele = document.getElementById("backHome");
    var title = ele.getAttribute("text")
    window.location=title;
}
</script>
<script type="text/javascript">
    var svgContainer = document.getElementById('svgContainer');
    var animItem = bodymovin.loadAnimation({
        wrapper: svgContainer,
        animType: 'svg',
        loop: true,
        animationData: JSON.parse(animationData)
    });
</script>

<!--footer-->
<?php get_footer(); ?>