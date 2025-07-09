<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MembersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'user_id' => 2,
            'name'    => 'Siti Nur',
            'email'   => 'siti@example.com',
            'phone'   => '081234567890',
        ];

        $this->db->table('members')->insert($data);
    }
}
