<div class="row"><br>
    <div class="panel panel-default">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <span class="fas fa-tachometer-alt fa-fw"></span>
                <li class="breadcrumb-item">
                    <a href="/admin/pages"><b><i>Pages</i></b></a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Page</li>
            </ol>
        </nav>
        <div class="panel-body">
            <?php echo validation_errors('<div class="alert alert-danger alert-dismissible">', '</div>'); ?>
            <form method="post">
                <div class="row">
                    <div class="col-lg-10 col-lg-offset-1">
                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <input id="title" type="text" class="form-control input-field" name="title"
                                   value="<?php if (isset($page->title)) {
                                       echo $page->title;
                                   } ?>" required/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Slug</label>
                            <input id="slug" type="text" class="form-control input-field" name="slug"
                                   value="<?php if (isset($page->slug)) {
                                       echo $page->slug;
                                   } ?>" required/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Subtitle</label>
                            <input id="subtitle" type="text" class="form-control input-field" name="subtitle"
                                   value="<?php if (isset($page->subtitle)) {
                                       echo $page->subtitle;
                                   } ?>"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Content</label>
                            <textarea id="content" class="form-control input-field"
                                      name="content"><?php if (isset($page->content)) {
                                    echo $page->content;
                                } ?></textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Page CSS</label>
                            <input id="page_css" class="form-control" name="page_css"
                                   value="<?php if (isset($page->page_css)) {
                                       echo $page->page_css;
                                   } ?>"/>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Status</label>
                            <select class="form-control" name="status">
                                <option value="0" <?php if (isset($page->status)) {
                                    echo $page->status == 0 ? 'selected' : '';
                                } ?>>Draft
                                </option>
                                <option value="1" <?php if (isset($page->status)) {
                                    echo $page->status == 1 ? 'selected' : '';
                                } ?>>Published
                                </option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="row pull-right">
                    <div class="col-lg-12">

                        <button type="submit" class="btn btn-primary" value="Save">
                            <span class="fas fa-paper-plane"></span>
                            Save
                        </button>
                        <a id="cancel" href="/admin/pages" class="btn btn-danger">
                            <span class="fas fa-times"></span>
                            Cancel
                        </a>
                    </div>
                </div>
                <input type="hidden" name="author_id" value="<?php echo $this->session->user->id; ?>"/>
                <input type="hidden" name="id" value="<?php if (isset($page->id)) {
                    echo $page->id;
                } ?>"/>
            </form>
        </div>
    </div>
</div>
    