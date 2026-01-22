<?php

namespace Modules\Programs\Controllers;

use App\Controllers\BaseController;
use Modules\Programs\Models\ProgramsModel;

class ProgramsController extends BaseController
{
    protected $programModel;

    public function __construct()
    {
        $this->programModel = new ProgramsModel();
    }

    public function index()
    {
        // Ambil status dari filter (default 'active')
        $status = $this->request->getGet('status') ?? 'active';

        $model = new \Modules\Programs\Models\ProgramsModel();

        if ($status === 'deleted') {
            // Hanya mengambil data yang sudah di-soft delete
            $programs = $model->onlyDeleted()->findAll();
        } else {
            // Data normal (aktif)
            $programs = $model->findAll();
        }

        return view('Modules\Programs\Views\index', [
            'title'    => $status === 'deleted' ? 'Program Terhapus (Trash)' : 'Daftar Program',
            'programs' => $programs,
            'status'   => $status // Kirim status ke view untuk toggle UI
        ]);
    }

    public function restore($id)
    {
        $model = new \Modules\Programs\Models\ProgramsModel();

        // CodeIgniter soft-delete restore cukup dengan update field deleted_at menjadi null
        $model->update($id, ['deleted_at' => null]);

        return redirect()->to(base_url('programs?status=deleted'))
            ->with('success', 'Program berhasil dikembalikan.');
    }

    public function purge($id)
    {
        $model = new \Modules\Programs\Models\ProgramsModel();

        // Hapus permanen dari database
        $model->delete($id, true);

        return redirect()->to(base_url('programs?status=deleted'))
            ->with('success', 'Program dihapus secara permanen.');
    }

    public function create()
    {
        return view('Modules\Programs\Views\create', ['title' => 'Tambah Program']);
    }

