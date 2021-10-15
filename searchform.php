<form action="<?php echo home_url('/'); ?>" id="search_form" method="get">
    <div class="input-group form-inline">
        <input type="text" name="s" placeholder="搜索一下..."
              style="box-shadow: none;" class="form-control form-control-sm" value="<?php the_search_query(); ?>">
        <div class="input-group-append">
            <button class="btn btn-dark btn-sm" type="submit">搜索</button>
        </div>
    </div>
</form>
