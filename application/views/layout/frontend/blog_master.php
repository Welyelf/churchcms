<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <link rel="icon" href="<?php echo $settings->church_logo ?>" type="image/png">
    <title><?php echo $settings->site_name; ?></title>

    <?php
    $method = $this->router->fetch_directory() . '/' . $this->router->fetch_class() . '/' . $this->router->fetch_method();
    $controller = $this->router->fetch_directory() . '/' . $this->router->fetch_class();

    // Load HEAD

    $this->load->view('layout/frontend/includes/blog_head.php');    // This will load the frontend wide head file which contains required javascripts.

    if (file_exists(FCPATH . 'application/views/' . $method . '/head.php')) {
        $this->load->view($method . '/head.php');
    } elseif (file_exists(FCPATH . 'application/views/' . $controller . '/includes/head.php')) {
        $this->load->view($controller . '/includes/head.php');
    } elseif (file_exists(FCPATH . 'application/views/' . $this->router->fetch_directory() . '/includes/head.php')) {
        $this->load->view($this->router->fetch_directory() . '/includes/head.php');
    }
    ?>

</head>
<body>
<div>
    <div class="blog-theatre">
        <?php
        // Load The Page HEADER
        if (file_exists(FCPATH . 'application/views/' . $method . '/page_header.php')) {
            $this->load->view($method . '/page_header.php');
        } elseif (file_exists(FCPATH . 'application/views/' . $controller . '/includes/page_header.php')) {
            $this->load->view($controller . '/includes/page_header.php');
        } elseif (file_exists(FCPATH . 'application/views/' . $this->router->fetch_directory() . '/includes/page_header.php')) {
            $this->load->view($this->router->fetch_directory() . '/includes/page_header.php');
        } else {
            $this->load->view('layout/frontend/includes/page_header.php');
        }
        ?>
    </div>

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
    } elseif (file_exists(FCPATH . 'application/views/' . $controller . '/includes/page_footer.php')) {
        $this->load->view($controller . '/includes/page_footer.php');
    } elseif (file_exists(FCPATH . 'application/views/' . $this->router->fetch_directory() . '/includes/page_footer.php')) {
        $this->load->view($this->router->fetch_directory() . '/includes/page_footer.php');
    } else {
        $this->load->view('layout/frontend/includes/page_footer.php');
    }

    ?>


    <?php
    // Load FOOT

    $this->load->view('layout/frontend/includes/blog_foot.php'); // This will load the frontend wide foot file which contains required javascripts.

    if (file_exists(FCPATH . 'application/views/' . $method . '/blog_foot.php')) {
        $this->load->view($method . '/blog_foot.php');
    } elseif (file_exists(FCPATH . 'application/views/' . $controller . '/blog_foot.php')) {
        $this->load->view($controller . '/blog_foot.php');
    } elseif (file_exists(FCPATH . 'application/views/' . $this->router->fetch_directory() . '/includes/blog_foot.php')) {
        $this->load->view($this->router->fetch_directory() . '/includes/blog_foot.php');
    }
    ?>
</div>
</body>
</html>