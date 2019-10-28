<div class="row"><br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="fas fa-folder fa-fw"></span>
            <b><i>Files</i> </b>
        </div>
        <div class="col-lg-10">
            <br/>
        </div>
        <div class="col-lg-2" style="margin-top:10px;">
            <a href="/admin/files/upload/" class="btn btn-primary pull-right">
                <i class="fa fa-plus"></i> Add</a>
        </div>
        <br><br>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="files-list" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th width="15%">&nbsp;</th>
                        <th width="30%">Filename</th>
                        <th width="30%">Path</th>
                        <th width="20%">Uploaded Date</th>
                        <th width="5%">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($files as $file) { ?>
                        <tr>
                            <td width="10%">
                                <?php if ($file->ext == ".pdf") { ?>
                                    <img src="/assets/img/pdf.png" width="100"/>
                                <?php } else if ($file->ext == ".docx" || $file->ext == ".doc") { ?>
                                    <img src="/assets/img/doc.png" width="100"/>
                                <?php } else if ($file->ext == ".mp3") { ?>
                                    <img src="/assets/img/mp3.png" width="100"/>
                                <?php } else { ?>
                                    <img src="<?php echo '/uploads/' . $file->name ?>" width="100"/>
                                <?php } ?>
                            </td>

                            <?php if ($file->path) { // Check if file path exists.
                                // Get file path starting from /uploads/
                                $file_path = substr($file->path, strpos($file->path, "/uploads/"));
                                ?>
                                <td><a href="<?php echo $file_path . $file->name ?>"
                                       target="_blank"><?php echo $file->name ?></a></td>
                                <td><?php echo $file_path . $file->name; ?></td>

                            <?php } else { ?>
                                <td><a href="<?php echo '/uploads/' . $file->name ?>"
                                       target="_blank"><?php echo $file->name ?></a></td>
                                <td><?php echo '/uploads/' . $file->name; ?></td>
                            <?php } ?>

                            <td><?php echo $file->created_at; ?></td>
                            <td><a href="/admin/files/delete/<?php echo $file->id; ?>/"
                                   onclick="return confirm('Confirm Delete?')" class="btn btn-xs btn-default"><i
                                            class="fa fa-trash"></i></a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
