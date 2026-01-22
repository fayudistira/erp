<?php

use CodeIgniter\Config\Services;

$routes = Services::routes();

$routes->group('', ['namespace' => 'Modules\Pages\Controllers'], function ($routes) {
    $routes->get('/', 'PagesController::home');
});