    public function store()
    {
        $rules = [
            'title'      => 'required|min_length[3]',
            'tuition'    => 'required|numeric',
            'thumbnails' => 'uploaded[thumbnails]|max_size[thumbnails,2048]|is_image[thumbnails]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('thumbnails');
        $fileName = $file->getRandomName();
        $file->move('uploads/programs', $fileName);

        $data = $this->transformInput($this->request->getPost());
        $data['thumbnails'] = $fileName;

        $this->programModel->insert($data);

        return redirect()->to(base_url('programs'))->with('success', 'Program berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $program = $this->programModel->find($id);
        if (!$program) return redirect()->to('/programs')->with('error', 'Data tidak ditemukan.');

        return view('Modules\Programs\Views\edit', [
            'title'   => 'Edit Program',
            'program' => $program
        ]);
    }

    public function update($id)
    {
        $program = $this->programModel->find($id);
        if (!$program) return redirect()->to('/programs')->with('error', 'Data tidak ditemukan.');

        // Perbaikan: Validasi update tanpa mewajibkan upload foto (permit_empty)
        $rules = [
            'title'   => 'required|min_length[3]',
            'tuition' => 'required|numeric',
            'thumbnails' => 'permit_empty|max_size[thumbnails,2048]|is_image[thumbnails]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = $this->transformInput($this->request->getPost());

        $file = $this->request->getFile('thumbnails');
        if ($file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move('uploads/programs', $fileName);
            $data['thumbnails'] = $fileName;

            if ($program['thumbnails'] && file_exists('uploads/programs/' . $program['thumbnails'])) {
                unlink('uploads/programs/' . $program['thumbnails']);
            }
        }

        $this->programModel->update($id, $data);

        return redirect()->to(base_url('programs'))->with('success', 'Program berhasil diperbarui.');
    }

    private function transformInput(array $postData): array
    {
        // Perbaikan: Gunakan array_values agar index JSON konsisten [0,1,2...]
        if (!empty($postData['features'])) {
            $postData['features'] = array_values(array_filter(explode("\n", str_replace("\r", "", $postData['features']))));
        }

        if (!empty($postData['facilities'])) {
            $postData['facilities'] = array_values(array_filter(explode("\n", str_replace("\r", "", $postData['facilities']))));
        }

        if (!empty($postData['curriculum'])) {
            foreach ($postData['curriculum'] as $key => $item) {
                if (isset($item['content'])) {
                    $postData['curriculum'][$key]['content'] = array_values(array_filter(explode("\n", str_replace("\r", "", $item['content']))));
                }
            }
            $postData['curriculum'] = array_values($postData['curriculum']);
        }

        return $postData;
    }

    public function delete($id)
    {
        $this->programModel->delete($id);
        return redirect()->to(base_url('programs'))->with('success', 'Program berhasil dihapus.');
    }

    public function show($id)
    {
        $program = $this->programModel->find($id);
        if (!$program) return redirect()->back()->with('error', 'Program tidak ditemukan.');

        return view('Modules\Programs\Views\show', [
            'title'   => 'Detail Program: ' . $program['title'],
            'program' => $program
        ]);
    }

    public function downloadTemplate()
    {
        // Urutan kolom disesuaikan dengan allowedFields (minus ID karena auto-generated)
        $header = [
            'title',
            'description',
            'language',
            'category',
            'classtype',
            'duration',
            'features',
            'facilities',
            'curriculum',
            'tuition',
            'registrationfee',
            'thumbnails'
        ];

        $example = [
            'Bahasa Jepang N5',
            'Kursus dasar bahasa Jepang.',
            'Jepang',
            'Reguler',
            'Offline',
            '6 Bulan',
            'Sertifikat|Modul',             // features
            'Ruang AC|WiFi',                // facilities
            'Bab 1: Hiragana; Katakana | Bab 2: Tata Bahasa', // curriculum
            '3000000',                      // tuition
            '200000',                       // registrationfee
            'default.jpg'                   // thumbnails
        ];

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="template_programs.csv"');

        $output = fopen('php://output', 'w');
        fputcsv($output, $header);
        fputcsv($output, $example);
        fclose($output);
        exit;
    }

    public function bulkUpload()
    {
        $file = $this->request->getFile('file_csv');

        if (!$file || !$file->isValid()) {
            return redirect()->back()->with('error', 'File tidak valid.');
        }

        if (($handle = fopen($file->getTempName(), "r")) !== FALSE) {
            $rowNumber = 0;
            $successCount = 0;

            while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) {
                $rowNumber++;
                if ($rowNumber == 1) continue; // Skip header

                // Parsing Features & Facilities
                $features   = array_values(array_filter(array_map('trim', explode('|', $data[6] ?? ''))));
                $facilities = array_values(array_filter(array_map('trim', explode('|', $data[7] ?? ''))));

                // Parsing Curriculum
                $curriculum = [];
                if (!empty($data[8])) {
                    $chapters = explode('|', $data[8]);
                    foreach ($chapters as $c) {
                        if (strpos($c, ':') !== false) {
                            [$chapName, $contents] = explode(':', $c);
                            $curriculum[] = [
                                'chapter' => trim($chapName),
                                'content' => array_values(array_filter(array_map('trim', explode(';', $contents))))
                            ];
                        }
                    }
                }

                // Susun data sesuai allowedFields
                $insertData = [
                    'title'           => $data[0],
                    'description'     => $data[1],
                    'language'        => $data[2],
                    'category'        => $data[3],
                    'classtype'       => $data[4],
                    'duration'        => $data[5],
                    'features'        => $features,
                    'facilities'      => $facilities,
                    'curriculum'      => $curriculum,
                    'tuition'         => (int)($data[9] ?? 0),
                    'registrationfee' => (int)($data[10] ?? 0),
                    'thumbnails'      => $data[11] ?? 'default.jpg',
                ];

                // PENTING: Gunakan insert() per baris agar callback generateUuid dan encodeJsonFields terpicu
                // insertBatch() terkadang melewati callback tertentu tergantung versi CI4
                if ($this->programModel->insert($insertData)) {
                    $successCount++;
                }
            }
            fclose($handle);

            return redirect()->to('/programs')->with('success', "$successCount data berhasil diimpor.");
        }

        return redirect()->back()->with('error', 'Gagal membuka file CSV.');
    }
}
