<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMMAS - Sistem Manajemen Magang Siswa
    </title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">

</head>

<body>
    <div class="d-flex align-items-center justify-content-center mt-4">
        <div class="card shadow-sm login-card p-4">
            <div class="card-body">

                <div class="text-center">
                    <div class="icon-circle">
                        <i class="bi bi-person"></i>
                    </div>
                    <h4 class="fw-bold mb-1">Welcome Back</h4>
                    <p class="text-muted mb-4">Sign in to your account</p>
                </div>

                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger text-center">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif ?>

                <form action="<?= base_url('login') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3 position-relative">
                        <label>Email Address</label>
                        <i class="bi bi-envelope input-icon"></i>
                        <input type="email" name="email" value="<?= old('email') ?>" class="form-control" placeholder="Enter your email" required>
                    </div>

                    <div class="mb-4 position-relative">
                        <label>Password</label>
                        <i class="bi bi-lock input-icon"></i>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                        <span
                            class="toggle-icon"
                            style="cursor: pointer;"
                            onclick="togglePassword()">
                            <i class="bi bi-eye" id="toggleIcon"></i>
                        </span>
                    </div>

                    <button class="btn btn-primary w-100 py-2 rounded-pill">
                        Sign In
                    </button>
                </form>

                <p class="text-center mt-3 mb-0">
                    Don’t have an account?
                    <a href="<?= base_url('register') ?>" class="fw-semibold text-decoration-none">
                        Sign up
                    </a>
                </p>

            </div>
        </div>
    </div>
    <div class="small-text d-flex align-items-center justify-content-center">
        <p class="text-center small">
            By signing in, you agree to our
            <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">
                Terms of Service
            </a>
            and
            <a href="#" data-bs-toggle="modal" data-bs-target="#privacyModal">
                Privacy Policy
            </a>
        </p>
    </div>
    <div class="modal fade" id="termsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Terms of Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p>
                        Dengan menggunakan aplikasi <strong>SIMMAS</strong>, Anda menyetujui ketentuan berikut:
                    </p>
                    <ul>
                        <li>Akun hanya digunakan untuk keperluan magang</li>
                        <li>Pengguna bertanggung jawab atas keamanan akun</li>
                        <li>Dilarang menyalahgunakan sistem</li>
                        <li>Admin berhak menonaktifkan akun jika melanggar aturan</li>
                    </ul>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="privacyModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Privacy Policy</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p>
                        Kami menghargai privasi pengguna <strong>SIMMAS</strong>.
                    </p>
                    <ul>
                        <li>Email dan data pribadi tidak dibagikan ke pihak lain</li>
                        <li>Password disimpan dalam bentuk terenkripsi</li>
                        <li>Data hanya digunakan untuk keperluan sistem</li>
                    </ul>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Tutup
                    </button>
                </div>

            </div>
        </div>
    </div>

</body>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('bi-eye');
            toggleIcon.classList.add('bi-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('bi-eye-slash');
            toggleIcon.classList.add('bi-eye');
        }
    }
</script>
<script src="<?= base_url('assets/js/login.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>