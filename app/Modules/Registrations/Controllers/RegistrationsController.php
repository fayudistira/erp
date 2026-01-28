<?php

namespace Modules\Registrations\Controllers;

use App\Controllers\BaseController;
use Modules\Registrations\Models\RegistrationsModel;
use Modules\Programs\Models\ProgramsModel;
use Modules\Students\Models\ProfileModel;
use Modules\Payments\Models\InvoicesModel;

class RegistrationsController extends BaseController
{
    protected $registrationsModel;
    protected $programsModel;
    protected $profileModel;
    protected $invoicesModel;

    // Konfigurasi bank account dan whatsapp
    protected $bankAccounts = [
        [
            'bank' => 'BCA',
            'number' => '1234-567-890',
            'name' => 'LEMBAGA KURSUS MANDIRI'
        ]
    ];

    protected $whatsappAdmin = '6285810310950';

    public function __construct()
    {
        $this->registrationsModel = new RegistrationsModel();
        $this->programsModel      = new ProgramsModel();
        $this->profileModel       = new ProfileModel();
        $this->invoicesModel      = new InvoicesModel();
    }

    public function index($program_id)
    {
        $program = $this->programsModel->find($program_id);

        if (!$program) {
            return redirect()->back()->with('error', 'Program tidak ditemukan.');
        }

        // Decode JSON fields untuk tampilan
        $userProfile = null;
        if (auth()->loggedIn()) {
            $profile = $this->profileModel->find(auth()->id());
            if ($profile) {
                // Pastikan field JSON sudah di-decode
                $userProfile = $profile;
            }
        }

        $data = [
            'program'     => $program,
            'isLoggedIn'  => auth()->loggedIn(),
            'userProfile' => $userProfile
        ];

        return view('Modules\Registrations\Views\form_pendaftaran', $data);
    }

