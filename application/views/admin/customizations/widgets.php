<div class="row"><br>
    <div class="panel panel-default">
        <div class="panel-heading">

            <span class="fas fa-wrench fa-fw"></span>
            <b><i>Custom Widgets</i> </b>
        </div>
        <div class="col-lg-10">
            <?php if (isset($success)) { ?>
                <div class="alert alert-success">Settings saved successfully!</div>
                <br/>
            <?php } ?>
        </div>
        <div class="col-lg-2" style="margin-top:10px;">
            <a href="/admin/customizations/add-widgets/" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>
                Add</a>
        </div>
        <br><br>
        <div class="panel-body">
            <div class="widget stacked widget-table action-table">
                <div class="">
                    <table class="table table-striped table-bordered">
                        <thead class="widget-header">
                        <tr>
                            <th>Name</th>

                            <!-- Commented out for the meantime not yet functional -->
                            <!--<th>Status</th> -->


                            <th class="td-actions">Actions</th>
                            <th class="td-actions"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($widgets as $widget) { ?>
                            <tr>
                                <td>
                                    <a href="/admin/customizations/add_widgets/<?php echo $widget->id; ?>/"><?php echo $widget->name; ?></a>
                                </td>
                                <!-- Commented out for the meantime not yet functional -->
                                <!--<td>
                                        <label class="switch">
                                                <input  type="checkbox" <?php echo $widget->is_enabled == 1 ? 'checked' : ''; ?> value="1">
                                                <span class="slider"></span>
                                            </label>
                                    </td>-->
                                <td class="td-actions">
                                    <div>
                                        <a href="/admin/customizations/add_widgets/<?php echo $widget->id; ?>/">
                                            <button class="btn btn-success btn-sm">
                                                <i class="fa fa-edit"></i>
                                                EDIT
                                            </button>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="tooltips">?
                                        <span class="tooltiptext"><?php echo $widget->description; ?></span>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



