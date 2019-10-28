<div class="row"><br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="fas fa-users fa-fw"></span>
            <b><i>Users</i> </b>
        </div>
        <div class="col-lg-10">
            <br/>
        </div>
        <div class="col-lg-2" style="margin-top:10px;">
            <a href="/admin/users/add/" class="btn btn-primary pull-right">
                <i class="fa fa-plus"></i> Add
            </a>
        </div>
        <br><br>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="users-list" class="table table-striped">
                    <thead>
                    <tr>
                        <th width="25%">Name</th>
                        <th width="25%">Email</th>
                        <th width="25%">Username</th>
                        <th width="15%">Role</th>
                        <th width="10%">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $user) { ?>
                        <?php if (($this->session->user->role == "Admin" && $user->role != "Super Admin") || $this->session->user->role == "Super Admin") { ?>
                            <tr>
                                <td><?php echo $user->first_name . " " . $user->last_name; ?></td>
                                <td>
                                    <a href="/admin/users/edit/<?php echo $user->id; ?>/"><?php echo $user->email; ?></a>
                                </td>
                                <td><?php echo $user->username; ?></td>
                                <td><?php echo $user->role; ?></td>
                                <td>
                                    <!--a href="/<?php echo $user->id; ?>/" target="_blank" class="btn btn-xs btn-default"><i class="fa fa-eye"></i></a>-->
                                    <?php if ($user->email == "") { ?>
                                        <a href="/admin/users/edit/<?php echo $user->id; ?>/"
                                           class="btn btn-xs btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                    <?php } ?>

                                    <a href="/admin/users/delete/<?php echo $user->id; ?>/"
                                       onclick="return confirm('Confirm Delete?')" class="btn btn-xs btn-danger"><i
                                                class="fa fa-trash"></i> Delete</a>

                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>