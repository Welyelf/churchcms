<div class="row"><br>
    <div class="panel panel-default">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <span class="fas fa-tags fa-fw"></span>
                <li class="breadcrumb-item">
                    <a href="/admin/post-categories"><b><i>Post Categories</i></b></a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Post Category</li>
            </ol>
        </nav>
        <div class="panel-body">
            <?php echo validation_errors('<div class="alert alert-danger alert-dismissible">', '</div>'); ?>
            <form method="post">
                <div class="row">
                    <div class="col-lg-10 col-lg-offset-1">
                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <input type="text" class="form-control" name="name"
                                   value="<?php echo isset($inputs['name']) ? $inputs['name'] : $category->name; ?>"
                                   required/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Slug</label>
                            <input type="text" class="form-control" name="slug"
                                   value="<?php echo isset($inputs['slug']) ? $inputs['slug'] : $category->slug; ?>"
                                   required/>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Description</label>

                            <textarea id="description" col="25" rows="5" type="text" class="form-control"
                                      name="description"><?php echo isset($inputs['description']) ? $inputs['description'] : $category->description; ?></textarea>
                        </div>

                    </div>
                </div>

                <div class="row pull-right">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary" value="Save">
                            <span class="fas fa-paper-plane"></span>
                            Save
                        </button>
                        <a id="cancel" href="/admin/post-categories" class="btn btn-danger">
                            <span class="fas fa-times"></span>
                            Cancel
                        </a>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?php echo $category->id; ?>"/>
            </form>
        </div>
    </div>
</div>
    