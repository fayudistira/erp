<?php

namespace Modules\Pages\Models;

use CodeIgniter\Model;

class FaqModel extends Model
{
    // Nama tabel di database
    protected $table      = 'faqs';

    // Nama primary key
    protected $primaryKey = 'id';

    // Mengizinkan penggunaan auto-increment
    protected $useAutoIncrement = true;

    // Tipe return data (bisa 'array' atau 'object')
    protected $returnType     = 'array';

    // Fitur Soft Deletes (data tidak benar-benar dihapus dari DB)
    protected $useSoftDeletes = true;

    // Kolom yang boleh diisi melalui insert/update (White List)
    protected $allowedFields = ['question', 'answer', 'category', 'status'];

    // Fitur Timestamps otomatis
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validasi sederhana (Opsional, tapi sangat disarankan)
    protected $validationRules = [
        'question' => 'required|min_length[10]|max_length[255]',
        'answer'   => 'required',
        'status'   => 'required|in_list[publish,draft]',
    ];

    protected $validationMessages = [
        'question' => [
            'required' => 'Pertanyaan harus diisi.',
            'min_length' => 'Pertanyaan terlalu pendek, minimal 10 karakter.'
        ],
    ];

    // Meleati validasi saat update (true jika ingin validasi setiap saat)
    protected $skipValidation = false;
}
