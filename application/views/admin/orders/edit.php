<div class="row">
    <div class="col-lg-12">
        <?php if ($order != null) { ?>
            <div class="row" style="border-bottom: 1px solid #EEE">
                <div class="col-lg-10">
                    <h1>Edit Order # <?php echo $order->id; ?></h1>
                </div>
                <!--<div class="col-lg-2" style="margin-top:20px;">
                    <a href="/admin/users/add/" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add</a>
                </div>-->
            </div>
            <form method="post">
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
                                <td>
                                    <select name="status">
                                        <option value="unpaid" <?php echo $order->status == "unpaid" ? 'selected="selected"' : '' ?>>
                                            Unpaid
                                        </option>
                                        <option value="paid" <?php echo $order->status == "paid" ? 'selected="selected"' : '' ?>>
                                            Paid
                                        </option>
                                        <option value="processing" <?php echo $order->status == "processing" ? 'selected="selected"' : '' ?>>
                                            Processing
                                        </option>
                                        <option value="completed" <?php echo $order->status == "completed" ? 'selected="selected"' : '' ?>>
                                            Completed
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td><?php echo date('m-d-Y', $order->date); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <input type="submit" class="btn btn-primary" value="Save"/>
                        <a id="cancel" href="/admin/orders" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
                <input type="hidden" id="id" name="id" value="<?php echo $order->id; ?>"/>
            </form>
        <?php } else { ?>
            <div class="row" style="border-bottom: 1px solid #EEE">
                <div class="col-lg-10">
                    <h1>Edit Order </h1>
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
