<div id="content">
    <div class="container">
        <div class="row">
            <h2>
                <center><span>My Donations</span></center>
            </h2>
            <div class="container" id="tourpackages-carousel">
                <div class="row">
                    <?php foreach ($donations as $donation) { ?>
                        <div class="span4">
                            <div class="thumbnail">
                                <div class="caption">
                                    <div class='col-lg-12'>
                                        <span class="glyphicon glyphicon-credit-card"></span>
                                        <span class="glyphicon glyphicon-trash pull-right text-primary"></span>
                                    </div>
                                    <div class=' well well-add-card'>
                                        <h4><?php echo date("m-d-Y h:i A", $donation->timestamp); ?></h4>
                                    </div>
                                    <p><strong>Amount:</strong></p>
                                    <p class="text-muted" style="font-size:1.5em;">
                                        $ <?php echo number_format($donation->amount, 2, '.', ','); ?></p>
                                    <td class="text-center">
                                        <?php if ($donation->status == "failed") { ?>
                                            <span class="label label-danger">Failed</span>
                                        <?php } elseif ($donation->status == "cancelled") { ?>
                                            <span class="label label-warning">Cancelled</span>
                                        <?php } else { ?>
                                            <?php if ($donation->subscription_id == "") { ?>
                                                <span class="label label-success">One Time</span>
                                            <?php } else { ?>
                                                <a href="/users/subscription-info/<?php echo $donation->subscription_id; ?>">
                                                    <button type="button"
                                                            class="btn btn-primary btn-xs btn-update btn-add-card">
                                                        View
                                                    </button>
                                                </a>
                                                <a href="/stripe/cancel-subscription/<?php echo $donation->id; ?>"
                                                   onclick="return confirm('Are you sure you want to cancel your subscription?')">
                                                    <button type="button"
                                                            class="btn btn-danger btn-xs btn-update btn-add-card">
                                                        Cancel
                                                    </button>
                                                </a>
                                            <?php } ?>
                                        <?php } ?>
                                    </td>

                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="modal-footer">
                               <span class="pull-right">    
                                    <a href="/user/account">
                                        <input type="button" class="btn btn-success btn-sm" value="My Profile"/>
                                    </a>
                                    <a href="/auth/logout">
                                        <input type="button" class="btn btn-danger btn-sm" value="Logout"/>
                                    </a>
                                </span>
                </div>
            </div>
        </div>
    </div>
</div>

     
