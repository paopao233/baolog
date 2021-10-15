    <ul class="baolog_side_nav">

    <li class="sidebar_app <?php baolog_check_sidebar_switcher("baolog-sidebar-app-switcher") ?>">
        <i class="baolog_sn1 icon-android"></i>
        <i class="baolog_sn_i"></i>
        <div class="baolog_sn2">
            <div class="wx_qrcode">
                <div class="qq_qr">
                    <img src="
                    <?php
                    $options = get_option('baolog_framework');
                    echo $options['baolog-sidebar-app'];
                    ?>">
                    <span>扫码下载安卓APP</span>
                </div>
            </div>
        </div>
    </li>
    <li class="sidebar_qrcode <?php baolog_check_sidebar_switcher("baolog-sidebar-qrcode-switcher") ?>">
        <i class="baolog_sn1 icon-weixin"></i>
        <i class="baolog_sn_i"></i>
        <div class="baolog_sn2">
            <div class="wx_qrcode">
                <div class="mr-3">
                    <img src="
                    <?php
                    $options = get_option('baolog_framework');
                    echo $options['baolog-sidebar-wx'];
                    ?>">
                    <span>微信扫一扫关注我们</span>
                </div>
                <div class="mr-3">
                    <img src="
                    <?php
                    $options = get_option('baolog_framework');
                    echo $options['baolog-sidebar-miniapp'];
                    ?>">
                    <span>微信扫一扫打开小程序</span>
                </div>
                <div class="qq_qr">
                    <img src="
                    <?php
                    $options = get_option('baolog_framework');
                    echo $options['baolog-sidebar-qqapp'];
                    ?>">
                    <span>手Q扫一扫打开小程序</span>
                </div>
            </div>
        </div>
    </li>
    <li id="gotop" style="display: none;">
        <i class="baolog_sn1 icon-chevron-up" ></i>
        <i class="baolog_sn_i"></i>
        <div class="baolog_sn2">返回顶部</div>
    </li>
</ul>