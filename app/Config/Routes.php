<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::index');

$routes->get('/profilDesa', 'ProfilDesaController::index');

$routes->get('/paketWisata', 'PaketWisataController::index');

$routes->get('/galeri', 'GaleriController::index');

$routes->get('/kontak', 'KontakController::index');

$routes->post('/kontak/kirim', 'KontakController::kirim');

$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::registerPost');

$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::attemptLogin');
$routes->get('/logout', 'AuthController::logout');

$routes->get('/pesan/(:num)', 'PesanController::form/$1');
$routes->post('/pesan/simpan', 'PesanController::simpan');

$routes->get('/riwayat', 'UserController::riwayat', ['filter' => 'auth']);
$routes->post('/upload-bukti/(:num)', 'UserController::uploadBukti/$1', ['filter' => 'auth']);

$routes->get('/berita', 'BeritaController::index');

$routes->get('/admin/dashboard', 'AdminController::index', ['filter' => 'admin']);

// ---

$routes->group('admin', ['filter' => 'admin'], function ($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');

    // Kelola User
    $routes->get('user', 'Admin\UserController::index');

    // Kelola Paket
    $routes->get('paket', 'Admin\PaketController::index');

    // Kelola Galeri
    $routes->get('galeri', 'Admin\GaleriController::index');

    // Kelola Video
    $routes->get('video', 'Admin\VideoController::index');

    // Kelola Berita
    $routes->get('berita', 'Admin\BeritaController::index');

    // Kelola Pesan
    $routes->get('kontak', 'Admin\KontakController::index');

    // Kelola Transaksi
    $routes->get('transaksi', 'Admin\TransaksiController::index');
});

// ---

// $routes->group('admin', ['filter' => 'auth'], function ($routes) {
//     $routes->get('paket-wisata', 'Admin\PaketWisataController::index');
//     $routes->get('paket-wisata/create', 'Admin\PaketWisataController::create');
//     $routes->post('paket-wisata/store', 'Admin\PaketWisataController::store');
//     $routes->get('paket-wisata/delete/(:num)', 'Admin\PaketWisataController::delete/$1');

//     $routes->get('galeri', 'Admin\GaleriController::index');
//     $routes->get('galeri/create', 'Admin\GaleriController::create');
//     $routes->post('galeri/store', 'Admin\GaleriController::store');
//     $routes->get('galeri/delete/(:num)', 'Admin\GaleriController::delete/$1');
// });


// ----

$routes->group('admin', ['filter' => 'auth_admin'], function ($routes) {
    $routes->get('/', 'Admin\DashboardController::index');
    $routes->get('users', 'Admin\UserController::index');
    $routes->post('users/create', 'Admin\UserController::create');
    $routes->post('users/delete/(:num)', 'Admin\UserController::delete/$1');


    $routes->get('paket-wisata', 'Admin\PaketWisataController::index');
    $routes->post('paket-wisata/create', 'Admin\PaketWisataController::create'); // ← Ini penting!
    $routes->post('paket-wisata/update/(:num)', 'Admin\PaketWisataController::update/$1');
    $routes->post('paket-wisata/delete/(:num)', 'Admin\PaketWisataController::delete/$1');

    $routes->get('galeri', 'Admin\GaleriController::index');
    $routes->post('galeri/create', 'Admin\GaleriController::create');
    $routes->post('galeri/update/(:num)', 'Admin\GaleriController::update/$1');
    $routes->post('galeri/delete/(:num)', 'Admin\GaleriController::delete/$1');


    $routes->get('video', 'Admin\VideoController::index');
    $routes->post('video/create', 'Admin\VideoController::create');
    $routes->post('video/update/(:num)', 'Admin\VideoController::update/$1');
    $routes->post('video/delete/(:num)', 'Admin\VideoController::delete/$1');

    $routes->get('berita', 'Admin\BeritaController::index');
    $routes->post('berita/create', 'Admin\BeritaController::create');
    $routes->post('berita/update/(:num)', 'Admin\BeritaController::update/$1');
    $routes->post('berita/delete/(:num)', 'Admin\BeritaController::delete/$1');

    $routes->get('pesan', 'Admin\PesanController::index');
    $routes->post('pesan/delete/(:num)', 'Admin\PesanController::delete/$1');

    $routes->get('transaksi', 'Admin\TransaksiController::index');
    $routes->post('transaksi/create', 'Admin\TransaksiController::create');
    $routes->post('transaksi/update/(:num)', 'Admin\TransaksiController::update/$1');
    $routes->post('transaksi/delete/(:num)', 'Admin\TransaksiController::delete/$1');
    $routes->get('transaksi/laporan', 'Admin\TransaksiController::laporan');
    $routes->get('transaksi/cetak-pdf', 'Admin\TransaksiController::cetakPDF');
});

// Chatbot Routes
$routes->group('api/chat', function ($routes) {
    $routes->post('send', 'ChatbotController::send');
    $routes->get('history', 'ChatbotController::loadHistory');
});

$routes->get('auth-google', 'AuthGoogle::redirect');
$routes->get('auth/google-callback', 'AuthGoogle::callback');
