<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductsModel extends Migration
{
    public function up()
    {
        $fields = [
            'hsn_code' => [
                'type' => 'INT',
                'default' => 0
            ],
        ];
        $this->forge->addColumn('products', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('products', ['hsn_code']);
    }
}
