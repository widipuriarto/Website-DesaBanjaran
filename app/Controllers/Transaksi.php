<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\PaketWisataModel;
use App\Models\TransaksiModel;
use App\Models\MemberModel;

class Transaksi extends BaseController
{
    public function index()
    {
        //
    }

    public function pesan($id)
    {
        $paketModel = new PaketWisataModel();
        $paket = $paketModel->find($id);

        if (!$paket) {
            return redirect()->to('/paketWisata')->with('error', 'Paket tidak ditemukan.');
        }

        return view('v_formPemesanan', ['paket' => $paket]);
    }

    public function simpan()
    {
        $transaksiModel = new TransaksiModel();
        $memberModel = new MemberModel();

        $userId = session()->get('user_id');
        $member = $memberModel->where('user_id', $userId)->first();

        if (!$member) {
            return redirect()->back()->with('error', 'Member tidak ditemukan.');
        }

        $data = [
            'member_id'         => $member['id'],
            'paket_id'          => $this->request->getPost('paket_id'),
            'tanggal_pemesanan' => $this->request->getPost('tanggal'),
            'jumlah_orang'      => $this->request->getPost('jumlah_orang'),
            'total_harga'       => $this->request->getPost('total_harga'),
            'metode_pembayaran' => $this->request->getPost('metode'),
            'status'            => 'pending'
        ];

        $transaksiModel->insert($data);
        return redirect()->to('/riwayat')->with('success', 'Pemesanan berhasil!');
    }
}
