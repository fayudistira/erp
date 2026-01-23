<?php

namespace Modules\Registrations\Services;

use CodeIgniter\Config\Services;
use Modules\Registrations\Models\RegistrationsModel;
use Modules\Programs\Models\ProgramsModel;
use Modules\Students\Models\ProfileModel;
use Modules\Payments\Models\InvoicesModel;

class RegistrationsService
{
    protected $db;
    protected $regModel;
    protected $programModel;
    protected $profileModel;
    protected $invoiceModel;

    public function __construct()
    {
        $this->db           = \Config\Database::connect();
        $this->regModel     = new RegistrationsModel();
        $this->programModel = new ProgramsModel();
        $this->profileModel = new ProfileModel();
        $this->invoiceModel = new InvoicesModel();
    }

    /**
     * Logika utama pendaftaran: User -> Profile -> Registration -> Invoice
     */
    public function executeRegistration(array $formData)
    {
        $this->db->transStart();

        try {
            // 1. Ambil data program (untuk biaya & info batch)
            $program = $this->programModel->find($formData['program_id']);
            if (!$program) throw new \Exception('Program tidak ditemukan.');

            // 2. Handle User (Shield Integration)
            $userId = $this->getOrCreateUser($formData['email']);

            // 3. Handle Profile (Upsert)
            $this->upsertProfile($userId, $formData);

            // 4. Create Registration
            $registrationId = $this->createRegistration($userId, $program, $formData);

            // 5. Create Invoice
            $invoiceId = $this->createInvoice($registrationId, $program);

            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                throw new \Exception('Transaksi database gagal.');
            }

            return [
                'status'          => true,
                'registration_id' => $registrationId,
                'invoice_id'      => $invoiceId
            ];
        } catch (\Exception $e) {
            $this->db->transRollback();
            return [
                'status'  => false,
                'message' => $e->getMessage()
            ];
        }
    }

    private function getOrCreateUser(string $email)
    {
        $users = auth()->getProvider();
        $user  = $users->findByCredentials(['email' => $email]);

        if (!$user) {
            // Skenario 1: User Baru
            $userEntity = new \CodeIgniter\Shield\Entities\User([
                'username' => explode('@', $email)[0] . mt_rand(100, 999),
                'email'    => $email,
                'password' => bin2hex(random_bytes(5)), // Password random sementara
            ]);
            $users->save($userEntity);
            $newUserId = $users->getInsertID();

            // Aktivasi & Beri Role
            $user = $users->findById($newUserId);
            $user->activate();
            $user->addGroup('student');

            return $newUserId;
        }

        // Skenario 2: User Lama
        return $user->id;
    }

    private function upsertProfile(int $userId, array $data)
    {
        $profileData = [
            'user_id'             => $userId,
            'nama_lengkap'        => $data['nama_lengkap'],
            'nama_panggilan'      => $data['nama_panggilan'] ?? null,
            'jenis_kelamin'       => $data['jenis_kelamin'],
            'agama'               => $data['agama'] ?? null,
            'pendidikan_terakhir' => $data['pendidikan_terakhir'] ?? null,
            'nama_ayah'           => $data['nama_ayah'] ?? null,
            'nama_ibu'            => $data['nama_ibu'] ?? null,
            'kontak_darurat'      => $data['kontak_darurat'] ?? null,
            'telp_kontak'         => $data['telp_kontak'] ?? null,
            'hubungan'            => $data['hubungan'] ?? null,
            'catatan'             => $data['catatan'] ?? null,
            'ttl' => [
                'tempat'  => $data['tempat_lahir'] ?? null,
                'tanggal' => $data['tanggal_lahir'] ?? null
            ],
            'alamat' => [
                'jalan'    => $data['alamat_jalan'] ?? null,
                'kota'     => $data['kota'] ?? null,
                'provinsi' => $data['provinsi'] ?? null
            ],
            'telp' => [
                'utama' => $data['telp_utama']
            ]
        ];

        if ($this->profileModel->find($userId)) {
            return $this->profileModel->update($userId, $profileData);
        }
        return $this->profileModel->insert($profileData);
    }

    private function createRegistration(int $userId, array $program, array $formData)
    {
        $regData = [
            'user_id'    => $userId,
            'program_id' => $program['id'],
            'reg_num'    => 'REG/' . date('Ymd') . '/' . strtoupper(substr(uniqid(), -4)),
            'status'     => 'pending',
            'batch'      => $formData['batch'] ?? date('F Y'), // Default bulan ini jika kosong
            'start_date' => $formData['start_date'] ?? null,
        ];

        if (!$this->regModel->insert($regData)) {
            throw new \Exception('Gagal membuat data pendaftaran.');
        }

        return $this->regModel->getInsertID();
    }

    private function createInvoice($registrationId, array $program)
    {
        $items = [
            ['desc' => 'Biaya Kursus: ' . $program['title'], 'amount' => (float)$program['tuition']],
            ['desc' => 'Biaya Pendaftaran', 'amount' => (float)$program['registrationfee']]
        ];

        // Di sini Anda bisa menambahkan logic potongan harga jika ada

        $total = array_sum(array_column($items, 'amount'));

        $invData = [
            'registration_id' => $registrationId,
            'invoice_number'  => 'INV/' . date('Ymd') . '/' . strtoupper(substr(uniqid(), -4)),
            'invoice_items'   => $items,
            'total_amount'    => $total,
            'status'          => 'unpaid'
        ];

        if (!$this->invoiceModel->insert($invData)) {
            throw new \Exception('Gagal membuat invoice.');
        }

        return $this->invoiceModel->getInsertID();
    }
}
