<?php

use CodeIgniter\Config\Services;

$routes = Services::routes();

$routes->group('', ['namespace' => 'Modules\Registrations\Controllers'], function ($routes) {
    $routes->get('daftar/(:any)', 'RegistrationsController::daftar/$1');
});
