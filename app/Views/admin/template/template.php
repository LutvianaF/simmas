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
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>

<body>
    <div class="app d-flex">

        <!-- ===================== SIDEBAR ===================== -->
        <ul id="accordionSidebar" class="navbar-nav sidebar sidebar-dark accordion">

            <!-- Brand -->
            <a class="sidebar-brand d-flex align-items-center gap-2" href="<?= base_url('admin/dashboard') ?>">
                <div class="sidebar-brand-icon">
                    <i class="bi bi-mortarboard-fill fs-4"></i>
                </div>
                <div class="sidebar-brand-text text-start">
                    <div class="fw-bold">SIMMAS</div>
                    <small class="text-muted">Panel Admin</small>
                </div>
            </a>

            <hr class="sidebar-divider my-2">

            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2 <?= url_is('admin/dashboard') ? 'active' : '' ?>"
                    href="<?= base_url('admin/dashboard') ?>">
                    <i class="bi bi-grid fs-5"></i>
                    <div>
                        <div class="fw-semibold">Dashboard</div>
                        <small>Ringkasan sistem</small>
                    </div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2 <?= url_is('admin/dudi*') ? 'active' : '' ?>"
                    href="<?= base_url('admin/dudi') ?>">
                    <i class="bi bi-building fs-5"></i>
                    <div>
                        <div class="fw-semibold">DUDI</div>
                        <small>Manajemen DUDI</small>
                    </div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2 <?= url_is('admin/pengguna*') ? 'active' : '' ?>"
                    href="<?= base_url('admin/pengguna') ?>">
                    <i class="bi bi-people fs-5"></i>
                    <div>
                        <div class="fw-semibold">Pengguna</div>
                        <small>Manajemen user</small>
                    </div>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2 <?= url_is('admin/pengaturan*') ? 'active' : '' ?>"
                    href="<?= base_url('admin/pengaturan') ?>">
                    <i class="bi bi-gear fs-5"></i>
                    <div>
                        <div class="fw-semibold">Pengaturan</div>
                        <small>Konfigurasi sistem</small>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2" href="<?= base_url('login') ?>">
                    <i class="bi bi-box-arrow-right fs-5"></i>
                    <div>
                        <div class="fw-semibold">Logout</div>
                    </div>
                </a>
            </li>

            <hr class="sidebar-divider mt-auto">
            <div class="sidebar-footer d-flex align-items-center gap-2 mb-3">
                <i class="bi bi-record-fill"></i>
                <div>
                    <div class="fw-semibold">SMK Negeri 1 Ampelgading</div>
                    <small class="text-white"> Sistem Pelaporan v1.0</small>
                </div>
            </div>

        </ul>
        <div class="flex-grow-1">
            <nav class="navbar navbar-expand navbar-light bg-white shadow-sm">
                <div class="d-flex flex-column">
                    <span class="fw-bold">SMK Negeri 1 Ampelgading</span>
                    <small class="text-muted">Sistem Manajemen Magang Siswa</small>
                </div>
                <ul class="navbar-nav ms-auto align-items-center">

                    <li class="nav-item d-flex align-items-center">
                        <i class="bi bi-person"></i>
                        <div class="text-start">
                            <div class="fw-semibold">Admin Sistem</div>
                            <small class="text-muted">Admin</small>
                        </div>
                    </li>

                </ul>

            </nav>
            <main class="container-fluid mb-4">
                <?= $this->renderSection('content') ?>
            </main>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>