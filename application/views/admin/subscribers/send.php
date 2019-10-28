<div class="row"><br>
    <div class="panel panel-default">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <span class="fas fa-clipboard-list fa-fw"></span>
                <li class="breadcrumb-item">
                    <a href="/admin/subscribers"><b><i>Subscribers</i></b></a></li>
                <li class="breadcrumb-item active" aria-current="page">Send Mail</li>
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
                            <label class="control-label">Subject</label>
                            <input type="text" class="form-control" name="subject"
                                   value="<?php echo set_value("subject"); ?>" required/>
                            <?php echo form_error('subject'); ?>
                        </div>
                        <?php if (isset($subscriber)) { ?>
                            <div class="form-group">
                                <label class="control-label">To:</label>
                                <input type="email" class="form-control" name="email"
                                       value="<?php echo $subscriber->email; ?>" readonly>
                                <input type="hidden" class="form-control" name="subscriber_name"
                                       value="<?php echo $subscriber->name; ?>">
                            </div>
                        <?php } ?>

                        <div class="form-group">
                            <label class="control-label">Choose Template:</label>
                            <select id="email_template" class="form-control">
                                <option selected disabled>Select</option>
                                <?php foreach ($email_templates as $template) { ?>
                                    <option value="<?php echo $template->id; ?>"><?php echo $template->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div id="sermon_fields" class="form-group" style="display:none">
                            <label class="control-label">Choose Sermon:</label>
                            <select id="sermon_dropdown" class="form-control" name="sermon">
                                <option selected disabled>Select</option>
                                <?php foreach ($sermons as $sermon) { ?>
                                    <option value="<?php echo $sermon->id; ?>"><?php echo $sermon->slug; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Message</label>
                            <textarea id="ckeditor" class="form-control"
                                      name="message"><?php echo set_value('message'); ?></textarea>
                            <?php echo form_error('message'); ?>
                        </div>
                    </div>
                </div>
                <div class="row pull-right">
                    <div class="col-lg-12">
                        <button id="submit-btn" type="submit" class="btn btn-primary" value="Send">
                            <span class="fa fa-paper-plane"></span>
                            Send
                        </button>
                        <a id="cancel" href="/admin/subscribers/all" class="btn btn-danger">
                            <span class="fas fa-times"></span>
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
    