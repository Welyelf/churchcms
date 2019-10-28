<div class="row"><br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="fas fa-envelope fa-fw"></span>
            <b><i>Emails</i> </b>
        </div>
        <div class="col-lg-10">
            <br/>
        </div>
        <div class="col-lg-2" style="margin-top:10px;">
            <a href="/admin/emails/add/" class="btn btn-primary pull-right">
                <i class="fa fa-plus"></i> Add
            </a>
        </div>
        <br><br>
        <div class="panel-body">
            <table id="sermons-list" class="table table-striped">
                <thead>
                <tr>
                    <th width="10%">ID</th>
                    <th width="75%">Title</th>
                    <th width="15%">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($emails as $email) { ?>
                    <tr>
                        <td><?php echo $email->id; ?></td>
                        <td><a href="/admin/emails/edit/<?php echo $email->id; ?>/"><?php echo $email->name; ?></a></td>
                        <td>
                            <a href="/admin/emails/delete/<?php echo $email->id; ?>/"
                               onclick="return confirm('Confirm Delete #<?php echo $email->id; ?> - <?php echo $email->name; ?>?')"
                               class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
