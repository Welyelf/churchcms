<div class="blogs-widget">
    <h2><span>Featured Blog Post</span></h2>
    <div class="container">
        <?php
        if (count($blog_posts) < 1) {
            echo "No Post";
        } else {
            foreach ($blog_posts as $posts) {
                ?>
                <div class="panel panel-default panel-google-plus">
                    <div class="panel-heading">
                                    <span class="post-date">
                                        <?php echo date('F d, Y', $posts->date); ?>
                                    </span>
                        <span class="post-title">
                                       <a href="blog/<?php echo $posts->slug; ?>">
                                                <?php
                                                if ($posts->title) {
                                                    echo string_max_length($posts->title, 60);
                                                } else {
                                                    echo "No Title.";
                                                }
                                                ?>
                                        </a>
                                    </span>
                    </div>
                    <div class="panel-body">
                        <p>
                            <?php
                            if ($posts->content) {
                                echo substr(strip_tags($posts->content), 0, $maximum_characters);
                            } else {
                                echo "No Content.";
                            }
                            ?>
                        </p>
                    </div>
                    <div class="panel-footer">
                        <a href="blog/<?php echo $posts->slug; ?>">
                            <button class="btn btn-success btn-sm">
                                Read More...
                            </button>
                        </a>
                    </div>
                </div>

                <?php
            }
        }
        ?>
    </div>
</div>


<style type="text/css">


</style>
