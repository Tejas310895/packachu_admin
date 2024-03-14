<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group('', [['filter' => 'session']], function ($routes) {
    $routes->match(['get', 'post'], 'products', 'DashboardController::products', ['filter' => \App\Filters\AccessFilter::class]);
    $routes->match(['get', 'post'], 'customers', 'DashboardController::customers', ['filter' => \App\Filters\AccessFilter::class]);
    $routes->match(['get', 'post'], '/', 'DashboardController::users', ['filter' => \App\Filters\AccessFilter::class]);
    $routes->match(['get', 'post'], 'purchases', 'BillingController::purchaseIndex', ['filter' => \App\Filters\AccessFilter::class]);
    $routes->match(['get', 'post'], 'new_purchase', 'BillingController::purchasecreate', ['filter' => \App\Filters\AccessFilter::class]);
    $routes->match(['get', 'post'], 'sales', 'BillingController::saleIndex', ['filter' => \App\Filters\AccessFilter::class]);
    $routes->match(['get', 'post'], 'new_sales', 'BillingController::salecreate', ['filter' => \App\Filters\AccessFilter::class]);
    $routes->match(['get', 'post'], 'print_sale/1', 'TemplateController::sale_invoice_prnt/1', ['filter' => \App\Filters\AccessFilter::class]);
    $routes->get('upload', 'Upload::index');
});

service('auth')->routes($routes);
