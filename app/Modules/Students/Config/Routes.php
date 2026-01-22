<?php

use CodeIgniter\Config\Services;

$routes = Services::routes();

$routes->group('students', ['namespace' => 'Modules\Students\Controllers'], function($routes) {
    $routes->get('/', 'StudentsController::index');
});