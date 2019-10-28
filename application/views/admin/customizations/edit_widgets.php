<div class="row"><br>
    <div class="panel panel-default">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <span class="fas fa-wrench fa-fw"></span>
                <li class="breadcrumb-item">
                    <a href="/admin/customizations/widgets"><b><i>Customization</i></b></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $widget->name; ?></li>
            </ol>
        </nav>
        <div class="panel-body">
            <div class="kedra_panel">
                <form method="post">
                    <div class="form-group row">
                        <label for="inputDisplay" class="col-sm-5 col-form-label">Name</label>
                        <div class="col-sm-7">
                            <input type="text" name="name" class="form-control"
                                   value="<?php echo isset($inputs['name']) ? $inputs['name'] : $widget->name; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDisplay" class="col-sm-5 col-form-label">Active?</label>
                        <div class="col-sm-7">
                            <input type="text" name="is_enabled" class="form-control"
                                   value="<?php echo isset($inputs['is_enabled']) ? $inputs['is_enabled'] : $widget->is_enabled; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDisplay" class="col-sm-5 col-form-label">Model Parameters</label>
                        <div class="col-sm-7">
                            <textarea class="form-control" name="model_parameters"
                                      rows="5"><?php echo isset($inputs['model_parameters']) ? $inputs['model_parameters'] : $widget->model_parameters; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDisplay" class="col-sm-5 col-form-label">View Parameters</label>
                        <div class="col-sm-7">
                            <?php if ($widget->function_name != "custom_widget") { ?>
                                <textarea class="form-control" name="view_parameters"
                                          rows="5"><?php echo isset($inputs['view_parameters']) ? $inputs['view_parameters'] : $widget->view_parameters; ?></textarea>
                            <?php } else { ?>
                                <?php $tmp = json_decode($widget->view_parameters) ?>
                                <textarea class="form-control" name="content" rows="5"
                                          id="content"><?php echo isset($inputs['content']) ? $inputs['content'] : stripslashes($tmp->content); ?></textarea>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDisplay" class="col-sm-5 col-form-label">Order</label>
                        <div class="col-sm-7">
                            <input type="text" name="ordering" class="form-control"
                                   value="<?php echo isset($inputs['ordering']) ? $inputs['ordering'] : $widget->ordering; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDisplay" class="col-sm-5 col-form-label">Location</label>
                        <div class="col-sm-7">
                            <input type="text" name="location" class="form-control"
                                   value="<?php echo isset($inputs['location']) ? $inputs['location'] : $widget->location; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDisplay" class="col-sm-5 col-form-label">Custom CSS</label>
                        <div class="col-sm-7">
                            <textarea class="form-control" rows="5"
                                      name="custom_css"><?php echo isset($inputs['custom_css']) ? $inputs['custom_css'] : $widget->custom_css; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDisplay" class="col-sm-5 col-form-label">Custom JS</label>
                        <div class="col-sm-7">
                            <textarea class="form-control" rows="5"
                                      name="custom_js"><?php echo isset($inputs['custom_js']) ? $inputs['custom_js'] : $widget->custom_js; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDisplay" class="col-sm-5 col-form-label">Function Name</label>
                        <div class="col-sm-7">
                            <input type="text" name='function_name' class="form-control"
                                   value="<?php echo isset($inputs['function_name']) ? $inputs['function_name'] : $widget->function_name; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputDisplay" class="col-sm-5 col-form-label">Description</label>
                        <div class="col-sm-7">
                            <input type="text" name='description' class="form-control"
                                   value="<?php echo isset($inputs['description']) ? $inputs['description'] : $widget->description; ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div style="float:left">
                            <a href="/admin/customizations/delete-widgets/<?php echo $widget->id; ?>/ "
                               onclick="return confirm('Confirm Delete?( Clicking OK permanently remove the widget.)')"
                            <button class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                                DELETE
                            </button>
                            </a>
                        </div>
                        <a href="/admin/customizations/widgets">
                            <button type="button" class="btn btn-danger btn-md ">Cancel</button>
                        </a>
                        <button type="submit" class="btn btn-primary btn-md ">Save</button>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $widget->id; ?>"/>
                </form>
            </div>
            <br>
        </div>
    </div>
</div>

