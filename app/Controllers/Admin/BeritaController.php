<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BeritaModel;

class BeritaController extends BaseController
{
    public function index()
    {
        helper('text');

        $model = new BeritaModel();
        $data = [
            'title' => 'Kelola Berita',
            'berita' => $model->findAll()
        ];
        return view('admin/berita', $data);
    }

    public function create()
    {
        $model = new BeritaModel();
        $file = $this->request->getFile('gambar');
        $namaFile = '';

        if ($file && $file->isValid()) {
            $namaFile = $file->getRandomName();
            $file->move('img/', $namaFile);
        }

        $model->insert([
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
            'gambar' => $namaFile,
            'tanggal' => date('Y-m-d')
        ]);

        return redirect()->to('/admin/berita')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function update($id)
    {
        $model = new BeritaModel();
        $berita = $model->find($id);
        $file = $this->request->getFile('gambar');

        $data = [
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
        ];

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $namaFile = $file->getRandomName();
            $file->move('img/', $namaFile);
            $data['gambar'] = $namaFile;
        }

        $model->update($id, $data);
        return redirect()->to('/admin/berita')->with('success', 'Berita berhasil diperbarui.');
    }

    public function delete($id)
    {
        $model = new BeritaModel();
        $berita = $model->find($id);

        if ($berita && $berita['gambar']) {
            $gambarPath = FCPATH . 'img/' . $berita['gambar'];
            if (file_exists($gambarPath)) {
                unlink($gambarPath);
            }
        }

        $model->delete($id);
        return redirect()->to('/admin/berita')->with('success', 'Berita berhasil dihapus.');
    }
}
