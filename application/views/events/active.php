<div id="content">
    <div class="container">
        <div class="row">
            <div class="span12">
                <h2><span>Active Events</span></h2><br/>
                <div class="row">
                    <?php $num = 1; ?>
                    <?php foreach ($events as $event) {

                        ?>
                        <div class="span4">
                            <div class="work1 clearfix">
                                <div class="txt1"><?php echo $num; ?></div>
                                <div class="txt2"><?php echo $event->title; ?> @ <?php echo $event->location; ?></div>
                            </div>
                            <div class="txt2">

                                <?php
                                if ("none" == $event->recurrence) {
                                    echo date('F d, Y', $event->datetime) . " " . get_12_hour($event->time);
                                } else if ("daily" == $event->recurrence) {

                                    $until = "";
                                    if (!empty($event->end_date)) {
                                        $until = " until " . date("F d, Y", $event->end_date);
                                    }

                                    echo "daily @ " . get_12_hour($event->time) . $until;
                                } else if ("weekly" == $event->recurrence) {
                                    $recur_days = "";
                                    $weekdays = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
                                    $days = str_split($event->day_weekly, 1);
                                    foreach ($days as $day) {
                                        $recur_days .= " " . $weekdays[$day] . ",";
                                    }
                                    $recur_days = rtrim($recur_days, ", ");

                                    $until = "";
                                    if (!empty($event->end_date)) {
                                        $until = " until " . date("F d, Y", $event->end_date);
                                    }

                                    echo $recur_days . " @ " . get_12_hour($event->time) . $until;
                                } else if ("monthly" == $event->recurrence) {

                                    $until = "";
                                    if (!empty($event->end_date)) {
                                        $until = " until " . date("F d, Y", $event->end_date);
                                    }

                                    echo "every " . ordinal($event->day_monthly) . " of the month @ " . get_12_hour($event->time) . $until;

                                } else if ("yearly" == $event->recurrence) {

                                    $until = "";
                                    if (!empty($event->end_date)) {
                                        $until = " until " . date("F d, Y", $event->end_date);
                                    }

                                    echo "every " . get_month($event->month_yearly) . " " . ordinal($event->day_yearly) . " of the year @ " . get_12_hour($event->time) . $until;
                                } else if ("others" == $event->recurrence) {

                                    $until = "";
                                    if (!empty($event->end_date)) {
                                        $until = " until " . date("F d, Y", $event->end_date);
                                    }

                                    $recur_months = "";
                                    $months = explode("|", $event->month_others);
                                    foreach ($months as $month) {
                                        $recur_months .= " " . get_month($month) . ",";
                                    }
                                    $recur_months = rtrim($recur_months, ", ");


                                    echo "every " . ucfirst($event->order_others) . " " . ucfirst($event->weekday_others) . " of " . $recur_months . " @ " . get_12_hour($event->time) . $until;
                                }
                                ?>

                            </div>
                            <p><?php echo $event->details; ?></p>
                        </div>


                        <?php $num++;
                    } ?>
                </div>

            </div>
        </div>
    </div>
</div>
