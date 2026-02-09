<?= $this->extend('admin/template/template') ?>
<?= $this->section('content') ?>
<div class="container mt-4">
    <h4 class="fw-bold mb-3">Manajemen Pengguna</h4>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif ?>

    <div class="card p-3 shadow-sm">
        <div class="d-flex justify-content-between mb-3">
            <span class="fw-semibold">Daftar Pengguna</span>
            <a href="<?= base_url('admin/pengguna/create') ?>"
                class="btn btn-primary">
                + Tambah Pengguna
            </a>
        </div>

        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Terdaftar</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                    <?php $role = $u['role'] ?? 'siswa'; ?>
                    <tr>
                        <td><?= esc($u['name']) ?></td>
                        <td><?= esc($u['email']) ?></td>
                        <td>
                            <span class="badge badge-<?= $role ?>">
                                <?= ucfirst($role) ?>
                            </span>
                        </td>
                        <td>
                            <?= $u['created_at']
                                ? date('d M Y', strtotime($u['created_at']))
                                : '-' ?>
                        </td>
                        <td>
                            <a href="<?= base_url('admin/pengguna/edit/' . $u['id']) ?>"
                                class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <a href="<?= base_url('admin/pengguna/delete/' . $u['id']) ?>"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Hapus pengguna ini?')">
                                Hapus
                            </a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div><?= $this->endSection() ?>