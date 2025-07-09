<?= $this->extend('admin/layout_dashboard') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Kelola Transaksi</h4>
    <button class="btn btn-sm text-white" style="background-color: #819A91;" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-circle me-1"></i> Tambah Transaksi
    </button>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php elseif (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>
<!-- Filter & Cetak -->
<form class="row g-2 mb-3" id="filterForm" action="<?= base_url('admin/transaksi/laporan') ?>" method="get">
    <div class="col-md-3">
        <input type="date" name="dari" id="dari" class="form-control" required value="<?= esc($_GET['dari'] ?? '') ?>">
    </div>
    <div class="col-md-3">
        <input type="date" name="sampai" id="sampai" class="form-control" required value="<?= esc($_GET['sampai'] ?? '') ?>">
    </div>
    <div class="col-auto">
        <button class="btn btn-success" type="submit">
            <i class="bi bi-search"></i> Tampilkan
        </button>
    </div>
    <div class="col-auto">
        <button class="btn btn-danger" type="button" id="cetakPDF">
            <i class="bi bi-file-earmark-pdf"></i> Cetak PDF
        </button>
    </div>
</form>

<script>
    document.getElementById("cetakPDF").addEventListener("click", function() {
        const dari = document.getElementById("dari").value;
        const sampai = document.getElementById("sampai").value;

        if (dari && sampai) {
            const url = `<?= base_url('admin/transaksi/cetak-pdf') ?>?dari=${dari}&sampai=${sampai}`;
            window.open(url, '_blank'); // buka tab baru
        } else {
            alert("Harap pilih tanggal terlebih dahulu.");
        }
    });
</script>


<!-- Tabel -->
<div class="table-responsive">
    <table class="table table-bordered align-middle">
        <thead class="table-success text-center">
            <tr>
                <th>No</th>
                <th>Member</th>
                <th>Paket</th>
                <th>Tanggal</th>
                <th>Jumlah Orang</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Metode</th>
                <th>Bukti</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($transaksi as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($row['nama_member']) ?></td>
                    <td><?= esc($row['nama_paket']) ?></td>
                    <td><?= esc($row['tanggal_pemesanan']) ?></td>
                    <td class="text-center"><?= esc($row['jumlah_orang']) ?></td>
                    <td>Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                    <td class="text-center"><span class="badge bg-secondary"><?= esc($row['status']) ?></span></td>
                    <td><?= esc($row['metode_pembayaran']) ?></td>
                    <td class="text-center">
                        <?php if ($row['bukti_pembayaran']): ?>
                            <a href="<?= base_url('uploads/bukti/' . $row['bukti_pembayaran']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i> Lihat
                            </a>
                        <?php else: ?>
                            <span class="text-muted">-</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            <button class="btn btn-sm text-white" style="background-color: #819A91;" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row['id'] ?>">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button class="btn btn-sm text-white" style="background-color: #819A91;" data-bs-toggle="modal" data-bs-target="#modalDelete<?= $row['id'] ?>">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <form action="<?= base_url('admin/transaksi/create') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-header text-white" style="background-color: #819A91;">
                    <h5 class="modal-title">Tambah Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label>Member</label>
                        <select name="member_id" class="form-select" required>
                            <option value="">Pilih Member</option>
                            <?php foreach ($members as $m): ?>
                                <option value="<?= $m['id'] ?>"><?= esc($m['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Paket Wisata</label>
                        <select name="paket_id" class="form-select" required>
                            <option value="">Pilih Paket</option>
                            <?php foreach ($paket as $p): ?>
                                <option value="<?= $p['id'] ?>"><?= esc($p['title']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal_pemesanan" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label>Jumlah Orang</label>
                        <input type="number" name="jumlah_orang" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label>Total Harga</label>
                        <input type="number" name="total_harga" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Status</label>
                        <select name="status" class="form-select" required>
                            <option value="pending">Pending</option>
                            <option value="menunggu">Menunggu</option>
                            <option value="diterima">Diterima</option>
                            <option value="ditolak">Ditolak</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Metode Pembayaran</label>
                        <input type="text" name="metode_pembayaran" class="form-control" required>
                    </div>
                    <div class="col-md-12">
                        <label>Bukti Pembayaran</label>
                        <input type="file" name="bukti_pembayaran" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white" style="background-color: #819A91;">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php foreach ($transaksi as $row): ?>
    <!-- Modal Edit -->
    <div class="modal fade" id="modalEdit<?= $row['id'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <form action="<?= base_url('admin/transaksi/update/' . $row['id']) ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="modal-header text-white" style="background-color: #819A91;">
                        <h5 class="modal-title">Edit Transaksi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body row g-3">
                        <!-- Member -->
                        <div class="col-md-6">
                            <label>Member</label>
                            <select name="member_id" class="form-select" required>
                                <?php foreach ($members as $m): ?>
                                    <option value="<?= $m['id'] ?>" <?= $m['id'] == $row['member_id'] ? 'selected' : '' ?>>
                                        <?= esc($m['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Paket -->
                        <div class="col-md-6">
                            <label>Paket Wisata</label>
                            <select name="paket_id" class="form-select" required>
                                <?php foreach ($paket as $p): ?>
                                    <option value="<?= $p['id'] ?>" <?= $p['id'] == $row['paket_id'] ? 'selected' : '' ?>>
                                        <?= esc($p['title']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Tanggal -->
                        <div class="col-md-4">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal_pemesanan" class="form-control" value="<?= esc($row['tanggal_pemesanan']) ?>" required>
                        </div>

                        <!-- Jumlah Orang -->
                        <div class="col-md-4">
                            <label>Jumlah Orang</label>
                            <input type="number" name="jumlah_orang" class="form-control" value="<?= esc($row['jumlah_orang']) ?>" required>
                        </div>

                        <!-- Total Harga -->
                        <div class="col-md-4">
                            <label>Total Harga</label>
                            <input type="number" name="total_harga" class="form-control" value="<?= esc($row['total_harga']) ?>" required>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <label>Status</label>
                            <select name="status" class="form-select" required>
                                <option value="pending" <?= $row['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="menunggu" <?= $row['status'] == 'menunggu' ? 'selected' : '' ?>>Menunggu</option>
                                <option value="diterima" <?= $row['status'] == 'diterima' ? 'selected' : '' ?>>Diterima</option>
                                <option value="ditolak" <?= $row['status'] == 'ditolak' ? 'selected' : '' ?>>Ditolak</option>
                            </select>
                        </div>

                        <!-- Metode Pembayaran -->
                        <div class="col-md-6">
                            <label>Metode Pembayaran</label>
                            <input type="text" name="metode_pembayaran" class="form-control" value="<?= esc($row['metode_pembayaran']) ?>" required>
                        </div>

                        <!-- Bukti Pembayaran -->
                        <div class="col-md-12">
                            <label>Ganti Bukti Pembayaran (Opsional)</label>
                            <input type="file" name="bukti_pembayaran" class="form-control">
                            <?php if ($row['bukti_pembayaran']): ?>
                                <small class="text-muted">Bukti saat ini: <?= esc($row['bukti_pembayaran']) ?></small>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn text-white" style="background-color: #819A91;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>


<?php foreach ($transaksi as $row): ?>
    <!-- Modal Delete -->
    <div class="modal fade" id="modalDelete<?= $row['id'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="<?= base_url('admin/transaksi/delete/' . $row['id']) ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="modal-header text-white" style="background-color: #819A91;">
                        <h5 class="modal-title">Hapus Transaksi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        Yakin ingin menghapus transaksi dari <strong><?= esc($row['nama_member']) ?></strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn text-white" style="background-color: #819A91;">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Total Pendapatan -->
<?php if (isset($totalDiterima)): ?>
    <div class="alert alert-info">
        <strong>Total Pendapatan:</strong> Rp <?= number_format($totalDiterima, 0, ',', '.') ?>
    </div>
<?php endif; ?>

<?= $this->endSection() ?>