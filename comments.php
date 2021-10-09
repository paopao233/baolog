<?php
/*
* @author parklot
* @link https://github.com/paopao233
 */
if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('Please do not load this page directly. Thanks!');

?>

<div class="comment-body">
    <div class="comment-input">
        <h5 class="text-center font-weight-bold">发表评论</h5>
        <div class="message">

            <?php
            //获取主题选项的值
            $options = get_option('baolog_framework');
            //查看是否有密码 有密码 输入密码后才可以查看评论
            if (post_password_required()) {
                echo '<div class="form-control my-5" id="comments" style="height: 5rem;">';
                echo '<span class="">请输入密码后再查看评论内容~</span>';
                echo '</div>';
                return;//未登录不可以查看评论 所以返回空 不能进入下一步
            }

            //是否已经登录
            if (is_user_logged_in()) {
                if ($post->comment_status == 'closed') {
                    echo '<div class="form-control my-5" style="height: 5rem;">';
                    echo '<span class="">该文章暂时关闭了评论哦~</span>';
                    echo '</div>';
                } else {
                    //评论区（包括有内容

            $comments_args = array(
                        // change the title of send button
                        'label_submit' => '发表评论',
                        // change the title of the reply section
                        'title_reply' => '',
                        // remove "Text or HTML to be displayed after the set of comment fields"
                        'comment_form_top' => 'ds',
                        'comment_notes_before' => '',
                        'comment_notes_after' => '',
                        // redefine your own textarea (the comment body)
                        'comment_field' => '<p class="comment-form-comment"><textarea class="form-control" id="comments" style="height: 5rem;box-shadow: none;" spellcheck="false" name="comment" placeholder="快来评论一下这篇文章吧(所有评论要经过管理员审核后才可以显示哦)~" aria-required="true"></textarea></p>',
                        'class_submit' => 'btn btn-sm btn-dark',
                    );

                    comment_form($comments_args);

                }

            } else {
                echo '<div class="form-control my-5" id="comments" style="height: 5rem;">';
                echo '<span class="">请先<a href="';
                echo $options['baolog-page-login']."/?redirect_to=".urlencode(get_permalink());
                echo '">登录</a>后再评论~</span>';
                echo '</div>';

            }

            //显示评论区
            wp_list_comments('type=comment&callback=aurelius_comment');
            //

            ?>


        </div>
    </div>
</div>
