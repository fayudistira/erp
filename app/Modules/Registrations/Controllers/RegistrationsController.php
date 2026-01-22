<?php

namespace Modules\Registrations\Controllers;

use Modules\Registrations\Models\RegistrationsModel;

use App\Controllers\BaseController;

class RegistrationsController extends BaseController
{
    protected $registrationsModel;

    public function __construct()
    {
        $this->registrationsModel = new RegistrationsModel();
    }

    public function index()
    {
        return view('Modules\Registrations\Views\index', [
            'title' => 'Registrations',
            'menu'  => [
                'index'  => base_url('registrations'),
                'create' => base_url('registrations/create'),
            ]
        ]);
    }
}