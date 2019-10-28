<div id="content">
    <div class="container">
        <div class="row">
            <h2><span>Category: <?php echo $category_name; ?></span></h2>
            <?php foreach ($posts as $post) { ?>
                <article>
                    <small class="meta-date"><?php echo date('m-d-y', $post->date); ?></small>
                    <h1><a href="<?php echo base_url("blog/" . $post->slug); ?>"><?php echo $post->title ?></a></h1>
                    <br/>
                    <?php echo $post->content; ?>
                    <br/>
                    <?php if (!empty($post->categories)) { ?>
                        <small>in <?php echo $post->categories; ?></small>
                    <?php } ?>
                    <div class="content-divider-long"></div>
                </article>
            <?php } ?>
            <div class="pagination">
                <?php /* echo $this->pagination->create_links();*/ ?>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>
