<div class="row">
    <div class="panel panel-default">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <span class="fas fa-cog fa-fw"></span>
                <li class="breadcrumb-item">
                    <a href="/admin/settings/"><b><i>Settings</i></b></a></li>
                <li class="breadcrumb-item active" aria-current="page">Add New Config</li>
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
                        <div class="form-group">
                            <label class="control-label">Name</label>
                            <div class="tooltips">?
                                <span class="tooltiptext">This is the name value of the setting. Should be a Unique value. Check Documentation for available settings.</span>
                            </div>
                            <input id="name" type="text" class="form-control" name="name"
                                   value="<?php echo set_value('name'); ?>" required/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Display Name</label>
                            <div class="tooltips">?
                                <span class="tooltiptext">This would appear as the label of the setting.</span>
                            </div>
                            <input id="display_name" type="text" class="form-control" name="display_name"
                                   value="<?php echo set_value('display_name'); ?>" required/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Value</label>
                            <div class="tooltips">?
                                <span class="tooltiptext">This is the current value of the setting. Leave blank if there is no default value.</span>
                            </div>
                            <input id="value" type="text" class="form-control" name="value"
                                   value="<?php echo set_value('value'); ?>"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <div class="tooltips">?
                                <span class="tooltiptext">This is the description of the setting. It will appear as a tooltip.</span>
                            </div>
                            <textarea id="description" class="form-control" name="description"
                                      style="resize:vertical;"><?php echo set_value('description'); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Type</label>
                            <div class="tooltips">?
                                <span class="tooltiptext">Set the type of the setting to determine the input type. Default is text.</span>
                            </div>
                            <select class="form-control" name="type">
                                <option value selected>Text</option>
                                <option value="file">File</option>
                                <option value="textarea">Textarea</option>
                                <option value="dropdown">Dropdown</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Category</label>
                            <div class="tooltips">?
                                <span class="tooltiptext">Set the category of the setting. Default is General.</span>
                            </div>
                            <select class="form-control" name="classification">
                                <option value="0">General</option>
                                <option value="1">Email</option>
                                <option value="2">Stripe</option>
                                <option value="3">Socials</option>
                                <option value="4">Others</option>
                            </select>
                        </div>
                        <div class="form-group">
                            Is super admin only ? <input id="status" type="checkbox" name="permissions"
                                                         value="Super Admin"/>
                            <div class="tooltips">?
                                <span class="tooltiptext">Check if only Super Admin has access.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pull-right">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary" value="Save">
                            <span class="fas fa-paper-plane"></span>
                            Save
                        </button>
                        <a id="cancel" href="/admin/settings/" class="btn btn-danger">
                            <span class="fas fa-times"></span>
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>