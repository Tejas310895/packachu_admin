<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductsModel extends Migration
{
    public function up()
    {
        $fields = [
            'gst_rate' => [
                'type' => 'INT',
                'default' => 0
            ],
        ];
        $this->forge->addColumn('products', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('products', ['gst_rate']);
    }
}
