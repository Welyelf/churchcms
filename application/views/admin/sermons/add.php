<div class="row"><br>
    <div class="panel panel-default">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <span class="fas fa-church fa-fw"></span>
                <li class="breadcrumb-item">
                    <a href="/admin/sermons"><b><i>Sermons</i></b></a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?php
                    if (!isset($sermon->title)) {
                        echo "Add Sermon";
                    } else {
                        echo "Edit Sermon";
                    }
                    ?>
                </li>
            </ol>
        </nav>
        <div class="panel-body">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <?php if (isset($error)) {
                        ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>Sorry !</strong> <?php echo $error; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <?php if (isset($success)) {
                        ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>Congrats!</strong> <?php echo $success; ?>
                        </div>
                        <?php
                    }
                    ?>

                    <div class="col-lg-6">
                        <div class="panel panel-default">

                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="control-label">Title</label>
                                            <small> (Title of the sermon.)</small>
                                            <input type="text" class="form-control" name="title"
                                                   value="<?php if (isset($sermon->title)) {
                                                       echo $sermon->title;
                                                   } ?>" required/>
                                            <?php echo form_error('title'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="control-label">Content</label>
                                            <small> (Please specify the content of the sermon. You can also edit it by
                                                HTML.)
                                            </small>
                                            <textarea id="ckeditor" class="form-control"
                                                      name="transcript"><?php if (isset($sermon->transcript)) {
                                                    echo $sermon->transcript;
                                                } ?></textarea>
                                            <?php echo form_error('transcript'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="control-label">Date</label>
                                            <small> (Please specify the date of the sermon.)</small>
                                            <input type="text" id="datepicker" class="form-control" name="date"
                                                   value="<?php if (isset($sermon->date)) {
                                                       echo date('m/d/Y', $sermon->date);
                                                   } ?>" required/>
                                            <?php echo form_error('date'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="control-label">Speaker</label>
                                            <small> (Please specify the speaker of the sermon.)</small>
                                            <input type="text" class="form-control" name="pastor"
                                                   value="<?php if (isset($sermon->pastor)) {
                                                       echo $sermon->pastor;
                                                   } else {
                                                       echo !empty($default_sermon_speaker) ? $default_sermon_speaker : '';
                                                   } ?>" required/>
                                            <?php echo form_error('pastor'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="control-label">Youtube URL</label>
                                            <small> (Please input valid Youtube id only.)</small>
                                            <input id="youtube_id" type="text" class="form-control" name="youtube_id"
                                                   value="<?php if (isset($sermon->youtube_id)) {
                                                       echo $sermon->youtube_id;
                                                   } ?>"/><br>
                                            <button id="youtube_verify_btn" class="btn btn-default pull-right">Verify
                                                ID
                                            </button>
                                            <?php echo form_error('youtube_id'); ?>
                                            <?php echo isset($youtube_error) ? 'Please enter a valid youtube URL' : ''; ?>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="control-label">MP3 File </label>
                                            <small> (You can upload your MP3 file here.)</small>
                                            <p>
                                                <small>
                                                    <strong>Current: </strong><br/><?php if (isset($sermon->mp3_link)) {
                                                        echo $sermon->mp3_link;
                                                    } ?></small>
                                            </p>
                                            <input class="" type="file" name="mp3" accept="audio/*"/>
                                            <!--<input type="text" class="form-control" name="mp3_link" value="<?php echo set_value('mp3_link'); ?>" />-->
                                            <?php if ($mp3_error) { ?>
                                                <div class="form-error">
                                                    <small><?php echo $mp3_error; ?></small>
                                                </div>
                                            <?php } ?>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <label><strong>Passage</strong></label>
                                        <small> (You can add multiple scriptures.)</small>
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-12">
                                            <select id="book" class="form-control">
                                                <option disabled selected value> Select Book</option>
                                                <?php foreach ($books as $key => $value) { ?>
                                                    <option value="<?php echo $key ?>"><?php echo $value['short_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <br><br><br>
                                        <div class="col-md-2">
                                            From
                                        </div>
                                        <div class="col-md-5">
                                            <select id="chapter-from" class="form-control" disabled="disabled"></select>
                                        </div>
                                        <div class="col-md-5">
                                            <select id="verse-from" class="form-control" disabled="disabled"></select>
                                        </div>
                                        <br/><br/>
                                        <div class="col-md-2">
                                            To
                                        </div>
                                        <div class="col-md-5">
                                            <select id="chapter-to" class="form-control" disabled="disabled"></select>
                                        </div>
                                        <div class="col-md-5">
                                            <select id="verse-to" class="form-control" disabled="disabled"></select>
                                        </div>
                                        <br><br>
                                        <div class="col-md-8"></div>
                                        <div class="col-md-4">
                                            <a href="javascript:void(0);" class="btn btn-primary btn-block text-center"
                                               id="add-scripture" disabled="disabled">Add</a>
                                        </div>
                                        <br><br>

                                        <div class="col-md-12">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th width="80%">Passages</th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                                </thead>
                                                <tbody id="scriptures-list">
                                                <?php
                                                if (isset($sermon->scriptures)) {
                                                    $x = 0;
                                                    foreach ($sermon->scriptures as $scripture) {
                                                        $input_value = $scripture->book_id . "|" . $scripture->chapter_from . "|" . $scripture->verse_from . "|" . $scripture->chapter_to . "|" . $scripture->verse_to;
                                                        ?>
                                                        <tr id="item-<?php echo $x; ?>">
                                                            <td>
                                                                <?php echo get_scripture_label_new($input_value); ?>
                                                                <input type="hidden" name="scriptures[]"
                                                                       value="<?php echo $input_value; ?>"/>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-danger"
                                                                        onclick="remove_scripture(<?php echo $x; ?>);">
                                                                    <i
                                                                            class="fa fa-trash"></i></button>
                                                            </td>
                                                        </tr>
                                                        <?php $x++;
                                                    }
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="panel-footer ">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Multiple File Upload -->

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <label class="control-label">Attachments: </label>
                                <small> (Maximum file size of <?php echo round($sermons_max_file_size / 1048576); ?> MB.
                                    Allowed file types: <?php echo $allowed_types; ?>.)
                                </small>
                            </div>
                            <div class="panel-body">
                                <div id="upload_files" class="row">
                                    <div class="col-lg-12 clearfix ">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <div class="btn btn-primary add_files"><span class="fa fa-plus"></span>
                                                    Add Files
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br><br>
                                    <?php
                                    if (isset($sermon->file_attachments)) {
                                        $att_id = 0;
                                        $files = json_decode($sermon->file_attachments);
                                        //if($files)
                                        if (!empty($files)) {
                                            foreach ($files as $key => $file) {
                                                ?>
                                                <div id="file-att-id-<?php echo $att_id; ?>" class="file col-lg-12 ">
                                                    <div class="col-lg-5">
                                                        <input class="form-control file_name" type="text"
                                                               name="file_name[]"
                                                               value="<?php if (isset($file->file_name)) {
                                                                   echo $file->file_name;
                                                               } ?>" placeholder="Filename">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <select class="form-control file_tag" name="file_tag[]">
                                                            <option selected value disabled>Select Tag</option>
                                                            <?php
                                                            if (isset($file->file_tag)) { // Prevent error to previous data that has no file tags yet. ?>
                                                                <?php
                                                                foreach ($sermons_file_tags as $sermon_file_tag) { // File Tags. ?>
                                                                    <?php $cur_sermon_file_tag = $sermon_file_tag; ?>
                                                                    <option value="<?php echo $cur_sermon_file_tag; ?>" <?php echo $file->file_tag == $cur_sermon_file_tag ? 'selected' : '' ?>><?php echo $sermon_file_tag; ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <?php
                                                                foreach ($sermons_file_tags as $sermon_file_tag) { // File Tags. ?>
                                                                    <option value="<?php echo $sermon_file_tag; ?>"><?php echo $sermon_file_tag; ?></option>
                                                                    <?php
                                                                } ?>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <span class="btn btn-default btn-file" style="display:none;">
                                                            <i class="fas fa-upload"></i><input class="chosen_file"
                                                                                                type="file"
                                                                                                name="fileUpload[]">
                                                        </span>
                                                        <span class="btn btn-danger btn-delete-file"
                                                              onclick="delete_attachment(<?php echo $att_id; ?>);">
                                                                <i class="fas fa-trash"></i>
                                                        </span>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <input class="hidden" type="text" name="file_url[]"
                                                               value="<?php if (isset($file->file_url)) {
                                                                   echo $file->file_url;
                                                               } ?>">
                                                        <p>
                                                            <small>
                                                                <strong>Current: </strong><?php if (isset($file->file_url)) {
                                                                    echo $file->file_url;
                                                                } ?></small>
                                                        </p>
                                                    </div>
                                                </div>
                                                <?php $att_id++; // Increment attachment id.
                                            }
                                        } ?>
                                        <div id="cur-att-id" value="<?php echo $att_id; ?>" hidden></div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="file col-lg-12">
                                            <div class="col-lg-5">
                                                <input class="form-control file_name" type="text" name="file_name[]"
                                                       placeholder="Filename">
                                            </div>
                                            <div class="col-lg-4">
                                                <select class="form-control file_tag" name="file_tag[]">
                                                    <option selected value disabled>Select Tag</option>
                                                    <?php foreach ($sermons_file_tags as $file_tags) { // File Tags. ?>
                                                        <option value="<?php echo $file_tags; ?>"><?php echo $file_tags; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-3">
                                                    <span class="btn btn-primary btn-file">
                                                        Browse <input class="chosen_file" type="file"
                                                                      name="fileUpload[]">
                                                    </span>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <?php $att_id = 0; // Initialize increment attachment id. ?>

                                    <div id="cur-att-id" value="<?php echo $att_id; ?>" hidden></div>
                                    <br><br>
                                </div>

                            </div>
                            <div class="panel-footer ">

                            </div>
                        </div>


                    </div>
                </div>
                <hr>
                <a href="/admin/sermons" class="btn btn-danger">
                    <span class="fas fa-times"></span>
                    Back
                </a>
                <div class="row pull-right">

                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary" value="Save" id="save-btn">
                            <span class="fas fa-paper-plane"></span>
                            Save
                        </button>

                    </div>


                </div>
                <input type="hidden" name="id" value="<?php if (isset($sermon->id)) {
                    echo $sermon->id;
                } ?>"/>
            </form>

        </div>
    </div>
</div>


