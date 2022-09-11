<?php
/*
* @author parklot
* @link https://github.com/paopao233
 */
if (isset($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('Please do not load this page directly. Thanks!');

if (_lot('baolog-close-comment'))
    return;
?>
<div class="divider"></div>
<div class="comment-body">
    <div class="comment-input">
        <h5 class="text-center font-weight-bold my-4">发表评论</h5>
        <div class="message">
            <?php
            //获取主题选项的值
            $options = get_option('baolog_framework');
            //查看是否有密码 有密码 输入密码后才可以查看评论
            if (post_password_required()) {
                echo '<div class="form-control" id="comments" style="height: 5rem;">';
                echo '<span class="">请输入密码后再查看评论内容~</span>';
                echo '</div>';
                return;//未登录不可以查看评论 所以返回空 不能进入下一步
            }
            
            // 未登录显示的评论框
            $comment_filed_login = '<p class="comment-form-comment"><textarea class="form-control" id="comments"  spellcheck="false" name="comment" placeholder="快来评论一下这篇文章吧(所有评论要经过管理员审核后才可以显示哦)~" aria-required="true"></textarea></p>';
            
            // 登录显示的评论框
            $comment_filed_no_login = '<div class="row" id="comment-author-info">
                            <div class="col-md-4">
                                <div class="form-group input-group">
            						<div class="input-group-prepend">
            							<span class="input-group-text"><i class="icon icon-user icon-fw"></i></span>
            						</div>
            						<input type="text" value="'.$comment_author .'" class="form-control" placeholder="昵称 *" id="author" name="author">
            					</div>                                  
                            </div>
                        
                            <div class="col-md-4">
                                <div class="form-group input-group">
            						<div class="input-group-prepend">
            							<span class="input-group-text"><i class="icon icon-envelope icon-fw"></i></span>
            						</div>
            						<input type="text" value="'.$comment_author_email .'" class="form-control" placeholder="Email *" id="email" name="email">
            					</div>                              
                            </div>
                            <div class="col-md-4">
                                <div class="form-group input-group">
            						<div class="input-group-prepend">
            							<span class="input-group-text"><i class="icon icon-link icon-fw"></i></span>
            						</div>
            						<input type="text" value="'.$comment_author_url .'" class="form-control" placeholder="你的网站" id="url" name="url">
            					</div>                                
                            </div>
                          </div>
                          <p class="comment-form-comment"><textarea class="form-control" id="comments"  spellcheck="false" name="comment" placeholder="快来评论一下这篇文章吧(所有评论要经过管理员审核后才可以显示哦)~" aria-required="true"></textarea></p>';
                          
            // 评论框未登录（包括有内容
            $comments_args_no_login = array(
                // change the title of send button
                'label_submit' => '发表评论',
                // change the title of the reply section
                'title_reply' => '',
                // remove "Text or HTML to be displayed after the set of comment fields"
                'comment_form_top' => 'ds',
                'comment_notes_before' => '',
                'comment_notes_after' => '',
                // redefine your own textarea (the comment body)
                'comment_field' => $comment_filed_no_login,
                'class_submit' => 'btn btn-sm btn-dark comment_submit',
            );
            
            // 评论框登录（包括有内容
            $comments_args_login = array(
                // change the title of send button
                'label_submit' => '发表评论',
                // change the title of the reply section
                'title_reply' => '',
                // remove "Text or HTML to be displayed after the set of comment fields"
                'comment_form_top' => 'ds',
                'comment_notes_before' => '',
                'comment_notes_after' => '',
                // redefine your own textarea (the comment body)
                'comment_field' => $comment_filed_login,
                'class_submit' => 'btn btn-sm btn-dark comment_submit',
            );
                          
             if ($post->comment_status == 'closed') {
                    echo '<div class="form-control" style="height: 5rem;">';
                    echo '<span class="">该文章暂时关闭了评论哦~</span>';
                    echo '</div>';
                }    
			
            // 是否已经登录
            if (is_user_logged_in()) {   
						if($post->comment_status != 'closed'){
							echo '<span class="margin-bottom:10px;"><i class="icon-comments mr-2 mb-1"></i>评论(' . $post->comment_count . '条评论)</span>';     
						}
    			     // 调用函数 显示评论框
                comment_form($comments_args_login);
            } else {
                 // 调用函数 显示评论框
                comment_form($comments_args_no_login);
            }
            
           

            //显示评论区
            wp_list_comments('type=comment&callback=aurelius_comment');

            //评论分页 https://wordpress.stackexchange.com/questions/125389/return-paginate-comments-links-as-array
            $pages = paginate_comments_links(array('echo' => false, 'type' => 'array', 'next_text' => '▶', 'prev_text' => '◀'));
            if ($pages != null) {
                echo '<ul class="pagination justify-content-center mt-md-5 mt-3 num-font">';
                $active = null;

                foreach ($pages as $page) {

                    if (strstr($page, 'current') != null) {
                        $active = 'active';
                    }
                    $page = str_replace("<a class=\"prev page-numbers", "<a class=\"prev page-numbers page-link", $page);
                    $page = str_replace("<a class=\"page-numbers", "<a class=\"page-numbers page-link", $page);
                    $page = str_replace("<a class=\"next page-numbers", "<a class=\"next page-numbers page-link", $page);
                    $page = str_replace("<span aria-current=\"page\" class=\"page-numbers current",
                        "<span aria-current=\"page\" class=\"page-numbers current page-link", $page);
                    echo "<li class='page-item " . $active . "'>" . $page . "</li>";
                    $active = null;
                }

                echo ' </ul>';
            }


            ?>


        </div>
    </div>
</div>

