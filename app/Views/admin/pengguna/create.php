<?= $this->extend('admin/template/template') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h4 class="fw-bold mb-3">Tambah Pengguna</h4>

    <div class="card p-3 shadow-sm">
        <form action="<?= base_url('admin/pengguna/store') ?>" method="post">
            <div class="mb-2">
                <label class="form-label">Nama</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-2">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-2">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-control" required>
                    <option value="admin">Admin</option>
                    <option value="guru">Guru</option>
                    <option value="siswa">Siswa</option>
                </select>
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="<?= base_url('admin/pengguna') ?>"
                class="btn btn-secondary">
                Kembali
            </a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>