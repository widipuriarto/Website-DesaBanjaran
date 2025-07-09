<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login - Desa Wisata Banjaran</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        .loginGoogle:hover {
            background-color:rgb(232, 232, 232) !important;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow rounded-4">
                    <div class="card-body text-center rounded-top-4" style="background-color: #819A91;">
                        <h1 class="fs-4 fw-bold text-white my-2">Login</h1>
                    </div>
                    <div class="card-body p-5">
                        <?php if (session()->getFlashdata('error')) : ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                        <?php endif; ?>
                        <form method="post" action="<?= base_url('/login') ?>">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <button type="submit" class="btn w-100 text-white mt-3 tombolLogin" style="background-color: #819A91;">Login</button>
                            <div class="text-center mt-3">
                                <hr>
                                <a href="<?= base_url('auth-google') ?>" class="btn w-100 mt-2 loginGoogle" style="background-color: white; border: 1px solid #ccc;">
                                    <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google" style="width: 20px; margin-right: 10px;">
                                    Login dengan Google
                                </a>
                            </div>

                        </form>

                        <div class="text-center mt-3">
                            <small>Belum punya akun? <a href="<?= base_url('/register') ?>" class="registrasi">Daftar di sini</a></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>