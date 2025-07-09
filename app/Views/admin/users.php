<?= $this->extend('admin/layout_dashboard') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Kelola User</h4>
    <button class="btn btn-sm text-white" style="background-color: #819A91;" data-bs-toggle="modal" data-bs-target="#addUserModal">
        <i class="bi bi-plus-circle me-1"></i> Tambah User
    </button>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-success">
            <tr class="text-center">
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($users as $user): ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td class="text-center"><?= esc($user['name'] ?? '-') ?></td>
                    <td class="text-center"><?= esc($user['username']) ?></td>
                    <td class="text-center"><?= esc($user['email'] ?? '-') ?></td>
                    <td class="text-center"><span class="badge bg-secondary"><?= esc($user['role']) ?></span></td>
                    
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<!-- Modal Tambah User -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?= base_url('admin/users/create') ?>" method="post">
        <?= csrf_field() ?>
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="addUserModalLabel">Tambah User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Role</label>
                    <select name="role" class="form-control" required>
                        <option value="admin">Admin</option>
                        <option value="member">Member</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label>Nama</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="mb-2">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-success">Simpan</button>
            </div>
        </div>
    </form>
  </div>
</div>

<?= $this->endSection() ?>
