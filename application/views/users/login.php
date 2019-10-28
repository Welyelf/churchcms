<div id="content">
    <!--<div class="container">
        <div class="row">
            <div class="span12">
                <h2><span>Login</span></h2><br/>
                <div class="row">
                        <br />
                        <div class="span5"></div>
                        <div class="span4">
                        <form method="post">
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <label class="control-label">username</label>
                                    <input type="text" class="form-control" name="first_name"  />
                                </div>
                                <div class="form-group col-lg-12">
                                    <label class="control-label">Password</label>
                                    <input type="password" class="form-control" name="last_name"/>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-lg btn-primary" value="Register" />

                        </form>
                        </div>
                </div>

            </div>
        </div>
    </div>	-->

    <div class="container">
        <div class="card card-container">
            <h2><span>SIGN IN TO <?php echo $settings->site_name; ?> </span></h2><br/>
            <center><img id="profile-img" src="/assets/img/hopelogo.png"/></center>
            <p id="profile-name" class="profile-name-card"></p>

            <div class="panel-body">
                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <strong>Error!</strong> <?php echo $error; ?>
                    </div>
                    <?php
                } ?>
                <form method="post">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            <input type="text" class="form-control span4" name="username" placeholder="Username"
                                   required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-key"></i></div>
                            <input type="password" class="form-control span4" name="password" placeholder="Password"
                                   required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-sm">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
	

   

