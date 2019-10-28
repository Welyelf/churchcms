<div class="row"><br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="fas fa-thumbtack fa-fw"></span>
            <b><i>Posts</i> </b>
        </div>
        <div class="col-lg-10">
            <br/>

        </div>
        <div class="col-lg-2" style="margin-top:10px;">
            <a href="/admin/posts/add/" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add</a>
        </div>
        <br><br>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="posts-list" class="table table-striped">
                    <thead>
                    <tr>
                        <th width="40%">Title</th>
                        <th width="20%">Slug</th>
                        <th width="15%">Date</th>
                        <th width="15%">Author</th>
                        <th width="15%">Status</th>
                        <th width="10%">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($posts as $post) { ?>
                        <tr>
                            <td>
                                <a href="/blog/<?php echo $post->slug; ?>/" target="_blank"
                                   class="btn btn-xs btn-default"><i class="fa fa-eye"></i></a> &nbsp;
                                <a href="/admin/posts/edit/<?php echo $post->id; ?>/"><?php echo $post->title; ?></a>
                            </td>
                            <td><?php echo $post->slug; ?></td>
                            <td><?php echo date('F d, Y h:i A', $post->date); ?></td>
                            <td><?php echo $post->first_name . " " . $post->last_name; ?></td>
                            <td>
                                <?php
                                if ($post->is_active == 1) {
                                    echo "Active";
                                } else {
                                    echo "Inactive";
                                }
                                ?>
                            </td>
                            <td>
                                <a href="/admin/posts/delete/<?php echo $post->id; ?>/"
                                   onclick="return confirm('Confirm Delete #<?php echo $post->id; ?> - <?php echo $post->title; ?> ?')"
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
    