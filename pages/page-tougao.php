<?php
/*
* @author parklot
* @link https://github.com/paopao233
* Template Name: BaoLog-投稿
 */
get_header();

$options = get_option('baolog_framework');
?>
<body>
<main id="body">
    <div class="container">
        <div class="divider"></div>
        <div class="thread-body">
            <div class="thread-top text-center my-4">
                <h1 class="title font-weight-bold mb-3">
                    <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                </h1>
            </div>

            <div class="divider"></div>
            <div class="thread-content message break-all">
                <!--内容区-->
                <!--文章内容-->
                <?php the_content(); ?>
                <form method="post" action="<?php echo $_SERVER["REQUEST_URI"];
                $current_user = wp_get_current_user(); ?>" class="row" id="submitForm">
                <div class="t1 tt col-sm-4">
                    <div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="icon icon-user icon-fw"></i></span>
						</div>
						<input class="form-control" type="text" size="40" placeholder="昵称*"
                           value="<?php if (0 != $current_user->ID) echo $current_user->user_login; ?>" name="tougao_authorname" id="tougao_authorname" tabindex="1" />
					</div>                                  
                </div>
                <div class="t2 tt col-sm-4">
                    <div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="icon icon-envelope icon-fw"></i></span>
						</div>
				       <input class="form-control" type="text" size="40" placeholder="您的邮箱*"
                           value="<?php if (0 != $current_user->ID) echo $current_user->user_email; ?>" name="tougao_authoremail"
                           id="tougao_authoremail" tabindex="2"/>
					</div>    
                </div>
                <div class="t3 tt col-sm-4">
                     <div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="icon icon-link icon-fw"></i></span>
						</div>
		                 <input class="form-control" type="text" size="40" placeholder="您的网站"
                           value="<?php if (0 != $current_user->ID) echo $current_user->user_url; ?>" name="tougao_site"
                           id="tougao_site" tabindex="4"/>
			    	</div>    
                </div>
                <div class="t4 tt col-sm-4">
                    <div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="icon icon-font icon-fw"></i></span>
						</div>
                          <input class="form-control" type="text" size="40" value="" name="tougao_title" id="tougao_title" tabindex="3" placeholder="文章标题*（6到50字之间）"/>
			    	</div>
                </div>
                <div class="t5 tt col-sm-4">
                    <div class="form-group input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="icon icon-flag icon-fw"></i></span>
						</div>
                         <input class="form-control" type="text" size="40" value="" name="tougao_tags" id="tougao_tags" tabindex="5" placeholder="文章标签*（以英文逗号分开"/>
			    	</div>
                </div>
                <div class="t6 tt col-sm-4">
                    <!--文章分类*(必选)-->
                    <div class="form-group input-group">
            			<div class="input-group-prepend">
							<span class="input-group-text"><i class="icon icon-reorder icon-fw"></i></span>
						</div>
                            <?php wp_dropdown_categories('show_count=0&hierarchical=1&hide_empty=0&class=form-control'); ?>
                        
                    </div>
                </div>
                    <div class="clear"></div>
                    <div id="postform">
                        <textarea rows="15" cols="70" class="form-control col-sm-12" id="tougao_content"
                                  name="tougao_content" tabindex="6" placeholder="请输入文章内容...注意文章是带格式化的。"></textarea>
                        <p>字数限制：50到1000字之间</p>
                    </div>
                    <div class="col-sm-12" id="submit_post">
                        <input type="hidden" value="send" name="tougao_form"/>
                        <input class="btn btn-danger pull-right" type="submit" name="submit" value="投稿文章" tabindex="7"/>
                        <input class="btn btn-outline-secondary pull-right" type="reset" name="reset" value="重填内容" tabindex="8"/>
                    </div>
                </form>
            </div>


            
            <!--返回首页-->
            <div class="back_index text-center num-font mb-4">
                <a href="<?php echo get_option('home'); ?>" class="text-small" style="color: gray;">
                    << · Back Index ·>>
                </a>
            </div>
        </div>
</main>
<script type="text/javascript" src="<?php echo home_url(); ?>/wp-includes/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        selector: '#tougao_content',
        menubar: false,
        //toolbar: false,
    });

    document.getElementById('submitForm').addEventListener('submit', function(event) {
        var name = document.getElementById('tougao_authorname').value.trim();
        var title = document.getElementById('tougao_title').value.trim();
        var email = document.getElementById('tougao_authoremail').value.trim();
        var content = document.getElementById('tougao_content').value.trim();
        var tags = document.getElementById('tougao_tags').value.trim();

        if (name === '') {
            alert('昵称必须填写，且长度不得超过20个字');
            event.preventDefault();
            return false;
        } else if (name.length > 20) {
            alert('你的名字怎么这么长啊，起个简单易记的吧，长度不要超过20个字哟!');
            event.preventDefault();
            return false;
        } else if (title === '') {
            alert('文章标题必须填写，长度6到50个字之间');
            event.preventDefault();
            return false;
        } else if (title.length > 50) {
            alert('文章标题太长了，长度不得超过50个字');
            event.preventDefault();
            return false;
        } else if (title.length < 6) {
            alert('文章标题太短了，长度不得少于6个字');
            event.preventDefault();
            return false;
        } else if (email === '' || !isValidEmail(email)) {
            alert('Email必须填写，必须符合Email格式');
            event.preventDefault();
            return false;
        } else if (content === '') {
            alert('内容必须填写，不要太长也不要太短，50到1000个字之间');
            event.preventDefault();
            return false;
        } else if (content.length > 1000) {
            alert('你也太能写了吧，写这么多，别人看着也累呀，50到1000个字之间');
            event.preventDefault();
            return false;
        } else if (content.length < 50) {
            alert('太简单了吧，才写这么点，再加点内容吧，50到1000个字之间');
            event.preventDefault();
            return false;
        } else if (tags === '') {
            alert('不要这么懒吗，加个标签好让别人搜到你的文章，长度在2到8个字！');
            event.preventDefault();
            return false;
        } else if (tags.length < 2) {
            alert('不要这么懒吗，加个标签好让别人搜到你的文章，长度在2到8个字！');
            event.preventDefault();
            return false;
        } else if (tags.length > 8) {
            alert('标签不用太长，长度在2到8个字就可以了！');
            event.preventDefault();
            return false;
        }

        // 其他校验逻辑可以继续添加

        return true;
    });
    // 判断邮箱格式是否正确的辅助函数
    function isValidEmail(email) {
        var emailRegex = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
        return emailRegex.test(email);
    }
</script>
<!-- sidebar -->
<?php
get_sidebar();
?>
<!--footer-->
<?php get_footer(); ?>


