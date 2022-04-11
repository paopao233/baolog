<?php
/**
Template Name: BaoLog-蓝奏云盘直链解析
 **/
get_header(); ?>

<!--header-->
<main id="body">
    <div class="container">
        <div class="divider"></div>

        <div class="post-body">

            <!--内容-->
            <h2 class="d-flex justify-content-start" style="font-size: 1.5em;">蓝奏云盘直链解析</h2>
            <div class="input-group flex-nowrap mt-4">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-lanzou">蓝奏云地址</span>
                </div>
                <input type="text" class="form-control" id="input-lanzou" placeholder="请输入要解析的链接, 例：https://vpao.lanzouw.com/idwwKve3dzg">
                <div class="input-group-append">
                    <button class="btn btn-success" type="button" id="button-lanzou-clear">清空</button>
                    <button class="btn btn-dark " type="button" id="button-lanzou">解析</button>
                </div>
            </div>
            <span class="short-tips text-small text-danger mt-2 d-block">示例链接：https://vpao.lanzoui.com/idwwKve3dzg?w</span>
            <h5 class="my-4" style="border-left:2px solid #ec1611;padding-left:10px;">解析结果</h5>
            <span class="short-tips text-small text-dangerd-block">注意：出现https://developer.lanzoug.com/file/0 则证明链接有误</span>
            <div class="input-group flex-nowrap mt-4">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-lanzou">直链链接</span>
                </div>
                <input type="text" id="input-result" class="form-control" disabled="">

                <div class="input-group-append">
                    <button class="btn btn-dark" type="button" id="button-lanzou-copy">复制</button>
                </div>
            </div>
            <div class="input-group flex-nowrap mt-4">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-lanzou">文件名称</span>
                </div>
                <input type="text" id="input-lanzou-name" class="form-control" disabled="">
            </div>
            <div class="input-group flex-nowrap mt-4">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-lanzou">文件大小</span>
                </div>
                <input type="text" id="input-lanzou-size" class="form-control" disabled="">
            </div>
            <div class="input-group flex-nowrap mt-4">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-lanzou">上传时间</span>
                </div>
                <input type="text" id="input-lanzou-time" class="form-control" disabled="">
            </div>
            <div class="input-group flex-nowrap mt-4">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="addon-lanzou">文件类型</span>
                </div>
                <input type="text" id="input-lanzou-type" class="form-control" disabled="">
            </div>
        </div>

    </div>
</main>

<?php get_sidebar();?>
<?php get_footer(); ?>