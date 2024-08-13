<?php
echo '<script>console.log("\n %c ' . THEME_NAME . '主题v' . THEME_VERSIONNAME . ' %c by parklot | ' . THEME_DOWNURL . '", "color:#000;background:#f90;padding:5px 0;", "color:#eee;background:#444;padding:5px 10px;");
</script>';
/*
喝水不忘挖井人，请勿删除版权，让更多人使用，作者才有动力更新下去
删版权可能会影响SEO哦，good luck
*/
?>
<div class="footer text-muted text-center py-3">
    <div class="container">
        <div class="frend-link mb-2">
            <?php
            $links = get_bookmarks(array(
                'orderby' => 'name',
            ));

            if (!empty($links)) {
                echo '友情链接：';
                foreach ($links as $link) {
                    echo '<a href="' . esc_url($link->link_url) . '" title="' . esc_attr($link->link_name) . '">' . esc_html($link->link_name) . '</a>';
                }
            }
            ?>
        </div>

        <div class="copy-right mb-2">
            Copyright © <?php bloginfo('name'); ?> |
            <?php
            echo _lot('baolog-website-create');
            ?> |
            <a href="https://beian.miit.gov.cn/" target="_blank"
                <?php if (!_lot('baolog-beian')) echo 'style="display:none;"'; ?>>
                <?php
                echo _lot('baolog-beian');
                ?>| </a>

<!--            --><?php //echo sprintf('本页面共 %d 次数据库查询，耗时 %.3f 秒', get_num_queries(), timer_stop(0, 3)) ?><!-- -->
            主题作者：<a href="https://github.com/paopao233/baolog">parklot</a>
        </div>

        <!--        <div class="loadtime">-->
        <!--            网页加载时间：--><?php //timer_stop(1); ?><!--/ms-->
        <!--            制作不易 请给个star 勿移除本声明-->
        <!--          主题作者：<a href="https://github.com/paopao233/baolog">parklot</a>-->
        <!--        </div>-->


    </div>
    <?php wp_footer(); ?>
</div>
</body>
<script src="<?php bloginfo('template_url'); ?>/assets/js/jquery-3.1.0.js"></script>
<script src="<?php bloginfo('template_url'); ?>/assets/js/lang.js"></script>
<script src="<?php bloginfo('template_url'); ?>/assets/js/popper.js"></script>
<script src="<?php bloginfo('template_url'); ?>/assets/js/bootstrap.js"></script>
<script src="<?php bloginfo('template_url'); ?>/assets/js/baolog-alert.js"></script>
<script src="<?php bloginfo('template_url'); ?>/assets/js/baolog-func.js"></script>
<script src="<?php bloginfo('template_url'); ?>/assets/js/baolog-page.js"></script>
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
            $.alert('请输入关键词后再搜索...', 30, {size: 'sm'});
            return false;
        }
    });
</script>
<script>
    $('.share-logo').click(function () {
        $('#shareModal').modal('hide')
    })

    $(".support-author").click(function () {
        $("#supportModalCenter").modal({});
    });
</script>

<div style="position: fixed; right: 10px; bottom: 20px;width: 100px;height: auto;">
    <?php baolog_advertisement("global-right"); ?>
</div>
</html>