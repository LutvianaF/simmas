<?= $this->extend('admin/template/template') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h4 class="fw-bold">Edit User</h4>
    <small>Perbarui informasi user</small>

    <div class="card p-3 card-hero-dash modal-content mt-3">
        <form action="<?= base_url('admin/pengguna/update/' . $user['id']) ?>" method="post">
            <!-- Nama Lengkap -->
            <div class="mb-3">
                <label class="form-label">Nama Lengkap *</label>
                <input type="text" name="name"
                    value="<?= esc($user['name']) ?>"
                    class="form-control" placeholder="Masukkan nama lengkap" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email *</label>
                <input type="email" name="email"
                    value="<?= esc($user['email']) ?>"
                    class="form-control" placeholder="Contoh: user@email.com" required>
            </div>

            <!-- Role -->
            <div class="mb-3">
                <label class="form-label">Role *</label>
                <select name="role" class="form-select" required>
                    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="guru" <?= $user['role'] == 'guru' ? 'selected' : '' ?>>Guru</option>
                    <option value="siswa" <?= $user['role'] == 'siswa' ? 'selected' : '' ?>>Siswa</option>
                </select>
            </div>

            <!-- Catatan Password -->
            <div class="mb-3 bg-pw">
                <small class="text-primary">
                    <b>Catatan:</b>
                    Untuk mengubah password, silakan gunakan fitur reset password terpisah.
                </small>
            </div>

            <!-- Verifikasi Email -->
            <div class="mb-3">
                <label class="form-label">Email Verification *</label>
                <select name="email_verified" class="form-select" required>
                    <option value="0" selected>Unverified</option>
                    <option value="1">Verified</option>
                </select>
            </div>

            <!-- Tombol -->
            <div class="d-flex justify-content-end modal-footer">
                <a href="<?= base_url('admin/pengguna') ?>" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>