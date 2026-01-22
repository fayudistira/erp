<?php

use CodeIgniter\Config\Services;

$routes = Services::routes();

$routes->group('registrations', ['namespace' => 'Modules\Registrations\Controllers'], function($routes) {
    $routes->get('/', 'RegistrationsController::index');
});