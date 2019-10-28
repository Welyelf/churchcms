<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-user"></span> Login to
                    <b> <?php echo $settings->site_name; ?></div>
                <div class="panel-body">
                    <?php if (isset($error)) { ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <strong>Error!</strong> <?php echo $error; ?>
                        </div>
                        <?php
                    } ?>
                    <form method="post">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                <input type="text" class="form-control" name="username" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-key"></i></div>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-sm pull-right">Login</button>
                    </form>

                </div>
            </div>
            <center>

                Powered By :
                <a href=""> Kedra Software </a>
                <div class="">
                    <img width="100" height="100" src="/assets/img/sample.png"/>
                </div>

        </div>
    </div>
</div>
