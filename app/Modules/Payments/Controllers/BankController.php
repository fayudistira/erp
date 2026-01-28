<?php

namespace Modules\Payments\Controllers;

use App\Controllers\BaseController;
use Modules\Payments\Models\BankModel;
use CodeIgniter\HTTP\ResponseInterface;

class BankController extends BaseController
{
    protected $bankModel;

    public function __construct()
    {
        $this->bankModel = new BankModel();
        // Memastikan helper URL dan Form tersedia
        helper(['url', 'form']);
    }

    /**
     * Menampilkan daftar semua bank (yang belum di-soft delete)
     */
    public function index()
    {
        $data = [
            'title' => 'Daftar Rekening Bank',
            'banks' => $this->bankModel->findAll(),
        ];

        return view('Modules\Payments\Views\bank\index', $data);
    }

    /**
     * Menyimpan data bank baru
     */
    public function store()
    {
        $rules = [
            'bank_name'      => 'required|min_length[2]',
            'account_number' => 'required|numeric',
            'account_holder' => 'required',
            'bank_logo'      => 'uploaded[bank_logo]|max_size[bank_logo,2048]|is_image[bank_logo]|mime_in[bank_logo,image/jpg,image/jpeg,image/png,image/svg+xml]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $logoFile = $this->request->getFile('bank_logo');
        // Cek apakah file valid sebelum dipindahkan
        if ($logoFile->isValid() && !$logoFile->hasMoved()) {
            $newName = $logoFile->getRandomName();
            $logoFile->move(FCPATH . 'uploads/images', $newName);
        }

        $this->bankModel->save([
            'bank_name'      => $this->request->getPost('bank_name'),
            'account_number' => $this->request->getPost('account_number'),
            'account_holder' => $this->request->getPost('account_holder'),
            'bank_logo'      => $newName ?? null,
            'is_active'      => $this->request->getPost('is_active') ?? 1,
        ]);

        return redirect()->to(base_url('banks'))->with('success', 'Data bank berhasil ditambahkan.');
    }

    /**
     * Memperbarui data bank
     */
    public function update($id = null)
    {
        $bank = $this->bankModel->find($id);
        if (!$bank) return redirect()->back()->with('error', 'Data tidak ditemukan.');

        // Validasi Update: bank_logo tidak wajib diisi (uploaded dihilangkan)
        $rules = [
            'bank_name'      => 'required|min_length[2]',
            'account_number' => 'required|numeric',
            'account_holder' => 'required',
            'bank_logo'      => 'max_size[bank_logo,2048]|is_image[bank_logo]|mime_in[bank_logo,image/jpg,image/jpeg,image/png,image/svg+xml]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $logoFile = $this->request->getFile('bank_logo');
        $fileName = $bank['bank_logo'];

        // Cek jika user mengunggah file baru
        if ($logoFile && $logoFile->isValid() && !$logoFile->hasMoved()) {
            // Hapus file lama jika ada dan file tersebut bukan file default
            if ($fileName && file_exists(FCPATH . 'uploads/images/' . $fileName)) {
                unlink(FCPATH . 'uploads/images/' . $fileName);
            }
            $fileName = $logoFile->getRandomName();
            $logoFile->move(FCPATH . 'uploads/images', $fileName);
        }

        $this->bankModel->update($id, [
            'bank_name'      => $this->request->getPost('bank_name'),
            'account_number' => $this->request->getPost('account_number'),
            'account_holder' => $this->request->getPost('account_holder'),
            'bank_logo'      => $fileName,
            'is_active'      => $this->request->getPost('is_active') ?? 1,
        ]);

        return redirect()->to(base_url('banks'))->with('success', 'Data bank berhasil diperbarui.');
    }

    /**
     * Melakukan Soft Delete
     */
    public function delete($id = null)
    {
        if ($this->bankModel->delete($id)) {
            return redirect()->back()->with('success', 'Data bank berhasil dihapus (Soft Delete).');
        }

        return redirect()->back()->with('error', 'Gagal menghapus data.');
    }

    /**
     * Menampilkan data yang sudah di-soft delete (Trash)
     */
    public function trash()
    {
        $data = [
            'title' => 'Bank Terhapus',
            'banks' => $this->bankModel->onlyDeleted()->findAll(),
        ];

        return view('Modules\Payments\Views\bank\trash', $data);
    }

    /**
     * Mengembalikan data dari Soft Delete
     */
    public function restore($id = null)
    {
        $this->bankModel->update($id, ['deleted_at' => null]);
        return redirect()->back()->with('success', 'Data bank berhasil dipulihkan.');
    }
}
