<?php

use CodeIgniter\Config\Services;

$routes = Services::routes();

$routes->group('faq', ['namespace' => 'Modules\Pages\Controllers', 'filter' => 'group:admin'], function ($routes) {
    $routes->get('/', 'FaqController::index');
    $routes->get('create', 'FaqController::create');
    $routes->post('store', 'FaqController::store');
    $routes->get('edit/(:num)', 'FaqController::edit/$1');
    $routes->post('update/(:num)', 'FaqController::update/$1');
    $routes->get('delete/(:num)', 'FaqController::delete/$1');
});
