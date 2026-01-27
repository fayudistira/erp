<?php

// JANGAN panggil Services::routes() di sini

$routes->group('programs', ['namespace' => 'Modules\Programs\Controllers'], function ($routes) {
    $routes->get('show/(:segment)', 'ProgramsController::show/$1');
});

$routes->group('programs', ['namespace' => 'Modules\Programs\Controllers', 'filter' => 'group:admin'], function ($routes) {

    $routes->get('/', 'ProgramsController::index');
    $routes->get('create', 'ProgramsController::create');
    $routes->get('downloadTemplate', 'ProgramsController::downloadTemplate');

    $routes->post('store', 'ProgramsController::store');
    $routes->post('bulkUpload', 'ProgramsController::bulkUpload');

    $routes->get('show/(:segment)', 'ProgramsController::show/$1');
    $routes->get('edit/(:segment)', 'ProgramsController::edit/$1');
    $routes->post('update/(:segment)', 'ProgramsController::update/$1');

    $routes->post('delete/(:segment)', 'ProgramsController::delete/$1');
    $routes->post('restore/(:segment)', 'ProgramsController::restore/$1');
    $routes->post('purge/(:segment)', 'ProgramsController::purge/$1');
});
