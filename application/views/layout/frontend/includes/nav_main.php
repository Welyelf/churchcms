<div class="top1_wrapper" style="display: table-row;">
    <div class="top1 clearfix">
        <header>
            <div class="logo_wrapper">
                <a href="/" class="logo">
                    <img style="height:50px;" src="<?php echo $settings->church_logo; ?>"
                         alt="<?php echo $settings->site_name ?>">
                </a>
            </div>
        </header>
        <div class="menu_wrapper clearfix">
            <div class="navbar navbar_">
                <div class="navbar-inner navbar-inner_">
                    <a href="#" class="btn btn-navbar btn-navbar_" data-toggle="collapse" data-target=".nav-collapse_">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="nav-collapse nav-collapse_ collapse">
                        <ul class="nav sf-menu clearfix">
                            <?php echo $settings->menu; ?>

                            <!--
                                    -- Commented out for not yet ready to publicizing due to 
                                    -- functionality don't works well enough
                                    
                                    <li class="sub-menu">
                                    <a href="javascript:void(0)">Account <i class="fa fa-angle-double-down" aria-hidden="true"></i></a></a>
                                    <ul>
                                        <li><a href="index-1.html">Login</a></li>
                                            <li><a href="index-1.html">Register</a></li>
                                            </ul>
                                        <ul>
                                            <?php
                            if (isset($this->session->user->id)) {
                                ?>
                                                <li><a  href="/user/account">My Account</a></li>
                                                <li><a  href="/auth/logout">Logout</a></li>
                                             <?php
                            } else {
                                ?>
                                           <li><a  href="/register">Register</a> </li>
                                           <li> <a  href="/auth/login">Login</a></li>
                                           <?php
                            }
                            ?>
                                        </ul>
                                    </li>
                                    -->

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
