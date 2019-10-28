<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="row" style="border-bottom: 1px solid #EEE">
                <div class="col-lg-10">
                    <h1>Log Viewer</h1>
                </div>
            </div>
            <br/>
            <br/>
            <form method="post" class="form-inline">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        From <input type="text" class="form-control" id="from" name="from"
                                    value="<?php echo $date_range->from; ?>"/> To <input type="text"
                                                                                         class="form-control" id="to"
                                                                                         name="to"
                                                                                         value="<?php echo $date_range->to; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit"/>
                    </div>
                </div>
            </form>
            <br/>
            <table class="table table-bordered">
                <tr>
                    <th>Level</th>
                    <th width="50%">Page Message</th>
                    <th>Referer</th>
                    <th>IP Address</th>
                    <th>Date/Time</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($logs as $log) { ?>
                    <tr>
                        <td>
                            <?php echo $log->level; ?>
                        </td>
                        <td><?php echo $log->message; ?></td>
                        <td><?php echo $log->referer; ?></td>
                        <td><?php echo $log->ip_address; ?></td>
                        <td><?php echo date('F d, Y h:i:s', $log->datetime) ?></td>
                        <td><a href="/admin/logs/view/<?php echo $log->id; ?>/" class="btn btn-xs btn-success"><i
                                        class="fa fa-search"></i> View</a></td>

                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
