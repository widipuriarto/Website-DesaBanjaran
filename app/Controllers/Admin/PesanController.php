<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\PesanModel;

class PesanController extends BaseController
{
    public function index()
    {
        $model = new PesanModel();

        $data = [
            'title' => 'Kelola Pesan',
            'pesan' => $model->orderBy('created_at', 'DESC')->findAll()
        ];

        return view('admin/pesan', $data);
    }

    public function delete($id)
    {
        $model = new PesanModel();
        $model->delete($id);

        return redirect()->back()->with('success', 'Pesan berhasil dihapus.');
    }
}
