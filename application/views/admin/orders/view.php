<div class="row">
    <div class="col-lg-12">
        <?php if ($order != null) { ?>
            <div class="row" style="border-bottom: 1px solid #EEE">
                <div class="col-lg-10">
                    <h1>View Order # <?php echo $order->id; ?></h1>
                </div>
                <!--<div class="col-lg-2" style="margin-top:20px;">
                    <a href="/admin/users/add/" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add</a>
                </div>-->
            </div>
            <div class="row">
                <div class="col-lg-10">
                    <table class="table table-striped">
                        <tr>
                            <td>Type</td>
                            <td><?php echo $order->type; ?></td>
                        </tr>
                        <tr>
                            <td>Client Name</td>
                            <td><?php echo $order->client_name; ?></td>
                        </tr>
                        <tr>
                            <td>Client Email</td>
                            <td><?php echo $order->client_email; ?></td>
                        </tr>
                        <tr>
                            <td>Client Notes</td>
                            <td><?php echo $order->client_notes; ?></td>
                        </tr>
                        <tr>
                            <td>Video Link</td>
                            <td>
                                <a href="<?php echo $order->youtube_link == "" ? "https:" . base_url($order->video_link) : $order->youtube_link; ?>"><?php echo $order->youtube_link == "" ? "https:" . base_url($order->video_link) : $order->youtube_link; ?></a>
                            </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td><?php echo $order->status; ?></td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td><?php echo date('m-d-Y', $order->date); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        <?php } else { ?>
            <div class="row" style="border-bottom: 1px solid #EEE">
                <div class="col-lg-10">
                    <h1>View Order </h1>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger"> Order Does Not Exist.</div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
