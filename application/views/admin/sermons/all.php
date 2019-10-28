<div class="row"><br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="fas fa-church fa-fw"></span>
            <b><i>Sermons</i> </b>
        </div>
        <div class="col-lg-10">
            <br/>
        </div>
        <div class="col-lg-2" style="margin-top:10px;">
            <a href="/admin/sermons/add/" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add</a>
        </div>
        <br><br>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="sermons-list" class="table table-striped">
                    <thead>
                    <tr>
                        <th width="45%">Title</th>
                        <th width="20%">Pastor</th>
                        <th width="10%">Date</th>
                        <th width="10%">Status</th>
                        <th width="25%">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($sermons as $sermon) { ?>
                        <tr>
                            <td><a href="/sermons/<?php echo $sermon->slug; ?>/" target="_blank"
                                   class="btn btn-xs btn-default"><i class="fa fa-eye"></i></a>
                                <a href="/admin/sermons/add/<?php echo $sermon->slug; ?>/"><?php echo $sermon->title; ?></a>
                            </td>
                            <td><?php echo $sermon->pastor; ?></td>
                            <td><?php echo date('Y-m-d', $sermon->date); ?></td>
                            <td><?php
                                if ($sermon->is_active == 1) {
                                    echo "Active";
                                } else {
                                    echo "Inactive";
                                }
                                ?>
                            </td>
                            <td>
                                <a href="/admin/sermons/delete/<?php echo isset($sermon->sermon_id) ? $sermon->sermon_id : $sermon->id; ?>/"
                                   onclick="return confirm('Confirm Delete #<?php echo isset($sermon->sermon_id) ? $sermon->sermon_id : $sermon->id; ?> - <?php echo $sermon->title; ?>?')"
                                   class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                <a href="/sermons/view/<?php echo $sermon->slug; ?>" target="_blank"
                                   class="btn btn-xs btn-default"><i class="fa fa-eye"></i> View</a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>