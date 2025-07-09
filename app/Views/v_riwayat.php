<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container py-5">
    <h2 class="mb-4 fw-bold text-center text-md-start">Riwayat Pemesanan</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php if (empty($riwayat)): ?>
        <p class="text-muted text-center">Belum ada pemesanan.</p>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-nowrap">
                <thead class="table-light">
                    <tr>
                        <th>Paket</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Bukti</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($riwayat as $r): ?>
                        <tr>
                            <td><?= esc($r['paket_id']) ?></td>
                            <td><?= esc($r['tanggal_pemesanan']) ?></td>
                            <td><?= esc($r['jumlah_orang']) ?> orang</td>
                            <td>Rp <?= number_format($r['total_harga'], 0, ',', '.') ?></td>
                            <td>
                                <span class="badge bg-secondary"><?= esc($r['status']) ?></span>
                            </td>
                            <td>
                                <?php if ($r['bukti_pembayaran']): ?>
                                    <a href="<?= base_url('uploads/bukti/' . $r['bukti_pembayaran']) ?>" target="_blank" class="btn btn-sm lihat">Lihat</a>
                                <?php elseif ($r['status'] === 'pending'): ?>
                                    <form action="<?= base_url('upload-bukti/' . $r['id']) ?>" method="post" enctype="multipart/form-data" class="d-grid gap-2">
                                        <?= csrf_field() ?>
                                        <input type="file" name="bukti" class="form-control form-control-sm" required>
                                        <button type="submit" class="btn btn-sm">Upload</button>
                                    </form>
                                <?php else: ?>
                                    <em>-</em>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>