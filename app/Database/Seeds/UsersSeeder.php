<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role'     => 'admin',
            ],
            [
                'username' => 'warga01',
                'password' => password_hash('member123', PASSWORD_DEFAULT),
                'role'     => 'member',
            ],
        ];

        // Simple Query Builder
        $this->db->table('users')->insertBatch($data);
    }
}
