<?php

namespace Modules\Pages\Controllers;

use App\Controllers\BaseController;
use Modules\Pages\Models\FaqModel;
use CodeIgniter\API\ResponseTrait;

class FaqController extends BaseController
{
    use ResponseTrait;

    protected $faqModel;

    public function __construct()
    {
        $this->faqModel = new FaqModel();
    }

    // Menampilkan daftar FAQ
    public function index()
    {
        helper('text'); // Tambahkan ini
        $data = [
            'title' => 'Manage FAQ',
            'faqs'  => $this->faqModel->findAll(),
        ];
        return view('Modules\Pages\Views\faqs\index', $data);
    }

    // Form Tambah
    public function create()
    {
        return view('Modules\Pages\Views\faqs\form');
    }

    // Proses Simpan
    public function store()
    {
        $data = $this->request->getPost();

        if (!$this->faqModel->save($data)) {
            return redirect()->back()->withInput()->with('errors', $this->faqModel->errors());
        }

        return redirect()->to('/faq')->with('success', 'FAQ berhasil ditambahkan.');
    }

    // Form Edit
    public function edit($id)
    {
        $faq = $this->faqModel->find($id);
        if (!$faq) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        return view('Modules\Pages\Views\faqs\form', ['faq' => $faq]);
    }

    // Proses Update
    public function update($id)
    {
        $data = $this->request->getPost();

        if (!$this->faqModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $this->faqModel->errors());
        }

        return redirect()->to('/faq')->with('success', 'FAQ berhasil diperbarui.');
    }

    // Proses Hapus (Soft Delete)
    public function delete($id)
    {
        $this->faqModel->delete($id);
        return redirect()->to('/faq')->with('success', 'FAQ berhasil dihapus.');
    }
}
