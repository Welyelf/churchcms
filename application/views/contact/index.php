<div id="content">
    <div class="container">
        <div class="row">
            <br/><br/>
            <h2><span>Contact Us</span></h2>
            <div class="span8">
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>', '</div>'); ?>
                <form method="post">
                    <div class="row">
                        <div class="span4">
                            <div class="form-group">
                                <label>Your Name</label>
                                <input class="form-control" type="text" name="name" id="name" placeholder="Name"/>
                            </div>
                            <div class="input-group">
                                <label>Email Address</label>
                                <input class="form-control" type="email" name="email" id="email"
                                       placeholder="Email Address"/>
                            </div>
                            <div class="input-group">
                                <label>Phone Number</label>
                                <input class="form-control" type="text" name="phone" id="phone"
                                       placeholder="Phone Number"/>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="input-group">
                                <label>Message</label>
                                <textarea name="message" class="form-control"></textarea>
                            </div>
                            <div>
                                <button class="btn-primary " type="submit">Send</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="span4">
                <div class="caption">
                    <h3><i class="fa fa-church"></i> <?php echo $settings->site_name ?></h3>
                    <p>
                        <?php echo isset($settings->address) ? $settings->address : ''; ?><br/>
                        <?php echo isset($settings->admin_number) ? $settings->admin_number : ''; ?><br/>
                        <?php echo isset($settings->admin_email) ? $settings->admin_email : ''; ?><br/>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


