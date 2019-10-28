<div id="content">
    <div class="container">
        <div class="row">
            <div class="span12">
                <h2><span>Events</span></h2>
                <br>
                <a href="/events/index/<?php echo $prev_week; ?>" class="btn btn-success btn-sm eventsBtn">Previous
                    Week</a>
                <a href="/events/index/<?php echo $next_week; ?>" class="btn btn-success btn-sm pull-right eventsBtn">Next
                    Week</a>
                <br/>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <h1>Events</h1>
                        <div class="span6">
                            <?php
                            foreach ($events as $timestamp => $event) {
                                ?>
                                <h2><span><?php echo date('l, F d, Y', $timestamp) ?></span></h2>
                                <ul class="ul1">
                                    <?php
                                    foreach ($event as $details) {
                                        ?>
                                        <li>

                                            <?php
                                            // Check if Time is not blank. Then show 12 hour type of time.
                                            if ($details->time) {
                                                if ($details->time < 12)
                                                    echo $details->time . " AM";
                                                else {
                                                    $time = explode(":", $details->time);
                                                    // Check if time is equal 12 then do not subtract.
                                                    if ($time[0] != 12)
                                                        $time[0] -= 12;
                                                    echo implode(":", $time) . " PM";
                                                }
                                            }
                                            ?> - <?php echo $details->title; ?>


                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>

                                <ul class="ul1">
                                    <?php
                                    // Check sermons then add a link.
                                    foreach ($sermons as $sermon) {
                                        if ($sermon->date >= $timestamp && $sermon->date <= $timestamp) {
                                            ?>
                                            <li>
                                                <a href="/sermons/<?php echo $sermon->slug; ?>" target="_blank"><i
                                                            class="fa fa-xs fa-church"></i>
                                                    - <?php echo $sermon->title; ?></a>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>