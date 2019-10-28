<div class="row"><br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="fas fa-file-alt fa-fw"></span>
            <b><i>Pages</i> </b>
        </div>
        <div class="col-lg-10">
            <br/>
        </div>
        <div class="col-lg-2" style="margin-top:10px;">
            <a href="/admin/pages/add/" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add</a>
        </div>
        <br><br>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="pages-list" class="table table-striped">
                    <thead>
                    <tr>
                        <th width="40%">Title</th>
                        <th width="30%">Slug</th>
                        <th width="20%">Author</th>
                        <th width="10%">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($pages as $page) { ?>
                        <tr>
                            <td>
                                <a href="/<?php echo $page->slug; ?>/" target="_blank" class="btn btn-xs btn-default"><i
                                            class="fa fa-eye"></i></a> &nbsp;
                                <a href="/admin/pages/add/<?php echo $page->id; ?>/"><?php echo $page->title; ?></a>
                            </td>
                            <td><?php echo $page->slug; ?></td>
                            <td><?php echo $page->first_name . " " . $page->last_name; ?></td>
                            <td>
                                <a href="/admin/pages/delete/<?php echo $page->id; ?>/"
                                   onclick="return confirm('Confirm Delete #<?php echo $page->id; ?> - <?php echo $page->title; ?>?')"
                                   class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>