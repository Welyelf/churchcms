<div id="content">
    <div class="container">
        <div class="row">
            <div class="span12">
                <h2><span><?php echo ucfirst($type) ?> Volunteers Schedule
                </span></h2><br/>
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
                    </center>

                    <!-- Month Slider -->
                    <div class="clearfix">
                        <a href="/volunteers/schedules/<?php echo $type; ?>/<?php echo date('Y-m-d', $prev_month); ?>"
                           class="btn btn-success btn-sm pull-left eventsBtn"><?php echo date('F', $prev_month); ?></a>
                        <a href="/volunteers/schedules/<?php echo $type; ?>/<?php echo date('Y-m-d', $next_month); ?>"
                           class="btn btn-success btn-sm pull-right eventsBtn"><?php echo date('F', $next_month); ?></a>
                    </div>

                    <br/>
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
                                            <time class="icon">
                                                <em></em>
                                                <strong><?php echo $day; ?></strong>
                                                <span></span>
                                                <p>
                                                    <?php
                                                    $timestamp = strtotime($day . ' ' . $month . ' ' . $year);
                                                    foreach ($volunteer_schedules[$timestamp] as $schedule) { ?>
                                                        <i><?php echo $schedule->persons; ?></i>
                                                        <?php
                                                    }
                                                    ?>
                                                </p>
                                                <?php $day++; ?>
                                            </time>
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
 
    