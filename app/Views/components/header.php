<!-- Layer 2: Navbar -->
<header class="header-nav border-top border-bottom shadow-lg sticky-top" style="background-color: #819A91; z-index: 1030;">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid position-relative">
                <!-- Logo kecil (optional) -->
                <a class="navbar-brand d-lg-none fw-bold" href="#">Desa Banjaran</a>

                <!-- Hamburger button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar Content -->
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <!-- Navigasi utama di tengah -->
                    <ul class="navbar-nav text-center">
                        <li class="nav-item">
                            <a class="nav-link fw-semibold text-white px-3" href="<?= base_url('home') ?>">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold text-white px-3" href="<?= base_url('profilDesa') ?>">Profil Desa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold text-white px-3" href="<?= base_url('paketWisata') ?>">Paket Wisata</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold text-white px-3" href="<?= base_url('galeri') ?>">Galeri</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold text-white px-3" href="<?= base_url('berita') ?>">Berita</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold text-white px-3 kontak" href="<?= base_url('kontak') ?>">Kontak</a>
                        </li>

                        <!-- Login/Logout: hanya tampil di mobile -->
                        <?php if (session()->get('logged_in')): ?>
                            <li class="nav-item d-lg-none">
                                <a class="nav-link fw-semibold text-white px-3" href="<?= base_url('/riwayat') ?>">Riwayat</a>
                            </li>
                            <li class="nav-item d-lg-none">
                                <a class="nav-link fw-semibold text-white px-3" href="<?= base_url('/logout') ?>">Logout</a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item d-lg-none">
                                <a class="nav-link fw-semibold text-white px-3" href="<?= base_url('/login') ?>">Login</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Kanan atas: Dropdown nama user saat layar besar -->
                <div class="d-none d-lg-block position-absolute end-0 me-3">
                    <?php if (session()->get('logged_in')): ?>
                        <div class="dropdown">
                            <button class="btn btn-sm dropdown-toggle text-white fw-semibold" style="background-color: #819A91;" type="button" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                                <?= esc(session()->get('name') ?? session()->get('username')) ?>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                                <li><a class="dropdown-item" href="<?= base_url('/riwayat') ?>">Riwayat</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-danger" href="<?= base_url('/logout') ?>">Logout</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a href="<?= base_url('/login') ?>" class="btn btn-sm fw-semibold text-white" style="background-color: #819A91;">Login</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </div>
</header>