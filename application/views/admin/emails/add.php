<div class="row"><br>
    <div class="panel panel-default">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <span class="fas fa-envelope fa-fw"></span>
                <li class="breadcrumb-item">
                    <a href="/admin/emails"><b><i>Email</i></b></a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Email Template</li>
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
                            <input id="email-template-name" type="text" class="form-control" name="name"
                                   value="<?php echo set_value("name"); ?>" required/>
                            <?php echo form_error('name'); ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Slug</label>
                            <input id="slug" type="text" class="form-control" name="slug"
                                   value="<?php echo set_value("slug"); ?>" required/>
                            <?php echo form_error('slug'); ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Template</label>
                            <div class="pull-right">
                                <div class="btn btn-primary btn-xs btn-tool" data-toggle="modal"
                                     data-target="#templateSnippetsGuide">
                                    <i class="fas fa-info"></i>
                                </div>
                            </div>
                            <textarea id="ckeditor" class="form-control"
                                      name="template"><?php echo set_value('template'); ?></textarea>
                            <?php echo form_error('template'); ?>
                        </div>
                    </div>
                </div>
                <div class="row pull-right">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary" value="Save">
                            <span class="fas fa-paper-plane"></span>
                            Save
                        </button>
                        <a id="cancel" href="/admin/emails" class="btn btn-danger">
                            <span class="fas fa-times"></span>
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="templateSnippetsGuide" tabindex="-1" role="dialog"
     aria-labelledby="templateSnippetsGuideTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="templateSnippetsGuideTitle">Template Snippets Guide</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Snippet</th>
                        <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th colspan="2">Users</th>
                    </tr>
                    <tr>
                        <td>{users:first_name}</td>
                        <td>Will display the selected user's first name.</td>
                    </tr>
                    <tr>
                        <td>{users:last_name}</td>
                        <td>Will display the selected user's last name.</td>
                    </tr>
                    <tr>
                        <td>{users:username}</td>
                        <td>Will display the selected user's username.</td>
                    </tr>
                    <tr>
                        <td>{users:email}</td>
                        <td>Will display the selected user's email.</td>
                    </tr>

                    <tr>
                        <th colspan="2">Sermons</th>
                    </tr>
                    <tr>
                        <td>{sermons:title}</td>
                        <td>Will display the selected sermon's title.</td>
                    </tr>
                    <tr>
                        <td>{sermons:passage}</td>
                        <td>Will display the selected sermon's passage or multiple passages.</td>
                    </tr>
                    <tr>
                        <td>{sermons:pastor}</td>
                        <td>Will display the selected sermon's pastor.</td>
                    </tr>
                    <tr>
                        <td>{sermons:transcript}</td>
                        <td>Will display the selected sermon's transcript.</td>
                    </tr>

                    <tr>
                        <th colspan="2">Subscribers</th>
                    </tr>
                    <tr>
                        <td>{subscribers:name}</td>
                        <td>Will display the selected subscriber's name.</td>
                    </tr>
                    </tbody>
                </table>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>