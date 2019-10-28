<div id="content">
    <div class="container">
        <div class="row">
            <h2><span>Browse Blog Categories: </span></h2>
            <?php foreach ($categories as $category) { ?>
                <center>
                    <div class="span3">
                        <a href="<?php echo '/blog/category/' . get_book_slug($category->slug); ?>">
                            <div class="box clearfix">
                                <div class="box-header">
                                    <h4 class="box-title"><?php echo $category->name; ?></h4>
                                    <div class="box-tools pull-right">
                                        <span class="label <?php echo ($category->count) ? 'label-success' : 'label-default'; ?>"><?php echo $category->count; ?></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </center>
            <?php } ?>
        </div>
    </div>
</div>