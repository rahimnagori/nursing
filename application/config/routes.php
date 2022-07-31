<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* Static Route */
$route['About'] = 'Home/about';
$route['Newses'] = 'Home/newses';
$route['News/(:any)'] = 'Home/news/$1';
$route['Work'] = 'Home/work';

$route['Jobs'] = 'Home/jobs';
$route['Search-Jobs'] = 'Jobs';
$route['Job-Details/(:any)'] = 'Jobs/job_details/$1';
$route['Apply'] = 'Jobs/apply';
$route['Apply-Guest'] = 'Jobs/apply_as_guest';
$route['Applied-Jobs'] = 'Jobs/applied';

$route['Contact'] = 'Home/contact';
$route['Contact/Request'] = 'Home/contact_request';
$route['Contact/Resume'] = 'Home/resume';
$route['Request-Professional'] = 'Home/request_professional';

$route['Terms'] = 'Home/terms';
$route['Privacy'] = 'Home/privacy';

/* Protected Routes */
$route['Login'] = 'Users/index';
$route['Log-In'] = 'Users/login';

$route['Sign-Up'] = 'Users/signup';
$route['Register'] = 'Users/register';

$route['Forget'] = 'Users/forget';
$route['Reset-Password'] = 'Users/reset';
$route['Reset/(:any)/(:any)'] = 'Users/reset_password/$1/$2';
$route['Update-Password'] = 'Users/update_new_password';

$route['Profile'] = 'Users/profile';
$route['Verify'] = 'Users/verify';
$route['Resend-Email-Verification'] = 'Users/resend';
$route['Verify/(:any)/(:any)'] = 'Users/email_verification/$1/$2';

$route['Update-User'] = 'Users/update';
$route['Account'] = 'Users/account';
$route['Contact-Admin'] = 'Chats';
$route['Message/send'] = 'Chats/add';
$route['Get-Messages'] = 'Chats/get_messages';
$route['Send-File'] = 'Chats/send_file';
$route['DELETE-CHAT-DOCUMENT'] = 'Chats/delete_document';
$route['DELETE-CHAT-MESSAGE'] = 'Chats/delete_message';

$route['User-Documents'] = 'User_Documents';
$route['Update-Document'] = 'User_Documents/update';
$route['Delete-Document'] = 'User_Documents/delete_document';

$route['User-Jobs'] = 'Home/user_jobs';
$route['User-Job-Details/(:any)'] = 'Jobs/user_job_details/$1';

$route['Add-Post'] = 'Users/post';
$route['My-Posts'] = 'Users/posts';
$route['Change-Password'] = 'Users/password';
$route['Logout'] = 'Users/logout';

/* Admin Routes */
$route['Admin'] = 'Admin';
$route['Update-Admin'] = 'Admin_Dashboard/update_profile';
$route['Update-Admin-Password'] = 'Admin_Dashboard/update_password';
$route['Admin-Login'] = 'Admin/login';
$route['Dashboard'] = 'Admin_Dashboard';
$route['Admin-Profile'] = 'Admin_Dashboard/profile';

$route['Users-Management'] = 'Admin_Users';

$route['Admins-Management'] = 'Admin_Users/admin';
$route['Create-Admin'] = 'Admin_Users/create_admin';
$route['Verify-Admin/(:any)/(:any)'] = 'Admin/verify_admin/$1/$2';
$route['Resend-Password'] = 'Admin_Users/resend_password';
$route['Admin-First-Time-Login'] = 'Admin/new_login';

$route['Get-Permissions'] = 'Admin_Users/get_admin_permissions';
$route['Update-Permissions'] = 'Admin_Users/update_admin_permissions';
$route['Delete-Admin'] = 'Admin_Users/delete_admin';
$route['Block-Unblock-Admin'] = 'Admin_Users/block_unblock_admin';

$route['Admin-Jobs'] = 'Admin_Jobs';
$route['Admin-Jobs/Get/(:any)'] = 'Admin_Jobs/get_job/$1';
$route['Admin-Jobs/Add'] = 'Admin_Jobs/add_job';
$route['Admin-Jobs/delete'] = 'Admin_Jobs/delete_job';
$route['Admin-Jobs/Update'] = 'Admin_Jobs/update_job';

$route['Job-Types'] = 'Admin_Jobs/types';
$route['Job-Type/Get/(:any)'] = 'Admin_Jobs/get_job_type/$1';
$route['Job-Type/Add'] = 'Admin_Jobs/add_type';
$route['Job-Type/delete'] = 'Admin_Jobs/delete_type';
$route['Job-Type/Update'] = 'Admin_Jobs/update_job_type';

$route['Admin-Contact'] = 'Admin_Contacts';

$route['Admin-News'] = 'Admin_News';
$route['Professional-Request'] = 'Admin_News/professionals';

$route['Admin-News/Get/(:any)'] = 'Admin_News/get_news/$1';
$route['Admin-News/Add'] = 'Admin_News/add_news';
$route['Admin-News/delete'] = 'Admin_News/delete_news';
$route['Admin-News/Update'] = 'Admin_News/update_news';
$route['Job-Applications'] = 'Admin_Applications';
$route['Admin-Chat'] = 'Admin_Chat';
$route['Admin-Message/send'] = 'Admin_Chat/add';
$route['Admin-Get-Messages'] = 'Admin_Chat/get_messages';
