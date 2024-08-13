<?php get_header();
$is_one_layout = _lot('baolog-home-one-layout');
?>
    <!--header-->
    <main id="body">
        <div class="container">
            <div class="divider"></div>
            <!--文章内容区-->
            <div class="post-body">
                <?php if ($is_one_layout) { ?>
                    <ul class="list-group post-list mt-3">
                        <?php baolog_get_the_postsV2(); ?>
                    </ul>
                    <ul class="pagination justify-content-center mt-md-5 mt-3 num-font">
                        <?php baolog_pagenavi(); ?>
                    </ul>
                <?php } else { ?>
                    <ul class="nav nav-tabs justify-content-center" id="indexTab" role="tablist"
                        style="border-bottom: none">
                        <li class="nav-item">
                            <a class="nav-link active" id="newposts-tab" data-toggle="tab" href="#newposts" role="tab"
                               aria-controls="newposts" aria-selected="true">最新线报</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="dayhot-tab" data-toggle="tab" href="#dayhot" role="tab"
                               aria-controls="dayhot" aria-selected="false">24小时热门</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="weekhot-tab" data-toggle="tab" href="#weekhot" role="tab"
                               aria-controls="weekhot" aria-selected="false">一周热门</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="indexTabContent">
                        <div class="tab-pane fade show active" id="newposts" role="tabpanel"
                             aria-labelledby="newposts-tab">
                            <!--blog posts-->
                            <ul class="list-group post-list mt-3">
                                <?php baolog_get_the_postsV2(); ?>
                            </ul>
                            <ul class="pagination justify-content-center mt-md-5 mt-3 num-font">
                                <?php baolog_pagenavi(); ?>
                            </ul>
                        </div>
                        <div class="tab-pane fade" id="dayhot" role="tabpanel" aria-labelledby="dayhot-tab">
                            <?php baolog_get_most_viewed(30, 1); ?>
                        </div>
                        <div class="tab-pane fade" id="weekhot" role="tabpanel" aria-labelledby="weekhot-tab">
                            <?php baolog_get_most_viewed(30, 7); ?>
                        </div>
                    </div>
                <?php } ?>

            </div>


        </div>
    </main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>