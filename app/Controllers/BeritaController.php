<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\BeritaModel;

class BeritaController extends BaseController
{
    public function index()
    {
        helper('text');
        
        $model = new BeritaModel();
        $berita = $model->orderBy('tanggal', 'DESC')->findAll();

        return view('v_berita', ['berita' => $berita]);
    }
}
