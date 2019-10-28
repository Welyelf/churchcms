<div class="row"><br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="fas fa-calendar-alt fa-fw"></span>
            <b><i>Volunteers Schedule</i> </b>
        </div>
        <div class="col-lg-10">
            <br/>
        </div>
        <div class="col-lg-2" style="margin-top:10px;">
            <a href="/admin/volunteers/add" class="btn btn-primary pull-right">
                <i class="fa fa-plus"></i> Add
            </a>
        </div>
        <br><br>
        <div class="panel-body">
            <table id="volunteer-list" class="table table-striped">
                <thead>
                <tr>
                    <th width="20%">Date</th>
                    <th width="30%">Volunteer Type</th>
                    <th width="30%">Persons</th>
                    <th width="20%">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($volunteer_schedules as $schedule) { ?>
                    <tr>
                        <td>
                            <?php echo date("F d, Y", $schedule->datetime); ?>
                        </td>
                        <td>
                            <?php echo ucfirst($schedule->volunteer_type); ?>
                        </td>
                        <td>
                            <?php echo $schedule->persons; ?>
                        </td>
                        <td>
                            <a href="/admin/volunteers/edit/<?php echo $schedule->id; ?>/"
                               class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a>
                            <a href="/admin/volunteers/delete/<?php echo $schedule->id; ?>/"
                               onclick="return confirm('Confirm Delete?')" class="btn btn-xs btn-danger"><i
                                        class="fa fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div> 
 

