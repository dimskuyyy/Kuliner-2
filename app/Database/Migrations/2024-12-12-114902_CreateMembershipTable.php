<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMembershipTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'member_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'          => 'INT',
                'unsigned'      => true
            ],
            'member_code' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'expired_date' => [
                'type'       => 'TIMESTAMP',
                'null'       => true,
            ],
            'member_status' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'comment' => '1=tidak aktif,2=aktif'
            ],
            'member_created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'member_created_by' => [
                'type' => 'INT',
                'null' => true
            ],
            'member_updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'member_updated_by' => [
                'type' => 'INT',
                'null' => true
            ],
            'member_deleted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'member_deleted_by' => [
                'type' => 'INT',
                'null' => true
            ]
        ]);
        $this->forge->addKey('member_id', true);
        // $this->forge->addForeignKey('user_id', 'user', 'user_id', 'CASCADE', 'CASCADE', 'user_id');
        $this->forge->createTable('membership');
    }

    public function down()
    {
        $this->forge->dropTable('membership');
    }
}
