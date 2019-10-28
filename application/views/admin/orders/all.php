<div class="row"><br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="fas fa-box-open fa-fw"></span>
            <b><i>Orders</i> </b>
        </div>

        <br><br>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="orders-list" class="table table-striped">
                    <thead>
                    <tr>
                        <th width="10%">ID</th>
                        <th width="20%">Type</th>
                        <th width="35%">Client</th>
                        <th width="20%">Status</th>
                        <th width="5%">Date</th>
                        <th width="10%">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($orders as $order) { ?>
                        <tr>
                            <td><?php echo $order->id; ?></td>
                            <td><?php echo $order->type; ?></td>
                            <td><?php echo $order->client_name; ?><br/>
                                <small><?php echo $order->client_email; ?></small>
                            </td>
                            <td><?php echo $order->status; ?></td>
                            <td><?php echo date('m-d-Y', $order->date); ?></td>
                            <td>

                                <a href="/admin/orders/view/<?php echo $order->id; ?>/"
                                   class="btn btn-xs btn-default"><i class="fas fa-eye"></i></a>
                                <a href="/admin/orders/edit/<?php echo $order->id; ?>/"
                                   class="btn btn-xs btn-warning"><i class="fas fa-edit"></i></a>
                                <!--<a href="/admin/orders/delete/<?php echo $order->id; ?>/" onclick="return confirm('Confirm Delete?')" class="btn btn-xs btn-default"><i class="fa fa-trash"></i></a>-->

                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
 