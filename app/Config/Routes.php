<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group('', [['filter' => 'session']], function ($routes) {
    $routes->match(['get', 'post'], '/', 'DashboardController::products', ['filter' => \App\Filters\AccessFilter::class]);
    $routes->match(['get', 'post'], 'customers', 'DashboardController::customers', ['filter' => \App\Filters\AccessFilter::class]);
    $routes->match(['get', 'post'], 'users', 'DashboardController::users', ['filter' => \App\Filters\AccessFilter::class]);
    $routes->get('upload', 'Upload::index');
});

service('auth')->routes($routes);
