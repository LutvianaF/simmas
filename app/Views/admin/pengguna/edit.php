<?= $this->extend('admin/template/template') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h4 class="fw-bold mb-3">Edit Pengguna</h4>

    <div class="card p-3 shadow-sm">
        <form action="<?= base_url('admin/pengguna/update/' . $user['id']) ?>" method="post">
            <div class="mb-2">
                <label class="form-label">Nama</label>
                <input type="text" name="name"
                    value="<?= esc($user['name']) ?>"
                    class="form-control" required>
            </div>

            <div class="mb-2">
                <label class="form-label">Email</label>
                <input type="email" name="email"
                    value="<?= esc($user['email']) ?>"
                    class="form-control" required>
            </div>

            <div class="mb-2">
                <label class="form-label">Password</label>
                <input type="password" name="password"
                    class="form-control"
                    placeholder="Kosongkan jika tidak diubah">
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-control" required>
                    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="guru" <?= $user['role'] == 'guru' ? 'selected' : '' ?>>Guru</option>
                    <option value="siswa" <?= $user['role'] == 'siswa' ? 'selected' : '' ?>>Siswa</option>
                </select>
            </div>

            <button class="btn btn-primary">Simpan Perubahan</button>
            <a href="<?= base_url('admin/pengguna') ?>"
                class="btn btn-secondary">
                Kembali
            </a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>