<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class VideosSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('videos')->insert([
            'title' => 'Virtual Tour Desa Banjaran',
            'youtube_url' => 'https://youtu.be/NhLC1qXKYfg'
        ]);
    }
}
