<div class="row">
    <div class="col-lg-12">
        <?php if ($log != null) { ?>
            <div class="row" style="border-bottom: 1px solid #EEE">
                <div class="col-lg-10">
                    <h1>View Log # <?php echo $log->id; ?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10">
                    <table class="table table-striped">
                        <tr>
                            <td>Level</td>
                            <td><?php echo $log->level; ?></td>
                        </tr>
                        <tr>
                            <td>Message</td>
                            <td><?php echo $log->message; ?></td>
                        </tr>
                        <tr>
                            <td>PHP Error</td>
                            <td><?php echo $log->php_error; ?></td>
                        </tr>
                        <tr>
                            <td>Data</td>
                            <td><?php echo $log->data; ?></td>
                        </tr>

                        <tr>
                            <td>Request URI</td>
                            <td><?php echo $log->request_uri; ?></td>
                        </tr>
                        <tr>
                            <td>User Agent</td>
                            <td><?php echo $log->user_agent; ?></td>
                        </tr>
                        <tr>
                            <td>Referrer</td>
                            <td><?php echo $log->referer; ?></td>
                        </tr>
                        <tr>
                            <td>Stack Trace</td>
                            <td>
                            <pre><?php
                                if ($log->stack_trace) {
                                    $stack_trace = json_decode(str_replace('\\', '\\\\', $log->stack_trace));
                                    print_r($stack_trace); // Update json_encode to print_r. Issue #92.
                                }
                                ?></pre>
                            </td>
                        </tr>
                        <tr>
                            <td>IP Address</td>
                            <td><?php echo $log->ip_address; ?></td>
                        </tr>
                        <tr>
                            <td>Date Time</td>
                            <td><?php echo date('m-d-Y', $log->datetime); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        <?php } else { ?>
            <div class="row" style="border-bottom: 1px solid #EEE">
                <div class="col-lg-10">
                    <h1>View Log </h1>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
