<div id="content">
    <div class="container">
        <div class="row">
            <h2><span>My Account</span></h2>
            <div class="span3">
                My Profile<br/>
                <a href="/user/donations">My Donations</a><br/>
                <a href="/auth/logout">Logout</a>
            </div>
            <div class="span9">
                <table class="table table-striped">
                    <tr>
                        <th width="30%">ID</th>
                        <td width="70%"><?php echo $subscription->id ?></td>
                    </tr>
                    <tr>
                        <th>Start Date</th>
                        <td><?php echo date('M d, Y', $subscription->start); ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td><?php echo $subscription->status; ?></td>
                    </tr>
                </table>

                <h3>Details</h3>

                <table class="table table-striped">
                    <tr>
                        <th width="40%">Plan</th>
                        <th width="30%">Amount</th>
                        <th width="30%">Interval</th>
                    </tr>
                    <?php foreach ($subscription->items->data as $item) {
                        $amount = $item->plan->amount * $item->quantity;
                        $offset = strlen($amount) - 2;
                        $amount = substr($amount, 0, $offset) . "." . substr($amount, $offset);
                        ?>
                        <tr>
                            <td><?php echo $item->plan->id; ?></td>
                            <td><?php echo $amount . " " . $item->plan->currency; ?></td>
                            <td><?php echo $item->plan->interval; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>	

