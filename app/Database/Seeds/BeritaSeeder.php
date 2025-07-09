<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BeritaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'judul'   => 'Pelatihan Kewirausahaan Desa Banjaran',
                'isi'     => 'Desa Banjaran mengadakan pelatihan kewirausahaan untuk pemuda desa agar mandiri secara ekonomi.',
                'gambar'  => 'berita1.jpg',
                'tanggal' => '2025-06-01',
            ],
            [
                'judul'   => 'Perbaikan Jalan Utama Desa',
                'isi'     => 'Pemerintah desa telah memulai proyek perbaikan jalan utama untuk kenyamanan warga.',
                'gambar'  => 'berita2.jpg',
                'tanggal' => '2025-06-10',
            ]
        ];

        $this->db->table('berita')->insertBatch($data);
    }
}
