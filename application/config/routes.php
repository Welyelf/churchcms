<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';

$route['blog/(:any)'] = 'posts/view/$1';
$route['blog/category/browse'] = 'posts/browse_category';
$route['blog/category/(:any)'] = 'posts/category_archive/$1';
//$route['blog'] = 'posts/blog';

$route['blog'] = 'posts/blog';
$route['events'] = 'events/index';
$route['contact'] = 'contact/index';
$route['contact/send'] = 'contact/send';
$route['contact/success'] = 'contact/success';
$route['sitemap'] = 'sitemap/index';
$route['sitemap\.xml'] = "sitemap/sitemap_xml";
$route['user/account'] = 'users/my_profile';
$route['user/donations'] = 'users/my_donations';
$route['register'] = 'users/register';
$route['login'] = 'users/login';
$route['donations'] = 'donations/index';
$route['volunteers'] = 'volunteers/index';
$route['volunteer-schedules'] = 'volunteers/volunteers_file';
$route['volunteer-schedule'] = 'volunteers/volunteers_file';
$route['unsubscribe'] = 'subscriptions/unsubscribe';
$route['install'] = 'home/install';

$route['blog/page/(:num)'] = 'posts/blog/$1';
$route['blog/page'] = 'posts/blog';

/* ADMIN ROUTES */
$route['admin'] = 'admin/dashboard';
$route['admin/pages'] = 'admin/pages/all';
$route['admin/posts'] = 'admin/posts/all';
$route['admin/post-categories'] = 'admin/posts/all-category';
$route['admin/sermons'] = 'admin/sermons/all';
$route['admin/files'] = 'admin/files/all';
$route['admin/users'] = 'admin/users/all';
$route['admin/orders'] = 'admin/orders/all';
$route['admin/plans'] = 'admin/plans/all';
$route['admin/events'] = 'admin/events/all';
$route['admin/subscribers'] = 'admin/subscribers/all';
$route['admin/emails'] = 'admin/emails/all';
$route['admin/customizations'] = 'admin/customizations';
$route['admin/customizations/customize'] = 'admin/customizations/customize';
$route['admin/volunteers'] = 'admin/volunteers/all';
$route['admin/volunteer-schedules'] = 'admin/volunteersfile/all';
$route['admin/volunteer-schedule'] = 'admin/volunteersfile/all';
$route['admin/settings'] = 'admin/settings';

$route['sermons'] = 'sermons/sermons';
$route['sermons/request-transcript'] = 'sermons/request_transcript';
$route['sermons/request-transcript-success'] = 'sermons/request_transcript_success';
$route['sermons/view/(:any)'] = 'sermons/view/$1';
$route['sermons/browse/(:any)'] = 'sermons/sermons/$1';
$route['sermons/browse'] = 'sermons/sermons/$1';
$route['sermons/all'] = 'sermons/sermons';
$route['sermons/(:any)'] = 'sermons/view/$1';

$route['watch-live'] = 'pages/watch_live';
$route['(:any)'] = 'pages/view/$1';

$route['404_override'] = 'pages/override_404';
$route['translate_uri_dashes'] = TRUE;
