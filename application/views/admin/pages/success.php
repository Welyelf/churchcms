<script type="text/javascript">

    <?php if($page_id == FALSE) { ?>
    localStorage.removeItem("pagetitle");
    localStorage.removeItem("pageslug");
    localStorage.removeItem('pagecontent');
    localStorage.removeItem("pagesubtitle");
    <?php } else { ?>
    localStorage.removeItem("pagetitle<?php echo $page_id; ?>");
    localStorage.removeItem("pageslug<?php echo $page_id; ?>");
    localStorage.removeItem('pagecontent<?php echo $page_id; ?>');
    localStorage.removeItem("pagesubtitle<?php echo $page_id; ?>");
    <?php } ?>

    setTimeout(function () {
        window.location = "<?php echo base_url($this->directory . 'pages'); ?>";
    }, 1000);
</script>
