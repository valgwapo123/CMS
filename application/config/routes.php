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
|	https://codeigniter.com/userguide3/general/routing.html
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




$route['checker_req'] ='Function_API/requirement_checker';

$route['formchecker'] ='Function_API/formchecker';

$route['default_controller'] = 'SystemController/home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;


$route['login-api'] = 'Function_API/Login';
$route['logout'] = 'Login/logout';




$route['login'] = 'Login';



$route['qr-register'] = 'Login/scanview';
$route['recover'] = 'Recover';

$route['navigation'] = 'Function_API/navigation';
$route['cron_job'] = 'Function_API/cron_job';


$route['createSetupfolders'] = 'SystemController/createSetupfolders';

$route['quickregister'] = 'Function_API/quickregister';
$route['api/recover'] = 'Function_API/recover';

$route['switchlang/(:any)/(:any)/(:any)'] = 'Switchlanguage/switchlang/$1/$2/$3';


$route['quick-register'] = 'Login/quickregister';

//check requirement


//check updates
$route['checkupdate'] ='Function_API/checkupdate_route';


$route['(:any)'] = 'SystemController/front_view/$1/$2';
$route['(:any)/'] = 'SystemController/front_view/$1/$2';
$route['(:any)/(:any)'] = 'SystemController/front_view/$1/$2';


$route['(:any)/(:any)/(:any)'] = 'SystemController/front_view/$1/$2/$3';







