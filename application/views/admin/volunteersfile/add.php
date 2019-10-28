<div class="row"><br>
    <div class="panel panel-default">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <span class="fas fa-calendar-alt fa-fw"></span>
                <li class="breadcrumb-item">
                    <a href="/admin/volunteer-schedules"><b><i>Volunteers File</i></b></a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?php
                    if (isset($volunteer_schedules->name)) {
                        echo " Edit Volunteer Schedule";
                    } else {
                        echo " Add Volunteer Schedule";
                    }
                    ?>

                </li>
            </ol>
        </nav>
        <div class="panel-body">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-10 col-lg-offset-1">
                        <?php if (isset($error)) { ?>
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <strong>Error! </strong> <?php echo $error; ?>
                            </div>
                            <?php
                        } ?>

                        <!-- Volunteer Name -->
                        <div class="form-group">
                            <label class="control-label">Name</label>
                            <input type="text" class="form-control" required name="name"
                                   value="<?php if (isset($volunteer_schedules->name)) {
                                       echo $volunteer_schedules->name;
                                   } ?>"/>
                            <?php echo form_error('name'); ?>
                        </div>

                        <!-- Volunteer PDF File -->
                        <div class="form-group">
                            <label class="control-label">File</label>
                            <small><?php if (isset($volunteer_schedules->file)) {
                                    echo $volunteer_schedules->file;
                                } ?></small>
                            <input type="file" class="form-control" <?php if (!isset($volunteer_schedules->file)) {
                                echo "required";
                            } ?> name="file" accept="application/*,.docx" value="<?php echo set_value("file"); ?>"/>
                            <?php echo form_error('file'); ?>
                        </div>

                        <!-- Is Active -->
                        <div class="form-group">
                            <label class="control-label">Is Active</label>
                            <input type="number" class="form-control" required name="is_active" min="0" max="1"
                                   value="<?php if (isset($volunteer_schedules->is_active)) {
                                       echo $volunteer_schedules->is_active;
                                   } else {
                                       echo "1";
                                   } ?>"/>
                            <?php echo form_error('is_active'); ?>
                        </div>


                    </div>
                </div>
                <div class="row pull-right">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary" value="Save">
                            <span class="fas fa-paper-plane"></span>
                            Save
                        </button>
                        <a id="cancel" href="/admin/volunteer-schedules" class="btn btn-danger">
                            <span class="fas fa-times"></span>
                            Cancel
                        </a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
    