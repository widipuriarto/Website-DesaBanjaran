<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Galeri Foto</h2>
        <div class="row row-cols-2 row-cols-md-4 g-4">
            <?php foreach ($galeri as $g): ?>
                <div class="col">
                    <div class="card card-hover h-100 d-flex flex-column shadow-sm">
                        <img src="<?= base_url('img/' . $g['image']) ?>" class="card-img-top" alt="<?= $g['title'] ?>" style="height: 200px; object-fit: cover;">
                        <div class="card-body text-center mt-auto">
                            <h6 class="card-title"><?= $g['title'] ?></h6>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>


        <h2 class="text-center fw-bold mt-5 mb-5">Galeri Video</h2>
        <div class="row">
            <?php foreach ($videos as $v): ?>
                <div class="col-md-6 mb-4 mt-2">
                    <div class="ratio ratio-16x9">
                        <iframe src="<?= $v['youtube_url'] ?>" title="<?= $v['title'] ?>" allowfullscreen></iframe>
                    </div>
                    <p class="text-center mt-2"><?= $v['title'] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>