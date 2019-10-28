<div class="row">
    <div class="col-lg-12">
        <div class="row" style="border-bottom: 1px solid #EEE">
            <div class="col-lg-10">
                <h1>Add Event</h1>
            </div>
        </div>
        <br/>
    </div>
</div>


<div class="row"><br>
    <div class="panel panel-default">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <span class="fas fa-calendar-alt fa-fw"></span>
                <li class="breadcrumb-item">
                    <a href="/admin/events"><b><i>Events</i></b></a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Event</li>
            </ol>
        </nav>
        <div class="panel-body">
            <form method="post">
                <div class="row">
                    <div class="col-lg-10z col-lg-offset-1">
                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <input type="text" class="form-control" name="title" value="<?php echo $event->title; ?>"
                                   required/>
                            <?php echo form_error('title'); ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Location</label>
                            <input type="text" class="form-control" name="location"
                                   value="<?php echo $event->location; ?>"/>
                            <?php echo form_error('location'); ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Details</label>
                            <textarea class="form-control" name="details"><?php echo $event->details; ?></textarea>
                            <?php echo form_error('details'); ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Repeat</label>
                            <select class="form-control" name="recurrence" id="recurrence">
                                <!-- Edit event should allow editing the repeat line. Issue #88. -->
                                <option value="none" <?php echo $event->recurrence == "none" ? 'selected="selected"' : ''; ?>>
                                    None
                                </option>
                                <option value="daily" <?php echo $event->recurrence == "daily" ? 'selected="selected"' : ''; ?>>
                                    Daily
                                </option>
                                <option value="weekly" <?php echo $event->recurrence == "weekly" ? 'selected="selected"' : ''; ?>>
                                    Weekly
                                </option>
                                <option value="monthly" <?php echo $event->recurrence == "monthly" ? 'selected="selected"' : ''; ?>>
                                    Monthly
                                </option>
                                <option value="yearly" <?php echo $event->recurrence == "yearly" ? 'selected="selected"' : ''; ?>>
                                    Yearly
                                </option>
                                <option value="others" <?php echo $event->recurrence == "others" ? 'selected="selected"' : ''; ?>>
                                    Others
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Time</label>
                            <input type="time" class="form-control" name="time" value="<?php echo $event->time; ?>"
                                   required/>
                            <?php echo form_error('time'); ?>
                        </div>
                        <div class="row weekly-set">
                            <div class="col-lg-12">
                                <label class="control-label">Day of the week</label>
                            </div>

                            <div class="col-lg-5 col-lg-offset-1">
                                <div class="checkbox">
                                    <?php $weekdays = str_split($event->day_weekly); ?>
                                    <label><input
                                                name="day_weekly[]" <?php echo in_array(0, $weekdays) ? 'checked="checked"' : ''; ?>
                                                type="checkbox" value="0"> Sunday</label>
                                </div>
                                <div class="checkbox">
                                    <label><input
                                                name="day_weekly[]" <?php echo in_array(1, $weekdays) ? 'checked="checked"' : ''; ?>
                                                type="checkbox" value="1"> Monday</label>
                                </div>
                                <div class="checkbox">
                                    <label><input
                                                name="day_weekly[]" <?php echo in_array(2, $weekdays) ? 'checked="checked"' : ''; ?>
                                                type="checkbox" value="2"> Tuesday</label>
                                </div>
                                <div class="checkbox">
                                    <label><input
                                                name="day_weekly[]" <?php echo in_array(3, $weekdays) ? 'checked="checked"' : ''; ?>
                                                type="checkbox" value="3"> Wednesday</label>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="checkbox">
                                    <label><input
                                                name="day_weekly[]" <?php echo in_array(4, $weekdays) ? 'checked="checked"' : ''; ?>
                                                type="checkbox" value="4"> Thursday</label>
                                </div>
                                <div class="checkbox">
                                    <label><input
                                                name="day_weekly[]" <?php echo in_array(5, $weekdays) ? 'checked="checked"' : ''; ?>
                                                type="checkbox" value="5"> Friday</label>
                                </div>
                                <div class="checkbox">
                                    <label><input
                                                name="day_weekly[]" <?php echo in_array(6, $weekdays) ? 'checked="checked"' : ''; ?>
                                                type="checkbox" value="6"> Saturday</label>
                                </div>
                            </div>
                        </div>
                        <div class="row monthly-set">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">Day of the Month</label>
                                    <select class="form-control" name="day_monthly">
                                        <?php for ($x = 1; $x <= 31; $x++) { ?>
                                            <option value="<?php echo $x ?>" <?php echo $event->day_monthly == $x ? 'selected="selected"' : ''; ?>><?php echo $x; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row yearly-set">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Month</label>
                                    <select class="form-control" name="month_yearly">
                                        <option value="1" <?php echo $event->month_yearly == 1 ? 'selected="selected"' : ''; ?>>
                                            January
                                        </option>
                                        <option value="2" <?php echo $event->month_yearly == 2 ? 'selected="selected"' : ''; ?>>
                                            February
                                        </option>
                                        <option value="3" <?php echo $event->month_yearly == 3 ? 'selected="selected"' : ''; ?>>
                                            March
                                        </option>
                                        <option value="4" <?php echo $event->month_yearly == 4 ? 'selected="selected"' : ''; ?>>
                                            April
                                        </option>
                                        <option value="5" <?php echo $event->month_yearly == 5 ? 'selected="selected"' : ''; ?>>
                                            May
                                        </option>
                                        <option value="6" <?php echo $event->month_yearly == 6 ? 'selected="selected"' : ''; ?>>
                                            June
                                        </option>
                                        <option value="7" <?php echo $event->month_yearly == 7 ? 'selected="selected"' : ''; ?>>
                                            July
                                        </option>
                                        <option value="8" <?php echo $event->month_yearly == 8 ? 'selected="selected"' : ''; ?>>
                                            August
                                        </option>
                                        <option value="9" <?php echo $event->month_yearly == 9 ? 'selected="selected"' : ''; ?>>
                                            September
                                        </option>
                                        <option value="10" <?php echo $event->month_yearly == 10 ? 'selected="selected"' : ''; ?>>
                                            October
                                        </option>
                                        <option value="11" <?php echo $event->month_yearly == 11 ? 'selected="selected"' : ''; ?>>
                                            November
                                        </option>
                                        <option value="12" <?php echo $event->month_yearly == 12 ? 'selected="selected"' : ''; ?>>
                                            December
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Day</label>
                                    <select class="form-control" name="day_yearly">
                                        <?php for ($x = 1; $x <= 31; $x++) { ?>
                                            <option value="<?php echo $x ?>" <?php echo $event->day_yearly == $x ? 'selected="selected"' : ''; ?>><?php echo $x; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row others-set">
                            <div class="col-lg-12">
                                <label class="control-label">Day</label>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <select class="form-control" name="order_others" id="order_others">
                                        <option value="first" <?php echo $event->order_others == "first" ? 'selected="selected"' : ''; ?>>
                                            1st
                                        </option>
                                        <option value="second" <?php echo $event->order_others == "second" ? 'selected="selected"' : ''; ?>>
                                            2nd
                                        </option>
                                        <option value="third" <?php echo $event->order_others == "third" ? 'selected="selected"' : ''; ?>>
                                            3rd
                                        </option>
                                        <option value="fourth" <?php echo $event->order_others == "fourth" ? 'selected="selected"' : ''; ?>>
                                            4th
                                        </option>
                                        <option value="fifth" <?php echo $event->order_others == "fifth" ? 'selected="selected"' : ''; ?>>
                                            5th
                                        </option>
                                        <option value="last" <?php echo $event->order_others == "last" ? 'selected="selected"' : ''; ?>>
                                            Last
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <select class="form-control" name="weekday_others" id="weekday_others">
                                        <option value="monday" <?php echo $event->weekday_others == "monday" ? 'selected="selected"' : ''; ?>>
                                            Monday
                                        </option>
                                        <option value="tuesday" <?php echo $event->weekday_others == "tuesday" ? 'selected="selected"' : ''; ?>>
                                            Tuesday
                                        </option>
                                        <option value="wednesday" <?php echo $event->weekday_others == "wednesday" ? 'selected="selected"' : ''; ?>>
                                            Wednesday
                                        </option>
                                        <option value="thursday" <?php echo $event->weekday_others == "thursday" ? 'selected="selected"' : ''; ?>>
                                            Thursday
                                        </option>
                                        <option value="friday" <?php echo $event->weekday_others == "friday" ? 'selected="selected"' : ''; ?>>
                                            Friday
                                        </option>
                                        <option value="saturday" <?php echo $event->weekday_others == "saturday" ? 'selected="selected"' : ''; ?>>
                                            Saturday
                                        </option>
                                        <option value="sunday" <?php echo $event->weekday_others == "sunday" ? 'selected="selected"' : ''; ?>>
                                            Sunday
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <?php $event_month = explode('|', $event->month_others); // Fix issue when number is 12, January and February are also being marked as checked. ?>
                            <div class="col-lg-4">
                                <div class="checkbox">
                                    <label><input
                                                name="month_others[]" <?php echo in_array(1, $event_month) ? 'checked="checked"' : ''; ?>
                                                type="checkbox" value="1"> January</label>
                                </div>
                                <div class="checkbox">
                                    <label><input
                                                name="month_others[]" <?php echo in_array(2, $event_month) ? 'checked="checked"' : ''; ?>
                                                type="checkbox" value="2"> February</label>
                                </div>
                                <div class="checkbox">
                                    <label><input
                                                name="month_others[]" <?php echo in_array(3, $event_month) ? 'checked="checked"' : ''; ?>
                                                type="checkbox" value="3"> March</label>
                                </div>
                                <div class="checkbox">
                                    <label><input
                                                name="month_others[]" <?php echo in_array(4, $event_month) ? 'checked="checked"' : ''; ?>
                                                type="checkbox" value="4"> April</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="checkbox">
                                    <label><input
                                                name="month_others[]" <?php echo in_array(5, $event_month) ? 'checked="checked"' : ''; ?>
                                                type="checkbox" value="5"> May</label>
                                </div>
                                <div class="checkbox">
                                    <label><input
                                                name="month_others[]" <?php echo in_array(6, $event_month) ? 'checked="checked"' : ''; ?>
                                                type="checkbox" value="6"> June</label>
                                </div>
                                <div class="checkbox">
                                    <label><input
                                                name="month_others[]" <?php echo in_array(7, $event_month) ? 'checked="checked"' : ''; ?>
                                                type="checkbox" value="7"> July</label>
                                </div>
                                <div class="checkbox">
                                    <label><input
                                                name="month_others[]" <?php echo in_array(8, $event_month) ? 'checked="checked"' : ''; ?>
                                                type="checkbox" value="8"> August</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="checkbox">
                                    <label><input
                                                name="month_others[]" <?php echo in_array(9, $event_month) ? 'checked="checked"' : ''; ?>
                                                type="checkbox" value="9"> September</label>
                                </div>
                                <div class="checkbox">
                                    <label><input
                                                name="month_others[]" <?php echo in_array(10, $event_month) ? 'checked="checked"' : ''; ?>
                                                type="checkbox" value="10"> October</label>
                                </div>
                                <div class="checkbox">
                                    <label><input
                                                name="month_others[]" <?php echo in_array(11, $event_month) ? 'checked="checked"' : ''; ?>
                                                type="checkbox" value="11"> November</label>
                                </div>
                                <div class="checkbox">
                                    <label><input
                                                name="month_others[]" <?php echo in_array(12, $event_month) ? 'checked="checked"' : ''; ?>
                                                type="checkbox" value="12"> December</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label"><span class="recurring-only">Start </span>Date</label>
                            <input id="datepicker" class="form-control" name="date"
                                   value="<?php echo date('Y-m-d', $event->datetime); ?>" required/>
                            <?php echo form_error('date'); ?>
                        </div>
                        <div class="form-group recurring-only">
                            <label class="control-label">End Date</label>
                            <?php
                            // Default end date for events should be the same day it starts. Not 1969-12-31. Issue #87.
                            $end_date = $event->end_date;
                            //                            if(!$event->end_date)
                            //                                $end_date = $event->datetime;
                            ?>
                            <input id="datepicker2" class="form-control" name="end_date"
                                   value="<?php echo (!$end_date) ? '' : date('Y-m-d', $end_date); ?>"/>
                            <?php echo form_error('end_date'); ?>
                        </div>
                    </div>
                </div>
                <div class="row pull-right">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary" value="Save">
                            <span class="fas fa-paper-plane"></span>
                            Save
                        </button>
                        <a id="cancel" href="/admin/events" class="btn btn-danger">
                            <span class="fas fa-times"></span>
                            Cancel
                        </a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
    