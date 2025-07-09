<?= $this->extend('admin/layout_dashboard') ?>
<?= $this->section('content') ?>

<h2 class="fw-bold mb-4">Kelola Pesan</h2>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-success text-center">
            <tr>
                <th width="5%">No</th>
                <th width="15%">Nama</th>
                <th width="15%">Email</th>
                <th width="15%">Subjek</th>
                <th>Pesan</th>
                <th width="15%">Tanggal</th>
                <th width="10%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pesan as $i => $p): ?>
                <tr>
                    <td class="text-center"><?= $i + 1 ?></td>
                    <td><?= esc($p['name']) ?></td>
                    <td><?= esc($p['email']) ?></td>
                    <td><?= esc($p['subject']) ?></td>
                    <td><?= esc($p['message']) ?></td>
                    <td class="text-center">
                        <?= $p['created_at'] ? date('d M Y H:i', strtotime($p['created_at'])) : '-' ?>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-sm text-white" style="background-color: #819A91;" data-bs-toggle="modal" data-bs-target="#modalDelete<?= $p['id'] ?>">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<!-- Modal Delete (diletakkan di luar table) -->
<?php foreach ($pesan as $p): ?>
    <div class="modal fade" id="modalDelete<?= $p['id'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form class="modal-content" action="<?= base_url('admin/pesan/delete/' . $p['id']) ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-header text-dark" style="background-color: #d1e7dd;">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Yakin ingin menghapus pesan dari <strong><?= esc($p['name']) ?></strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white" style="background-color: #819A91;">Hapus</button>
                </div>
            </form>
        </div>
    </div>
<?php endforeach; ?>

<?= $this->endSection() ?>