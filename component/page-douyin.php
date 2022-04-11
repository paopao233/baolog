<?php
/**
Template Name: BaoLog-抖音去水印解析
 **/
get_header(); ?>

    <!--header-->
    <main id="body">
        <div class="container">
            <div class="divider"></div>

            <div class="post-body">

                <!--内容-->
                <h2 class="d-flex justify-content-start" style="font-size: 1.5em;">抖音无水印视频在线解析下载工具</h2>
                <div class="input-group flex-nowrap mt-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="addon-douyin">视频链接</span>
                    </div>
                    <input type="text" class="form-control" id="input-douyin" placeholder="请输入要解析的链接, 例：https://v.douyin.com/Ng97rGm/">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="button" id="button-douyin-clear">清空</button>
                        <button class="btn btn-dark " type="button" id="button-douyin">解析</button>
                    </div>
                </div>
                <span class="short-tips text-small text-danger mt-2 d-block">示例链接：https://v.douyin.com/Ng97rGm/</span>
                <h5 class="my-4" style="border-left:2px solid #ec1611;padding-left:10px;">解析结果</h5>
                <div class="input-group flex-nowrap mt-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="addon-douyin">视频文案</span>
                    </div>
                    <input type="text" id="input-result-title" class="form-control" disabled="">
                    <div class="input-group-append">
                        <button class="btn btn-dark" type="button" id="button-douyin-copy">复制</button>
                    </div>
                </div>

                <div class="input-group flex-nowrap mt-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="addon-lanzou">封面图片</span>
                    </div>
                    <input type="text" id="input-result-cover" class="form-control" disabled="">
                    <div class="input-group-append">
                        <button class="btn btn-dark" type="button" id="button-douyin-cover">打开</button>
                    </div>
                </div>
                <div class="input-group flex-nowrap mt-4">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="addon-lanzou">无水印链接</span>
                    </div>
                    <input type="text" id="input-result-url" class="form-control" disabled="">
                    <div class="input-group-append">
                        <button class="btn btn-dark" type="button" id="button-douyin-url">打开</button>
                    </div>
                </div>
            </div>

        </div>
    </main>

<?php get_sidebar();?>
<?php get_footer(); ?>