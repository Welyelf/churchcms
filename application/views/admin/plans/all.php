<div class="row"><br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="fas fa-cubes fa-fw"></span>
            <b><i>Plans</i> </b>
        </div>
        <div class="col-lg-10">
            <br/>
        </div>
        <div class="col-lg-2" style="margin-top:10px;">
            <a href="/admin/plans/add/" class="btn btn-primary pull-right">
                <i class="fa fa-plus"></i> Add
            </a>
        </div>
        <br><br>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="plans-list" class="table table-striped">
                    <thead>
                    <tr>
                        <th width="15%">ID</th>
                        <th width="40%">Name</th>
                        <th width="10%">Interval</th>
                        <th width="10%">Currency</th>
                        <th width="15%">Amount</th>
                        <th width="10%">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($plans as $plan) { ?>
                        <tr>
                            <td><?php echo $plan->name; ?></td>
                            <td><?php echo $plan->nice_name; ?></td>
                            <td><?php echo $plan->interval; ?></td>
                            <td><?php echo $plan->currency; ?></td>
                            <td>$ <?php echo number_format($plan->amount, 2); ?></td>
                            <td>
                                <!--a href="/<?php echo $plan->id; ?>/" target="_blank" class="btn btn-xs btn-default"><i class="fa fa-eye"></i></a>-->
                                <a href="/admin/plans/edit/<?php echo $plan->id; ?>/" class="btn btn-xs btn-default"><i
                                            class="fa fa-edit"></i></a>
                                <a href="/admin/plans/delete/<?php echo $plan->id; ?>/<?php echo $plan->name; ?>/"
                                   onclick="return confirm('Confirm Delete?')" class="btn btn-xs btn-default"><i
                                            class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
 