<div class="row"><br>
    <div class="panel panel-default">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <span class="fas fa-wrench fa-fw"></span>
                <li class="breadcrumb-item">
                    <a href="/admin/customizations/widgets"><b><i>Customization</i></b></a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?php
                    if (isset($widget->id)) {
                        echo $widget->name;
                    } else {
                        echo "Add Widget";
                    }
                    ?>
                </li>
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

            <div class="kedra_panel">
                <form method="post">
                    <div class="form-group row">
                        <label for="inputDisplay" class="col-sm-5 col-form-label">Name</label>
                        <div class="col-sm-7">
                            <input type="text" name="name" class="form-control" value="<?php if (isset($widget->name)) {
                                echo $widget->name;
                            } ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDisplay" class="col-sm-5 col-form-label">Active?</label>
                        <div class="col-sm-7">
                            <input type="text" name="is_enabled" class="form-control"
                                   value="<?php if (isset($widget->is_enabled)) {
                                       echo $widget->is_enabled;
                                   } ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDisplay" class="col-sm-5 col-form-label">Model Parameters</label>
                        <div class="col-sm-7">
                            <textarea class="form-control" name="model_parameters"
                                      rows="5"><?php if (isset($widget->model_parameters)) {
                                    echo $widget->model_parameters;
                                } ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDisplay" class="col-sm-5 col-form-label">View Parameters</label>
                        <div class="col-sm-7">

                            <?php
                            if (!isset($widget->function_name)) {
                                ?>
                                <textarea class="form-control" name="view_parameters"
                                          rows="5"><?php if (isset($widget->view_parameters)) {
                                        echo $widget->view_parameters;
                                    } ?></textarea>
                                <?php
                            } else {
                                if ($widget->function_name != "custom_widget") { ?>
                                    <textarea class="form-control" name="view_parameters"
                                              rows="5"><?php if (isset($widget->view_parameters)) {
                                            echo $widget->view_parameters;
                                        } ?></textarea>
                                <?php } else { ?>
                                    <?php $tmp = json_decode($widget->view_parameters) ?>
                                    <textarea class="form-control" name="content" rows="5"
                                              id="content"><?php if (isset($tmp->content)) {
                                            echo stripslashes($tmp->content);
                                        } ?></textarea>
                                <?php }
                            } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDisplay" class="col-sm-5 col-form-label">Order</label>
                        <div class="col-sm-7">
                            <input type="text" name="ordering" class="form-control"
                                   value="<?php if (isset($widget->ordering)) {
                                       echo $widget->ordering;
                                   } ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDisplay" class="col-sm-5 col-form-label">Location</label>
                        <div class="col-sm-7">
                            <input type="text" name="location" class="form-control"
                                   value="<?php if (isset($widget->location)) {
                                       echo $widget->location;
                                   } ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDisplay" class="col-sm-5 col-form-label">Custom CSS</label>
                        <div class="col-sm-7">
                            <textarea class="form-control" rows="5"
                                      name="custom_css"><?php if (isset($widget->custom_css)) {
                                    echo $widget->custom_css;
                                } ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDisplay" class="col-sm-5 col-form-label">Custom JS</label>
                        <div class="col-sm-7">
                            <textarea class="form-control" rows="5"
                                      name="custom_js"><?php if (isset($widget->custom_js)) {
                                    echo $widget->custom_js;
                                } ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDisplay" class="col-sm-5 col-form-label">Function Name</label>
                        <div class="col-sm-7">
                            <input type="text" name='function_name' class="form-control"
                                   value="<?php if (isset($widget->function_name)) {
                                       echo $widget->function_name;
                                   } ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDisplay" class="col-sm-5 col-form-label">Description</label>
                        <div class="col-sm-7">
                            <input type="text" name='description' class="form-control"
                                   value="<?php if (isset($widget->description)) {
                                       echo $widget->description;
                                   } ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="/admin/customizations/widgets">
                            <button type="button" class="btn btn-danger btn-md ">Cancel</button>
                        </a>
                        <button type="submit" class="btn btn-primary btn-md ">Save</button>
                    </div>
                    <input type="hidden" name="id" value="<?php if (isset($widget->id)) {
                        echo $widget->id;
                    } ?>"/>
                </form>
            </div>
            <br>
        </div>
    </div>
</div>

