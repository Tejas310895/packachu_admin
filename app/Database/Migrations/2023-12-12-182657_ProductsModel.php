<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductsModel extends Migration
{
    public function up()
    {
        $fields = [
            'product_img' => ['type' => 'TEXT'],
        ];
        $this->forge->addColumn('products', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('products', 'product_img');
    }
}
