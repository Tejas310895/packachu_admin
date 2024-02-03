<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductsModel extends Migration
{
    public function up()
    {
        $this->forge->addForeignKey('category_id', 'products_category', 'id', 'CASCADE', 'CASCADE', 'fk_category');
    }

    public function down()
    {
        $this->forge->dropForeignKey('products_category', 'fk_category');
    }
}
