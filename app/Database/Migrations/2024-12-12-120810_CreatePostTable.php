<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePostTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'post_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'          => 'INT',
                'unsigned'      => true
            ],
            'media_id' => [
                'type'          => 'INT',
                'unsigned'      => true
            ],
            'kuliner_id' => [
                'type'          => 'INT',
                'unsigned'      => true
            ],
            'slug_post' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'konten' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'post_created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'post_created_by' => [
                'type' => 'INT',
                'null' => true
            ],
            'post_updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'post_updated_by' => [
                'type' => 'INT',
                'null' => true
            ],
            'post_deleted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'post_deleted_by' => [
                'type' => 'INT',
                'null' => true
            ]
        ]);
        $this->forge->addKey('post_id', true);
        // $this->forge->addForeignKey('user_id', 'user', 'user_id', 'CASCADE', 'CASCADE', 'user_id');
        // $this->forge->addForeignKey('kuliner_id', 'kuliner', 'kuliner_id', 'CASCADE', 'CASCADE', 'kuliner_id');
        // $this->forge->addForeignKey('media_id', 'media', 'media_id', 'CASCADE', 'CASCADE', 'media_id');
        $this->forge->createTable('post');
    }

    public function down()
    {
        $this->forge->dropTable('post');
    }
}
