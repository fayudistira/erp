<?php

use CodeIgniter\Config\Services;

$routes = Services::routes();

$routes->group('', ['namespace' => 'Modules\Registrations\Controllers'], function ($routes) {

    $routes->get('daftar/(:segment)', 'RegistrationsController::index/$1');

    $routes->post(
        'daftar/(:segment)/submit',
        'RegistrationsController::submit/$1',
        ['filter' => 'session']
    );

    $routes->get('daftar/success/(:segment)', 'RegistrationsController::success/$1');

    $routes->get('auth-form/(:segment)', 'RegistrationsController::getAuthForm/$1');

    $routes->get('daftar/invoice-pdf/(:segment)', 'RegistrationsController::invoicePdf/$1', [
        'filter' => 'session'
    ]);

    $routes->get('invoice/view/(:any)', 'RegistrationsController::publicInvoice/$1');
});
