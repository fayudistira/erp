<?php

use CodeIgniter\Config\Services;

$routes = Services::routes();

$routes->group('', ['namespace' => 'Modules\Dashboard\Controllers', 'filter' => 'session'], function ($routes) {
    $routes->get('/', 'DashboardController::index');
});
$routes->group('dashboard', ['namespace' => 'Modules\Dashboard\Controllers', 'filter' => 'session'], function ($routes) {
    $routes->get('/', 'DashboardController::index');
});
