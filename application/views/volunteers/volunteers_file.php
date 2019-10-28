<div id="content">
    <div class="container">
        <div class="row">
            <h2>
                <center><span>VOLUNTEER SCHEDULES </span></center>
            </h2>
            <div class="row">
                <?php foreach ($volunteers_file as $file) { ?>
                    <?php if ($file->is_active) { ?>
                        <div class="span3">
                            <a href="<?php echo $file->file; ?>" target="_blank">
                                <div class="tile">
                                    <div class="wrapper">
                                        <div class="header"> <?php echo $file->name; ?></div>
                                        <div class="footer">
                                            <a href="<?php echo $file->file; ?>"
                                               class="btn btn-success btn-sm eventsBtn" target="_blank">
                                                VIEW
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>