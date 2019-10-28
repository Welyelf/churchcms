<div class="row"><br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="fas fa-calendar-alt fa-fw"></span>
            <b><i>Volunteers Schedule File</i> </b>
        </div>
        <div class="col-lg-10">
            <br/>
        </div>
        <div class="col-lg-2" style="margin-top:10px;">
            <a href="/admin/volunteersfile/add" class="btn btn-primary pull-right">
                <i class="fa fa-plus"></i> Add
            </a>
        </div>
        <br><br>
        <div class="panel-body">
            <table id="volunteer-list" class="table table-striped">
                <thead>
                <tr>
                    <th width="20%">Name</th>
                    <th width="30%">File</th>
                    <th width="10%">Is Active</th>
                    <th width="20%">Date Modified</th>
                    <th width="30%">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($volunteers_file as $file) { ?>
                    <tr>
                        <td>
                            <?php echo $file->name; ?>
                        </td>
                        <td>
                            <?php echo $file->file; ?>
                        </td>
                        <td>
                            <?php
                            if ($file->is_active == 1) {
                                echo "Active";
                            } else {
                                echo "Inactive";
                            }
                            ?>
                        </td>
                        <td>

                            <?php
                            if ($file->date_modified != 0) {
                                echo $file->date_modified;
                            }
                            ?>

                        </td>
                        <td>
                            <a href="/admin/volunteersfile/add/<?php echo $file->id; ?>/"
                               class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a>
                            <a href="/admin/volunteersfile/delete/<?php echo $file->id; ?>/"
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
 

