<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UserModel;
use App\Models\PaketWisataModel;
use App\Models\GaleriModel;
use App\Models\VideoModel;
use App\Models\BeritaModel;
use App\Models\KontakModel;
use App\Models\TransaksiModel;
class DashboardController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Admin',

            'totalUsers'     => (new UserModel())->countAll(),
            'totalPaket'     => (new PaketWisataModel())->countAll(),
            'totalGaleri'    => (new GaleriModel())->countAll(),
            'totalVideo'     => (new VideoModel())->countAll(),
            'totalBerita'    => (new BeritaModel())->countAll(),
            'totalPesan'     => (new KontakModel())->countAll(),
            'totalTransaksi' => (new TransaksiModel())->countAll(),
        ];

        return view('admin/dashboard', $data);
    }
}
