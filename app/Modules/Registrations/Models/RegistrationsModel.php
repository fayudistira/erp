<?php

namespace Modules\Registrations\Models;

use CodeIgniter\Model;

class RegistrationsModel extends Model
{
    protected $table            = 'registrations';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false; // Menggunakan UUID
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;

    protected $allowedFields = [
        'id',
        'user_id',
        'program_id',
        'reg_num',
        'status',
        'batch',
        'start_date',
        'schedule',
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

    // List kolom yang harus dikonversi ke/dari JSON (sesuai migrasi)
    protected array $jsonFields = ['schedule'];

    /**
     * Generate UUID v4 secara otomatis
     */
    protected function generateUuid(array $data): array
    {
        if (!isset($data['data']['id'])) {
            $data['data']['id'] = sprintf(
                '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                mt_rand(0, 0xffff),
                mt_rand(0, 0xffff),
                mt_rand(0, 0xffff),
                mt_rand(0, 0x0fff) | 0x4000,
                mt_rand(0, 0x3fff) | 0x8000,
                mt_rand(0, 0xffff),
                mt_rand(0, 0xffff),
                mt_rand(0, 0xffff)
            );
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

        // Jika data tunggal (find/first)
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
    private function decodeRow(array $row): array
    {
        foreach ($this->jsonFields as $field) {
            if (isset($row[$field]) && is_string($row[$field])) {
                $row[$field] = json_decode($row[$field], true);
            }
        }
        return $row;
    }
}
