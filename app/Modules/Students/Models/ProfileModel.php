<?php

namespace Modules\Students\Models;

use CodeIgniter\Model;

class ProfileModel extends Model
{
    protected $table            = 'profiles';
    protected $primaryKey       = 'user_id'; // Primary key mengacu ke user_id
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;

    protected $allowedFields = [
        'user_id',
        'nama_lengkap',
        'nama_panggilan',
        'jenis_kelamin',
        'ttl',
        'agama',
        'pendidikan_terakhir',
        'alamat',
        'telp',
        'foto',
        'dokumen',
        'kontak_darurat',
        'telp_kontak',
        'hubungan',
        'nama_ayah',
        'nama_ibu',
        'catatan'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Callbacks untuk JSON otomatis
    protected $beforeInsert = ['encodeJsonFields'];
    protected $beforeUpdate = ['encodeJsonFields'];
    protected $afterFind    = ['decodeJsonFields'];

    protected array $jsonFields = ['ttl', 'alamat', 'telp', 'dokumen'];

    protected function encodeJsonFields(array $data)
    {
        if (!isset($data['data'])) return $data;
        foreach ($this->jsonFields as $field) {
            if (isset($data['data'][$field]) && is_array($data['data'][$field])) {
                $data['data'][$field] = json_encode($data['data'][$field]);
            }
        }
        return $data;
    }

    protected function decodeJsonFields(array $data)
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

    private function decodeRow(array $row)
    {
        foreach ($this->jsonFields as $field) {
            if (isset($row[$field]) && is_string($row[$field])) {
                $row[$field] = json_decode($row[$field], true);
            }
        }
        return $row;
    }
}
