<?php
/**
Template Name: 蓝奏云盘直链解析
 **/
get_header(); ?>

    <body mpa-version="7.16.12" mpa-extension-id="aidjohbjielfdhcaookdaolppglahebo" data-new-gr-c-s-check-loaded="14.990.0"
          data-gr-ext-installed="">
<!--header-->
<main id="body">
    <div class="container">
        <div class="divider"></div>

        <div class="post-body">

            <!--内容-->
            <h2 class="d-flex justify-content-center" style="font-size: 1.5em;">蓝奏云盘直链解析</h2>
            <div class="input-group flex-nowrap mt-4">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-lanzou">蓝奏云地址</span>
                </div>
                <input type="text" class="form-control" id="input-lanzou" placeholder="请输入要解析的链接, 例：https://vpao.lanzouw.com/idwwKve3dzg">
                <div class="input-group-append">
                    <button class="btn btn-success" type="button" id="button-lanzou-clear">清空</button>
                    <button class="btn btn-dark " type="button" id="button-lanzou">开始解析</button>
                </div>
            </div>
            <span class="short-tips text-small text-danger mt-2 d-block">示例链接：https://vpao.lanzoui.com/idwwKve3dzg?w</span>
            <h5 class="my-4" style="border-left:2px solid #ec1611;padding-left:10px;">解析结果</h5>
            <div class="input-group flex-nowrap mt-4">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-lanzou">直链链接</span>
                </div>
                <input type="text" id="input-result" class="form-control" disabled="">

                <div class="input-group-append">
                    <button class="btn btn-dark" type="button" id="button-lanzou-copy">复制</button>
                </div>
            </div>

        </div>

    </div>
</main>

<!-- sidebar -->
<?php
get_sidebar();
?>
<!--footer-->
<?php get_footer(); ?>