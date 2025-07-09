<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\PaketWisataModel;

class PaketWisataController extends BaseController
{
    public function index()
    {
        $model = new PaketWisataModel();
        $data = [
            'title' => 'Kelola Paket Wisata',
            'paket' => $model->findAll()
        ];
        return view('admin/paket_wisata', $data);
    }

    public function create()
    {
        $paketModel = new PaketWisataModel();
        $image = $this->request->getFile('image');

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move('img/', $imageName); // Simpan ke folder public/img/
        } else {
            $imageName = null;
        }

        $paketModel->insert([
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'price'       => $this->request->getPost('price'),
            'duration'    => $this->request->getPost('duration'),
            'min_person'  => $this->request->getPost('min_person'),
            'image'       => $imageName,
            'created_at'  => date('Y-m-d H:i:s')
        ]);

        return redirect()->back()->with('success', 'Paket wisata berhasil ditambahkan!');
    }

    public function update($id)
    {
        $model = new PaketWisataModel();
        $paket = $model->find($id);

        if (!$paket) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $image = $this->request->getFile('image');
        $imageName = $paket['image'];

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move('img/', $imageName);
        }

        $model->update($id, [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'price'       => $this->request->getPost('price'),
            'duration'    => $this->request->getPost('duration'),
            'min_person'  => $this->request->getPost('min_person'),
            'image'       => $imageName,
        ]);

        return redirect()->back()->with('success', 'Paket wisata berhasil diperbarui.');
    }

    public function delete($id)
    {
        $model = new PaketWisataModel();
        $data = $model->find($id);

        if ($data && $data['image']) {
            $imagePath = FCPATH . 'img/' . $data['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $model->delete($id);
        return redirect()->back()->with('success', 'Paket wisata berhasil dihapus.');
    }
}
