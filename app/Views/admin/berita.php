<?= $this->extend('admin/layout_dashboard') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Kelola Berita</h4>
    <button class="btn btn-sm text-white" style="background-color: #819A91;" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-circle me-1"></i> Tambah Berita
    </button>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php elseif (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>

<!-- Tabel -->
<div class="table-responsive">
    <table class="table table-bordered align-middle table-striped">
        <thead class="table-success text-center">
            <tr>
                <th width="5%">No</th>
                <th width="20%">Judul</th>
                <th width="30%">Isi</th>
                <th width="15%">Gambar</th>
                <th width="10%">Tanggal</th>
                <th width="10%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php helper('text'); ?>
            <?php foreach ($berita as $i => $b): ?>
                <tr>
                    <td class="text-center"><?= $i + 1 ?></td>
                    <td><?= esc($b['judul']) ?></td>
                    <td><?= word_limiter(strip_tags($b['isi']), 20) ?></td>
                    <td class="text-center">
                        <img src="<?= base_url('img/' . $b['gambar']) ?>" width="100" class="img-thumbnail">
                    </td>
                    <td class="text-center"><?= $b['tanggal'] ?></td>
                    <td class="text-center">
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <button class="btn btn-sm text-white" style="background-color: #819A91;" data-bs-toggle="modal" data-bs-target="#editModal<?= $b['id'] ?>">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button class="btn btn-sm text-white" style="background-color: #819A91;" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $b['id'] ?>">
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
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-top">
        <form class="modal-content" action="<?= base_url('admin/berita/create') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="modal-header text-dark" style="background-color: #d1e7dd;">
                <h5 class="modal-title">Tambah Berita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Isi</label>
                    <textarea name="isi" class="form-control" rows="5" required></textarea>
                </div>
                <div class="mb-3">
                    <label>Gambar</label>
                    <input type="file" name="gambar" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn text-white" style="background-color: #819A91;">Tambah Berita</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit dan Delete -->
<?php foreach ($berita as $b): ?>
    <!-- Modal Edit -->
    <div class="modal fade" id="editModal<?= $b['id'] ?>" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-top">
            <form class="modal-content" action="<?= base_url('admin/berita/update/' . $b['id']) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-header text-dark" style="background-color: #d1e7dd;">
                    <h5 class="modal-title">Edit Berita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Judul</label>
                        <input type="text" name="judul" value="<?= esc($b['judul']) ?>" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Isi</label>
                        <textarea name="isi" class="form-control" rows="5" required><?= esc($b['isi']) ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Ganti Gambar (Opsional)</label>
                        <input type="file" name="gambar" class="form-control">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn text-white" style="background-color: #819A91;">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="deleteModal<?= $b['id'] ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" action="<?= base_url('admin/berita/delete/' . $b['id']) ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-header text-dark" style="background-color: #d1e7dd;">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Yakin ingin menghapus <strong><?= esc($b['judul']) ?></strong>?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
                    <button class="btn text-white" style="background-color: #819A91;">Hapus</button>
                </div>
            </form>
        </div>
    </div>
<?php endforeach ?>

<?= $this->endSection() ?>
