<?php

namespace Modules\Pages\Controllers;


use Modules\Programs\Models\ProgramsModel;
use App\Controllers\BaseController;

class PagesController extends BaseController
{
    protected $programModel;

    public function __construct()
    {
        $this->programModel = new ProgramsModel();
    }

    public function home()
    {
        // Ambil input filter jika ada
        $category = $this->request->getVar('category');
        $classType = $this->request->getVar('classtype');

        // Mulai query
        $builder = $this->programModel;

        if ($category) {
            $builder->where('category', $category);
        }

        if ($classType) {
            $builder->where('classtype', $classType);
        }

        $data = [
            'title'      => 'Selamat Datang di Portal Pendidikan',
            'programs'   => $builder->findAll(),
            'categories' => $this->programModel->select('category')->distinct()->findAll(),
            'filter'     => [
                'category'  => $category,
                'classtype' => $classType
            ]
        ];

        return view('Modules\Pages\Views\home', $data);
    }
}
