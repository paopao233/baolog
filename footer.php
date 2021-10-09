<div class="footer text-muted text-center py-3">
    <div class="container">
        <div class="frend-link mb-2">
            友情链接：
            <?php wp_get_links('after=&orderby=name'); ?>
        </div>

        <div class="copy-right">
            Copyright © <?php bloginfo('name'); ?> (<?php echo get_option('home'); ?>)
            <?php
            $options = get_option('baolog_framework');
            echo $options['baolog-website-create'];
            ?>
            <a href="http://beian.miit.gov.cn/" target="_blank">
                <?php
                $options = get_option('baolog_framework');
                echo $options['baolog-beian'];
                ?></a>

        </div>

        <div class="loadtime">
            网页加载时间：<?php timer_stop(1); ?>/ms
            <!--制作不易 请给个star 勿移除本声明-->
          主题作者：<a href="https://github.com/paopao233/baolog">parklot</a>
        </div>


    </div>
    <?php wp_footer(); ?>
</div>

<script src="<?php bloginfo('template_url'); ?>/js/jquery-3.1.0.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/lang.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/popper.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/bootstrap.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/baolog.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/bootstrap-plugin.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/async.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/post-content.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/baolog-like.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/baolog-top.js"></script>
<script>
    jsearch_form = $('#search_form');
    jsearch_form.on('submit', function () {
        var keyword = jsearch_form.find('input[name="s"]').val();
        if ($.trim(keyword) == '') {
            //php7.3 only
            $.alert('请输入关键词后再搜索...', 30, {size: 'sm'});
            return false;
        }
    });
</script>

<div class="mpa-sc mpa-plugin-article-gatherer mpa-new mpa-rootsc" data-z="100" style="display: block;"
     id="mpa-rootsc-article-gatherer"></div>
<div class="mpa-sc mpa-plugin-image-gatherer mpa-new mpa-rootsc" data-z="100" style="display: block;"
     id="mpa-rootsc-image-gatherer"></div>
<div class="mpa-sc mpa-plugin-page-clipper mpa-new mpa-rootsc" data-z="100" style="display: block;"
     id="mpa-rootsc-page-clipper"></div>
<div class="mpa-sc mpa-plugin-text-gatherer mpa-new mpa-rootsc" data-z="100" style="display: block;"
     id="mpa-rootsc-text-gatherer"></div>
<div class="mpa-sc mpa-plugin-video-gatherer mpa-new mpa-rootsc" data-z="100" style="display: block;"
     id="mpa-rootsc-video-gatherer"></div>
<div class="mpa-sc mpa-plugin-side-function-panel mpa-new mpa-rootsc" data-z="110" style="display: block;"
     id="mpa-rootsc-side-function-panel"></div>
<div class="mpa-sc mpa-plugin-notifier mpa-new mpa-rootsc" data-z="120" style="display: block;"
     id="mpa-rootsc-notifier"></div>
<div class="mpa-sc mpa-plugin-notification-manager mpa-new mpa-rootsc" data-z="130" style="display: block;"
     id="mpa-rootsc-notification-manager"></div>
</body>
<div id="edge-translate-notifier-container" class="edge-translate-notifier-center"></div>
<grammarly-desktop-integration data-grammarly-shadow-root="true"></grammarly-desktop-integration>

</html>