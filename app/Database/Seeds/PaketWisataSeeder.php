<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PaketWisataSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title'       => 'Paket Camping',
                'description' => 'Camping di tepi Kali Klawing dengan fasilitas lengkap',
                'price'       => 60000,
                'duration'    => '3D2N',
                'min_person'  => 10,
                'image'       => 'camping.jpg',
            ],
            [
                'title'       => 'Paket Outbound',
                'description' => 'Outbound menyenangkan untuk grup & anak-anak',
                'price'       => 120000,
                'duration'    => '1D',
                'min_person'  => 20,
                'image'       => 'outbound.jpg',
            ]
        ];

        $this->db->table('paket_wisata')->insertBatch($data);
    }
}
