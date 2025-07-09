<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\TransaksiModel;

class UserController extends BaseController
{
    public function index()
    {
        //
    }

    public function riwayat()
    {
        $transaksiModel = new TransaksiModel();
        $riwayat = $transaksiModel->where('member_id', session()->get('member_id'))->orderBy('id', 'DESC')->findAll();

        return view('v_riwayat', ['riwayat' => $riwayat]);
    }

    public function uploadBukti($id)
    {
        $transaksiModel = new TransaksiModel();
        $transaksi = $transaksiModel->find($id);

        // Cek jika transaksi milik user ini
        if ($transaksi['member_id'] != session()->get('member_id')) {
            return redirect()->to('/riwayat')->with('error', 'Akses ditolak.');
        }

        $file = $this->request->getFile('bukti');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $namaFile = $file->getRandomName();
            $file->move('uploads/bukti', $namaFile);

            $transaksiModel->update($id, [
                'bukti_pembayaran' => $namaFile,
                'status' => 'menunggu'
            ]);

            return redirect()->to('/riwayat')->with('success', 'Bukti pembayaran berhasil diupload.');
        }

        return redirect()->to('/riwayat')->with('error', 'Upload gagal.');
    }
}
