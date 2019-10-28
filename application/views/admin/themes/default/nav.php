<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">
                <img alt="Brand" src="/assets/img/logo.png">
            </a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-menu"
                    aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="main-menu">
            <ul class="nav navbar-nav">
                <li><a href="/admin/dashboard">Home </a></li>
                <li><a href="/admin/pages/all">Pages</a></li>
                <li><a href="/admin/files/all">Files</a></li>
                <li><a href="/admin/settings/">Settings</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Hello <?php echo $this->session->user->username; ?>! <span
                                class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/users/change_password">Change Password</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="/auth/logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
