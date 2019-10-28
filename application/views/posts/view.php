<div id="content">
    <div class="container">
        <div class="row">
            <div class="panel panel-default panel-google-plus">
                <div class="panel-heading">
                                    <span class="post-date">
                                        <?php echo date('F d, Y', $post->date); ?>
                                    </span>
                    <span class="post-title"><?php echo $post->title ?></span>
                </div>
                <div class="panel-body">
                    <p>
                        <?php echo $post->content; ?>
                    </p>
                </div>
                <div class="panel-footer">
                    <p>- <i><?php echo $author->first_name . " " . $author->last_name; ?></i> -</p>
                    <p><?php echo $author->about; ?></p>

                </div>

            </div>
            <a href="<?php echo base_url("blog/"); ?>">
                <button class="btn btn-success btn-sm">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Blogs
                </button>
            </a>
        </div>
        <br>
    </div>
</div>
        