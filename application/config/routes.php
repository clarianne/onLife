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
$route['default_controller'] = 'distributor';
$route['show_product'] = 'distributor/show_product';
$route['dist/cart'] = 'distributor/dist_cart';
$route['dist/contact'] = 'distributor/contact';
$route['dist/index'] = 'distributor/index';
$route['dist/add_to_cart'] = 'distributor/add_to_cart';
$route['dist/dist_index'] = 'distributor/dist_index';
$route['dist/dist_check'] = 'distributor/dist_check';
$route['dist/update_cart'] = 'distributor/update_cart';
$route['dist/update_billing'] = 'distributor/update_billing';
$route['dist/update_billing_execution'] = 'distributor/update_billing_execution';
$route['dist/update_login'] = 'distributor/update_login';
$route['dist/update_login_execution'] = 'distributor/update_login_execution';
$route['dist/remove'] = 'distributor/remove';
$route['dist/checkout'] = 'distributor/checkout';
$route['dist/checkout_success'] = 'distributor/checkout_success';
$route['dist/forgot_password'] = 'distributor/forgot_password';
$route['dist/checkpassword'] = 'distributor/checkpassword';
$route['dist/checklfsi_id'] = 'distributor/checklfsi_id';
$route['dist/validate_email'] = 'distributor/validate_email';
$route['dist/checkemail'] = 'distributor/checkemail';
$route['dist/login'] = 'distributor/login';
$route['dist/show_product'] = 'distributor/show_product';
$route['dist/logout'] = 'distributor/logout';
$route['dist/shop'] = 'distributor/shop_dist';
$route['dist/print_order'] = 'distributor/print_order';
$route['dist/product'] = 'distributor/product';
$route['dist/profile'] = 'distributor/profile';
$route['dist/search'] = 'distributor/search';
$route['dist/signup'] = 'distributor/signup';
$route['dist/update_profile'] = 'distributor/update_profile';
$route['dist/unreleased'] = 'distributor/unr_orders';
$route['dist/released'] = 'distributor/r_orders';
$route['dist/view_orders_unreleased'] = 'distributor/view_orders_unreleased';
$route['dist/view_orders_released'] = 'distributor/view_orders_released';

$route['admin'] = 'administrator/login';
$route['admin/dist_add_execution'] = 'administrator/dist_add_execution';
$route['admin/dist_update_execution'] = 'administrator/dist_update_execution';
$route['admin/prod_update_execution'] = 'administrator/prod_update_execution';
$route['admin/order_update_execution'] = 'administrator/order_update_execution';
$route['admin/prod_add_execution'] = 'administrator/prod_add_execution';
$route['admin/dashboard/server_time'] = 'administrator/server_time';
$route['admin/add_dist'] = 'administrator/add_dist';
$route['admin/add_prod'] = 'administrator/add_prod';
$route['admin/check_lfsiid'] = 'administrator/check_lfsiid';
$route['admin/check_product_code'] = 'administrator/check_product_code';
$route['admin/server_time'] = 'administrator/server_time';
$route['admin/distributors'] = 'administrator/distributors';
$route['admin/dist_archive'] = 'administrator/dist_archive';
$route['admin/update_distributor'] = 'administrator/update_distributor';
$route['admin/update_product'] = 'administrator/update_product';
$route['admin/view_orders_unreleased'] = 'administrator/view_orders_unreleased';
$route['admin/view_orders_released'] = 'administrator/view_orders_released';
$route['admin/products/update_product'] = 'administrator/update_product';
$route['admin/unreleased/view_orders_unreleased'] = 'administrator/view_orders_unreleased';
$route['admin/unreleased/view_orders_released'] = 'administrator/view_orders_released';
$route['admin/dashboard'] = 'administrator/dashboard';
$route['admin/forgot_pw'] = 'administrator/forgot_password';
$route['admin/login'] = 'administrator/login';
$route['admin/check_admin'] = 'administrator/check_admin';
$route['admin/check_password'] = 'administrator/check_password';
$route['admin/delete_dist'] = 'administrator/delete_dist';
$route['admin/logout'] = 'administrator/logout';
$route['admin/orders'] = 'administrator/orders';
$route['admin/products'] = 'administrator/products';
$route['admin/prod_archive'] = 'administrator/prod_archive';
$route['admin/unreleased'] = 'administrator/unr_orders';
$route['admin/released'] = 'administrator/r_orders';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
