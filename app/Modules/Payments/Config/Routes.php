<?php

use CodeIgniter\Config\Services;

$routes = Services::routes();

$routes->group('payments', ['namespace' => 'Modules\Payments\Controllers'], function($routes) {
    $routes->get('/', 'PaymentsController::index');
});