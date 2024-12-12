<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKomentarTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'komentar_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'post_id' => [
                'type'          => 'INT',
                'unsigned'      => true
            ],
            'user_id' => [
                'type'          => 'INT',
                'unsigned'      => true
            ],
            'komentar_konten' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'komentar_created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'komentar_created_by' => [
                'type' => 'INT',
                'null' => true
            ],
            'komentar_updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'komentar_updated_by' => [
                'type' => 'INT',
                'null' => true
            ],
            'komentar_deleted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'komentar_deleted_by' => [
                'type' => 'INT',
                'null' => true
            ]
        ]);
        $this->forge->addKey('komentar_id', true);
        // $this->forge->addForeignKey('post_id', 'post', 'post_id', 'CASCADE', 'CASCADE', 'post_id');
        // $this->forge->addForeignKey('user_id', 'user', 'user_id', 'CASCADE', 'CASCADE', 'user_id');
        $this->forge->createTable('komentar');
    }

    public function down()
    {
        $this->forge->dropTable('komentar');
    }
}
