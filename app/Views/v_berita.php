<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-5">
    <h2 class="mb-5 fw-bold text-center">Berita Desa</h2>

    <div class="row g-4">
        <?php foreach ($berita as $b): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card card-hover h-100 shadow-sm">
                    <img src="<?= base_url('img/' . $b['gambar']) ?>" class="card-img-top" style="height: 200px; object-fit: cover;" alt="<?= esc($b['judul']) ?>">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= esc($b['judul']) ?></h5>
                        <p class="card-text text-muted small mb-2"><?= date('d M Y', strtotime($b['tanggal'])) ?></p>
                        <p class="card-text"><?= word_limiter(strip_tags($b['isi']), 20) ?></p>
                        <a href="#" class="btn btn-sm btn-outline-primary mt-auto disabled">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?= $this->endSection() ?>