<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductsModel extends Migration
{
    public function up()
    {
        $fields = [
            'stock' => ['type' => 'DOUBLE',
                        'default' => 0],
            'measure_in' => ['type' => 'varchar',
                             'constraint'     => 100,],
        ];
        $this->forge->addColumn('products', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('products', ['stock','measure_in']);
    }
}
