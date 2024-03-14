<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class SaleModel extends Migration
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
            'customer_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'inc_no' => [
                'type'       => 'VARCHAR',
                'constraint' => '250',
            ],
            'invoice_date' => [
                'type' => 'DATE',
            ],
            'shipped_date' => [
                'type' => 'DATE',
            ],
            'sale_inventory' => [
                'type' => 'JSON',
                'null' => true,
            ],
            'billing_add' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'billing_state_code' => [
                'type' => 'INT',
                'constraint'     => 11,
                'null' => true,
            ],
            'shipping_add' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'shipping_state_code' => [
                'type' => 'INT',
                'constraint'     => 11,
                'null' => true,
            ],
            'transport_name' => [
                'type' => 'VARCHAR',
                'constraint'     => 100,
                'null' => true,
            ],
            'transport_number' => [
                'type' => 'VARCHAR',
                'constraint'     => 100,
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
        $this->forge->createTable('sale');
        $this->forge->addForeignKey('customer_id', 'customers', 'id', 'CASCADE', 'CASCADE', 'fk_customer');
    }

    public function down()
    {
        $this->forge->dropTable('sale');
        $this->forge->dropForeignKey('customers', 'fk_customer');
    }
}
