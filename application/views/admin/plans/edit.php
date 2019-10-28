<div class="row"><br>
    <div class="panel panel-default">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <span class="fas fa-cubes fa-fw"></span>
                <li class="breadcrumb-item">
                    <a href="/admin/plans"><b><i>Plans</i></b></a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Plan</li>
            </ol>
        </nav>
        <div class="panel-body">
            <?php if (validation_errors() != false) { ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <strong>Error!</strong><br/>
                    <?php echo validation_errors(); ?>
                </div>
            <?php } ?>
            <form method="post">
                <div class="row">
                    <div class="col-lg-10 col-lg-offset-1">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">ID</label>
                                    <input type="text" class="form-control" name="name" value="<?php echo $plan->name; ?>" required/>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" class="form-control" name="nice_name" value="<?php echo $plan->nice_name; ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea class="form-control"
                                      name="description"><?php echo $plan->description; ?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Interval</label>
                                    <input type="text" class="form-control" value="Monthly" disabled/>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Currency</label>
                                    <input type="text" class="form-control" value="USD" disabled/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Amount</label>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <input type="checkbox" <?php echo $plan->is_fixed == 1 ? 'checked' : ''; ?>
                                                   data-toggle="toggle" data-on="Fixed" data-off="Variable"
                                                   data-onstyle="success" data-offstyle="danger" value="1" disabled>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="input-group"
                                                 id="amt-container" <?php echo $plan->is_fixed == 1 ? '' : 'style="display:none;"'; ?>>
                                                <span class="input-group-addon"><strong>$</strong></span>
                                                <input type="number" class="form-control" name="amount"
                                                       value="<?php echo number_format($plan->amount, 2); ?>" step=".01"
                                                       disabled required/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Order</label>
                                    <input type="number" class="form-control" name="order"
                                           value="<?php echo $plan->order; ?>"/>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row pull-right">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary" value="Save">
                            <span class="fas fa-paper-plane"></span>
                            Save
                        </button>
                        <a id="cancel" href="/admin/plans" class="btn btn-danger">
                            <span class="fas fa-times"></span>
                            Cancel
                        </a>
                    </div>
                </div>
                <input type="hidden" name="currency" value="USD"/>
                <input type="hidden" name="interval" value="month"/>
                <input type="hidden" name="name" value="<?php echo $plan->name; ?>"/>
            </form>
        </div>
    </div>
</div>
    