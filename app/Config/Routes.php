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
$routes->setDefaultController('Client\Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->group('admin', static function($routes) {
    $routes->get('/', 'Home::index');

    // custom guard
    
    // branch
    $routes->group('branch', static function ($routes) {
        $routes->get('list', 'Admin\Branch::index');
        $routes->get('create', 'Admin\Branch::store');
        $routes->get('edit/(:segment)', 'Admin\Branch::edit/$1');
        $routes->get('delete/(:segment)', 'Admin\Branch::destroy/$1');

        $routes->post('create', 'Admin\Branch::create');
        $routes->post('update', 'Admin\Branch::update');
    });
    // category
    $routes->group('category', static function ($routes) {
        $routes->get('list', 'Admin\Category::index');
        $routes->get('create', 'Admin\Category::store');
        $routes->get('edit/(:segment)', 'Admin\Category::edit/$1');
        $routes->get('delete/(:segment)', 'Admin\Category::destroy/$1');

        $routes->post('create', 'Admin\Category::create');
        $routes->post('update', 'Admin\Category::update');
    });
    // type
    $routes->group('type', static function ($routes) {
        $routes->get('list', 'Admin\Type::index');
        $routes->get('create', 'Admin\Type::store');
        $routes->get('edit/(:segment)', 'Admin\Type::edit/$1');
        $routes->get('delete/(:segment)', 'Admin\Type::destroy/$1');

        $routes->post('create', 'Admin\Type::create');
        $routes->post('update', 'Admin\Type::update');
    });
    //client
    $routes->group('client', static function($routes) {
        $routes->get('list', 'Admin\Client::index');
        $routes->get('create', 'Admin\Client::store');
        $routes->get('edit/(:segment)', 'Admin\Client::edit/$1');
        $routes->get('delete/(:segment)', 'Admin\Client::destroy/$1');

        $routes->post('create', 'Admin\Client::create');
        $routes->post('update', 'Admin\Client::update');
    });
    // contact
    $routes->group('contact', static function($routes) {
        $routes->get('list', 'Admin\Contact::index');
        $routes->get('create', 'Admin\Contact::store');
        $routes->get('edit/(:segment)', 'Admin\Contact::edit/$1');
        $routes->get('delete/(:segment)', 'Admin\Contact::destroy/$1');

        $routes->post('create', 'Admin\Contact::create');
        $routes->post('update', 'Admin\Contact::update');
    });    
});

/**
 * Front-client side
 */
$routes->get('/', 'Client\Home::index');
$routes->get('/news', 'Client\Home::news');
$routes->post('/contact', 'Client\Home::contact');

/**
 * Auth
 */
service('auth')->routes($routes);

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
