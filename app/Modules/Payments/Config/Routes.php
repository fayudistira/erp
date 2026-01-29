<?php

use CodeIgniter\Config\Services;

$routes = Services::routes();

$routes->group('payments', ['namespace' => 'Modules\Payments\Controllers'], function ($routes) {
    $routes->get('/', 'PaymentsController::index');
});

$routes->group('banks', ['namespace' => 'Modules\Payments\Controllers'], function ($routes) {
    $routes->get('/', 'BankController::index');
    $routes->get('fetch/(:segment)', 'BankController::fetch/$1'); // Route untuk AJAX Tabs
    $routes->post('store', 'BankController::store');
    $routes->post('update/(:num)', 'BankController::update/$1');
    $routes->get('delete/(:num)', 'BankController::delete/$1');
    $routes->get('restore/(:num)', 'BankController::restore/$1');
    $routes->get('purge/(:num)', 'BankController::purge/$1'); // Route untuk Hapus Permanen
});
