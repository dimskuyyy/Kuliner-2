<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKulinerTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kuliner_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'member_id' => [
                'type'          => 'INT',
                'unsigned'      => true
            ],
            'media_id' => [
                'type'          => 'INT',
                'unsigned'      => true
            ],
            'nama_kuliner' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'slug_kuliner' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'deskripsi' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'alamat' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'latitude' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'longitude' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'kuliner_created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'kuliner_created_by' => [
                'type' => 'INT',
                'null' => true
            ],
            'kuliner_updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'kuliner_updated_by' => [
                'type' => 'INT',
                'null' => true
            ],
            'kuliner_deleted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'kuliner_deleted_by' => [
                'type' => 'INT',
                'null' => true
            ]
        ]);
        $this->forge->addKey('kuliner_id', true);
        // $this->forge->addForeignKey('member_id', 'membership', 'member_id', 'CASCADE', 'CASCADE', 'member_id');
        // $this->forge->addForeignKey('media_id', 'media', 'media_id', 'CASCADE', 'CASCADE', 'media_id');
        $this->forge->createTable('kuliner');
    }

    public function down()
    {
        $this->forge->dropTable('kuliner');
    }
}
