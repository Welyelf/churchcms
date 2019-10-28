<div class="row"><br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="fas fa-tags fa-fw"></span>
            <b><i>Post Categories</i> </b>
        </div>
        <div class="col-lg-10">
            <br/>

        </div>
        <div class="col-lg-2" style="margin-top:10px;">
            <a href="/admin/posts/add-category/" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add</a>
        </div>
        <br><br>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="posts-list" class="table table-striped">
                    <thead>
                    <tr>
                        <th width="45%">Name</th>
                        <th width="35%">Slug</th>
                        <th width="10%">Count</th>
                        <th width="10%">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($categories as $category) { ?>
                        <tr>
                            <td>
                                <a href="/blog/category/<?php echo $category->slug; ?>/" target="_blank"
                                   class="btn btn-xs btn-default"><i class="fa fa-eye"></i></a>&nbsp;
                                <a href="/admin/posts/edit-category/<?php echo $category->id; ?>/"><?php echo $category->name; ?></a>
                            </td>
                            <td><?php echo $category->slug; ?> </td>
                            <td><?php echo $category->count; ?></td>
                            <td>
                                <a href="/admin/posts/delete-category/<?php echo $category->id; ?>/"
                                   onclick="return confirm('Confirm Delete #<?php echo $category->id; ?> - <?php echo $category->name; ?> ?')"
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
    