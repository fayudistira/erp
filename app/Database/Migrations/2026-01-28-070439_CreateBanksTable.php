<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBanksTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'bank_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '50', // Contoh: BCA, BNI, Mandiri
            ],
            'account_number' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'account_holder' => [
                'type'       => 'VARCHAR',
                'constraint' => '100', // Nama pemilik rekening
            ],
            'bank_logo' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true, // Nama file di public/uploads/images/
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true, // Diperlukan untuk Soft Delete
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('banks');
    }

    public function down()
    {
        $this->forge->dropTable('banks');
    }
}
