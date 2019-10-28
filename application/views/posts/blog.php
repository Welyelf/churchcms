<div id="content">
    <div class="container">
        <div class="row">
            <h2>
                <center><span>Blogs</span></center>
            </h2>
            <?php
            if (!isset($posts)) {
                ?>
                <div class="alert alert-warning">No Posts Available!</div>
                <?php
            } else {


                foreach ($posts as $post) { ?>
                    <div class="panel panel-default panel-google-plus">
                        <div class="panel-heading">
                                    <span class="post-date">
                                        <?php echo date('F d, Y', $post->date); ?>
                                    </span>
                            <span class="post-title">
                                        <a href="<?php echo base_url("blog/" . $post->slug); ?>">
                                            <?php echo $post->title ?>
                                        </a>
                                    </span>
                            <?php //if (!empty($post->categories)) {
                            ?>
                            <small> <?php //echo $post->categories;
                                ?></small>
                            <?php// }
                            ?>
                        </div>
                        <div class="panel-body">
                            <p>
                                <?php echo $post->content; ?>
                            </p>
                        </div>
                        <div class="panel-footer">
                            <a href="<?php echo base_url("blog/" . $post->slug); ?>">
                                <button class="btn btn-success btn-sm">
                                    Read More...
                                </button>
                            </a>
                        </div>

                    </div>
                <?php }
            } ?>
            <div class="pagination">
                <?php if (isset($link)) {
                    echo $link;
                } ?>
                <div class="clear"></div>
            </div>
        </div>
        <br>
    </div>
</div>
