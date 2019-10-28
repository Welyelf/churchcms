<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/admin/">Church CMS</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="/admin/users/change_password"><i class="fas fa-key fa-fw"></i> Change Password</a>
                </li>
                <li class="divider"></li>
                <li><a href="/auth/logout"><i class="fas fa-sign-out-alt fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                    </div>
                    <!-- /input-group -->
                </li>
                <li>
                    <a href="<?php echo base_url('admin/dashboard'); ?>"><i class="fas fa-tachometer-alt fa-fw"></i>
                        Dashboard</a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/pages'); ?>"><i class="fas fa-file-alt fa-fw"></i> Pages</a>
                </li>
                <!--<li>
                            <a href="<?php echo base_url('admin/posts'); ?>"><i class="fas fa-thumbtack fa-fw"></i> Posts</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('admin/post-categories'); ?>"><i class="fas fa-tags fa-fw"></i> Post Categories</a>
                        </li>-->
                <li>
                    <a href="<?php echo base_url('admin/sermons'); ?>"><i class="fas fa-church fa-fw"></i> Sermons</a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/files'); ?>"><i class="fas fa-folder fa-fw"></i> Files</a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/users'); ?>"><i class="fas fa-users fa-fw"></i> Users</a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/orders'); ?>"><i class="fas fa-box-open fa-fw"></i> Orders</a>
                </li>
                <?php if ($this->session->user->role == "Super Admin") { ?>
                    <li>
                        <a href="<?php echo base_url('admin/plans'); ?>"><i class="fas fa-cubes fa-fw"></i> Plans</a>
                    </li>
                <?php } ?>
                <li>
                    <a href="<?php echo base_url('admin/events'); ?>"><i class="fas fa-calendar-alt fa-fw"></i>
                        Events</a>
                </li>
                <!--<li>
                            <a href="<?php echo base_url('admin/volunteers'); ?>"><i class="fas fa-calendar-alt fa-fw"></i> Volunteers Schedule </a>
                        </li>-->
                <li>
                    <a href="<?php echo base_url('admin/volunteer-schedules'); ?>"><i class="fas fa-folder fa-fw"></i>
                        Volunteer Schedules</a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/subscribers'); ?>"><i class="fas fa-clipboard-list fa-fw"></i>
                        Mailing List</a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/emails'); ?>"><i class="fas fa-envelope fa-fw"></i> Email
                        Templates</a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/customizations/widgets'); ?>"><i
                                class="fas fa-wrench fa-fw"></i> Custom Widgets </a>
                </li>
                <li>
                    <a href="<?php echo base_url('admin/settings/'); ?>"><i class="fas fa-cogs fa-fw"></i> Settings</a>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
