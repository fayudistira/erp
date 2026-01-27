<?php

namespace Modules\Programs\Models;

use CodeIgniter\Model;

class ProgramsModel extends Model
{
    protected $table            = 'programs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false; // Karena menggunakan UUID
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true; // Sesuai kolom deleted_at di migrasi
    protected $protectFields    = true;

    protected $allowedFields = [
        'id',
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
        'thumbnails',
        'deleted_at',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Callbacks
    protected $beforeInsert = ['generateUuid', 'encodeJsonFields'];
    protected $beforeUpdate = ['encodeJsonFields'];
    protected $afterFind    = ['decodeJsonFields'];

    // List kolom yang harus dikonversi ke/dari JSON
    protected array $jsonFields = ['features', 'facilities', 'curriculum'];

    /**
     * Membuat UUID v4 secara otomatis menggunakan random_bytes
     */
    protected function generateUuid(array $data): array
    {
        if (empty($data['data']['id'])) {
            $bytes = random_bytes(16);

            // Set versi ke 4 (0100) dan variant ke RFC 4122 (10xx)
            $bytes[6] = chr(ord($bytes[6]) & 0x0f | 0x40);
            $bytes[8] = chr(ord($bytes[8]) & 0x3f | 0x80);

            $data['data']['id'] = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($bytes), 4));
        }

        return $data;
    }

    /**
     * Mengubah array PHP menjadi string JSON sebelum disimpan ke database
     */
    protected function encodeJsonFields(array $data): array
    {
        if (!isset($data['data'])) return $data;

        foreach ($this->jsonFields as $field) {
            if (isset($data['data'][$field]) && (is_array($data['data'][$field]) || is_object($data['data'][$field]))) {
                $data['data'][$field] = json_encode($data['data'][$field]);
            }
        }

        return $data;
    }

    /**
     * Mengubah string JSON dari database kembali menjadi array PHP
     */
    protected function decodeJsonFields(array $data): array
    {
        if (empty($data['data'])) return $data;

        // Jika data tunggal (find)
        if (isset($data['singleton']) && $data['singleton'] === true) {
            $data['data'] = $this->decodeRow($data['data']);
        } else {
            // Jika data banyak (findAll)
            foreach ($data['data'] as $key => $row) {
                $data['data'][$key] = $this->decodeRow($row);
            }
        }

        return $data;
    }

    /**
     * Helper untuk decode per baris
     */
    protected function decodeRow(array $row): array
    {
        foreach ($this->jsonFields as $field) {
            if (isset($row[$field]) && is_string($row[$field])) {
                $decoded = json_decode($row[$field], true);
                $row[$field] = is_array($decoded) ? $decoded : [];
            }
        }
        return $row;
    }
}