    public function submit($program_id)
    {
        $db = \Config\Database::connect();
        $db->transBegin();

        try {
            // Ambil program dari URL (single source of truth)
            $program = $this->programsModel->find($program_id);
            if (!$program) {
                throw new \Exception('Program tidak ditemukan.');
            }

            // Validasi input (tanpa program_id)
            $validation = \Config\Services::validation();
            $validation->setRules([
                'nama_lengkap'   => 'required|min_length[3]|max_length[100]',
                'jenis_kelamin'  => 'required|in_list[L,P]',
                'telp'           => 'required|numeric|min_length[10]|max_length[15]',
                'kontak_darurat' => 'required|min_length[3]',
                'telp_kontak'    => 'required|numeric|min_length[10]|max_length[15]',
            ]);

            if (!$validation->withRequest($this->request)->run()) {
                throw new \Exception(implode(', ', $validation->getErrors()));
            }

            $userId = auth()->id();

            // --- GENERATE SEQUENCE ---
            $microtime = microtime(true) * 10000;
            $langCode  = strtoupper(substr($program['language'] ?? 'GEN', 0, 3));
            $yearMonth = date('Ym');

            $regCount = $this->registrationsModel
                ->where('DATE(created_at)', date('Y-m-d'))
                ->countAllResults();

            $regNum = sprintf(
                '%s/%s/%03d-%s',
                $langCode,
                $yearMonth,
                $regCount + 1,
                substr($microtime, -4)
            );

            $invCount = $this->invoicesModel
                ->where('DATE(created_at)', date('Y-m-d'))
                ->countAllResults();

            $invoiceNum = sprintf(
                'INV/%s/%04d-%s',
                $yearMonth,
                $invCount + 1,
                substr($microtime, -4)
            );

            // --- PROFILE DATA ---
            $profileData = [
                'user_id'        => $userId,
                'nama_lengkap'   => $this->request->getPost('nama_lengkap'),
                'nama_panggilan' => $this->request->getPost('nama_panggilan'),
                'jenis_kelamin'  => $this->request->getPost('jenis_kelamin'),
                'ttl' => [
                    'tempat'  => $this->request->getPost('ttl[tempat]'),
                    'tanggal' => $this->request->getPost('ttl[tanggal]')
                ],
                'agama'               => $this->request->getPost('agama'),
                'pendidikan_terakhir' => $this->request->getPost('pendidikan_terakhir'),
                'alamat' => [
                    'jalan'     => $this->request->getPost('alamat[jalan]'),
                    'kelurahan' => $this->request->getPost('alamat[kelurahan]'),
                    'kecamatan' => $this->request->getPost('alamat[kecamatan]'),
                    'kota'      => $this->request->getPost('alamat[kota]'),
                    'provinsi'  => $this->request->getPost('alamat[provinsi]')
                ],
                'telp' => [
                    'primary'   => $this->request->getPost('telp'),
                    'emergency' => $this->request->getPost('telp_kontak')
                ],
                'kontak_darurat' => $this->request->getPost('kontak_darurat'),
                'hubungan'       => $this->request->getPost('hubungan'),
                'nama_ayah'      => $this->request->getPost('nama_ayah'),
                'nama_ibu'       => $this->request->getPost('nama_ibu'),
                'catatan'        => $this->request->getPost('catatan'),
            ];

            $existingProfile = $this->profileModel->find($userId);
            if ($existingProfile) {
                $this->profileModel->update($userId, $profileData);
            } else {
                $this->profileModel->insert($profileData);
            }

            // --- REGISTRATION ---
            $this->registrationsModel->insert([
                'user_id'    => $userId,
                'program_id' => $program_id,
                'reg_num'    => $regNum,
                'status'     => 'pending'
            ]);

            $registrationId = $this->registrationsModel->getInsertID();

            // --- INVOICE ---
            $tuition = (int) $program['tuition'];
            $regFee  = (int) $program['registrationfee'];

            $this->invoicesModel->insert([
                'registration_id' => $registrationId,
                'invoice_number'  => $invoiceNum,
                'total_amount'    => $tuition + $regFee,
                'status'          => 'unpaid',
                'invoice_items'   => [
                    ['desc' => 'Biaya Kursus', 'amount' => $tuition],
                    ['desc' => 'Biaya Pendaftaran', 'amount' => $regFee],
                ]
            ]);

            if ($db->transStatus() === false) {
                $db->transRollback();
                throw new \Exception('Gagal menyimpan data.');
            }

            $db->transCommit();
            return redirect()->to("daftar/success/{$registrationId}");
        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Registration error: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }



    public function success($registrationId)
    {
        $registration = $this->registrationsModel->find($registrationId);

        if (!$registration) {
            return redirect()->to('/')->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        $data = [
            'registration'  => $registration,
            'program'       => $this->programsModel->find($registration['program_id']),
            'invoice'       => $this->invoicesModel->where('registration_id', $registrationId)->first(),
            'bankAccounts'  => $this->bankAccounts,
            'whatsappAdmin' => $this->whatsappAdmin
        ];

        return view('Modules\Registrations\Views\success_page', $data);
    }

    public function invoicePdf($registrationId)
    {
        $registration = $this->registrationsModel->find($registrationId);
        if (!$registration) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $invoice = $this->invoicesModel
            ->where('registration_id', $registrationId)
            ->first();

        $program = $this->programsModel->find($registration['program_id']);

        // URL invoice yang sudah aman untuk router
        $invoiceUrl = base_url('invoice/view/' . urlencode($invoice['invoice_number']));

        // URL QR yang benar
        $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . urlencode($invoiceUrl);

        return view('Modules\Registrations\Views\invoice_pdf', [
            'registration' => $registration,
            'invoice'      => $invoice,
            'program'      => $program,
            'qrUrl'        => $qrUrl,
        ]);
    }



    public function publicInvoice($encoded)
    {
        $invoiceNumber = urldecode($encoded);

        $invoice = $this->invoicesModel
            ->where('invoice_number', $invoiceNumber)
            ->first();

        if (!$invoice) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('invoice_public', ['invoice' => $invoice]);
    }


    public function adminIndex()
    {
        $registrations = $this->registrationsModel
            ->select('registrations.*, programs.title as program_name, profiles.nama_lengkap as student_name')
            ->join('programs', 'programs.id = registrations.program_id', 'left')
            ->join('profiles', 'profiles.user_id = registrations.user_id', 'left')
            ->where('registrations.deleted_at', null)
            ->orderBy('registrations.created_at', 'DESC')
            ->findAll();

        $data = [
            'title'         => 'Student Registrations',
            'registrations' => $registrations
        ];

        return view('Modules\Registrations\Views\index', $data);
    }


    public function getAuthForm($type)
    {
        if ($type === 'login') {
            return view('Modules\Registrations\Views\partials\login_form');
        }
        return view('Modules\Registrations\Views\partials\register_form');
    }
}
