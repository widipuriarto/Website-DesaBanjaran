<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('transaksi')->insert([
            'member_id' => 1,
            'paket_id' => 1,
            'tanggal_pemesanan' => '2025-07-15',
            'jumlah_orang' => 10,
            'total_harga' => 600000,
            'status' => 'pending',
            'metode_pembayaran' => 'Transfer Bank'
        ]);
    }
}
