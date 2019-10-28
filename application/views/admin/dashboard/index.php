<div class="row"><br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="fas fa-tachometer-alt fa-fw"></span>
            <b><i>Dashboard</i> </b>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-8">
                    <canvas id="pageviews"></canvas>
                </div>
                <div class="col-md-4">
                    <h2>Statistics (Today)</h2>
                    <table class="table table-bordered">
                        <tr>
                            <th>URI</th>
                            <th>Page Views</th>
                            <th>Site Visits</th>
                        </tr>
                        <?php foreach ($stats as $stat) { ?>
                            <tr>
                                <td><?php echo $stat->uri == "" ? '/' : $stat->uri; ?></td>
                                <td><?php echo $stat->count; ?></td>
                                <td><?php echo $stat->sessions; ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                    <a href="/admin/hits/all" class="btn btn-block btn-primary">Show All</a>
                </div>
            </div>
            <br/><br/>
            <div class="row">
                <div class="col-lg-12">

                    <h2></h2>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-church fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo $new_sermons; ?></div>
                                            <div>New Sermons!</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="/admin/sermons">
                                    <div class="panel-footer">
                                        <span class="pull-left"><?php echo $total_sermons; ?> Total Sermons</span>
                                        <span class="pull-right">View All <i
                                                    class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-envelope fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo $new_subscribers; ?></div>
                                            <div>New Subscribers!</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="/admin/subscribers">
                                    <div class="panel-footer">
                                        <span class="pull-left"><?php echo $total_subscribers; ?> Total Subscribers</span>
                                        <span class="pull-right">View All <i
                                                    class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-thumbtack fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo $new_posts; ?></div>
                                            <div>New Posts!</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="/admin/posts">
                                    <div class="panel-footer">
                                        <span class="pull-left"><?php echo $total_posts; ?> Total Posts</span>
                                        <span class="pull-right">View All <i
                                                    class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-calendar fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo $events_this_week; ?></div>
                                            <div>Events this Week!</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="/admin/events">
                                    <div class="panel-footer">
                                        <span class="pull-left"><?php echo $total_events; ?> Total Events</span>
                                        <span class="pull-right">View All <i
                                                    class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <br/><br/>
            <div class="row">
                <div class="col-lg-12">

                    <h2></h2>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Most Popular Sermons
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Sermon Title</th>
                                                <th>Views</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $x = 1; ?>
                                            <?php foreach ($top_sermons as $sermon) { ?>
                                                <tr>
                                                    <td><?php echo $x; ?></td>
                                                    <td><?php echo $sermon->title; ?></td>
                                                    <td><?php echo $sermon->count; ?></td>
                                                    <td>
                                                        <?php if ($sermon->is_exist) { ?>
                                                            <a href="<?php echo base_url($sermon->uri); ?>"
                                                               target="_blank" class="btn btn-xs btn-default"><i
                                                                        class="fas fa-eye"></i></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php $x++;
                                            } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Chart for Most Popular Sermons. -->
                        <div class="col-lg-6">
                            <canvas id="popularsermons"></canvas>
                        </div>
                    </div>
                    <br/><br/>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Top Books by Number of Sermons
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Book</th>
                                                <th>Total Sermons</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $x = 1; ?>
                                            <?php foreach ($top_books as $book) { ?>
                                                <tr>
                                                    <td><?php echo $x; ?></td>
                                                    <td><?php echo $book->book_id; ?></td>
                                                    <td><?php echo $book->total_sermons; ?></td>
                                                </tr>
                                                <?php $x++;
                                            } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Chart for Top Books by number of Sermons. -->
                        <div class="col-lg-6">
                            <canvas id="topbooks"></canvas>
                        </div>

                    </div>

                </div>

            </div>

            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Upcoming Events
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Event Title</th>
                                        <th>Location</th>
                                        <th>Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($upcoming_events as $timestamp => $event) { ?>
                                        <?php if (count($event) > 0) { // Check if day has events. Only show days with events. ?>
                                            <tr>
                                                <th colspan="3">
                                                    <center><?php echo (date('l, F d, Y', $timestamp) == date('l, F d, Y')) ? 'Today' : date('l, F d, Y', $timestamp); ?></center>
                                                </th>
                                            </tr>
                                            <?php foreach ($event as $details) { ?>
                                                <tr>
                                                    <td><?php echo $details->title; ?></td>
                                                    <td><?php echo $details->location; ?></td>
                                                    <td>
                                                        <?php
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
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>