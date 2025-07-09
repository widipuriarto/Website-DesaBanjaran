<?= $this->extend('admin/layout_dashboard') ?>
<?= $this->section('content') ?>

<style>
    .custom-color {
        color: #819A91;
    }

    .custom-outline {
        border-color: #819A91;
        color: #819A91;
    }

    .custom-outline:hover {
        background-color: #819A91;
        color: white;
    }

    .card-hover:hover {
        transform: translateY(-10px);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }
</style>



<div class="row g-4 mt-5">
    <?php
    $cards = [
        ['Users', 'totalUsers', 'users', 'bi-people'],
        ['Paket Wisata', 'totalPaket', 'paket-wisata', 'bi-card-list'],
        ['Galeri', 'totalGaleri', 'galeri', 'bi-image'],
        ['Video', 'totalVideo', 'video', 'bi-play-btn'],
        ['Berita', 'totalBerita', 'berita', 'bi-newspaper'],
        ['Pesan', 'totalPesan', 'pesan', 'bi-envelope'],
        ['Transaksi', 'totalTransaksi', 'transaksi', 'bi-receipt'],
    ];
    ?>

    <?php foreach ($cards as [$label, $key, $route, $icon]): ?>
        <?php
        switch ($key) {
            case 'totalUsers':
                $count = $totalUsers;
                break;
            case 'totalPaket':
                $count = $totalPaket;
                break;
            case 'totalGaleri':
                $count = $totalGaleri;
                break;
            case 'totalVideo':
                $count = $totalVideo;
                break;
            case 'totalBerita':
                $count = $totalBerita;
                break;
            case 'totalPesan':
                $count = $totalPesan;
                break;
            case 'totalTransaksi':
                $count = $totalTransaksi;
                break;
        }
        ?>
        <div class="col-md-6 col-xl-3">
            <div class="card card-hover shadow-sm border-0 h-100">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <div>
                        <i class="bi <?= $icon ?> fs-3 custom-color"></i>
                        <h5 class="fw-semibold mt-2"><?= $label ?></h5>
                        <p class="fs-4 fw-bold custom-color"><?= $count ?></p>
                    </div>
                    <a href="<?= base_url('admin/' . $route) ?>" class="btn btn-sm custom-outline">Kelola <?= $label ?></a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>
