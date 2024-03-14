<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class PurchaseModel extends Migration
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
            'supplier_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'inc_no' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'purchase_date' => [
                'type' => 'DATE',
            ],
            'purchase_inventory' => [
                'type' => 'JSON',
                'null' => true,
            ],
            'paid_amount' => [
                'type' => 'DECIMAl',
                'null' => true,
            ],
            'status' => [
                'type' => 'INT',
                'constraint'     => 11,
                'null' => true,
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'deleted_at' => [
                'type'    => 'TIMESTAMP',
                'default' => NULL,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('purchase');
        $this->forge->addForeignKey('supplier_id', 'customers', 'id', 'CASCADE', 'CASCADE', 'fk_supplier');
    }

    public function down()
    {
        $this->forge->dropTable('purchase');
        $this->forge->dropForeignKey('customers', 'fk_supplier');
    }
}
