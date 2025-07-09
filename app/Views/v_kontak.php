<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<section id="kontak" class="py-5" style="background-color: #FFFFFF;">
    <div class="container">
        <h2 class="text-center fw-bold fs-1 mb-5">Hubungi Kami</h2>

        <div class="row g-5">
            <!-- Kiri: Informasi Kontak -->
            <div class="col-md-5">
                <h4 class="fw-semibold">Desa Wisata Banjaran</h4>
                <p class="text-muted">
                    Jl. Raya Banjaran No. 1, Kecamatan Bojongsari, Kabupaten Purbalingga, Jawa Tengah.
                </p>
                <p class="mb-1"><strong>WhatsApp:</strong> <a href="https://wa.me/6282135426245" class="text-decoration-none text-success">0821-3542-6245</a></p>
                <p class="mb-1"><strong>Email:</strong> info@desabanjaran.com</p>
                <p class="mb-1"><strong>Instagram:</strong> @desabanjaran</p>

                <div class="mt-4">
                    <iframe src="https://www.google.com/maps?q=Desa+Banjaran,+Bojongsari,+Purbalingga,+Jawa+Tengah&output=embed"
                        width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

            <!-- Kanan: Form Kontak -->
            <div class="col-md-7">

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>

                <form action="<?= site_url('kontak/kirim') ?>" method="post" class="shadow p-4 bg-light rounded">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Aktif</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="subjek" class="form-label">Subjek</label>
                        <input type="text" class="form-control" id="subjek" name="subject" required>
                    </div>
                    <div class="mb-3">
                        <label for="pesan" class="form-label">Pesan</label>
                        <textarea class="form-control" id="pesan" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-palette">Kirim Pesan</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>