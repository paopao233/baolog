           <!--wx-share-modal-->
                    <div class="modal fade" id="wxModalCenter" tabindex="-1" role="dialog" aria-labelledby="wxModalCenter" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content share-modal">
                                <div class="modal-header" style="border-bottom:none;">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="wxModal">
                                        <div class="d-flex flex-column">
                                            <p class="d-flex justify-content-center mb-3 font-weight-bold">本文章的二维码</p>
                                            <div class="d-flex justify-content-center  px-2">
                                                <img class="w-75 h-75" src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php the_permalink(); ?>" alt="<?php the_title(); ?>"/>
                                            </div>
                                            <p class="d-flex justify-content-center mt-3 font-weight-ligh">用手机扫码打开本页</p>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer" style="border-top:none">

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- share Modal -->
                    <div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModal"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content share-modal">
                                <div class="modal-header" style="border-bottom:none;">
                                    <h5 class="modal-title" id="shareModalLabel">选择分享的方式</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <div class="modal-body">
                                <!--share style-->
                                <div class="px-2 d-flex justify-content-around ">
                                    <a href="#" class="share-logo icon-wx" title="分享到微信" data-toggle="modal" data-target="#wxModalCenter"></a>
                                    <a href="https://service.weibo.com/share/share.php?url=<?php the_permalink(); ?>&title=<?php echo the_title();echo ' | ';echo bloginfo('name'); ?>&content=utf-8&source=<?php echo bloginfo('name'); ?>" rel=”nofollow” class="share-logo icon-wb" title="分享到微博" target="_blank"></a>
                                    <a href="https://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php the_permalink(); ?>&title=<?php echo the_title();echo ' | ';echo bloginfo('name'); ?>&content=utf-8" class="share-logo icon-qqzone" title="分享到QQ空间" target="_blank"></a>
                                    <a href="https://connect.qq.com/widget/shareqq/index.html?url=<?php the_permalink(); ?>&title=<?php echo the_title();?>" class="share-logo icon-qq-1" title="分享到QQ" target="_blank"></a>
                                </div>
                            </div>
                                <div class="modal-footer" style="border-top:none;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--support-modal-->
                    <div class="modal fade" id="supportModalCenter" tabindex="-1" role="dialog" aria-labelledby="supportModalCenter" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered " role="document">
                            <div class="modal-content share-modal">
                                <div class="modal-header" style="border-bottom:none;">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="nav flex-column nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">支付宝</a>
                                                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">微信</a>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="tab-content" id="v-pills-tabContent">
                                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab"><img src="<?php
                                                    $options = get_option( 'baolog_framework' );
                                                    echo $options['baolog-support-alipay'];
                                                    ?>"></div>
                                                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab"><img src="<?php
                                                    $options = get_option( 'baolog_framework' );
                                                    echo $options['baolog-support-wechat'];
                                                    ?>"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="border-top:none">
                                </div>
                            </div>
                        </div>
                    </div>