<?php

namespace Modules\Students\Controllers;


use App\Controllers\BaseController;

class StudentsController extends BaseController
{

    public function index()
    {
        return view('Modules\Students\Views\index', [
            'title' => 'Students',
            'menu'  => [
                'index'  => base_url('students'),
                'create' => base_url('students/create'),
            ]
        ]);
    }
}