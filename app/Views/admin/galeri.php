<?= $this->extend('admin/layout_dashboard') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Kelola Galeri</h4>
    <button class="btn btn-sm text-white" style="background-color: #819A91;" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-circle me-1"></i> Tambah Galeri
    </button>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php elseif (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<div class="table-responsive">
    <table class="table table-bordered align-middle text-center">
        <thead class="table-success">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($galeri as $g): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($g['title']) ?></td>
                    <td><img src="<?= base_url('img/' . $g['image']) ?>" width="100" class="rounded"></td>
                    <td>
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <button class="btn btn-sm text-white" style="background-color: #819A91;" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $g['id'] ?>">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-sm text-white" style="background-color: #819A91;" data-bs-toggle="modal" data-bs-target="#modalDelete<?= $g['id'] ?>">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" action="<?= base_url('admin/galeri/create') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="modal-header text-dark" style="background-color: #d1e7dd;">
                <h5 class="modal-title">Tambah Galeri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Judul Gambar</label>
                    <input type="text" class="form-control" name="title" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Upload Gambar</label>
                    <input type="file" class="form-control" name="image" accept="image/*" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn text-white" style="background-color: #819A91;">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit & Delete (di luar tabel) -->
<?php foreach ($galeri as $g): ?>
    <!-- Edit Modal -->
    <div class="modal fade" id="modalEdit<?= $g['id'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" action="<?= base_url('admin/galeri/update/' . $g['id']) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-header text-dark" style="background-color: #d1e7dd;">
                    <h5 class="modal-title">Edit Galeri</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" class="form-control" name="title" value="<?= esc($g['title']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar Saat Ini</label><br>
                        <img src="<?= base_url('img/' . $g['image']) ?>" width="100" class="rounded mb-2">
                        <input type="file" class="form-control" name="image" accept="image/*">
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                    <button class="btn text-white" style="background-color: #819A91;">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Delete -->
        <div class="modal fade" id="modalDelete<?= $g['id'] ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form action="<?= base_url('admin/galeri/delete/' . $g['id']) ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="modal-content">
                        <div class="modal-header text-dark" style="background-color: #d1e7dd;">
                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            Yakin ingin menghapus <strong><?= esc($g['title']) ?></strong>?
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                            <button class="btn text-white" style="background-color: #819A91;">Hapus</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <?php endforeach; ?>

    <?= $this->endSection() ?>