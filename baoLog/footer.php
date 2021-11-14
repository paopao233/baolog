<?php
echo '<script>console.log("\n %c '. THEME_NAME .'主题v' . THEME_VERSIONNAME . ' %c by parklot | '. THEME_DOWNURL .'", "color:#000;background:#f90;padding:5px 0;", "color:#eee;background:#444;padding:5px 10px;");
</script>';
/*
喝水不忘挖井人，请勿删除版权，让更多人使用，作者才有动力更新下去
删版权可能会影响SEO哦，good luck
*/
?>
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
            <a href="https://beian.miit.gov.cn/" target="_blank">
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
</body>
<script src="<?php bloginfo('template_url'); ?>/js/jquery-3.1.0.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/lang.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/popper.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/bootstrap.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/baolog-alert.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/baolog-func.js"></script>
<?php 
    if (is_singular()) {
        wp_print_scripts('pagejs'); 
    }
?>

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
<script>
    $('.share-logo').click(function (){
        $('#shareModal').modal('hide')
    })

    $(".support-author").click(function(){
        $("#supportModalCenter").modal({
        });
    });
</script>

<div style="position: fixed; right: 10px; bottom: 20px;width: 100px;height: auto;">
    <?php baolog_advertisement("global-right"); ?>
</div>
</html>