<?php echo '<?xml version="1.0" encoding="UTF-8" ?>' ?>
<urlset xmlns="">
    <url>
        <loc><?php echo "https:" . base_url(); ?></loc>
    </url>

    <!-- Pages Sitemap -->
    <?php foreach ($pages as $page) { ?>
        <url>
            <loc><?php echo "https:" . "https:" . base_url() . $page->slug; ?></loc>
        </url>
    <?php } ?>

    <!-- Other Pages Sitemap -->
    <url>
        <loc><?php echo "https:" . base_url() . "/events"; ?></loc>
    </url>
    <url>
        <loc><?php echo "https:" . base_url() . "/events/month"; ?></loc>
    </url>
    <url>
        <loc><?php echo "https:" . base_url() . "/donations"; ?></loc>
    </url>
    <url>
        <loc><?php echo "https:" . base_url() . "/posts/blog"; ?></loc>
    </url>
    <url>
        <loc><?php echo "https:" . base_url() . "/volunteers"; ?></loc>
    </url>
    <url>
        <loc><?php echo "https:" . base_url() . "/watch-live"; ?></loc>
    </url>
    <url>
        <loc><?php echo "https:" . base_url() . "/contact"; ?></loc>
    </url>

    <!-- Categories Sitemap -->
    <?php foreach ($post_categories as $post_category) { ?>
        <url>
            <loc><?php echo "https:" . base_url() . $post_category->slug; ?></loc>
        </url>
    <?php } ?>

    <!-- Posts Sitemap -->
    <?php foreach ($posts as $post) { ?>
        <url>
            <loc><?php echo "https:" . base_url() . $post->slug; ?></loc>
        </url>
    <?php } ?>

    <!-- Sermons Sitemap -->
    <?php foreach ($sermons as $sermon) { ?>
        <url>
            <loc><?php echo "https:" . base_url() . $sermon->slug; ?></loc>
        </url>
    <?php } ?>

</urlset>