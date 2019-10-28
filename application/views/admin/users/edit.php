<div class="row"><br>
    <div class="panel panel-default">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <span class="fas fa-users fa-fw"></span>
                <li class="breadcrumb-item">
                    <a href="/admin/users"><b><i>Users</i></b></a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit User</li>
            </ol>
        </nav>
        <div class="panel-body">
            <?php if (validation_errors() != false) { ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <strong>Error!</strong><br/>
                    <?php echo validation_errors(); ?>
                </div>
            <?php } ?>
            <form method="post">
                <div class="row">
                    <div class="col-lg-10 col-lg-offset-1">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label class="control-label">First Name</label>
                                <input type="text" class="form-control" name="first_name"
                                       value="<?php echo $user->first_name; ?>" required/>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="control-label">Last Name</label>
                                <input type="text" class="form-control" name="last_name"
                                       value="<?php echo $user->last_name; ?>" required/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label class="control-label">Username</label>
                                <input type="text" class="form-control" name="username"
                                       value="<?php echo $user->username; ?>" required/>
                            </div>
                            <div class="form-group col-lg-6">
                                <label class="control-label">Email</label>
                                <input type="email" class="form-control" name="email"
                                       value="<?php echo $user->email; ?>" required/>
                            </div>
                        </div>
                        <div id="password_field" class="row" style="display:none">
                            <div class="col-lg-6">
                                <div class="form-group has-feedback">
                                    <label class="control-label">Password</label>
                                    <span id="generate_password" class="btn btn-default btn-xs pull-right">Generate Password</span>
                                    <input id="password" type="password" class="form-control" name="password" value=""
                                           required/>
                                    <span class="form-control-feedback">
                                                    <i class="fa fa-eye-slash toggle-password"></i>
                                                </span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group has-feedback">
                                    <label class="control-label">Confirm Password</label>
                                    <input id="confirm_password" type="password" class="form-control"
                                           name="confirm_password" value="" required/>
                                    <span class="form-control-feedback">
                                                    <i class="fa fa-eye-slash toggle-password"></i>
                                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">About</label>
                            <textarea class="form-control" name="about"><?php echo $user->about; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Role</label>
                            <select class="form-control" name="role" required>
                                <?php foreach ($roles as $role) { ?>
                                    <?php if (($this->session->user->role != "Super Admin") && $role->name == "Super Admin") { ?>
                                        <?php continue; ?>
                                    <?php } ?>
                                    <option value="<?php echo $role->name; ?>" <?php echo ($role->name == $user->role) ? 'selected' : ''; ?> ><?php echo $role->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row pull-right">
                    <div class="col-lg-12">
                        <div id="enable_password" class="btn btn-default">Edit Password</div>
                        <button type="submit" class="btn btn-primary" value="Save">
                            <span class="fas fa-paper-plane"></span>
                            Save
                        </button>
                        <a id="cancel" href="/admin/users" class="btn btn-danger">
                            <span class="fas fa-times"></span>
                            Cancel
                        </a>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?php echo $user->id; ?>"/>
            </form>

        </div>
    </div>
</div>
    