<div class="container">
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="row" style="border-bottom: 1px solid #EEE">
                <div class="col-lg-10">
                    <h1>Site Statistics</h1>
                </div>
            </div>
            <br/>
            <div class="row" style="font-size:30px;">
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    Page Views: <?php echo $hits_totals->page_views; ?>
                </div>
                <div class="col-lg-4 text-center">
                    Site Visits: <?php echo $hits_totals->sessions; ?>
                </div>
            </div>
            <br/>
            <form method="post" class="form-inline">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        From <input type="text" class="form-control" id="from" name="from"
                                    value="<?php echo $date_range->from; ?>"/> To <input type="text"
                                                                                         class="form-control" id="to"
                                                                                         name="to"
                                                                                         value="<?php echo $date_range->to; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit"/>
                    </div>
                </div>
            </form>
            <br/>
            <table class="table table-bordered">
                <tr>
                    <th width="50%">URI</th>
                    <th>Page Views</th>
                    <th>Site Visits</th>
                    <th>Date</th>
                </tr>
                <?php foreach ($hits as $hit) { ?>
                    <tr <?php echo $hit->is_total == 1 ? 'style="font-weight:bold;"' : ''; ?>>
                        <td>
                            <?php echo $hit->uri == "" ? '/' : $hit->uri; ?>
                        </td>
                        <td><?php echo $hit->count; ?></td>
                        <td><?php echo $hit->sessions; ?></td>
                        <td> <?php echo date('F d, Y', $hit->date) ?></td>

                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
