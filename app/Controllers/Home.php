<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PaketWisataModel;
use App\Models\GaleriModel;

class Home extends BaseController
{
    public function index(): string
    {
        $paketModel = new PaketWisataModel();
        $galeriModel = new GaleriModel();

        $data = [
            'paket' => $paketModel->findAll(),
            'galeri' => $galeriModel->findAll()
        ];

        return view('v_home', $data);
    }
}
