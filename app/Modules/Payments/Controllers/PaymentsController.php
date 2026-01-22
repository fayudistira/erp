<?php

namespace Modules\Payments\Controllers;


use App\Controllers\BaseController;

class PaymentsController extends BaseController
{

    public function index()
    {
        return view('Modules\Payments\Views\index', [
            'title' => 'Payments',
            'menu'  => [
                'index'  => base_url('payments'),
                'create' => base_url('payments/create'),
            ]
        ]);
    }
}