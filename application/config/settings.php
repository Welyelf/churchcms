<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config['theme'] = "default";
$config['admin_theme'] = "default";


$config['timezone'] = "UTC";

/* AUTHENTICATION REDIRECTS */

$config['auth_login_success'] = "admin/dashboard";
$config['auth_login'] = "auth/login"; //Redirect to this page after logout was initiated
$config['auth_denied'] = "auth/access-denied"; //Redirect to this page after logout was initiated