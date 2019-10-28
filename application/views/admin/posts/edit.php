<div class="row">
    <div class="col-lg-12">
        <?php if ($post != null) { ?>
            <div class="row" style="border-bottom: 1px solid #EEE">
                <div class="col-lg-10">
                    <h1>Edit Post</h1>
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
                                   value="<?php echo isset($inputs['title']) ? $inputs['title'] : $post->title; ?>"
                                   required/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Slug</label>
                            <input id="slug" type="text" class="form-control input-field" name="slug"
                                   value="<?php echo isset($inputs['slug']) ? $inputs['slug'] : $post->slug; ?>"
                                   required/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Content</label>
                            <textarea id="content" class="form-control input-field"
                                      name="content"><?php echo isset($inputs['content']) ? $inputs['content'] : $post->content; ?></textarea>
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
                                                   class="category-options checkbox"
                                                   value="<?php echo $category->id; ?>"
                                                   name="categories[]" <?php echo set_checkbox('categories[]', $category->id); ?> <?php echo in_array($category->id, $post_categories) == TRUE ? 'checked="checked"' : ''; ?> />
                                            <?php echo $category->name; ?>
                                        </label>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Is Active ?</label>
                            <select class="form-control" name="is_active">
                                <option value="0" <?php echo $post->is_active == 0 ? 'selected' : ''; ?> >Deactivate
                                </option>
                                <option value="1" <?php echo $post->is_active == 1 ? 'selected' : ''; ?> >Active
                                </option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="row pull-right">
                    <div class="col-lg-12">
                        <input type="submit" class="btn btn-primary" value="Save"/>
                        <a id="cancel" href="/admin/posts" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
                <input type="hidden" id="id" name="id" value="<?php echo $post->id; ?>"/>
            </form>
        <?php } else { ?>
            <div class="row" style="border-bottom: 1px solid #EEE">
                <div class="col-lg-10">
                    <h1>Edit Post </h1>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger"> Post Does Not Exist.</div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

