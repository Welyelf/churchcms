<script type="text/javascript">

    <?php if($post_id == FALSE) { ?>
    localStorage.removeItem("title");
    localStorage.removeItem("slug");
    localStorage.removeItem('content');
    localStorage.removeItem("categories");
    <?php } else { ?>
    localStorage.removeItem("title<?php echo $post_id; ?>");
    localStorage.removeItem("slug<?php echo $post_id; ?>");
    localStorage.removeItem('content<?php echo $post_id; ?>');
    localStorage.removeItem("categories<?php echo $post_id; ?>");
    <?php } ?>

    setTimeout(function () {
        window.location = "<?php echo base_url($this->directory . 'posts/'); ?>";
    }, 1000);
</script>
