<div id="content">

    <div class="container">
        <div class="card card-container">
            <h2><span>REGISTER FORM</span></h2><br/>
            <center><img id="profile-img" src="/assets/img/hopelogo.png"/></center>
            <p id="profile-name" class="profile-name-card"></p>

            <div class="panel-body">
                <?php if (validation_errors()) { ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <strong>Error!</strong> <?php echo validation_errors(); ?>
                    </div>
                    <?php
                } ?>
                <form method="post">
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label class="control-label">First Name</label>
                            <input required type="text" class="form-control span4" name="first_name"
                                   value="<?php echo set_value("first_name"); ?>"/>
                        </div>
                        <div class="form-group col-lg-12">
                            <label class="control-label">Last Name</label>
                            <input required type="text" class="form-control span4" name="last_name"
                                   value="<?php echo set_value("last_name"); ?>"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label class="control-label">Username</label>
                            <input required type="text" class="form-control span4" name="username"
                                   value="<?php echo set_value("username"); ?>"/>
                        </div>
                        <div class="form-group col-lg-12">
                            <label class="control-label">Email</label>
                            <input required type="email" class="form-control span4" name="email"
                                   value="<?php echo set_value("email"); ?>"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12">
                            <label class="control-label">Password</label>
                            <input required type="password" class="form-control span4" name="password"
                                   value="<?php echo set_value("password"); ?>"/>
                        </div>
                        <div class="form-group col-lg-12">
                            <label class="control-label">Confirm Password</label>
                            <input required type="password" class="form-control span4" name="confirm_password"
                                   value="<?php echo set_value("confirm_password"); ?>"/>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-success btn-sm" value="Register"/>

                </form>
            </div>
        </div>
    </div>
</div>




