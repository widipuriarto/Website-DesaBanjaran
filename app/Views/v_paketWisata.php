<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<section id="paket" class="py-5" style="background-color: #FFFFFF;">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold fs-1">Paket Wisata</h2>

        <?php foreach ($paket as $item): ?>
        <div class="row mb-5 align-items-center">
            <div class="col-md-4 mb-3 mb-md-0">
                <img src="<?= base_url('img/' . $item['image']) ?>" alt="<?= $item['title'] ?>"
                     class="img-fluid rounded shadow" style="width: 100%; height: 250px; object-fit: cover;">
            </div>
            <div class="col-md-8 mt-4">
                <h4 class="fw-bold" style="color: #595C5F;"><?= esc($item['title']) ?></h4>
                <p class="text-muted mb-1" style="color: #595C5F;"><?= esc($item['description']) ?></p>
                <p class="mb-1" style="color: #595C5F;">Durasi: <?= esc($item['duration']) ?></p>
                <p class="mb-1" style="color: #595C5F;">Minimal: <?= esc($item['min_person']) ?> orang</p>
                <h5 class="fw-semibold text-palette mt-4">Rp <?= number_format($item['price'], 0, ',', '.') ?> / orang</h5>
                <a href="<?= base_url('pesan/' . $item['id']) ?>" class="btn btn-sm btn-palette p-2 mt-2">Pesan Sekarang</a>

            </div>
        </div>
        <hr>
        <?php endforeach; ?>
    </div>
</section>


<?= $this->endSection() ?>