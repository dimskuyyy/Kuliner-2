<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMemberPaymentTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'payment_id' => [
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
            'payment_created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'payment_created_by' => [
                'type' => 'INT',
                'null' => true
            ],
            'payment_updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'payment_updated_by' => [
                'type' => 'INT',
                'null' => true
            ],
            'payment_deleted_at' => [
                'type' => 'TIMESTAMP',
                'null' => true
            ],
            'payment_deleted_by' => [
                'type' => 'INT',
                'null' => true
            ]
        ]);
        $this->forge->addKey('payment_id', true);
        // $this->forge->addForeignKey('member_id', 'membership', 'member_id', 'CASCADE', 'CASCADE', 'member_id');
        // $this->forge->addForeignKey('media_id', 'media', 'media_id', 'CASCADE', 'CASCADE', 'media_id');
        $this->forge->createTable('member_payment');
    }

    public function down()
    {
        $this->forge->dropTable('member_payment');
    }
}
