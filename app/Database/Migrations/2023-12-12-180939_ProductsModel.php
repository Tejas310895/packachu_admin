<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class ProductsModel extends Migration
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
            'category_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'product_mrp' => [
                'type' => 'DECIMAl',
                'null' => true,
            ],
            'product_rate' => [
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
        $this->forge->createTable('products');
        $this->forge->addForeignKey('category_id', 'products_category', 'id', 'CASCADE', 'CASCADE', 'fk_category');
    }

    public function down()
    {
        $this->forge->dropTable('products');
        $this->forge->dropForeignKey('products_category', 'fk_category');
    }
}
