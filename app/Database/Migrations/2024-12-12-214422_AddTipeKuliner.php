<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTipeKuliner extends Migration
{
    public function up()
    {
        $this->forge->addColumn('kuliner', [
            'tipe_kuliner' => [
                'type' => 'ENUM',
                'constraint' => [
                    'cafe',
                    'street food',
                    'kantin',
                    'rumah makan',
                    'restoran'
                ],
                'null' => false,
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('kuliner', 'tipe_kuliner');
    }
}
