<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Pages');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Pages::index');
// $routes->get('/(:any)', 'Pages::showme/$1');
$routes->get('/signup', 'Pages::signup');
$routes->get('/login', 'Pages::login');
$routes->get('/logout', 'Pages::logout');
$routes->get('/admin', 'Admin::index');
$routes->get('/admin/management', 'Admin::management');
$routes->get('/admin/contact', 'Admin::contact');
$routes->get('/user', 'User::index');
$routes->get('/user/addpost', 'User::addpost');
$routes->get('/user/poststatus', 'User::poststatus');
$routes->get('/user/contact', 'User::contactview');
$routes->get('/index.php/user/upload/(:any)', 'public::upload');


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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
