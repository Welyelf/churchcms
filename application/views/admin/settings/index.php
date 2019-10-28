<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="fas fa-cogs fa-fw"></span>
            <b><i>Settings</i></b>
        </div>
        <div class="col-lg-10">
            <?php if (isset($success)) { ?>
                <div class="alert alert-success">Settings saved successfully!</div>
            <?php } ?>
        </div>
        <div class="col-lg-2" style="margin-top:10px;">
            <?php if ($this->session->user->role == 'Super Admin') { ?>
                <a href="/admin/settings/add" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> New
                    Config</a>
            <?php } ?>
        </div>
        <br> <br>
        <div class="panel-body">
            <section style="background:#efefe9;">
                <div class="board">
                    <div class="board-inner">
                        <ul class="nav nav-tabs" id="myTab">
                            <div class="liner"></div>
                            <li class="active">
                                <a href="#home" data-toggle="tab" title="welcome">
                                    <span class="round-tabs one">
                                        <i class="glyphicon glyphicon-home"></i> General
                                    </span>
                                </a>
                            </li>
                            <li><a href="#email" data-toggle="tab" title="profile">
                                <span class="round-tabs two">
                                    <i class="glyphicon glyphicon-envelope"></i> Email
                                </span>
                                </a>
                            </li>
                            <li><a href="#stripe" data-toggle="tab" title="bootsnipp goodies">
                                <span class="round-tabs three">
                                    <i class="glyphicon glyphicon-gift"></i> Stripe
                                </span> </a>
                            </li>
                            <li><a href="#socials" data-toggle="tab" title="blah blah">
                                <span class="round-tabs four">
                                    <i class="glyphicon glyphicon-comment"></i> Socials
                                </span>
                                </a>
                            </li>
                            <li><a href="#others" data-toggle="tab" title="completed">
                                <span class="round-tabs five">
                                    <i class="glyphicon glyphicon-cog"></i> Others
                                </span> </a>
                            </li>
                        </ul>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="home">
                                <br>
                                <?php foreach ($setting as $settings) {
                                    foreach ($settings as &$set) {
                                        $set = htmlentities($set);
                                    }

                                    $permissions = explode(',', $settings->permissions);
                                    if (!is_null($settings->permissions) || in_array($this->session->user->role, $permissions)) {
                                        ?>
                                        <?php
                                        if ($settings->classification == 0) {
                                            ?>
                                            <div class="container col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label"><?php echo $settings->display_name; ?></label>
                                                    <?php if ($this->session->user->role == 'Super Admin') { ?>
                                                        <a href="edit/<?php echo $settings->id; ?>"><span
                                                                    class="fas fa-edit"></span></a>
                                                    <?php } ?>
                                                    <div class="tooltips">?
                                                        <span class="tooltiptext"><?php echo $settings->description; ?></span>
                                                    </div>
                                                    <?php
                                                    if ($settings->type === "file") {
                                                        ?>
                                                        <p>
                                                            <small>
                                                                <strong>Current: </strong><br/><?php echo $settings->value; ?>
                                                            </small>
                                                        </p>
                                                        <input type="file" name="<?php echo $settings->name; ?>"
                                                               class="form-control" placeholder='Choose a file...'/>
                                                        <?php
                                                    } else if ($settings->type === "dropdown") {
                                                        ?>
                                                        <?php if ($settings->name == 'timezone') { // If dropdown is a timezone. ?>
                                                            <select name="<?php echo $settings->name; ?>"
                                                                    class="form-control">
                                                                <option value="UTC" selected disabled>Select Timezone
                                                                </option>
                                                                <?php foreach ($timezones as $key => $value) { ?>
                                                                    <option value="<?php echo $key; ?>" <?php echo ($key == $settings->value) ? 'selected' : ''; ?> ><?php echo $value; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        <?php } ?>
                                                        <?php
                                                    } else {
                                                        if (strlen($settings->value) > 200) {
                                                            ?>
                                                            <textarea col="25" rows="5" type="text" class="form-control"
                                                                      name="<?php echo $settings->name; ?>"> <?php echo $settings->value; ?>  </textarea>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <input type="text" class="form-control"
                                                                   name="<?php echo $settings->name; ?>"
                                                                   value="<?php echo $settings->value; ?>"/>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>

                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            <div class="tab-pane fade" id="email">
                                <br>
                                <?php foreach ($setting as $settings) {
                                    foreach ($settings as &$set) {
                                        $set = htmlentities($set);
                                    }

                                    $permissions = explode(',', $settings->permissions);
                                    if (!is_null($settings->permissions) || in_array($this->session->user->role, $permissions)) {
                                        ?>
                                        <?php
                                        if ($settings->classification == 1) {
                                            ?>
                                            <div class="container col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label"><?php echo $settings->display_name; ?></label>
                                                    <?php if ($this->session->user->role == 'Super Admin') { ?>
                                                        <a href="edit/<?php echo $settings->id; ?>"><span
                                                                    class="fas fa-edit"></span></a>
                                                    <?php } ?>
                                                    <div class="tooltips">?
                                                        <span class="tooltiptext"><?php echo $settings->description; ?></span>
                                                    </div>
                                                    <?php
                                                    if ($settings->type === "file") {
                                                        ?>
                                                        <p>
                                                            <small>
                                                                <strong>Current: </strong><br/><?php echo $settings->value; ?>
                                                            </small>
                                                        </p>
                                                        <input type="file" name="<?php echo $settings->name; ?>"
                                                               class="form-control" placeholder='Choose a file...'/>
                                                        <?php
                                                    } else if ($settings->type === "dropdown") {
                                                        ?>
                                                        <?php if ($settings->name == 'timezone') { // If dropdown is a timezone. ?>
                                                            <select name="<?php echo $settings->name; ?>"
                                                                    class="form-control">
                                                                <option value="UTC" selected disabled>Select Timezone
                                                                </option>
                                                                <?php foreach ($timezones as $key => $value) { ?>
                                                                    <option value="<?php echo $key; ?>" <?php echo ($key == $settings->value) ? 'selected' : ''; ?> ><?php echo $value; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        <?php } ?>
                                                        <?php
                                                    } else {
                                                        if (strlen($settings->value) > 200) {
                                                            ?>
                                                            <textarea col="25" rows="5" type="text" class="form-control"
                                                                      name="<?php echo $settings->name; ?>"><?php echo $settings->value; ?>  </textarea>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <input type="text" class="form-control"
                                                                   name="<?php echo $settings->name; ?>"
                                                                   value="<?php echo $settings->value; ?>"/>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>

                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            <div class="tab-pane fade" id="stripe">
                                <br>
                                <?php foreach ($setting as $settings) {
                                    foreach ($settings as &$set) {
                                        $set = htmlentities($set);
                                    }

                                    $permissions = explode(',', $settings->permissions);
                                    if (!is_null($settings->permissions) || in_array($this->session->user->role, $permissions)) {
                                        ?>
                                        <?php
                                        if ($settings->classification == 2) {
                                            ?>
                                            <div class="container col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label"><?php echo $settings->display_name; ?></label>
                                                    <?php if ($this->session->user->role == 'Super Admin') { ?>
                                                        <a href="edit/<?php echo $settings->id; ?>"><span
                                                                    class="fas fa-edit"></span></a>
                                                    <?php } ?>
                                                    <div class="tooltips">?
                                                        <span class="tooltiptext"><?php echo $settings->description; ?></span>
                                                    </div>
                                                    <?php
                                                    if ($settings->type === "file") {
                                                        ?>
                                                        <p>
                                                            <small>
                                                                <strong>Current: </strong><br/><?php echo $settings->value; ?>
                                                            </small>
                                                        </p>
                                                        <input type="file" name="<?php echo $settings->name; ?>"
                                                               class="form-control" placeholder='Choose a file...'/>
                                                        <?php
                                                    } else if ($settings->type === "dropdown") {
                                                        ?>
                                                        <?php if ($settings->name == 'timezone') { // If dropdown is a timezone. ?>
                                                            <select name="<?php echo $settings->name; ?>"
                                                                    class="form-control">
                                                                <option value="UTC" selected disabled>Select Timezone
                                                                </option>
                                                                <?php foreach ($timezones as $key => $value) { ?>
                                                                    <option value="<?php echo $key; ?>" <?php echo ($key == $settings->value) ? 'selected' : ''; ?> ><?php echo $value; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        <?php } ?>
                                                        <?php
                                                    } else {
                                                        if (strlen($settings->value) > 200) {
                                                            ?>
                                                            <textarea col="25" rows="5" type="text" class="form-control"
                                                                      name="<?php echo $settings->name; ?>"><?php echo $settings->value; ?>  </textarea>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <input type="text" class="form-control"
                                                                   name="<?php echo $settings->name; ?>"
                                                                   value="<?php echo $settings->value; ?>"/>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>

                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            <div class="tab-pane fade" id="socials">
                                <br>
                                <?php foreach ($setting as $settings) {
                                    foreach ($settings as &$set) {
                                        $set = htmlentities($set);
                                    }

                                    $permissions = explode(',', $settings->permissions);
                                    if (!is_null($settings->permissions) || in_array($this->session->user->role, $permissions)) {
                                        ?>
                                        <?php
                                        if ($settings->classification == 3) {
                                            ?>
                                            <div class="container col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label"><?php echo $settings->display_name; ?></label>
                                                    <?php if ($this->session->user->role == 'Super Admin') { ?>
                                                        <a href="edit/<?php echo $settings->id; ?>"><span
                                                                    class="fas fa-edit"></span></a>
                                                    <?php } ?>
                                                    <div class="tooltips">?
                                                        <span class="tooltiptext"><?php echo $settings->description; ?></span>
                                                    </div>
                                                    <?php
                                                    if ($settings->type === "file") {
                                                        ?>
                                                        <p>
                                                            <small>
                                                                <strong>Current: </strong><br/><?php echo $settings->value; ?>
                                                            </small>
                                                        </p>
                                                        <input type="file" name="<?php echo $settings->name; ?>"
                                                               class="form-control" placeholder='Choose a file...'/>
                                                        <?php
                                                    } else if ($settings->type === "dropdown") {
                                                        ?>
                                                        <?php if ($settings->name == 'timezone') { // If dropdown is a timezone. ?>
                                                            <select name="<?php echo $settings->name; ?>"
                                                                    class="form-control">
                                                                <option value="UTC" selected disabled>Select Timezone
                                                                </option>
                                                                <?php foreach ($timezones as $key => $value) { ?>
                                                                    <option value="<?php echo $key; ?>" <?php echo ($key == $settings->value) ? 'selected' : ''; ?> ><?php echo $value; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        <?php } ?>
                                                        <?php
                                                    } else {
                                                        if (strlen($settings->value) > 200) {
                                                            ?>
                                                            <textarea col="25" rows="5" type="text" class="form-control"
                                                                      name="<?php echo $settings->name; ?>"><?php echo $settings->value; ?>  </textarea>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <input type="text" class="form-control"
                                                                   name="<?php echo $settings->name; ?>"
                                                                   value="<?php echo $settings->value; ?>"/>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>

                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            <div class="tab-pane fade" id="others">
                                <br>
                                <?php foreach ($setting as $settings) {
                                    foreach ($settings as &$set) {
                                        $set = htmlentities($set);
                                    }

                                    $permissions = explode(',', $settings->permissions);
                                    if (!is_null($settings->permissions) || in_array($this->session->user->role, $permissions)) {
                                        ?>
                                        <?php
                                        if ($settings->classification == 4) {
                                            ?>
                                            <div class="container col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label"><?php echo $settings->display_name; ?></label>
                                                    <?php if ($this->session->user->role == 'Super Admin') { ?>
                                                        <a href="edit/<?php echo $settings->id; ?>"><span
                                                                    class="fas fa-edit"></span></a>
                                                    <?php } ?>
                                                    <div class="tooltips">?
                                                        <span class="tooltiptext"><?php echo $settings->description; ?></span>
                                                    </div>
                                                    <?php
                                                    if ($settings->type === "file") {
                                                        ?>
                                                        <p>
                                                            <small>
                                                                <strong>Current: </strong><br/><?php echo $settings->value; ?>
                                                            </small>
                                                        </p>
                                                        <input type="file" name="<?php echo $settings->name; ?>"
                                                               class="form-control" placeholder='Choose a file...'/>
                                                        <?php
                                                    } else if ($settings->type === "dropdown") {
                                                        ?>
                                                        <?php if ($settings->name == 'timezone') { // If dropdown is a timezone. ?>
                                                            <select name="<?php echo $settings->name; ?>"
                                                                    class="form-control">
                                                                <option value="UTC" selected disabled>Select Timezone
                                                                </option>
                                                                <?php foreach ($timezones as $key => $value) { ?>
                                                                    <option value="<?php echo $key; ?>" <?php echo ($key == $settings->value) ? 'selected' : ''; ?> ><?php echo $value; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        <?php } ?>
                                                        <?php
                                                    } else {
                                                        if (strlen($settings->value) > 200) {
                                                            ?>
                                                            <textarea col="25" rows="5" type="text" class="form-control"
                                                                      name="<?php echo $settings->name; ?>"><?php echo $settings->value; ?>  </textarea>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <input type="text" class="form-control"
                                                                   name="<?php echo $settings->name; ?>"
                                                                   value="<?php echo $settings->value; ?>"/>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>

                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                    }
                                }
                                ?>

                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="row pull-right modal-footer">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary" value="Save">
                                    <span class="fas fa-paper-plane"></span>
                                    Save
                                </button>
                                <a id="cancel" href="/admin/settings" class="btn btn-danger">
                                    <span class="fas fa-times"></span>
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </section>


        </div>
    </div>
</div>

