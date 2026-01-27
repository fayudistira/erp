<?php

namespace Modules\Programs\Controllers;

use App\Controllers\BaseController;
use Modules\Programs\Models\ProgramsModel;
use Config\Database;

class ProgramsController extends BaseController
{
    protected ProgramsModel $programModel;

    public function __construct()
    {
        $this->programModel = new ProgramsModel();
    }

    public function index()
    {
        $status = $this->request->getGet('status') ?? 'active';

        $programs = ($status === 'deleted')
            ? $this->programModel->onlyDeleted()->findAll()
            : $this->programModel->findAll();

        return view('Modules\Programs\Views\index', [
            'title'    => $status === 'deleted' ? 'Program Terhapus (Trash)' : 'Daftar Program',
            'programs' => $programs,
            'status'   => $status
        ]);
    }

    public function restore($id)
    {
        $this->programModel
            ->withDeleted()
            ->update($id, ['deleted_at' => null]);

        return redirect()->to('/programs?status=deleted')
            ->with('success', 'Program berhasil dikembalikan.');
    }

    public function purge($id)
    {
        $this->programModel->delete($id, true);

        return redirect()->to('/programs?status=deleted')
            ->with('success', 'Program dihapus permanen.');
    }

    public function delete($id)
    {
        $this->programModel->delete($id);
        return redirect()->to('/programs')->with('success', 'Program dipindahkan ke trash.');
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

        return redirect()->to('/programs')->with('success', 'Program berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $program = $this->programModel->find($id);
        if (!$program) {
            return redirect()->to('/programs')->with('error', 'Data tidak ditemukan.');
        }

        return view('Modules\Programs\Views\edit', [
            'title'   => 'Edit Program',
            'program' => $program
        ]);
    }

    public function update($id)
    {
        $program = $this->programModel->find($id);
        if (!$program) {
            return redirect()->to('/programs')->with('error', 'Data tidak ditemukan.');
        }

        $rules = [
            'title'      => 'required|min_length[3]',
            'tuition'    => 'required|numeric',
            'thumbnails' => 'permit_empty|max_size[thumbnails,2048]|is_image[thumbnails]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = $this->transformInput($this->request->getPost());

        $file = $this->request->getFile('thumbnails');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move('uploads/programs', $fileName);
            $data['thumbnails'] = $fileName;

            if (!empty($program['thumbnails'])) {
                @unlink('uploads/programs/' . $program['thumbnails']);
            }
        }

        $this->programModel->update($id, $data);

        return redirect()->to('/programs')->with('success', 'Program berhasil diperbarui.');
    }

    public function show($id)
    {
        $program = $this->programModel
            ->withDeleted()
            ->find($id);

        if (!$program) {
            return redirect()->back()->with('error', 'Program tidak ditemukan.');
        }

        return view('Modules\Programs\Views\show', [
            'title'   => 'Detail Program: ' . $program['title'],
            'program' => $program
        ]);
    }


    public function downloadTemplate()
    {
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
            'Sertifikat|Modul',
            'Ruang AC|WiFi',
            'Bab 1: Hiragana; Katakana | Bab 2: Tata Bahasa',
            '3000000',
            '200000',
            'default.jpg'
        ];

        return $this->response
            ->setHeader('Content-Type', 'text/csv')
            ->setHeader('Content-Disposition', 'attachment; filename="template_programs.csv"')
            ->setBody($this->generateCsv([$header, $example]));
    }

    public function bulkUpload()
    {
        $file = $this->request->getFile('file_csv');
        if (!$file || !$file->isValid()) {
            return redirect()->back()->with('error', 'File CSV tidak valid.');
        }

        $db = Database::connect();
        $db->transStart();

        $success = 0;
        $handle = fopen($file->getTempName(), 'r');
        $row = 0;

        while (($csv = fgetcsv($handle, 2000, ',')) !== false) {
            $row++;
            if ($row === 1) continue;

            $insertData = [
                'title'           => $csv[0] ?? null,
                'description'     => $csv[1] ?? null,
                'language'        => $csv[2] ?? null,
                'category'        => $csv[3] ?? null,
                'classtype'       => $csv[4] ?? null,
                'duration'        => $csv[5] ?? null,
                'features'        => array_filter(explode('|', $csv[6] ?? '')),
                'facilities'      => array_filter(explode('|', $csv[7] ?? '')),
                'curriculum'      => [],
                'tuition'         => (int)($csv[9] ?? 0),
                'registrationfee' => (int)($csv[10] ?? 0),
                'thumbnails'      => $csv[11] ?? 'default.jpg',
            ];

            if ($this->programModel->insert($insertData)) {
                $success++;
            }
        }

        fclose($handle);
        $db->transComplete();

        return redirect()->to('/programs')
            ->with('success', "$success data berhasil diimpor.");
    }

    private function transformInput(array $post): array
    {
        foreach (['features', 'facilities'] as $field) {
            if (!empty($post[$field])) {
                $post[$field] = array_values(array_filter(
                    explode("\n", str_replace("\r", '', $post[$field]))
                ));
            }
        }

        if (!empty($post['curriculum'])) {
            foreach ($post['curriculum'] as &$c) {
                if (isset($c['content'])) {
                    $c['content'] = array_values(array_filter(
                        explode("\n", str_replace("\r", '', $c['content']))
                    ));
                }
            }
        }

        return $post;
    }

    private function generateCsv(array $rows): string
    {
        $fp = fopen('php://temp', 'r+');
        foreach ($rows as $row) {
            fputcsv($fp, $row);
        }
        rewind($fp);
        $csv = stream_get_contents($fp);
        fclose($fp);
        return $csv;
    }
}
