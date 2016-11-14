<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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

| There area two reserved routes:

|

|	$route['default_controller'] = 'welcome';

|

| This route indicates which controller class should be loaded if the

| URI contains no data. In the above example, the "welcome" class

| would be loaded.

|

|	$route['404_override'] = 'errors/page_missing';

|

| This route will tell the Router what URI segments to use if those provided

| in the URL cannot be matched to a valid route.

|

*/
/*******************	Front End Links		*********************************/
$route['welcome'] 							= 'home/index';
$route['search'] 							= 'home/search';
$route['dashboard'] 						= 'home/dashboard';
$route['profile'] 							= 'home/profile';
$route['incidents'] 						= 'home/incidents';
$route['incident_reporting'] 				= 'home/incident_reporting';
$route['visitor_delivery_request'] 			= 'home/visitor_delivery_request';
$route['visitor_request'] 					= 'home/visitor_request';
$route['delivery_request'] 					= 'home/delivery_request';
$route['change_password'] 					= 'home/change_password';
$route['close_account'] 					= 'home/close_account';
$route['posts'] 							= 'home/posts';
$route['resident'] 							= 'home/add_resident';
$route['success'] 							= 'home/thank_you';
$route['incidents'] 						= 'home/incidents';
$route['add_delivery'] 						= 'home/add_delivery';
$route['add_visitor'] 						= 'home/add_visitor';
$route['payment'] 							= 'home/payment';
$route['login'] 							= 'home/login';
$route['signup'] 							= 'home/signup';
$route['add_service_request'] 				= 'home/add_service_request';
$route['service_quotes'] 					= 'home/service_quotes';
$route['service_requests'] 					= 'home/service_requests';
$route['management_posts'] 					= 'home/management_posts';
$route['archived_posts'] 					= 'home/archived_posts';
$route['month_archived_posts'] 				= 'home/month_archived_posts';
$route['useful_contacts'] 					= 'home/useful_contacts';
$route['download_forms'] 					= 'home/download_forms';
$route['notifications'] 					= 'home/notifications';
$route['users_management'] 					= 'home/users_management';
$route['all_invitations'] 					= 'home/all_invitations';
$route['invite_users'] 						= 'home/invite_users';
$route['quick_pay'] 						= 'home/quick_pay';
$route['make_payment'] 						= 'home/make_payment';
$route['make_payment_submit'] 				= 'home/make_payment_submit';
$route['view_invoice/(:any)'] 				= 'home/view_invoice/$1';
$route['print_invoice/(:any)'] 				= 'home/print_invoice/$1';
$route['molpay_response/(:any)']			= 'home/molpay_response/$1/$2';

$route['add_advertisement'] 				= 'home/add_advertisement';
$route['add_facility_booking'] 				= 'home/add_facility_booking';
$route['facility_payment'] 					= 'home/facility_payment';
$route['facility_invoice/(:any)'] 			= 'home/facility_invoice/$1';
$route['manual_payment'] 					= 'home/manual_payment';
$route['all_incidents'] 					= 'home/all_incidents';
$route['all_facility_payments'] 			= 'home/all_facility_payments';
$route['calender'] 							= 'home/calender';
$route['my_bookings'] 						= 'home/my_bookings';
$route['advertisements'] 					= 'home/advertisements';
$route['service_providers'] 				= 'home/service_providers';
$route['view_all_comments/(:any)'] 			= 'home/view_all_comments/$1';
$route['services_quotes_comments/(:any)'] 	= 'home/services_quotes_comments/$1';
$route['services_quotes_details/(:any)'] 	= 'home/services_quotes_details/$1';
$route['single_request_quotes/(:any)'] 		= 'home/single_request_quotes/$1';
$route['single_management_post/(:any)'] 	= 'home/single_management_post/$1';
$route['single_advertisement/(:any)'] 		= 'home/single_advertisement/$1';
$route['service_feedback/(:any)'] 			= 'home/service_feedback/$1';
$route['vendor_profile/(:any)'] 			= 'home/vendor_profile/$1';
$route['service_providers_list/(:any)'] 	= 'home/service_providers_list/$1';
$route['infonlycat_facilities/(:any)'] 		= 'home/infonlycat_facilities/$1';

//Menu Pages

$route['terms_of_use'] 				= 'home/terms_of_use';
$route['privacy_policy'] 			= 'home/privacy_policy';
$route['contact_us'] 				= 'home/contact_us';
$route['about_us']                  = 'home/about_us';

//$route['ECustomer/(:any)'] = 'home/existing_reg_cust/$1';

/*******************************************************************/


$route['default_controller'] = "home";

$route['404_override'] = '';





/* End of file routes.php */

/* Location: ./application/config/routes.php */