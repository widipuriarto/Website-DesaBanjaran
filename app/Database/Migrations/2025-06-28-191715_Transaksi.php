<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transaksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'auto_increment' => true],
            'member_id'        => ['type' => 'INT'],
            'paket_id'         => ['type' => 'INT'],
            'tanggal_pemesanan'=> ['type' => 'DATE'],
            'jumlah_orang'     => ['type' => 'INT'],
            'total_harga'      => ['type' => 'INT'],
            'status'           => ['type' => 'ENUM("pending","dibayar","selesai","batal")', 'default' => 'pending'],
            'metode_pembayaran'=> ['type' => 'VARCHAR', 'constraint' => 50],
            'bukti_pembayaran' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at'       => [
                'type'    => 'DATETIME',
                'null'    => true,
                'default' => null
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('member_id', 'members', 'id');
        $this->forge->addForeignKey('paket_id', 'paket_wisata', 'id');
        $this->forge->createTable('transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi');
    }
}
