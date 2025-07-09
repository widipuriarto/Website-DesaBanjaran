<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\PesanModel;

class KontakController extends BaseController
{
    public function index()
    {
        return view('v_kontak');
    }

    public function kirim()
    {
        $model = new PesanModel();

        $model->insert([
            'name'    => $this->request->getPost('name'),
            'email'   => $this->request->getPost('email'),
            'subject' => $this->request->getPost('subject'),
            'message' => $this->request->getPost('message'),
        ]);

        return redirect()->to('/kontak')->with('success', 'Pesan berhasil dikirim!');
    }
}
