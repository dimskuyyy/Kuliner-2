<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLikeTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'post_id' => [
                'type'          => 'INT',
                'unsigned'      => true
            ],
            'user_id' => [
                'type'          => 'INT',
                'unsigned'      => true
            ],
        ]);
        // $this->forge->addForeignKey('post_id', 'post', 'post_id', 'CASCADE', 'CASCADE', 'post_id');
        // $this->forge->addForeignKey('user_id', 'user', 'user_id', 'CASCADE', 'CASCADE', 'user_id');
        $this->forge->createTable('like');
    }

    public function down()
    {
        $this->forge->dropTable('like');
    }
}
