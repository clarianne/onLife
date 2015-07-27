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
|	http://codeigniter.com/user_guide/general/routing.html
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
/*

*/
$route['default_controller'] = 'customer';
$route['customer/cart'] = 'customer/cart';
$route['customer/checkout'] = 'customer/checkout';
$route['customer/forgot_password'] = 'customer/forgot_password';
$route['customer/login'] = 'customer/login';
$route['customer/product'] = 'customer/product';
$route['customer/profile'] = 'customer/profile';
$route['customer/search'] = 'customer/search';
$route['customer/signup'] = 'customer/signup';
$route['customer/update_profile'] = 'customer/update_profile';

$route['admin'] = 'admin';
$route['admin/dist_add_execution'] = 'administrator/dist_add_execution';
$route['admin/prod_add_execution'] = 'administrator/prod_add_execution';
$route['admin/dashboard/server_time'] = 'administrator/server_time';
$route['admin/add_dist'] = 'administrator/add_dist';
$route['admin/add_prod'] = 'administrator/add_prod';
$route['admin/check_lfsiid'] = 'administrator/check_lfsiid';
$route['admin/check_product_code'] = 'administrator/check_product_code';
$route['admin/server_time'] = 'administrator/server_time';
$route['admin/distributors'] = 'administrator/distributors';
$route['admin/dashboard'] = 'administrator/dashboard';
$route['admin/forgot_pw'] = 'administrator/forgot_password';
$route['admin/login'] = 'administrator/login';
$route['admin/logout'] = 'administrator/logout';
$route['admin/orders'] = 'administrator/orders';
$route['admin/products'] = 'administrator/products';
$route['admin/unreleased'] = 'administrator/unr_orders';
$route['admin/released'] = 'administrator/r_orders';
$route['admin/update_dist'] = 'administrator/update_dist';
$route['admin/update_product'] = 'administrator/update_prod';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
