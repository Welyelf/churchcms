    <div class="row"><br>
        <div class="panel panel-default">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <span class="fas fa-calendar-alt fa-fw"></span> 
                    <li class="breadcrumb-item">
                    <a href="/admin/events"><b><i>Events</i></b></a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <?php
                            if(isset($event->title)){
                                echo "Edit Event";
                            }else{
                                echo "Add Event";
                            }
                        ?>

                    </li>
                </ol>
            </nav>
            <div class="panel-body">
                <form method="post">
                    <div class="row">
                        <div class="col-lg-10 col-lg-offset-1">
                            <div class="form-group">
                                <label class="control-label">Title</label>
                                <input type="text" class="form-control" name="title" value="<?php if(isset($event->title)){echo $event->title;} ?>" required />
                                <?php echo form_error('title'); ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Location</label>
                                <input type="text" class="form-control" name="location" value="<?php if(isset($event->location)){echo $event->location;} ?>"/>
                                <?php echo form_error('location'); ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Details</label>
                                <textarea class="form-control" name="details"><?php if(isset($event->details)){echo $event->details;} ?></textarea>
                                <?php echo form_error('details'); ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Repeat</label>
                                <select class="form-control" name="recurrence" id="recurrence">
                                    <?php
                                    for ($event_rec=0;$event_rec<6;$event_rec++){
                                        ?>
                                            <option value="<?php echo get_event_recurrence($event_rec); ?>" <?php if(isset($event->recurrence) && $event->recurrence==get_event_recurrence($event_rec)) {echo 'selected="selected"';} ?>> <?php echo ucfirst(get_event_recurrence($event_rec)); ?> </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Time</label>
                                <input type="time" class="form-control" name="time" value="<?php if(isset($event->time)){echo $event->time;} ?>" required />
                                <?php echo form_error('time'); ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label"><span class="recurring-only">Start </span>Date</label>
                                <input id="datepicker" class="form-control" name="date" value="<?php if(isset($event->datetime)){echo date('Y-m-d',$event->datetime);} ?>" required />
                                <?php echo form_error('date'); ?>
                            </div>
                            <div class="form-group recurring-only">
                                <label class="control-label">End Date</label>
                                <input id="datepicker2" class="form-control" name="end_date" value="<?php if(isset($event->end_date)){echo date('Y-m-d',$event->end_date);} ?>"  />
                                <?php echo form_error('end_date'); ?>
                            </div>
                            <div class="row weekly-set">
                                <div class="col-lg-12">
                                    <label class="control-label">Day of the week</label>
                                </div>
                                <div class="col-lg-5 col-lg-offset-1">
                                    <?php
                                    if(isset($event->day_weekly)){
                                        $weekdays = str_split($event->day_weekly);
                                    }else{
                                        $weekdays=array();
                                    }
                                    ?>

                                    <?php
                                    for ($wd=0;$wd<7;$wd++){
                                        ?>
                                        <div class="checkbox">
                                            <label><input name="day_weekly[]" <?php echo in_array($wd,$weekdays)? 'checked="checked"':''; ?> type="checkbox" value="<?php echo $wd; ?>"><?php echo get_week_day($wd);  ?></label>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                 </div>

                            </div>
                            <div class="row monthly-set">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="control-label">Day of the Month</label>
                                        <select class="form-control" name="day_monthly">
                                            <?php for($x=1; $x<=31; $x++) {?>
                                            <option value="<?php echo $x?>" <?php if(isset($event->day_monthly) && $event->day_monthly==$x)echo 'selected="selected"';?>><?php echo $x; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row yearly-set">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">Month</label>
                                        <select class="form-control" name="month_yearly">
                                            <?php
                                            for($i=1;$i<=12;$i++){
                                                ?>
                                                    <option value="<?php echo $i; ?>" <?php if(isset($event->month_yearly) && $event->month_yearly==$i)echo 'selected="selected"'; ?>><?php echo get_month($i); ?></option>
                                                <?php
                                            }
                                            ?>
                                         </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">Day</label>
                                        <select class="form-control" name="day_yearly">
                                            <?php for($x=1; $x<=31; $x++) {?>
                                                <option value="<?php echo $x?>" <?php if(isset($event->day_yearly) && $event->day_yearly==$x )echo 'selected="selected"' ;?>><?php echo $x; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row others-set">
                                <div class="col-lg-12">
                                    <label class="control-label">Day</label>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <select class="form-control" name="order_others" id="order_others">
                                            <?php
                                            for ($oo=0;$oo<6;$oo++){
                                                ?>
                                                    <option value="<?php echo get_other_order($oo); ?>" <?php if(isset($event->order_others) && $event->order_others==get_other_order($oo))echo 'selected="selected"'; ?>>
                                                        <?php echo ucfirst(get_other_order($oo)); ?>
                                                    </option>

                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <select class="form-control" name="weekday_others" id="weekday_others">
                                            <?php
                                            for ($wo=0;$wo<7;$wo++){
                                                ?>
                                                    <option value="<?php echo strtolower(get_week_day($wo)); ?>" <?php if(isset($event->weekday_others) && $event->weekday_others== trtolower(get_week_day($wo))){echo 'selected="selected"';} ?>>
                                                        <?php echo get_week_day($wo); ?>
                                                    </option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="checkbox">
                                        <?php
                                        if(isset($event->month_others)){
                                            $event_month = explode('|', $event->month_others);
                                        }else{
                                            $event_month=array();
                                        }
                                        ?>
                                        <?php
                                            for($i=1;$i<=12;$i++){
                                                ?>
                                                    <div class="checkbox">
                                                         <label><input name="month_others[]" <?php echo in_array($i,$event_month)? 'checked="checked"':''; ?> type="checkbox" value="<?php echo $i; ?>">
                                                             <?php echo get_month($i); ?>
                                                         </label>
                                                    </div>
                                                <?php
                                            }
                                        ?>
                                 </div>
                        </div>
                    </div>
                    <div class="row pull-right">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary" value="Save"> 
                            <span class="fas fa-paper-plane"></span>
                                Save
                        </button>
                        <a id="cancel" href="/admin/events" class="btn btn-danger">
                            <span class="fas fa-times"></span>
                                Cancel
                        </a>
                    </div>
                </div>
                </form>
    
            </div>
        </div>
    </div>
    