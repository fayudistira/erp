<?php

namespace Modules\Registrations\Models;

use CodeIgniter\Model;

class RegistrationsModel extends Model
{
    protected $table            = 'registrations';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
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

    protected array $jsonFields = ['schedule'];

    /**
     * Generate UUID v4 untuk registration
     */
    protected function generateUuid(array $data): array
    {
        if (empty($data['data']['id'])) {
            $bytes = random_bytes(16);
            $bytes[6] = chr(ord($bytes[6]) & 0x0f | 0x40);
            $bytes[8] = chr(ord($bytes[8]) & 0x3f | 0x80);
            $data['data']['id'] = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($bytes), 4));
        }
        return $data;
    }

    // --- Helper JSON (Tidak Berubah) ---
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

    protected function decodeJsonFields(array $data): array
    {
        if (empty($data['data'])) return $data;
        if (isset($data['singleton']) && $data['singleton'] === true) {
            $data['data'] = $this->decodeRow($data['data']);
        } else {
            foreach ($data['data'] as $key => $row) {
                $data['data'][$key] = $this->decodeRow($row);
            }
        }
        return $data;
    }

    private function decodeRow(array $row): array
    {
        foreach ($this->jsonFields as $field) {
            if (isset($row[$field]) && is_string($row[$field])) {
                $decoded = json_decode($row[$field], true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $row[$field] = $decoded;
                }
            }
        }
        return $row;
    }
}
