<?php
if (count($widgets['page_header']) > 0) {
    foreach ($widgets['page_header'] as $widget) {
        echo $widget;
    }
}
?>

<div id="content">
    <div class="container">
        <div class="row">
            <div class="find_wrapper">
                <?php if (count($widgets['full-width']) > 0) { ?>
                    <div class="span12">
                        <div class="row">
                            <?php foreach ($widgets['full-width'] as $widget) {
                                echo $widget;
                            } ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if (count($widgets['content']) > 0) { ?>
                    <div class="span9">
                        <?php foreach ($widgets['content'] as $widget) {
                            echo $widget;
                        } ?>
                    </div>
                <?php } ?>
                <?php if (count($widgets['content']) > 0) { ?>
                    <div class="span3" style="position:relative;z-index:10;">
                        <?php foreach ($widgets['right_sidebar'] as $widget) {
                            echo $widget;
                        } ?>
                    </div>

                <?php } ?>
            </div>
        </div>
    </div>
</div>



