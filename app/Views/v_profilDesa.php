<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<!-- Section: Profil Desa + Lokasi -->
<section class="py-5" style="background-color: #FFFFFF;">
    <div class="container">
        <div class="row align-items-start">
            <!-- Profil Desa -->
            <div class="col-md-6 mb-4 mb-md-0">
                <h2 class="fw-bold mb-3">Profil Desa Banjaran</h2>
                <p class="text-muted">
                    Desa Banjaran terletak di Kecamatan Bojongsari, Kabupaten Purbalingga, Jawa Tengah.
                    Desa ini dikenal dengan keindahan alamnya serta keramahan penduduknya. Letaknya yang strategis di tepi sungai Klawing membuat desa ini menjadi destinasi wisata unggulan yang menyajikan keindahan alam dan kekayaan budaya lokal.
                </p>
                <p class="text-muted">
                    Desa Banjaran memiliki berbagai potensi seperti wisata alam, kuliner tradisional, serta produk lokal yang dikelola langsung oleh masyarakat.
                </p>
            </div>
            <!-- Google Maps -->
            <div class="col-md-6">
                <div class="ratio ratio-4x3 shadow rounded">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.5921701771514!2d109.3799443!3d-7.8321367!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e654fa8456a1b95%3A0x6df567bfaad1eec0!2sBanjaran%2C%20Bojongsari%2C%20Purbalingga%2C%20Jawa%20Tengah!5e0!3m2!1sen!2sid!4v1719922222222"
                        style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section: Sejarah Singkat -->
<section class="py-5" style="background-color: #EEEFE0;">
    <div class="container">
        <h2 class="fw-bold text-center mb-4">Sejarah Singkat Desa</h2>
        <p class="text-center text-muted mx-auto" style="max-width: 800px;">
            Desa Banjaran telah berdiri sejak zaman penjajahan dan memiliki peran penting dalam sejarah lokal di wilayah Bojongsari.
            Dulu, desa ini menjadi tempat persinggahan bagi para pelancong yang melewati Sungai Klawing. Kini, Desa Banjaran berkembang menjadi desa wisata yang mengedepankan nilai budaya dan alam yang masih alami.
        </p>
    </div>
</section>

<!-- Section: Statistik -->
<section class="py-5" style="background-color: #FFFFFF;">
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
                <div class="col-md-3 mb-4 mb-md-0">
                    <h3 class="display-6 fw-bold"><?= $stat[0] ?></h3>
                    <p class="fs-5 fw-semibold mb-0"><?= $stat[1] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Section: Testimoni -->
<section class="py-5" style="background-color: #EEEFE0;">
    <div class="container">
        <h2 class="fw-bold text-center mb-5">Testimoni Masyarakat</h2>
        <div class="row g-4 justify-content-center">
            <?php
            $testimoni = [
                ['img' => 'ProfesorWidi.jpg', 'nama' => 'Pak Joko', 'pesan' => 'Desa Banjaran sangat ramah dan bersih. Saya bangga menjadi bagian dari desa ini.'],
                ['img' => 'ProfesorWidi.jpg', 'nama' => 'Bu Sari', 'pesan' => 'Wisata di desa ini sangat menarik. Anak-anak sangat senang berkunjung ke hutan pinus.'],
                ['img' => 'ProfesorWidi.jpg', 'nama' => 'Mas Bayu', 'pesan' => 'Fasilitas desa sangat lengkap dan cocok untuk kegiatan kampus maupun komunitas.']
            ];
            foreach ($testimoni as $t): ?>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm text-center p-4">
                        <img src="<?= base_url('img/' . $t['img']) ?>" class="rounded-circle mx-auto mb-3" alt="<?= $t['nama'] ?>" width="80" height="80" style="object-fit: cover;">
                        <h6 class="fw-bold"><?= $t['nama'] ?></h6>
                        <p class="text-muted fst-italic mt-2">"<?= $t['pesan'] ?>"</p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<?= $this->endSection() ?>