<div id="content">
    <div class="container">
        <div class="row">
            <div class="span12">
                <h2>
                    <center><span>Events Calendar</span></center>
                </h2>
                <div class="row">
                    <center>
                        <h5>
                                <span>
                                    <?php
                                    $dateNow = date('F - Y');
                                    echo $month . ' ' . $year;
                                    ?>
                                </span>
                        </h5>
                        <br/>
                        <a href="/events/month/<?php echo date('Y-m-d', $prev_month); ?>"
                           class="btn btn-success btn-sm eventsBtn"><?php echo date('F', $prev_month); ?></a>
                        <a href="/events/month/<?php echo date('Y-m-d', $next_month); ?>"
                           class="btn btn-success btn-sm eventsBtn"><?php echo date('F', $next_month); ?></a>
                        <br/><br/>

                        <div class="input-group">
                            <input id="datepicker" class="form-control" placeholder="yyyy-mm-dd">
                            <button class="btn btn-primary" type="button" onclick="goToDate()">Go</button>
                        </div>

                    </center>
                    <br>
                    <br>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th width="15%">Sunday</th>
                            <th width="14%">Monday</th>
                            <th width="14%">Tuesday</th>
                            <th width="14%">Wednesday</th>
                            <th width="14%">Thursday</th>
                            <th width="14%">Friday</th>
                            <th width="15%">Saturday</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($day <= $num_days) { ?>
                            <tr>
                                <?php
                                for ($x = 0; $x < 7; $x++) {
                                    if (($x == $offset || $offset == FALSE) && $day <= $num_days) {

                                        ?>
                                        <td>
                                            <b style="font-size:1.4em;color:#444444"> <?php //echo $day; ?> </b>
                                            <div class="icon">
                                                <strong><?php echo $day; ?></strong>
                                                <span></span>


                                                <p>
                                                    <?php
                                                    $timestamp = strtotime($day . ' ' . $month . ' ' . $year);
                                                    $count = 0;
                                                    foreach ($events[$timestamp] as $details) { ?>
                                                        <b>
                                                            <small>

                                                                <?php
                                                                // Check if Time is not blank.
                                                                if ($details->time) {
                                                                    // AM
                                                                    if ($details->time < 12) {
                                                                        // echo $details->time . " AM";
                                                                        // PM
                                                                    } else if (12 == $details->time) {
                                                                        //echo $details->time . " PM";
                                                                    } else {
                                                                        $time = explode(":", $details->time);
                                                                        $time[0] -= 12;
                                                                        //echo implode(":",$time) . " PM";
                                                                    }
                                                                }
                                                                $count++;
                                                                ?>
                                                            </small>
                                                        </b>

                                                        <i><?php //echo $details->title; ?></i>

                                                        <?php
                                                    }
                                                    ?>

                                                    <?php
                                                    $sermon_count = 0;
                                                    foreach ($sermons

                                                    as $sermon) {

                                                    if ($sermon->date >= $timestamp && $sermon->date <= $timestamp) {
                                                    ?>
                                                <div style="text-align:center;">
                                                    <a href="/sermons/<?php echo $sermon->slug; ?>">
                                                        <button type="button" class="btn btn-primary btn-circle btn-lg">
                                                            <i class="fa fa-xs fa-church"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                                <?php
                                                }
                                                }
                                                ?>


                                                <?php
                                                if ($count > 0) {
                                                    ?>
                                                    <div style="text-align:center;">
                                                        <a href="/events/daily/<?php echo date('Y-m-d', $timestamp); ?>">
                                                            <button type="button"
                                                                    class="btn btn-success btn-circle btn-lg">
                                                                <?php echo $count; ?>
                                                            </button>
                                                        </a>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                </p>

                                                <?php $day++; ?>
                                            </div>

                                        </td>
                                        <?php
                                        $offset = FALSE;
                                    } else {
                                        echo "<td>&nbsp;</td>";
                                    }

                                } ?>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<style>
    .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1;
        border-radius: 15px;
        cursor: pointer;
    }

    .btn-circle.btn-lg {
        width: 30px;
        height: 30px;
        padding: 5px 8px;
        font-size: 14px;
        line-height: 1.33;
        border-radius: 15px;
    }
</style>
    