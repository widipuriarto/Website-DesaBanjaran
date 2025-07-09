<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard Admin' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            background-color: #f5f7fa;
        }

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            width: 240px;
            background-color: #819A91;
            color: white;
            overflow-y: auto;
            z-index: 1000;
            padding: 1rem;
        }

        .nav-link {
            border-radius: 10px;
        }

        .sidebar .nav-link {
            color: white;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #6b837b;
        }

        .header {
            background-color: #ffffff;
            padding: 1rem;
            border-bottom: 1px solid #ddd;
        }

        .footer {
            background-color: #eee;
            text-align: center;
            padding: 1rem;
            font-size: 0.9rem;
        }

        .wrapper {
            margin-left: 240px;
            /* Sesuai dengan width sidebar */
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

        /* Responsive */
        @media (max-width: 991.98px) {
            .sidebar {
                left: -250px;
                transition: left 0.3s;
                width: 250px;
            }

            .sidebar.active {
                left: 0;
            }

            .wrapper {
                margin-left: 0;
            }

            #sidebarBackdrop {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                bottom: 0;
                right: 0;
                background-color: rgba(0, 0, 0, 0.4);
                z-index: 999;
            }

            #sidebarBackdrop.active {
                display: block;
            }
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar shadow-sm" id="sidebar">
        <h5 class="fw-bold mb-4 text-center mt-4">Admin Menu</h5>
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/') ?>"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/users') ?>"><i class="bi bi-people me-2"></i>Kelola User</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/paket-wisata') ?>"><i class="bi bi-card-list me-2"></i>Paket Wisata</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/galeri') ?>"><i class="bi bi-image me-2"></i>Galeri</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/video') ?>"><i class="bi bi-play-btn me-2"></i>Video</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/berita') ?>"><i class="bi bi-newspaper me-2"></i>Berita</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/pesan') ?>"><i class="bi bi-envelope me-2"></i>Pesan</a></li>
            <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/transaksi') ?>"><i class="bi bi-receipt me-2"></i>Transaksi</a></li>
            <hr class="bg-light">
            <li class="nav-item"><a class="nav-link" href="<?= base_url('/logout') ?>"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
        </ul>
    </div>

    <!-- Sidebar backdrop (HP only) -->
    <div id="sidebarBackdrop" onclick="toggleSidebar()"></div>

    <!-- Main Content -->
    <div class="wrapper">
        <!-- Header -->
        <div class="header d-flex justify-content-center align-items-center px-4 text-center position-relative shadow-sm">
            <h4 class="m-3 fw-bold w-100" style="color: #6b837b;">Dashboard Admin<br>Website Desa Banjaran</h4>

            <!-- Tombol hamburger kiri atas (hanya di layar kecil) -->
            <button class="btn d-lg-none position-absolute start-0 ms-2" onclick="toggleSidebar()">
                <i class="bi bi-list fs-4"></i>
            </button>
        </div>

        <!-- Content -->
        <main class="p-4">
            <?= $this->renderSection('content') ?>
        </main>

        <!-- Footer -->
        <footer class="footer">
            <p>&copy; <?= date('Y') ?> Desa Banjaran. All rights reserved.</p>
        </footer>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('sidebarBackdrop').classList.toggle('active');
        }
    </script>
</body>

</html>