<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_nama' => 'SuperAdmin',
                'user_email' => 'superadmin@gmail.com',
                'user_password' => password_hash('superadmin123', PASSWORD_BCRYPT),
                'user_level' => 1,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')

            ],
            [
                'user_nama' => 'Rizki Paok',
                'user_email' => 'rizki7@gmail.com',
                'user_password' => password_hash('rizki123', PASSWORD_BCRYPT),
                'user_level' => 3,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ]
        ];
        // Using Query Builder
        $this->db->table('user')->insertBatch($data);
    }
}
