<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\GaleriModel;

class GaleriController extends BaseController
{
    public function index()
    {
        $model = new GaleriModel();
        $data = [
            'title' => 'Kelola Galeri',
            'galeri' => $model->findAll()
        ];

        return view('admin/galeri', $data);
    }

    public function create()
    {
        $model = new GaleriModel();
        $image = $this->request->getFile('image');

        if ($image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move('img/', $imageName);
        } else {
            $imageName = null;
        }

        $model->insert([
            'title' => $this->request->getPost('title'),
            'image' => $imageName,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->back()->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function update($id)
    {
        $model = new GaleriModel();
        $galeri = $model->find($id);

        if (!$galeri) return redirect()->back()->with('error', 'Data tidak ditemukan.');

        $image = $this->request->getFile('image');
        $imageName = $galeri['image'];

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move('img/', $imageName);
        }

        $model->update($id, [
            'title' => $this->request->getPost('title'),
            'image' => $imageName,
        ]);

        return redirect()->back()->with('success', 'Galeri berhasil diperbarui.');
    }

    public function delete($id)
    {
        $model = new GaleriModel();
        $data = $model->find($id);

        if ($data && $data['image']) {
            $path = FCPATH . 'img/' . $data['image'];
            if (file_exists($path)) unlink($path);
        }

        $model->delete($id);
        return redirect()->back()->with('success', 'Galeri berhasil dihapus.');
    }
}
