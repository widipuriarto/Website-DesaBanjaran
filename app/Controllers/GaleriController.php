<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\GaleriModel;
use App\Models\VideoModel;

class GaleriController extends BaseController
{
    public function index()
    {
        $galeriModel = new GaleriModel();
        $videoModel  = new VideoModel();

        $data = [
            'galeri' => $galeriModel->findAll(),
            'videos' => $videoModel->findAll()
        ];
        
        return view('v_galeri', $data);
    }
}
