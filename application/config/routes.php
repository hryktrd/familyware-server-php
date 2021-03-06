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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['api/v1/family']['get'] = 'family/getFamilies';
$route['api/v1/family']['post'] = 'family/postFamily';
$route['api/v1/family/(:num)']['post'] = 'user/postUserToFamily/$1';
$route['api/v1/family/(:num)']['put'] = 'user/putUserToFamily/$1';
$route['api/v1/family/(:num)/(:num)']['delete'] = 'user/leaveUserFromFamily/$1/$2';
$route['api/v1/family']['options'] = 'user/options';
$route['api/v1/family/(:num)']['options'] = 'user/options';
$route['api/v1/family/(:num)/(:num)']['options'] = 'user/options';

$route['api/v1/family/(:any)/user']['get'] = 'user/getUserByFamilyId/$1';
$route['api/v1/family/(:any)/user']['options'] = 'user/options';

$route['api/v1/user/(:num)']['get'] = 'user/getUser/$1';
$route['api/v1/user/(:num)']['put'] = 'user/putUser/$1';
$route['api/v1/user']['get'] = 'user/getUserByUuid';
$route['api/v1/user']['post'] = 'user/postUser';
$route['api/v1/user_name/(:any)']['get'] = 'user/getUserByName/$1';
$route['api/v1/user']['options'] = 'user/options';
$route['api/v1/user/(:num)']['options'] = 'user/options';
$route['api/v1/user_name/(:any)']['options'] = 'user/options';

//$route['api/v1/contact/(:any)']['get'] = 'family/getFamilyUsers/$1';

$route['api/v1/task']['get'] = 'task/getTasksByUuid';
$route['api/v1/task/family/(:num)']['get'] = 'task/getTasksByFamilyId/$1';
$route['api/v1/task']['post'] = 'task/postTask';
$route['api/v1/task']['put'] = 'task/putTask';
$route['api/v1/task/(:num)']['delete'] = 'task/deleteTask/$1';
$route['api/v1/task/family/(:num)']['options'] = 'task/options';
$route['api/v1/task']['options'] = 'task/options';
$route['api/v1/task/(:any)']['options'] = 'task/options';
