<div class="row">
    <div class="col-lg-12">
        <div class="row" style="border-bottom: 1px solid #EEE">
            <div class="col-lg-10">
                <h1>Add Post</h1>
            </div>
        </div>
        <br/>
        <?php echo validation_errors('<div class="alert alert-danger alert-dismissible">', '</div>'); ?>
        <form method="post">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="form-group">
                        <label class="control-label">Title</label>
                        <input id="title" type="text" class="form-control input-field" name="title"
                               value="<?php echo isset($inputs['title']) ? $inputs['title'] : ''; ?>" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Slug</label>
                        <input id="slug" type="text" class="form-control input-field" name="slug"
                               value="<?php echo isset($inputs['slug']) ? $inputs['slug'] : ''; ?>" required/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Content</label>
                        <textarea id="content" class="form-control input-field"
                                  name="content"><?php echo isset($inputs['content']) ? $inputs['content'] : ''; ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label class="control-label">Category</label>
                        </div>
                        <?php foreach ($categories as $category) { ?>
                            <div class="col-lg-4">
                                <div class="checkbox">
                                    <label>
                                        <input id="category-<?php echo $category->id; ?>" type="checkbox"
                                               class="category-options checkbox" value="<?php echo $category->id; ?>"
                                               name="categories[]" <?php echo set_checkbox('categories[]', $category->id); ?> />
                                        <?php echo $category->name; ?>
                                    </label>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-lg-12">
                    <input type="submit" class="btn btn-primary" value="Save"/>
                    <a id="cancel" href="/admin/posts" class="btn btn-danger">Cancel</a>
                </div>
            </div>
            <input type="hidden" name="author_id" value="<?php echo $this->session->user->id; ?>"/>
        </form>
    </div>
</div>
