<?php

use CodeIgniter\Config\Services;

$routes = Services::routes();


// app/Modules/Programs/Config/Routes.php

$routes->group('programs', ['namespace' => 'Modules\Programs\Controllers'], function ($routes) {

    // 1. Rute Statis (Taruh di atas)
    $routes->get('/', 'ProgramsController::index');
    $routes->get('create', 'ProgramsController::create');
    $routes->get('downloadTemplate', 'ProgramsController::downloadTemplate'); // <--- TAMBAHKAN INI
    $routes->post('bulkUpload', 'ProgramsController::bulkUpload'); // Pastikan ini juga ada
    $routes->post('store', 'ProgramsController::store');


    // 2. Rute dengan Parameter/Wildcard (Taruh di bawah)
    $routes->get('show/(:any)', 'ProgramsController::show/$1');
    $routes->get('edit/(:any)', 'ProgramsController::edit/$1');
    $routes->post('update/(:any)', 'ProgramsController::update/$1');
    $routes->get('delete/(:any)', 'ProgramsController::delete/$1');
    $routes->get('restore/(:any)', 'Programs::restore/$1');
    $routes->get('purge/(:any)', 'Programs::purge/$1');
});
