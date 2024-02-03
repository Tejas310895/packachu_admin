<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductsCategoryModel extends Migration
{
    public function up()
    {
        $fields = [
            'category_img' => ['type' => 'TEXT'],
        ];
        $this->forge->addColumn('products_category', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('products_category', 'product_img');
    }
}
