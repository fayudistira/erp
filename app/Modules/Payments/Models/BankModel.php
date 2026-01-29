<?php

namespace Modules\Payments\Models;

use CodeIgniter\Model;

class BankModel extends Model
{
    protected $table      = 'banks';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    // Aktifkan fitur ini
    protected $returnType     = 'array';
    protected $useSoftDeletes = true; // <--- Mengaktifkan Soft Delete

    protected $allowedFields = ['bank_name', 'account_number', 'account_holder', 'bank_logo', 'is_active', 'deleted_at'];

    // Aktifkan timestamp otomatis
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
