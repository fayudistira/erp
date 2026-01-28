<?php

use CodeIgniter\Config\Services;

$routes = Services::routes();

$routes->group('payments', ['namespace' => 'Modules\Payments\Controllers'], function ($routes) {
    $routes->get('/', 'PaymentsController::index');
});

$routes->group('banks', ['namespace' => 'Modules\Payments\Controllers'], function ($routes) {
    $routes->get('/', 'BankController::index');
    $routes->post('store', 'BankController::store');
    $routes->post('update/(:num)', 'BankController::update/$1');
    $routes->get('delete/(:num)', 'BankController::delete/$1');
    $routes->get('trash', 'BankController::trash');
    $routes->get('restore/(:num)', 'BankController::restore/$1');
});
