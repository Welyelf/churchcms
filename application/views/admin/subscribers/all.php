<div class="row"><br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="fas fa-clipboard-list fa-fw"></span>
            <b><i>Subscribers</i> </b>
        </div>
        <div class="col-lg-10">
            <br/>
        </div>
        <div class="col-lg-2" style="margin-top:10px;">
            <a href="/admin/subscribers/send/" class="btn btn-primary pull-right">
                <i class="fa fa-paper-plane"></i> Send Mail
            </a>
        </div>
        <br><br>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="sermons-list" class="table table-striped">
                    <thead>
                    <tr>
                        <th width="10%">ID</th>
                        <th width="30%">Name</th>
                        <th width="35%">Email</th>
                        <th width="10%">Active?</th>
                        <th width="15%">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($subscribers as $subscriber) { ?>
                        <tr>
                            <td><?php echo $subscriber->id; ?></td>
                            <td><?php echo $subscriber->name; ?></td>
                            <td><?php echo $subscriber->email; ?></td>
                            <td><?php echo $subscriber->is_active; ?></td>
                            <td>
                                <a href="/admin/subscribers/send/<?php echo $subscriber->id; ?>"
                                   class="btn btn-xs btn-default"><i class="fa fa-paper-plane"></i></a>
                                <a href="/admin/subscribers/delete/<?php echo $subscriber->id; ?>/"
                                   onclick="return confirm('Confirm Delete?')" class="btn btn-xs btn-danger"><i
                                            class="fa fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>