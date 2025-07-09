<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi - Desa Wisata Banjaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/styleLoginRegister.css') ?>">
    <style>
        body {
            background-color: #EEEFE0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .registrasi {
            color: #819A91;
            text-decoration: none;
        }

        .registrasi:hover {
            color: #A7C1A8;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow rounded-4">
                    <!-- Header Card -->
                    <div class="card-body text-center rounded-top-4" style="background-color: #819A91;">
                        <h5 class="fw-semibold text-white my-2">Selamat Datang di Website Desa Banjaran</h5>
                    </div>

                    <!-- Form Card -->
                    <div class="card-body p-4">
                        <h4 class="text-center mb-3 fw-bold" style="color: #819A91;">Form Registrasi</h4>

                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>

                        <form method="post" action="<?= base_url('/register') ?>">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Aktif</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Nomor HP / WhatsApp</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>

                            <button type="submit" class="btn w-100 text-white tombolDaftar" style="background-color: #819A91;">Daftar</button>
                        </form>

                        <div class="text-center mt-3">
                            <small>Sudah punya akun? <a href="<?= base_url('/login') ?>" class="registrasi">Login</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>