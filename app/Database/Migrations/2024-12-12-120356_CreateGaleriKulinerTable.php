<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGaleriKulinerTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'galeri_id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kuliner_id' => [
                'type'          => 'INT',
                'unsigned'      => true
            ],
            'media_id' => [
                'type'          => 'INT',
                'unsigned'      => true
            ],
            'judul' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'galeri_created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'galeri_created_by' => [
                'type' => 'INT',
                'null' => true
            ],
            'galeri_updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'galeri_updated_by' => [
                'type' => 'INT',
                'null' => true
            ],
            'galeri_deleted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'galeri_deleted_by' => [
                'type' => 'INT',
                'null' => true
            ]
        ]);
        $this->forge->addKey('galeri_id', true);
        // $this->forge->addForeignKey('kuliner_id', 'kuliner', 'kuliner_id', 'CASCADE', 'CASCADE', 'kuliner_id');
        // $this->forge->addForeignKey('media_id', 'media', 'media_id', 'CASCADE', 'CASCADE', 'media_id');
        $this->forge->createTable('galeri_kuliner');
    }

    public function down()
    {
        $this->forge->dropTable('galeri_kuliner');
    }
}
