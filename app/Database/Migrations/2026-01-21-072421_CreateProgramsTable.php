<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProgramsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'       => 'CHAR',
                'constraint' => 36, // Sesuai untuk UUID yang digenerate di model
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'description' => [
                'type' => 'TEXT', // Menggunakan TEXT jika isinya adalah HTML/LongText
                'null' => true,
            ],
            'language' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'category' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'classtype' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'duration' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'features' => [
                'type' => 'JSON', // Menyimpan objek/list keunggulan
                'null' => true,
            ],
            'facilities' => [
                'type' => 'JSON', // Menyimpan objek/list fasilitas
                'null' => true,
            ],
            'curriculum' => [
                'type' => 'JSON', // Menyimpan objek/list kurikulum
                'null' => true,
            ],
            'tuition' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0.00,
            ],
            'registrationfee' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0.00,
            ],
            'thumbnails' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
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
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true); // Primary Key
        $this->forge->createTable('programs');
    }

    public function down()
    {
        $this->forge->dropTable('programs');
    }
}
