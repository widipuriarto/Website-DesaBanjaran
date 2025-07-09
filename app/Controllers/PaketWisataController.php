<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\PaketWisataModel;

class PaketWisataController extends BaseController
{
    public function index()
    {
        $model = new PaketWisataModel();
        $data['paket'] = $model->findAll();

        return view('v_paketWisata', $data);
    }
}
