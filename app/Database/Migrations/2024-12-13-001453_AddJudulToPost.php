<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddJudulToPost extends Migration
{
    public function up()
    {
        $this->forge->addColumn('post', [
            'judul' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('post', 'judul');
    }
}
