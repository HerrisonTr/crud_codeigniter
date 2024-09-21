<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'AuthController::index');
$routes->post('/login', 'AuthController::authenticate');
$routes->get('/logout', 'AuthController::logout');

$routes->get('/dashboard', 'UserController::index', ['filter' => 'auth']);

$routes->group('users', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'UserController::index');
    $routes->get('create', 'UserController::create');
    $routes->post('store', 'UserController::store');
    $routes->get('edit/(:num)', 'UserController::edit/$1');
    $routes->put('update/(:num)', 'UserController::update/$1');
    $routes->delete('delete/(:num)', 'UserController::delete/$1');
});
