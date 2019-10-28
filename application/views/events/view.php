<div id="content">
    <div class="container">
        <div class="row">
            <div class="span12">
                <h2>
                    <center><span><?php echo $event->title; ?></span></center>
                </h2>
                <div class="row">
                    <p>
                    <div class="row">
                        <div class="span3"></div>
                        <div class="span6">
                            <div class="tile">
                                <div class="wrapper">
                                    <div class="header">
                                        <?php
                                        if ("none" == $event->recurrence) {
                                            echo unix_to_human($event->datetime);
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

                                            echo "Every " . $recur_days . " @ " . get_12_hour($event->time) . $until;
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
                                    <div class="dates">
                                        <div class="start">
                                            <strong>Location</strong> <?php echo $event->location; ?>
                                            <span></span>
                                        </div>
                                        <div class="ends">
                                            <strong>Details</strong> <?php echo $event->details; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        

       
   
