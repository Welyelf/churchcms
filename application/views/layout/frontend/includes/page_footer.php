<!-- Footer 
<div style="clear:fix"></div>
<div id="footer" class="container-fluid text-center clearfix" >
    <div class="row">
        <div class="col-lg-3">
            <strong>Website By:</strong> <a href="http://kedrasoft.com">Kedra Software</a>
        </div>
        <div class="col-lg-3 col-lg-offset-6">
            &copy;
        </div>
    </div>
</div>-->

<div class="page-footer" style="background-color:#d1d4d6;margin-top:10px;">
    <div class="container">
        <div class="bot1 clearfix">
            <div class="row">
                <div id="footer" style="display: table-row;">
                    <div class="span4">
                        <div class="bot1-title">
                            Subscribe
                            <form action="form">
                                <div class="alert" id="error-alert" style="display:none">
                                    <span class="closebtn"
                                          onclick="this.parentElement.style.display='none';">&times;</span>
                                    <small style="font-size:0.5em;" id="error_message">Name and Emal are required !
                                    </small>
                                </div>
                                <div class="alert-success" id="success-alert" style="display:none">
                                    <span class="closebtn"
                                          onclick="this.parentElement.style.display='none';">&times;</span>
                                    <small style="font-size:0.5em;" id="success_message">Subscribe successfully sent !
                                    </small>
                                </div>

                                <div class="form-group">
                                    <input type="text" id="name" name="name" required placeholder="Name"
                                           class="form-control" value="<?php echo set_value("name"); ?>"/>
                                    <?php echo form_error('name'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="email" id="email" name="email" required placeholder="Email"
                                           class="form-control" value="<?php echo set_value("email"); ?>"/>
                                    <?php echo form_error('name'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="button" id="btn-subscribe" class="btn btn-success btn-sm"
                                           value="Subscribe"/>
                                </div>
                            </form>
                        </div>
                        <div class="bot1-title">Links</div>
                        <ul class="ul1">

                            <?php if ($this->session->userdata('user')) { ?>
                                <li><span><a href="/user/account">My Profile</a></span></li>
                            <?php } ?>

                            <li><span><a href="/sitemap" target="_blank">Sitemap</a></span></li>
                            <li><span><a href="/unsubscribe">Unsubscribe</a></span></li>
                        </ul>

                    </div>
                    <div class="span4">
                        <div class="bot1-title">LOCATION</div>
                        <figure class="google_map">
                            <iframe src="<?php echo $settings->google_map; ?>">
                            </iframe>
                        </figure>
                    </div>
                    <div class="span4">
                        <?php
                        if (!empty($settings->facebook_page) || !empty($settings->google_plus) || !empty($settings->pinterest) || !empty($settings->twitter) || !empty($settings->youtube_channel)) {
                            ?>
                            <div class="bot1-title">
                                Follow Us
                            </div>


                            <ul class="social clearfix">
                                <?php if (!empty($settings->facebook_page)) { ?>
                                    <li><a href="<?php echo $settings->facebook_page; ?>"><img
                                                    src="/assets/plugins/addins/images/social_ic1.png"></a></li>
                                <?php } ?>
                                <?php if (!empty($settings->google_plus)) { ?>
                                    <li><a href="<?php echo $settings->google_plus; ?>"><img
                                                    src="/assets/plugins/addins/images/social_ic2.png"></a></li>
                                <?php } ?>
                                <?php if (!empty($settings->linkedin)) { ?>
                                    <li><a href="<?php echo $settings->linkedin; ?>"><img
                                                    src="/assets/plugins/addins/images/social_ic3.png"></a></li>
                                <?php } ?>
                                <?php if (!empty($settings->pinterest)) { ?>
                                    <li><a href="<?php echo $settings->pinterest; ?>"><img
                                                    src="/assets/plugins/addins/images/social_ic4.png"></a></li>
                                <?php } ?>
                                <?php if (!empty($settings->twitter)) { ?>
                                    <li><a href="<?php echo $settings->twitter; ?>"><img
                                                    src="/assets/plugins/addins/images/social_ic5.png"></a></li>
                                <?php } ?>
                                <?php if (!empty($settings->youtube_channel)) { ?>
                                    <li><a href="<?php echo $settings->youtube_channel; ?>"><img
                                                    src="/assets/plugins/addins/images/social_ic6.png"></a></li>
                                <?php } ?>
                            </ul>
                            <?php
                        }
                        ?>
                        <footer style="margin-bottom:5px;">
                            <div class="copyright">
                                <b> Copyright © <?php echo date('Y'); ?>.<br> </b>
                                All rights reserved.
                            </div>
                            <?php echo $settings->site_name; ?>

                        </footer>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
         
