<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- Info dan Video -->
<section class="info-video d-flex align-items-center" style="min-height: 70vh; background-color: #EEEFE0;">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <h2 class="fs-2 fw-bold mb-3">Selamat Datang di Website Desa Banjaran</h2>
                <p class="text-muted mb-4">
                    Desa Banjaran menyuguhkan harmoni alam dan budaya lokal yang masih terjaga. Nikmati pengalaman tak terlupakan bersama kami!
                </p>
                <a href="<?= base_url('paketWisata') ?>" class="btn btn-palette me-2 mb-2">Cek Paket Wisata</a>
                <a href="<?= base_url('kontak') ?>" class="btn btn-outline-palette mb-2">Kontak Kami</a>
            </div>
            <div class="col-md-6">
                <div class="ratio ratio-16x9">
                    <iframe src="https://www.youtube.com/embed/NhLC1qXKYfg" title="YouTube Video" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Aktivitas -->
<section id="aktivitas" class="py-5" style="background-color: #FFFFFF;">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold fs-1">Aktivitas Kami</h2>
        <div class="row g-4">
            <?php foreach ($galeri as $a): ?>
                <div class="col-6 col-md-3">
                    <div class="card card-hover h-100 border-0 shadow-lg" style="color: #819A91;">
                        <img src="<?= base_url('img/' . $a['image']) ?>" class="card-img-top rounded" style="height: 200px; object-fit: cover;" alt="<?= $a['title'] ?>">
                        <div class="card-body p-3 text-center">
                            <h6 class="card-title mb-0"><?= $a['title'] ?></h6>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Statistik -->
<section class="py-5" style="background-color: #EEEFE0;">
    <div class="container">
        <div class="row text-center text-dark">
            <?php
            $stats = [
                ['100+', 'Paket Wisata Terjual'],
                ['25+', 'Instansi Penyelenggara'],
                ['15.000+', 'Pengunjung'],
                ['70+', 'Kegiatan']
            ];
            foreach ($stats as $stat): ?>
                <div class="col-md-3">
                    <h3 class="display-6 fw-bold"><?= $stat[0] ?></h3>
                    <p class="fs-5 fw-semibold mb-0"><?= $stat[1] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Paket Wisata -->
<section id="paket" class="py-5" style="background-color: #FFFFFF;">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold fs-1">Paket Wisata</h2>
        <div class="row">
            <?php foreach ($paket as $p): ?>
                <div class="col-md-4 mb-4">
                    <div class="card card-hover h-100 text-center shadow-lg">
                        <img src="<?= base_url('img/' . $p['image']) ?>" class="card-img-top" style="height: 200px; object-fit: cover;" alt="<?= $p['title'] ?>">
                        <div class="card-body d-flex flex-column">
                            <h5 class="fw-bold"><?= $p['title'] ?></h5>
                            <small class="d-block mb-2 text-muted"><?= $p['description'] ?></small>
                            <h3 class="fw-bold text-dark"><?= number_format($p['price']) ?></h3>
                            <small class="text-muted">/ orang</small>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>Durasi: <?= $p['duration'] ?></li>
                                <li>Minimal <?= $p['min_person'] ?> orang</li>
                                <li>Asuransi & Fasilitas</li>
                            </ul>
                            <div class="mt-auto mb-3">
                                <a href="<?= base_url('pesan/' . $p['id']) ?>" class="btn btn-sm btn-palette p-3 mt-2">Pesan Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Sponsor -->
<section id="sponsor" class="py-5" style="background-color: #EEEFE0;">
    <div class="container text-center">
        <h2 class="fw-bold fs-1 mb-5">Sponsor & Partner</h2>
        <div class="d-flex justify-content-center flex-wrap gap-4">
            <?php
            $sponsor = ['logobanjaran.png', 'unesco.png', 'wonderful.png'];
            foreach ($sponsor as $logo): ?>
                <img src="<?= base_url('img/' . $logo) ?>" alt="Sponsor" style="height: 80px; object-fit: contain;">
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- QnA -->
<section id="qna" class="py-5" style="background-color: #FFFFFF;">
    <div class="container">
        <h2 class="text-center fw-bold fs-2 mb-5">Pertanyaan yang Sering Diajukan</h2>
        <div class="accordion" id="faqAccordion">
            <?php
            $qna = [
                ["Dimana lokasi Desa Wisata Banjaran?", "Desa Wisata Banjaran terletak di Bojongsari, Purbalingga, Jawa Tengah."],
                ["Apa paket termurah?", "Paket camping mulai dari Rp100.000/orang."],
                ["Apakah panitia bisa menggunakan bus ukuran besar?", "Bisa, bus medium atau besar dapat mencapai lokasi."],
                ["Bagaimana cara melakukan reservasi dan pembayaran?", "Reservasi langsung melalui kontak. DP 10%, pelunasan hari H."]
            ];
            foreach ($qna as $i => $item):
                $qId = 'q' . $i;
                $aId = 'a' . $i;
            ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="<?= $qId ?>">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $aId ?>" aria-expanded="false" aria-controls="<?= $aId ?>">
                            <?= $item[0] ?>
                        </button>
                    </h2>
                    <div id="<?= $aId ?>" class="accordion-collapse collapse" aria-labelledby="<?= $qId ?>" data-bs-parent="#faqAccordion">
                        <div class="accordion-body"><?= $item[1] ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-5 text-center" style="background-color: #EEEFE0; margin-bottom: 0;">
    <div class="container">
        <h2 class="fw-bold mb-3 fs-1">Jadilah Bagian dari Desa Wisata Banjaran</h2>
        <p class="lead mb-5">Kami akan memberikan layanan atraksi desa wisata yang terbaik untuk Anda</p>
        <a href="<?= base_url('paketWisata') ?>"
            class="d-inline-flex flex-column justify-content-center align-items-center text-white text-decoration-none btn-reservasi"
            style="background-color: #819A91; padding: 1.5rem 2rem; border-radius: 0.5rem; width: 100%; max-width: 450px; margin: 0 auto;">
            <span class="fw-bold fs-5 text-white">RESERVASI SEKARANG</span>
            <small class="fw-normal mt-1 text-white">Pastikan tanggal terbaik Anda di Desa Wisata Banjaran</small>
        </a>
    </div>
</section>

<?= $this->endSection() ?>