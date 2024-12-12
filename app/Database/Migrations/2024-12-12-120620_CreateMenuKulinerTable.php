<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMenuKulinerTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'menu_id' => [
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
            'nama_menu' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'deskripsi_menu' => [
                'type'       => 'TEXT',
                'null'       => true,
            ],
            'harga_menu' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'menu_created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'menu_created_by' => [
                'type' => 'INT',
                'null' => true
            ],
            'menu_updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'menu_updated_by' => [
                'type' => 'INT',
                'null' => true
            ],
            'menu_deleted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'menu_deleted_by' => [
                'type' => 'INT',
                'null' => true
            ]
        ]);
        $this->forge->addKey('menu_id', true);
        // $this->forge->addForeignKey('kuliner_id', 'kuliner', 'kuliner_id', 'CASCADE', 'CASCADE', 'kuliner_id');
        // $this->forge->addForeignKey('media_id', 'media', 'media_id', 'CASCADE', 'CASCADE', 'media_id');
        $this->forge->createTable('menu');
    }

    public function down()
    {
        $this->forge->dropTable('menu');
    }
}
