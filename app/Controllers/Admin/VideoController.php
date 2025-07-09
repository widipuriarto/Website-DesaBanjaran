<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\VideoModel;


class VideoController extends BaseController
{
    public function index()
    {
        $model = new VideoModel();
        $data = [
            'title' => 'Kelola Video',
            'videos' => $model->findAll(),
        ];
        return view('admin/video', $data);
    }

    public function create()
    {
        $model = new VideoModel();
        $model->insert([
            'title' => $this->request->getPost('title'),
            'youtube_url' => $this->request->getPost('youtube_link'), // perhatikan ini
        ]);
        return redirect()->to('/admin/video')->with('success', 'Video berhasil ditambahkan.');
    }

    public function update($id)
    {
        $model = new VideoModel();
        $model->update($id, [
            'title' => $this->request->getPost('title'),
            'youtube_url' => $this->request->getPost('youtube_url'), // sesuai dengan form
        ]);
        return redirect()->to('/admin/video')->with('success', 'Video berhasil diperbarui.');
    }

    public function delete($id)
    {
        $model = new VideoModel();
        $model->delete($id);
        return redirect()->to('/admin/video')->with('success', 'Video berhasil dihapus.');
    }
}
