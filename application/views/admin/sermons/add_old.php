<div class="container">
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="row" style="border-bottom: 1px solid #EEE">
                <div class="col-lg-10">
                    <h1>Add Sermon</h1>
                </div>
            </div>
            <form method="post">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">Title</label>
                                    <input type="text" class="form-control" name="title"
                                           value="<?php echo set_value('title'); ?>"/>
                                    <?php echo form_error('title'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Passage</label>
                                    <input type="text" class="form-control" name="passage"
                                           value="<?php echo set_value('passage'); ?>"/>
                                    <?php echo form_error('passage'); ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Date</label>
                                    <input type="text" id="datepicker" class="form-control" name="date"
                                           value="<?php echo set_value('date'); ?>"/>
                                    <?php echo form_error('date'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">Pastor</label>
                                    <input type="text" class="form-control" name="pastor"
                                           value="<?php echo set_value('pastor'); ?>"/>
                                    <?php echo form_error('pastor'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">Video Id</label>
                                    <input type="text" class="form-control" name="youtube_id"
                                           value="<?php echo set_value('youtube_id'); ?>"/>
                                    <?php echo form_error('youtube_id'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">MP3 Link</label>
                                    <input type="text" class="form-control" name="mp3_link"
                                           value="<?php echo set_value('mp3_link'); ?>"/>
                                    <?php echo form_error('mp3_link'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Bulletin Link</label>
                                    <input type="text" class="form-control" name="bulletin_link"
                                           value="<?php echo set_value('bulletin_link'); ?>"/>
                                    <?php echo form_error('bulletin_link'); ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Transcript Link</label>
                                    <input type="text" class="form-control" name="transcript_link"
                                           value="<?php echo set_value('transcript_link'); ?>"/>
                                    <?php echo form_error('transcript_link'); ?>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">Content</label>
                            <textarea id="ckeditor" class="form-control"
                                      name="transcript"><?php echo set_value('transcript'); ?></textarea>
                            <?php echo form_error('transcript'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <input type="submit" class="btn btn-primary" value="Save"/>
                        <a href="/admin/pages/all" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
