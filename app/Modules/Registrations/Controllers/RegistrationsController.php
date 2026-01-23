<?php

namespace Modules\Registrations\Controllers;

use App\Controllers\BaseController;
use Modules\Registrations\Models\RegistrationsModel;
use Modules\Programs\Models\ProgramsModel; // Tambahkan ini untuk cek data program

class RegistrationsController extends BaseController
{
    protected $registrationsModel;
    protected $programsModel;

    public function __construct()
    {
        $this->registrationsModel = new RegistrationsModel();
        $this->programsModel      = new ProgramsModel(); // Inisialisasi model program
    }

    /**
     * Halaman index untuk Admin (melihat list pendaftar)
     */
    public function index()
    {
        return view('Modules\Registrations\Views\index', [
            'title' => 'Daftar Registrasi Siswa',
            'menu'  => [
                'index'  => base_url('registrations'),
                'create' => base_url('registrations/create'),
            ],
            // Contoh mengambil data untuk admin
            'registrations' => $this->registrationsModel->findAll()
        ]);
    }

    /**
     * Method untuk menampilkan form pendaftaran (Public)
     * Diakses melalui route: /daftar/(:any)
     */
    public function daftar($uuid = null)
    {
        // 1. Cari data program berdasarkan UUID dari URL
        $program = $this->programsModel->find($uuid);
        // dd($program);
        // 2. Jika program tidak ditemukan, kembalikan ke home dengan pesan error
        if (!$program) {
            return redirect()->to('/')->with('error', 'Program tidak ditemukan atau sudah tidak aktif.');
        }

        // 3. Kirim data ke view form pendaftaran
        return view('Modules\Registrations\Views\form_pendaftaran', [
            'title'   => 'Pendaftaran ' . $program['title'],
            'program' => $program, // Berisi detail title, tuition, reg fee, dll
        ]);
    }
}
