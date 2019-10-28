<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo $settings->favicon; ?> " type="image/png">

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo isset($page_title) ? $page_title . " | " . $settings->site_name : $settings->site_name; ?></title>

    <?php
    $method = $this->router->fetch_directory() . '/' . $this->router->fetch_class() . '/' . $this->router->fetch_method();
    $controller = $this->router->fetch_directory() . '/' . $this->router->fetch_class();

    // Load HEAD

    $this->load->view('layout/backend/includes/head.php');    // This will load the frontend wide head file which contains required javascripts.

    if (file_exists(FCPATH . 'application/views/' . $method . '/head.php')) {
        $this->load->view($method . '/head.php');
    } elseif (file_exists(FCPATH . 'application/views/' . $controller . '/head.php')) {
        $this->load->view($controller . '/head.php');
    } elseif (file_exists(FCPATH . 'application/views/' . $this->router->fetch_directory() . '/includes/head.php')) {
        $this->load->view($this->router->fetch_directory() . '/includes/head.php');
    }
    ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div id="wrapper">
    <?php
    // Load The Page HEADER
    if (file_exists(FCPATH . 'application/views/' . $method . '/page_header.php')) {
        $this->load->view($method . '/page_header.php');
    } elseif (file_exists(FCPATH . 'application/views/' . $controller . '/page_header.php')) {
        $this->load->view($controller . '/page_header.php');
    } elseif (file_exists(FCPATH . 'application/views/' . $this->router->fetch_directory() . '/page_header.php')) {
        $this->load->view($this->router->fetch_directory() . '/page_header.php');
    } else {
        $this->load->view('layout/backend/includes/page_header.php');
    }
    ?>
    <div <?php echo $_SERVER['REQUEST_URI'] != '/auth/login' ? 'id="page-wrapper"' : '' ?> >
        <div class="container-fluid">
            <?php
            // Load The Page CONTENT
            if (file_exists(FCPATH . 'application/views/' . $method . '.php')) {
                $this->load->view($method);
            } else {
                $this->load->view('layout/errors/404.php');
            }

            // Load The Page FOOTER
            if (file_exists(FCPATH . 'application/views/' . $method . '/page_footer.php')) {
                $this->load->view($method . '/page_footer.php');
            } elseif (file_exists(FCPATH . 'application/views/' . $controller . '/page_footer.php')) {
                $this->load->view($controller . '/page_footer.php');
            } elseif (file_exists(FCPATH . 'application/views/' . $this->router->fetch_directory() . '/page_footer.php')) {
                $this->load->view($this->router->fetch_directory() . '/page_footer.php');
            } else {
                $this->load->view('layout/backend/includes/page_footer.php');
            }
            ?>
        </div>
    </div>

    <?php
    // Load FOOT

    $this->load->view('layout/backend/includes/foot.php'); // This will load the frontend wide foot file which contains required javascripts.

    if (file_exists(FCPATH . 'application/views/' . $method . '/foot.php')) {
        $this->load->view($method . '/foot.php');
    } elseif (file_exists(FCPATH . 'application/views/' . $controller . '/foot.php')) {
        $this->load->view($controller . '/foot.php');
    } elseif (file_exists(FCPATH . 'application/views/' . $this->router->fetch_directory() . '/includes/foot.php')) {
        $this->load->view($this->router->fetch_directory() . '/includes/foot.php');
    }
    ?>

</div>
</body>
</html>