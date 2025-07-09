<?= $this->extend('admin/layout_dashboard') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Kelola Video</h2>
    <button class="btn text-white" style="background-color: #819A91;" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-circle me-1"></i> Tambah Video
    </button>
</div>

<!-- Flashdata -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<div class="table-responsive">
    <table class="table table-bordered text-center align-middle">
        <thead class="table-success">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Link / Preview</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($videos as $v): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($v['title']) ?></td>
                    <td>
                        <iframe width="200" height="120" src="<?= esc($v['youtube_url']) ?>" frameborder="0" allowfullscreen></iframe>
                    </td>
                    <td>
                        <div class="d-flex flex-wrap justify-content-center gap-2">
                            <button class="btn btn-sm text-white" style="background-color: #819A91;" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $v['id'] ?>">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-sm text-white" style="background-color: #819A91;" data-bs-toggle="modal" data-bs-target="#modalDelete<?= $v['id'] ?>">
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
    <div class="modal-dialog">
        <form class="modal-content" action="<?= base_url('admin/video/create') ?>" method="post">
            <?= csrf_field() ?>
            <div class="modal-header text-dark" style="background-color: #d1e7dd;">
                <h5 class="modal-title">Tambah Video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="title" class="form-label">Judul Video</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="youtube_url" class="form-label">Embed YouTube Link</label>
                    <input type="text" name="youtube_url" class="form-control" required>
                    <small class="text-muted">Contoh: https://www.youtube.com/embed/VIDEO_ID</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn text-white" style="background-color: #819A91;">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit & Delete -->
<?php foreach ($videos as $v): ?>
    <!-- Modal Edit -->
    <div class="modal fade" id="modalEdit<?= $v['id'] ?>" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" action="<?= base_url('admin/video/update/' . $v['id']) ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-header text-dark" style="background-color: #d1e7dd;">
                    <h5 class="modal-title">Edit Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul</label>
                        <input type="text" name="title" class="form-control" value="<?= esc($v['title']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="youtube_url" class="form-label">Embed YouTube Link</label>
                        <input type="text" name="youtube_url" class="form-control" value="<?= esc($v['youtube_url']) ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white" style="background-color: #819A91;">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="modalDelete<?= $v['id'] ?>" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" action="<?= base_url('admin/video/delete/' . $v['id']) ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-header text-dark" style="background-color: #d1e7dd;">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    Yakin ingin menghapus video <strong><?= esc($v['title']) ?></strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white" style="background-color: #819A91;">Hapus</button>
                </div>
            </form>
        </div>
    </div>
<?php endforeach ?>

<?= $this->endSection() ?>