<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GaleriSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['title' => 'Sunset di Klawing', 'image' => 'sunset.jpg'],
            ['title' => 'Bendung Slinga', 'image' => 'bendung.jpg']
        ];
        $this->db->table('galeri')->insertBatch($data);
    }
}
