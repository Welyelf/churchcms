<?php
if (!empty($page->template)) {
    $this->load->view('pages/templates/' . $page->template);
} else { ?>
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="find_wrapper">
                    <div class="span12">
                        <h2>
                            <center><span><?php echo $page->title ?></span></center>
                        </h2>
                        <div class="row">
                            <center>
                                <div class="col-lg-12">
                                    <h3>
                                        <?php echo $page->subtitle; ?>
                                    </h3>
                                    <?php echo $page->content; ?>
                                    <br>
                                </div>
                            </center>
                        </div>
                        <br><br>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php

} ?>

