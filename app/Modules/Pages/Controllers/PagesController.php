<?php

namespace Modules\Pages\Controllers;

use Modules\Programs\Models\ProgramsModel;
use Modules\Pages\Models\FaqModel; // Tambahkan ini
use App\Controllers\BaseController;

class PagesController extends BaseController
{
    protected $programModel;
    protected $faqModel; // Tambahkan properti untuk FaqModel

    public function __construct()
    {
        $this->programModel = new ProgramsModel();
        $this->faqModel = new FaqModel(); // Inisialisasi FaqModel
    }


    public function home()
    {
        // Ambil input filter jika ada
        $category = $this->request->getVar('category');
        $classType = $this->request->getVar('classtype');

        // Mulai query untuk Programs
        $programBuilder = $this->programModel;

        if ($category) {
            $programBuilder->where('category', $category);
        }

        if ($classType) {
            $programBuilder->where('classtype', $classType);
        }

        // Ambil data FAQ yang dipublish
        // Kita urutkan berdasarkan 'id' terbaru atau 'created_at' agar FAQ terbaru muncul di atas
        $faqs = $this->faqModel->where('status', 'publish')
            ->orderBy('id', 'ASC')
            ->findAll();

        $data = [
            'title'      => 'Selamat Datang di Portal Pendidikan',
            'programs'   => $programBuilder->findAll(),
            'faqs'       => $faqs, // Masukkan data FAQ ke array data
            'categories' => $this->programModel->select('category')->distinct()->findAll(),
            'filter'     => [
                'category'  => $category,
                'classtype' => $classType
            ]
        ];

        return view('Modules\Pages\Views\home', $data);
    }
}
