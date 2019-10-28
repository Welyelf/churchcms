<div class="row"><br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="fas fa-calendar-alt fa-fw"></span>
            <b><i>Events</i> </b>
        </div>
        <div class="col-lg-10">
            <br/>
        </div>
        <div class="col-lg-2" style="margin-top:10px;">
            <a href="/admin/events/add/" class="btn btn-primary pull-right">
                <i class="fa fa-plus"></i> Add
            </a>
        </div>
        <br><br>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="events-list" class="table table-striped">
                    <thead>
                    <tr>
                        <th width="50%">Event Title</th>
                        <th width="20%">Event Type</th>
                        <th width="20%">Date/Time</th>
                        <th width="10%">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($events as $event) { ?>
                        <tr>
                            <td>
                                <a href="/events/view/<?php echo $event->id; ?>/" target="_blank"
                                   class="btn btn-xs btn-default"><i class="fa fa-eye"></i></a> &nbsp;
                                <a href="/admin/events/add/<?php echo $event->id; ?>/"><?php echo $event->title; ?></a>
                            </td>
                            <td><?php echo $event->recurrence; ?></td>
                            <td>
                                <?php
                                if ("none" == $event->recurrence) {
                                    // Fixed time stuck at 12:00 issue.
                                    echo date("Y-m-d", $event->datetime) . ' ';
                                    // Check if time exist, show 12 hours time if existing, blank if none.
                                    echo ($event->time) ? get_12_hour($event->time) : '';
                                } else if ("daily" == $event->recurrence) {

                                    $until = "";
                                    if (!empty($event->end_date)) {
                                        $until = " until " . date("F d, Y", $event->end_date);
                                    }

                                    if (!$event->end_date) {
                                        // Default end date for events should be the same day it starts. Not 1969-12-31. Issue #87.
                                        $until = " until " . date("F d, Y", $event->datetime);
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
                                    if (!$event->end_date) {
                                        // Default end date for events should be the same day it starts. Not 1969-12-31. Issue #87.
                                        $until = " until " . date("F d, Y", $event->datetime);
                                    }

                                    echo $recur_days . " @ " . get_12_hour($event->time) . $until;
                                } else if ("monthly" == $event->recurrence) {

                                    $until = "";
                                    if (!empty($event->end_date)) {
                                        $until = " until " . date("F d, Y", $event->end_date);
                                    }
                                    if (!$event->end_date) {
                                        // Default end date for events should be the same day it starts. Not 1969-12-31. Issue #87.
                                        $until = " until " . date("F d, Y", $event->datetime);
                                    }

                                    echo "every " . ordinal($event->day_monthly) . " of the month @ " . get_12_hour($event->time) . $until;

                                } else if ("yearly" == $event->recurrence) {

                                    $until = "";
                                    if (!empty($event->end_date)) {
                                        $until = " until " . date("F d, Y", $event->end_date);
                                    }
                                    if (!$event->end_date) {
                                        // Default end date for events should be the same day it starts. Not 1969-12-31. Issue #87.
                                        $until = " until " . date("F d, Y", $event->datetime);
                                    }

                                    echo "every " . get_month($event->month_yearly) . " " . ordinal($event->day_yearly) . " of the year @ " . get_12_hour($event->time) . $until;
                                } else if ("others" == $event->recurrence) {

                                    $until = "";
                                    if (!empty($event->end_date)) {
                                        $until = " until " . date("F d, Y", $event->end_date);
                                    }
                                    if (!$event->end_date) {
                                        // Default end date for events should be the same day it starts. Not 1969-12-31. Issue #87.
                                        $until = " until " . date("F d, Y", $event->datetime);
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
                            </td>
                            <td>
                                <a href="/admin/events/delete/<?php echo $event->id; ?>/"
                                   onclick="return confirm('Confirm Delete #<?php echo $event->id; ?> - <?php echo $event->title; ?>?')"
                                   class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
 