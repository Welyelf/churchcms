<div class="row">
    <div class="panel panel-default">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <span class="fas fa-cog fa-fw"></span>
                <li class="breadcrumb-item">
                    <a href="/admin/settings/"><b><i>Settings</i></b></a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Config</li>
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
                                   value="<?php echo isset($setting->name) ? $setting->name : ''; ?>" required/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Display Name</label>
                            <div class="tooltips">?
                                <span class="tooltiptext">This would appear as the label of the setting.</span>
                            </div>
                            <input id="display_name" type="text" class="form-control" name="display_name"
                                   value="<?php echo isset($setting->display_name) ? $setting->display_name : ''; ?>"
                                   required/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Value</label>
                            <div class="tooltips">?
                                <span class="tooltiptext">This would the value of the configured setting.</span>
                            </div>
                            <input id="display_name" type="text" class="form-control" name="value"
                                   value="<?php echo isset($setting->value) ? $setting->value : ''; ?>" required/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <div class="tooltips">?
                                <span class="tooltiptext">This is the description of the setting. It will appear as a tooltip.</span>
                            </div>
                            <textarea id="description" class="form-control" name="description"
                                      style="resize:vertical;"><?php echo isset($setting->description) ? $setting->description : ''; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Type</label>
                            <div class="tooltips">?
                                <span class="tooltiptext">Set the type of the setting to determine the input type. Default is text.</span>
                            </div>
                            <select class="form-control" name="type">
                                <option value selected>Text</option>
                                <option value="file" <?php echo $setting->type == 'file' ? 'selected' : ''; ?> >File
                                </option>
                                <option value="textarea" <?php echo $setting->type == 'textarea' ? 'selected' : ''; ?>>
                                    Textarea
                                </option>
                                <option value="dropdown" <?php echo $setting->type == 'dropdown' ? 'selected' : ''; ?>>
                                    Dropdown
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Category</label>
                            <div class="tooltips">?
                                <span class="tooltiptext">Set the category of the setting. Default is General.</span>
                            </div>
                            <select class="form-control" name="classification">
                                <option value="0" <?php echo $setting->classification == '0' ? 'selected' : ''; ?>>
                                    General
                                </option>
                                <option value="1" <?php echo $setting->classification == '1' ? 'selected' : ''; ?>>
                                    Email
                                </option>
                                <option value="2" <?php echo $setting->classification == '2' ? 'selected' : ''; ?>>
                                    Stripe
                                </option>
                                <option value="3" <?php echo $setting->classification == '3' ? 'selected' : ''; ?>>
                                    Socials
                                </option>
                                <option value="4" <?php echo $setting->classification == '4' ? 'selected' : ''; ?>>
                                    Others
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            Is super admin only ? <input id="status" type="checkbox" name="permissions"
                                                         value="Super Admin" <?php echo !empty($setting->permissions) ? 'checked' : ''; ?>/>
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
                <input type="hidden" name="id" value="<?php echo $setting->id; ?>"/>
            </form>
        </div>
    </div>
</div>