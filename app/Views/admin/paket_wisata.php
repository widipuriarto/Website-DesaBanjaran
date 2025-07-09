<?= $this->extend('admin/layout_dashboard') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Kelola Paket Wisata</h4>
    <button class="btn btn-sm text-white" style="background-color: #819A91;" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-circle me-1"></i> Tambah Paket
    </button>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<div class="table-responsive">
    <table class="table table-bordered align-middle">
        <thead class="table-success text-center align-middle">
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Durasi</th>
                <th>Min. Orang</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($paket as $p): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><img src="<?= base_url('img/' . $p['image']) ?>" alt="gambar" width="100" class="img-thumbnail"></td>
                    <td><?= esc($p['title']) ?></td>
                    <td><?= esc($p['description']) ?></td>
                    <td><?= esc($p['duration']) ?> hari</td>
                    <td><?= esc($p['min_person']) ?> orang</td>
                    <td>Rp <?= number_format($p['price'], 0, ',', '.') ?></td>
                    <td>
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <button class="btn btn-sm text-white" style="background-color: #819A91;" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $p['id'] ?>">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-sm text-white" style="background-color: #819A91;" data-bs-toggle="modal" data-bs-target="#modalDelete<?= $p['id'] ?>">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>

                <!-- Modal Edit -->
                <div class="modal fade" id="modalEdit<?= $p['id'] ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <form action="<?= base_url('admin/paket-wisata/update/' . $p['id']) ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="modal-content">
                                <div class="modal-header text-white" style="background-color: #d1e7dd;">
                                    <h5 class="modal-title text-dark">Edit Paket Wisata</h5>
                                    <button class="btn-close" data-bs-dismiss="modal" type="button"></button>
                                </div>
                                <div class="modal-body row g-3">
                                    <div class="col-md-6">
                                        <label>Judul Paket</label>
                                        <input type="text" name="title" value="<?= esc($p['title']) ?>" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Durasi (hari)</label>
                                        <input type="number" name="duration" value="<?= esc($p['duration']) ?>" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Minimal Orang</label>
                                        <input type="number" name="min_person" value="<?= esc($p['min_person']) ?>" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Harga (Rp)</label>
                                        <input type="number" name="price" value="<?= esc($p['price']) ?>" class="form-control" required>
                                    </div>
                                    <div class="col-12">
                                        <label>Deskripsi</label>
                                        <textarea name="description" class="form-control" rows="3" required><?= esc($p['description']) ?></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label>Gambar Baru (Opsional)</label>
                                        <input type="file" name="image" class="form-control" accept="image/*">
                                        <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar</small>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                                    <button class="btn text-white" style="background-color: #819A91;">Simpan Perubahan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modal Delete -->
                <div class="modal fade" id="modalDelete<?= $p['id'] ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="<?= base_url('admin/paket-wisata/delete/' . $p['id']) ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="modal-content">
                                <div class="modal-header text-dark" style="background-color: #d1e7dd;">
                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Yakin ingin menghapus <strong><?= esc($p['title']) ?></strong>?</p>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                                    <button class="btn text-white" style="background-color: #819A91;">Hapus</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            <?php endforeach ?>
        </tbody>
    </table>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="<?= base_url('admin/paket-wisata/create') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="modal-content">
                <div class="modal-header text-dark" style="background-color: #d1e7dd;">
                    <h5 class="modal-title">Tambah Paket Wisata</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label>Judul Paket</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Durasi (hari)</label>
                        <input type="number" name="duration" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Minimal Orang</label>
                        <input type="number" name="min_person" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label>Harga (Rp)</label>
                        <input type="number" name="price" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label>Deskripsi</label>
                        <textarea name="description" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="col-12">
                        <label>Gambar</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white" style="background-color: #819A91;">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>