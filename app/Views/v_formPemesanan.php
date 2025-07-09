<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-5">
    <h2 class="text-center mb-5 fw-bold">Form Pemesanan</h2>

    <div class="row g-4 align-items-stretch mb-5">
        <!-- KIRI: Info Paket -->
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <img src="<?= base_url('img/' . $paket['image']) ?>" class="card-img-top" alt="<?= esc($paket['title']) ?>" style="height: 280px; object-fit: cover;">
                <div class="card-body d-flex flex-column">
                    <h4 class="fw-bold"><?= esc($paket['title']) ?></h4>
                    <p class="text-muted"><?= esc($paket['description']) ?></p>
                    <p class="mb-1 mt-3"><strong>Durasi:</strong> <?= esc($paket['duration']) ?></p>
                    <p class="mb-1"><strong>Minimal Peserta:</strong> <?= esc($paket['min_person']) ?> orang</p>
                    <h5 class="fw-bold text-palette mt-auto mb-3">Rp <?= number_format($paket['price'], 0, ',', '.') ?> / orang</h5>
                </div>
            </div>
        </div>

        <!-- KANAN: Form Pemesanan -->
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body p-4 d-flex flex-column">
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <form action="<?= base_url('pesan/simpan') ?>" method="post" id="formPemesanan">
                        <?= csrf_field() ?>
                        <input type="hidden" name="paket_id" value="<?= $paket['id'] ?>">
                        <input type="hidden" id="harga_per_orang" value="<?= $paket['price'] ?>">

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Pemesan</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= esc(session()->get('name')) ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Aktif</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= esc(session()->get('email')) ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="jumlah_orang" class="form-label">Jumlah Orang</label>
                            <input type="number" class="form-control" id="jumlah_orang" name="jumlah_orang" min="<?= $paket['min_person'] ?>" required min="1">
                        </div>

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal Pemesanan</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>

                        <div class="mb-3">
                            <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                            <select class="form-select" id="metode_pembayaran" name="metode_pembayaran" required>
                                <option value="">Pilih Metode</option>
                                <option value="BRI">Bank BRI</option>
                                <option value="BCA">Bank BCA</option>
                                <option value="MANDIRI">Bank Mandiri</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Total Harga</label>
                            <input type="text" id="total_harga" class="form-control" readonly style="font-weight: bold;">
                        </div>

                        <button type="submit" class="btn btn-palette w-100 mt-auto">Pesan Sekarang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script Hitung Total Harga -->
<script>
    document.getElementById('jumlah_orang').addEventListener('input', function() {
        const jumlah = parseInt(this.value) || 0;
        const harga = parseInt(document.getElementById('harga_per_orang').value);
        const total = jumlah * harga;

        document.getElementById('total_harga').value = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR'
        }).format(total);
    });
</script>

<?= $this->endSection() ?>