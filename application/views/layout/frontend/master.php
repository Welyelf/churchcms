<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <link rel="icon" href="<?php echo $settings->favicon; ?>" type="image/png">

    <?php if (isset($page)) { ?>

        <title><?php echo ($page->seo_meta_title) ? $page->seo_meta_title : $settings->site_name; ?></title>
        <meta name="description"
              content="<?php echo ($page->seo_meta_description) ? $page->seo_meta_description : ''; ?>">

    <?php } else if (isset($post)) { ?>

        <title><?php echo ($post->seo_meta_title) ? $post->seo_meta_title : $settings->site_name; ?></title>
        <meta name="description"
              content="<?php echo ($post->seo_meta_description) ? $post->seo_meta_description : ''; ?>">

    <?php } else if (isset($sermon)) { ?>

        <title><?php echo ($sermon->seo_meta_title) ? $sermon->seo_meta_title : $settings->site_name; ?></title>
        <meta name="description"
              content="<?php echo ($sermon->seo_meta_description) ? $sermon->seo_meta_description : ''; ?>">

    <?php } else if (isset($category)) { ?>

        <title><?php echo ($category->seo_meta_title) ? $category->seo_meta_title : $settings->site_name; ?></title>
        <meta name="description"
              content="<?php echo ($category->seo_meta_description) ? $category->seo_meta_description : ''; ?>">

    <?php } else { ?>


        <title><?php echo $settings->site_name; ?></title>

    <?php } ?>

    <?php
    $method = $this->router->fetch_directory() . '/' . $this->router->fetch_class() . '/' . $this->router->fetch_method();
    $controller = $this->router->fetch_directory() . '/' . $this->router->fetch_class();

    // Load HEAD

    $this->load->view('layout/frontend/includes/head.php');    // This will load the frontend wide head file which contains required javascripts.

    if (file_exists(FCPATH . 'application/views/' . $method . '/head.php')) {
        $this->load->view($method . '/head.php');
    } elseif (file_exists(FCPATH . 'application/views/' . $controller . '/includes/head.php')) {
        $this->load->view($controller . '/includes/head.php');
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
<div id="main">
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

    <div id="inner">
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
    </div>
    <?php
    // Load FOOT

    $this->load->view('layout/frontend/includes/foot.php'); // This will load the frontend wide foot file which contains required javascripts.

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