<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
$routes->group('dashboard',['namespace'=>'App\Controllers\Dashboard'],function($routes){
//Rutas CATEGORIES
$routes->resource('category');
$routes->post('category/create', 'category::create');
$routes->post('category/update/(:segment)', 'category::update/$1');
$routes->post('category/delete/(:segment)', 'category::delete/$1');
//Rutas TAGS
$routes->resource('tag');
$routes->post('tag/create', 'tag::create');
$routes->post('tag/update/(:segment)', 'tag::update/$1');
$routes->post('tag/delete/(:segment)', 'tag::delete/$1');

$routes->get('product/trace/(:num)', 'Product::trace/$1',['as' => 'product.trace']);
//Rutas PRODUCTS
$routes->resource('product');
$routes->post('product/create', 'product::create');
$routes->post('product/update/(:segment)', 'product::update/$1');
$routes->post('product/delete/(:segment)', 'product::delete/$1');
//DOMPDF

$routes->get('demo-pdf', 'product::demoPDF');

$routes->post('product/add-stock/(:num)/(:num)', 'product::addStock/$1/$2');
$routes->post('product/exit-stock/(:num)/(:num)', 'product::exitStock/$1/$2');

$routes->get('user/get-by-type/(:alpha)', 'User::getUsers/$1/');
});

if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
