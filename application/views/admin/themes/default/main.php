<?php get_template('header'); ?>

    <div class="container body">
        <div class="main_container">
            <?php get_template('page_header'); ?>

            <?php get_content(); ?>

            <?php get_template('page_footer'); ?>
        </div>
    </div>

<?php get_template('footer'); ?>