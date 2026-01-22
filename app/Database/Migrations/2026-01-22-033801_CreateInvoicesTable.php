<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInvoicesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'       => 'CHAR',
                'constraint' => 36,
            ],
            'registration_id' => [
                'type'       => 'CHAR',
                'constraint' => 36,
            ],
            'invoice_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
            ],
            'invoice_items' => [
                'type' => 'JSON',
                // Akan menyimpan: [{"desc": "Tuition", "amount": 1000}, {"desc": "Potongan Ultah", "amount": -100}]
                'null' => true,
            ],
            'total_amount' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0.00,
            ],
            'payment_method' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['unpaid', 'paid', 'canceled', 'expired'],
                'default'    => 'unpaid',
            ],
            'payment_details' => [
                'type' => 'JSON',
                'null' => true,
            ],
            'paid_at'    => ['type' => 'DATETIME', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('invoice_number');
        $this->forge->addForeignKey('registration_id', 'registrations', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('invoices');
    }

    public function down()
    {
        $this->forge->dropTable('invoices');
    }
}
