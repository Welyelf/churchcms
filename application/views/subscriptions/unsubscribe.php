<div id="content">
    <div class="container">
        <div class="row">
            <div class="span12">
                <h2>
                    <center><span> Unsubscribe </span></center>
                </h2>
                <div class="row">
                    <?php if (!$is_unsubscribe) { ?>
                        <div class="row">
                            <div class="span3"></div>
                            <div class="span6">
                                <div class="tile">
                                    <div class="wrapper">
                                        <div class="header">Do you want to unsubscribe?</div>
                                        <div class="dates">

                                            <form method="post">

                                                <div class="input-group">
                                                    <label>Email to unsubscribe:</label>
                                                    <input type="email" name="email_unsubscribe" id="email" required/>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="pull-left">
                                                <?php if (isset($success)) { ?>
                                                    <div class="alert-success" id="success-alert">
                                                        <span class="closebtn"
                                                              onclick="this.parentElement.style.display='none';">&times;</span>
                                                        <small style="font-size:1em;"
                                                               id="success_message"><?php echo $success; ?></small>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <?php if (isset($error)) { ?>
                                                    <div class="alert-success" id="success-alert">
                                                        <span class="closebtn"
                                                              onclick="this.parentElement.style.display='none';">&times;</span>
                                                        <small style="font-size:1em;" id="success_message">Error
                                                            : <?php echo $error; ?></small>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <input style="cursor:pointer;" type="submit" value="Unsubscribe" class="btn btn-success">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="row">
                            <div class="span3"></div>
                            <div class="span6">
                                <div class="tile">
                                    <div class="wrapper">
                                        <?php if (!$is_expired) { ?>
                                            <?php if ($unsubscribe_success) { ?>
                                                <div class="header">You have Unsubscribed Successfully!</div>
                                            <?php } else { ?>
                                                <div class="header">You are already Unsubscribed!</div>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <div class="header">Link is already expired.</div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
   