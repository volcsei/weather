<?php

use CodeIgniter\Router\RouteCollection;

if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setAutoRoute(true);

$routes->post('home/saveCity', 'Home::saveCity');