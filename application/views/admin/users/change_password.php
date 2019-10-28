<div class="row">
    <div class="col-lg-12">
        <div class="row" style="border-bottom: 1px solid #EEE">
            <div class="col-lg-10">
                <h1>Password Settings</h1>
            </div>
        </div>
        <br/>

        <form method="POST" role="form">
            <?php echo validation_errors('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
            <?php if (isset($error)) { ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button><?= $error ?></div>
            <?php } ?>
            <?php if (isset($success)) { ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button><?= $success ?></div>
            <?php } ?>
            <div class="form-group">
                <label for="">Old Password</label>
                <input type="password" class="form-control" name="password" id="" placeholder="Enter old password">
            </div>
            <div class="form-group">
                <label for="">New Password</label>
                <input type="password" class="form-control" id="" name="new_password" placeholder="New password">
            </div>
            <div class="form-group">
                <label for="">Confirm Password</label>
                <input type="password" class="form-control" id="" name="conf_password" placeholder="Confirm password">
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
            <a type="button" href="/admin" class="btn btn-danger">Cancel</a>
        </form>
    </div>
</div>
