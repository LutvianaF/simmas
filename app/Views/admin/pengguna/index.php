<?= $this->extend('admin/template/template') ?>
<?= $this->section('content') ?>
<div class="container mt-4">
    <h4 class="fw-bold mb-3">Manajemen Pengguna</h4>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif ?>

    <div class="card p-3 card-hero-dash">
        <div class="d-flex justify-content-between mb-3">
            <span class="fw-bold"><i class="bi bi-people fs-5 me1 icon-purple me-1"></i>Daftar Pengguna</span>
            <a href="<?= base_url('admin/pengguna/create') ?>"
                class="btn btn-dudi">
                + Tambah Pengguna
            </a>
        </div>
        <div class="card-body pb-0 d-flex justify-content-between align-items-center">
            <div class="d-flex w-50">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="search"
                        id="searchPengguna"
                        class="form-control"
                        placeholder="Cari perusahaan, alamat, penanggung jawab...">
                </div>
            </div>
            <div class="d-flex">
                <div class="d-flex justify-content-end me-1">
                    <label class="me-2"><i class="bi bi-funnel"></i></label>
                    <select id="roleFilter" class="form-select form-select-sm" style="width:auto;">
                        <option value="">Semua role</option>
                        <option value="admin">Admin</option>
                        <option value="guru">Guru</option>
                        <option value="siswa">Siswa</option>
                    </select>
                </div>
                <div class="d-flex align-items-center">
                    <span class="me-2">Tampilkan:</span>
                    <select class="form-select form-select-sm me-1" style="width:auto;">
                        <option>5</option>
                        <option>10</option>
                        <option>15</option>
                    </select>
                    <span>entri</span>
                </div>
            </div>
        </div>


        <div class="card-body table-responsive align-middle">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Terdaftar</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody id="userTable">
                    <?php foreach ($users as $u): ?>
                        <?php $role = $u['role'] ?? 'siswa'; ?>
                        <tr data-role="<?= $role ?>">
                            <td class="fw-semibold"><i class="bi bi-person-hearts icon-purple me-1"></i><?= esc($u['name']) ?></td>
                            <td>
                                <div><i class="bi bi-envelope"></i> <?= esc($u['email']) ?></div>
                                <small class="text-success">
                                    <i class="bi bi-person-check"></i> Verified
                                </small>
                            </td>
                            <td><span class="badge badge-<?= $role ?>"><?= ucfirst($role) ?></span></td>
                            <td>
                                <?= $u['created_at']
                                    ? date('d M Y', strtotime($u['created_at']))
                                    : '-' ?>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/pengguna/edit/' . $u['id']) ?>" class="text-warning me-2">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="<?= base_url('admin/pengguna/delete/' . $u['id']) ?>"
                                    class="text-danger delete-btn"
                                    data-id="<?= $u['id'] ?>">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <?php
            $group = 'users';

            $currentPage = $pager->getCurrentPage($group) ?? 1;
            $perPage     = $pager->getPerPage($group) ?? count($users);
            $total       = $pager->getTotal($group) ?? count($users);

            $start = $total > 0 ? ($currentPage - 1) * $perPage + 1 : 0;
            $end   = min($start + $perPage - 1, $total);
            ?>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted small">
                    Menampilkan <?= $total > 0 ? $start : 0 ?>
                    – <?= $end ?>
                    dari <?= $total ?> data
                </div>
                <?php if ($total > $perPage): ?>
                    <?= $pager->links('users', 'bootstrap_pagination') ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div id="confirmBox" class="confirm-box">
        <div class="confirm-content">
            <h5>Konfirmasi Hapus</h5>
            <p>Apakah Anda yakin ingin menghapus data user ini?<br>
                <small class="text-muted">Tindakan ini tidak dapat dibatalkan.</small>
            </p>
            <div class="text-end">
                <button id="cancelBtn" class="btn btn-secondary btn-sm">Batal</button>
                <button id="confirmBtn" class="btn btn-danger btn-sm">Ya, Hapus</button>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const confirmBox = document.getElementById('confirmBox');
            const confirmBtn = document.getElementById('confirmBtn');
            const cancelBtn = document.getElementById('cancelBtn');
            let deleteUrl = '';

            // Tangkap klik tombol hapus
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    deleteUrl = this.getAttribute('href');
                    confirmBox.style.display = 'block';
                });
            });

            // Tombol batal
            cancelBtn.addEventListener('click', function() {
                confirmBox.style.display = 'none';
                deleteUrl = '';
            });

            // Tombol konfirmasi hapus
            confirmBtn.addEventListener('click', function() {
                if (deleteUrl) {
                    window.location.href = deleteUrl;
                }
            });
        });
    </script>
    <script>
        document.getElementById('searchPengguna').addEventListener('keyup', function() {
            const keyword = this.value.toLowerCase();
            const rows = document.querySelectorAll('#userTable tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(keyword) ? '' : 'none';
            });
        });
    </script>

    <script>
        document.getElementById('roleFilter').addEventListener('change', function() {
            const selectedRole = this.value;
            const rows = document.querySelectorAll('#userTable tr');

            rows.forEach(row => {
                const role = row.getAttribute('data-role');
                if (!selectedRole || role === selectedRole) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</div><?= $this->endSection() ?>