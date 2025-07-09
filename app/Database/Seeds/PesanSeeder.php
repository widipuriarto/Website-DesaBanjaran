<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PesanSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('pesan')->insert([
            'name' => 'Andi',
            'email' => 'andi@example.com',
            'subject' => 'Inquiry Paket',
            'message' => 'Saya ingin tahu harga untuk 15 orang.'
        ]);
    }
}
