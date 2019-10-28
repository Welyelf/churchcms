<div class="row"><br>
    <div class="panel panel-default">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <span class="fas fa-calendar-alt fa-fw"></span>
                <li class="breadcrumb-item">
                    <a href="/admin/volunteers"><b><i>Volunteers</i></b></a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Schedule</li>
            </ol>
        </nav>
        <div class="panel-body">
            <form method="post">
                <div class="row">
                    <div class="col-lg-10 col-lg-offset-1">

                        <!-- Volunteer Type -->
                        <div class="form-group">
                            <label class="control-label">Volunteer Type</label>
                            <select class="form-control" name="volunteer_type">
                                <option value="worship" <?php echo set_value('volunteer_type') == "worship" ? 'selected="selected"' : ''; ?>>
                                    Worship
                                </option>
                                <option value="children" <?php echo set_value('volunteer_type') == "children" ? 'selected="selected"' : ''; ?>>
                                    Children's Church
                                </option>
                                <option value="nursery" <?php echo set_value('volunteer_type') == "nursery" ? 'selected="selected"' : ''; ?>>
                                    Nursery
                                </option>
                                <option value="greeter" <?php echo set_value('volunteer_type') == "greeter" ? 'selected="selected"' : ''; ?>>
                                    Greeter
                                </option>
                                <option value="counter" <?php echo set_value('volunteer_type') == "counter" ? 'selected="selected"' : ''; ?>>
                                    Counter
                                </option>
                                <option value="others" <?php echo set_value('volunteer_type') == "others" ? 'selected="selected"' : ''; ?>>
                                    Others
                                </option>
                            </select>
                        </div>

                        <!-- Persons -->
                        <div class="form-group">
                            <label class="control-label">Persons</label>
                            <input type="text" class="form-control" name="persons"
                                   value="<?php echo set_value("persons"); ?>"/>
                            <?php echo form_error('persons'); ?>
                        </div>

                        <!-- Details -->
                        <div class="form-group">
                            <label class="control-label">Details</label>
                            <textarea class="form-control" name="details"><?php echo set_value('details'); ?></textarea>
                            <?php echo form_error('details'); ?>
                        </div>

                        <!-- Location -->
                        <div class="form-group">
                            <label class="control-label">Location</label>
                            <input type="text" class="form-control" name="location"
                                   value="<?php echo set_value("location"); ?>"/>
                            <?php echo form_error('location'); ?>
                        </div>

                        <!-- Date -->
                        <div class="form-group">
                            <label class="control-label">Date</label>
                            <input id="datepicker" class="form-control" name="date"
                                   value="<?php echo set_value('date'); ?>" required/>
                            <?php echo form_error('date'); ?>
                        </div>

                    </div>
                </div>
                <div class="row pull-right">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary" value="Save">
                            <span class="fas fa-paper-plane"></span>
                            Save
                        </button>
                        <a id="cancel" href="/admin/volunteers" class="btn btn-danger">
                            <span class="fas fa-times"></span>
                            Cancel
                        </a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
    