<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

/*
 * | -------------------------------------------------------------------------
 * | URI ROUTING
 * | -------------------------------------------------------------------------
 * | This file lets you re-map URI requests to specific controller functions.
 * |
 * | Typically there is a one-to-one relationship between a URL string
 * | and its corresponding controller class/method. The segments in a
 * | URL normally follow this pattern:
 * |
 * | example.com/class/method/id/
 * |
 * | In some instances, however, you may want to remap this relationship
 * | so that a different class/function is called than the one
 * | corresponding to the URL.
 * |
 * | Please see the user guide for complete details:
 * |
 * | https://codeigniter.com/user_guide/general/routing.html
 * |
 * | -------------------------------------------------------------------------
 * | RESERVED ROUTES
 * | -------------------------------------------------------------------------
 * |
 * | There are three reserved routes:
 * |
 * | $route['default_controller'] = 'welcome';
 * |
 * | This route indicates which controller class should be loaded if the
 * | URI contains no data. In the above example, the "welcome" class
 * | would be loaded.
 * |
 * | $route['404_override'] = 'errors/page_missing';
 * |
 * | This route will tell the Router which controller/method to use if those
 * | provided in the URL cannot be matched to a valid route.
 * |
 * | $route['translate_uri_dashes'] = FALSE;
 * |
 * | This is not exactly a route, but allows you to automatically route
 * | controller and method names that contain dashes. '-' isn't a valid
 * | class or method name character, so it requires translation.
 * | When you set this option to TRUE, it will replace ALL dashes in the
 * | controller and method URI segments.
 * |
 * | Examples: my-controller/index -> my_controller/index
 * | my-controller/my-method -> my_controller/my_method
 */
$route ['default_controller'] = 'start';
$route ['download'] = 'downloadmanager';
$route ['404_override'] = 'Error404';
$route ['translate_uri_dashes'] = FALSE;

// User
$route ['confirm/(:any)'] = 'User/confirmAccount';
$route ['user/(:num)'] = 'User/showSingleUser/$1';

// ProductType
$route ['product/repair/(:any)'] = 'Product/repairWatermark/$1';
$route ['product/(:any)'] = 'ProductType/product_types';
$route ['product/(:num)'] = 'ProductType/showSingleProductType/$1';

// Product
$route ['product/(:any)'] = 'Product/showSinglePicture/$1';
$route ['product/deleteProductByID/(:num)'] = 'Product/deleteProductByID/$1';
$route ['product/lockProductByID/(:num)'] = 'Product/lockProductByID/$1';
$route ['product/unlockProductByID/(:num)'] = 'Product/unlockProductByID/$1';


// Event
$route ['event/uebersicht'] = 'Event/showEvents/';
$route ['event/approval'] = 'Event/showEventApproval/';
$route ['event/(:any)'] = 'Event/showSingleEvent/$1';
$route ['event/delete/(:any)'] = 'Event/deleteEvent/$1';
$route ['event/edit/(:any)'] = 'Event/editEvent/$1';

// Static Pages
$route ['legalnotice'] = 'staticpages/legalnotice';
$route ['privacypolicy'] = 'staticpages/privacypolicy';
$route ['termsandconditions'] = 'staticpages/termsandconditions';