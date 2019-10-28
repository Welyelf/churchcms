<div id="content">
    <div class="container">
        <div class="row">
            <div class="span12">
                <h2>
                    <center><span><?php echo $month . ' ' . $day . ', ' . $year; ?> Events</span></center>
                </h2>
                <div class="row">

                    <p>
                        <?php
                        $timestamp = strtotime($day . ' ' . $month . ' ' . $year);
                        foreach ($events[$timestamp] as $details) { ?>
                        <?php
                        // Check if Time is not blank.
                        if ($details->time) {
                            // AM
                            if ($details->time < 12) {
                                $displayTime = $details->time . " AM";
                            } // PM
                            else if (12 == $details->time) {
                                $displayTime = $details->time . " PM";
                            } else {
                                $time = explode(":", $details->time);
                                $time[0] -= 12;
                                $displayTime = implode(":", $time) . " PM";
                            }
                        }
                        ?>
                    <div class="row">
                        <div class="span3"></div>
                        <div class="span6">
                            <div class="tile">
                                <div class="wrapper">
                                    <div class="header"><?php echo $details->title; ?></div>
                                    <div class="dates">
                                        <div class="start">
                                            <strong>STARTS</strong> <?php echo $displayTime; ?>
                                            <span></span>
                                        </div>
                                        <div class="ends">
                                            <strong>ENDS</strong>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <?php } ?>
                    <a href="/events/month/<?php echo date('Y-m-d', $timestamp); ?>"
                       class="btn btn-success btn-sm eventsBtn">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    </a>

                </div>
            </div>
        </div>
    </div>
</div>
       
   