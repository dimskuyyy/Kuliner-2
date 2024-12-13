<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ModifyColumnMembership extends Migration
{
    public function up()
    {
        $fields = [
            'member_code' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'unique'     => 'true'
            ],
        ];
        $this->forge->modifyColumn('membership', $fields);
    }

    public function down()
    {
        $field = [
            'member_code' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
        ];
        $this->forge->modifyColumn('membership', $field);
    }
}
