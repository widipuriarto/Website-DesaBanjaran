<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\TransaksiModel;
use App\Models\PaketWisataModel;
use App\Models\PesanModel;

class PesanController extends BaseController
{
    public function index()
    {
        //
    }

    // Tampilkan form pemesanan
    // Tampilkan form pemesanan
    public function form($id)
    {
        // Cek login dulu
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu untuk memesan.');
        }

        $paketModel = new PaketWisataModel();
        $paket = $paketModel->asArray()->find($id);

        if (!$paket) {
            return redirect()->to('/paketWisata')->with('error', 'Paket tidak ditemukan.');
        }

        return view('v_formPemesanan', ['paket' => $paket]);
    }

    // Simpan data pemesanan
    public function simpan()
    {
        // Cek login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // ✅ Validasi input form
        $validation = \Config\Services::validation();
        $validation->setRules([
            'paket_id'          => 'required|is_natural_no_zero',
            'tanggal'           => 'required|valid_date[Y-m-d]',
            'jumlah_orang'      => 'required|is_natural_no_zero',
            'metode_pembayaran' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', 'Mohon isi form dengan benar.');
        }

        // Ambil input
        $paketId      = $this->request->getPost('paket_id');
        $tanggal      = $this->request->getPost('tanggal');
        $jumlahOrang  = (int) $this->request->getPost('jumlah_orang');
        $metode       = $this->request->getPost('metode_pembayaran');

        // Ambil harga paket
        $paketModel = new PaketWisataModel();
        $paket = $paketModel->asArray()->find($paketId);

        if (!$paket) {
            return redirect()->to('/paketWisata')->with('error', 'Paket tidak ditemukan.');
        }

        $totalHarga = $jumlahOrang * $paket['price'];

        // Simpan ke database
        $transaksiModel = new TransaksiModel();
        $transaksiModel->save([
            'member_id'          => session()->get('member_id'),
            'paket_id'           => $paketId,
            'tanggal_pemesanan'  => $tanggal,
            'jumlah_orang'       => $jumlahOrang,
            'total_harga'        => $totalHarga,
            'metode_pembayaran'  => $metode,
            'status'             => 'pending'
        ]);



        return redirect()->to('/riwayat')->with('success', 'Pemesanan berhasil dilakukan!');
    }

    public function delete($id)
    {
        $model = new PesanModel();
        $model->delete($id);
        return redirect()->back()->with('success', 'Pesan berhasil dihapus.');
    }
}
