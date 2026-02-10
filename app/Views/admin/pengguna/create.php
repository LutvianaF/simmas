<?= $this->extend('admin/template/template') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h4 class="fw-bold">Tambah User Baru</h4>
    <small>Lengkapi semua informasi yang diperlukan</small>

    <div class="card p-3 card-hero-dash modal-content mt-3">
        <form action="<?= base_url('admin/pengguna/store') ?>" method="post">
            <div class="mb-3">
                <label class="form-label">Nama Lengkap *</label>
                <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email *</label>
                <input type="email" name="email" class="form-control" placeholder="Contoh: user@email.com" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Role *</label>
                <select name="role" class="form-select" required>
                    <option value="admin">Admin</option>
                    <option value="guru">Guru</option>
                    <option value="siswa" selected>Siswa</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Password *</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password (min. 6 karakter)" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Konfirmasi Password *</label>
                <input type="password" name="password_confirm" class="form-control" placeholder="Ulangi password" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email Verification *</label>
                <select name="email_verified" class="form-select" required>
                    <option value="0" selected>Unverified</option>
                    <option value="1">Verified</option>
                </select>
            </div>
            <div class="d-flex justify-content-end modal-footer">
                <a href="<?= base_url('admin/pengguna') ?>" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>