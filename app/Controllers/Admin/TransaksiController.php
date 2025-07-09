<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TransaksiModel;
use App\Models\PaketWisataModel;
use App\Models\MemberModel;
use Dompdf\Dompdf;

class TransaksiController extends BaseController
{
    public function index()
    {
        $transaksiModel = new \App\Models\TransaksiModel();
        $paketModel     = new \App\Models\PaketWisataModel();
        $memberModel    = new \App\Models\MemberModel();

        $start = $this->request->getGet('start_date');
        $end   = $this->request->getGet('end_date');

        $builder = $transaksiModel
            ->select('transaksi.*, paket_wisata.title AS nama_paket, members.name AS nama_member')
            ->join('paket_wisata', 'paket_wisata.id = transaksi.paket_id')
            ->join('members', 'members.id = transaksi.member_id');

        // Filter tanggal jika ada
        if ($start && $end) {
            $builder->where('tanggal_pemesanan >=', $start)
                ->where('tanggal_pemesanan <=', $end);
        }

        $transaksi = $builder->findAll();

        // Hitung total pendapatan dari transaksi yang diterima
        $totalDiterima = 0;
        foreach ($transaksi as $row) {
            if ($row['status'] === 'diterima') {
                $totalDiterima += $row['total_harga'];
            }
        }

        $data = [
            'title'          => 'Kelola Transaksi',
            'transaksi'      => $transaksi,
            'paket'          => $paketModel->findAll(),
            'members'        => $memberModel->findAll(),
            'totalDiterima'  => $totalDiterima,
            'start_date'     => $start,
            'end_date'       => $end,
        ];

        return view('admin/transaksi', $data);
    }

    public function create()
    {
        $transaksiModel = new TransaksiModel();

        $data = [
            'member_id'         => $this->request->getPost('member_id'),
            'paket_id'          => $this->request->getPost('paket_id'),
            'tanggal_pemesanan' => $this->request->getPost('tanggal_pemesanan'),
            'jumlah_orang'      => $this->request->getPost('jumlah_orang'),
            'total_harga'       => $this->request->getPost('total_harga'),
            'status'            => $this->request->getPost('status'),
            'metode_pembayaran' => $this->request->getPost('metode_pembayaran'),
        ];

        $file = $this->request->getFile('bukti_pembayaran');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $namaFile = $file->getRandomName();
            $file->move('uploads/bukti', $namaFile);
            $data['bukti_pembayaran'] = $namaFile;
        }

        $transaksiModel->insert($data);

        return redirect()->to(base_url('admin/transaksi'))->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function update($id)
    {
        $transaksiModel = new TransaksiModel();

        $data = [
            'member_id'         => $this->request->getPost('member_id'),
            'paket_id'          => $this->request->getPost('paket_id'),
            'tanggal_pemesanan' => $this->request->getPost('tanggal_pemesanan'),
            'jumlah_orang'      => $this->request->getPost('jumlah_orang'),
            'total_harga'       => $this->request->getPost('total_harga'),
            'status'            => $this->request->getPost('status'),
            'metode_pembayaran' => $this->request->getPost('metode_pembayaran'),
        ];

        $file = $this->request->getFile('bukti_pembayaran');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $namaFile = $file->getRandomName();
            $file->move('uploads/bukti', $namaFile);
            $data['bukti_pembayaran'] = $namaFile;
        }

        $transaksiModel->update($id, $data);

        return redirect()->to(base_url('admin/transaksi'))->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function delete($id)
    {
        $transaksiModel = new TransaksiModel();

        $data = $transaksiModel->find($id);
        if ($data && $data['bukti_pembayaran']) {
            $path = FCPATH . 'uploads/bukti/' . $data['bukti_pembayaran'];
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $transaksiModel->delete($id);
        return redirect()->to(base_url('admin/transaksi'))->with('success', 'Transaksi berhasil dihapus.');
    }


    public function laporan()
    {
        $transaksiModel = new TransaksiModel();
        $dari   = $this->request->getGet('dari');
        $sampai = $this->request->getGet('sampai');

        $query = $transaksiModel->select('transaksi.*, paket_wisata.title AS nama_paket, members.name AS nama_member')
            ->join('paket_wisata', 'paket_wisata.id = transaksi.paket_id')
            ->join('members', 'members.id = transaksi.member_id');

        if ($dari && $sampai) {
            $query->where("tanggal_pemesanan >=", $dari)
                ->where("tanggal_pemesanan <=", $sampai);
        }

        $transaksi = $query->findAll();

        $total = 0;
        foreach ($transaksi as $t) {
            if ($t['status'] === 'diterima') {
                $total += $t['total_harga'];
            }
        }

        $data = [
            'transaksi' => $transaksi,
            'members'   => (new MemberModel())->findAll(),
            'paket'     => (new PaketWisataModel())->findAll(),
            'dari'      => $dari,
            'sampai'    => $sampai,
            'total_diterima' => $total
        ];

        return view('admin/transaksi', $data);
    }

    public function cetakPDF()
    {
        $transaksiModel = new TransaksiModel();
        $dari   = $this->request->getGet('dari');
        $sampai = $this->request->getGet('sampai');

        $transaksi = $transaksiModel->select('transaksi.*, paket_wisata.title AS nama_paket, members.name AS nama_member')
            ->join('paket_wisata', 'paket_wisata.id = transaksi.paket_id')
            ->join('members', 'members.id = transaksi.member_id')
            ->where("tanggal_pemesanan >=", $dari)
            ->where("tanggal_pemesanan <=", $sampai)
            ->findAll();

        $total = 0;
        foreach ($transaksi as $t) {
            if ($t['status'] === 'diterima') {
                $total += $t['total_harga'];
            }
        }

        $data = [
            'transaksi' => $transaksi,
            'dari' => $dari,
            'sampai' => $sampai,
            'total_diterima' => $total
        ];

        $html = view('admin/laporan_pdf', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('laporan-transaksi.pdf', ['Attachment' => false]);
    }
}
