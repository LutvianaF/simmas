<?= $this->extend('admin/template/template') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <h4 class="fw-bold mb-4">Manajemen DUDI</h4>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <small>Total DUDI</small>
                    <h3><?= $totalDudi ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <small>DUDI Aktif</small>
                    <h3><?= $aktif ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <small>DUDI Tidak Aktif</small>
                    <h3><?= $nonaktif ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <small>Total Siswa Magang</small>
                    <h3><?= $totalMagang ?></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span class="fw-semibold">Daftar DUDI</span>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambah">
                + Tambah DUDI
            </button>
        </div>
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="bi bi-lock input-icon"></i>
                <input type="search" name="" id="" placeholder="Cari perusahaan, alamat, penanggung jawab...">
            </div>
            <div>
                <span>Tampilkan:</span>
                <input type="text">
            </div>
        </div>

        <div class="card-body table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Perusahaan</th>
                        <th>Kontak</th>
                        <th>Penanggung Jawab</th>
                        <th>Status</th>
                        <th>Siswa Magang</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dudi as $row): ?>
                        <tr>
                            <td>
                                <strong><?= $row['nama_perusahaan'] ?></strong><br>
                                <small class="text-muted"><?= $row['alamat'] ?></small>
                            </td>
                            <td>
                                <?= $row['email'] ?><br>
                                <small><?= $row['telepon'] ?></small>
                            </td>
                            <td><?= $row['penanggung_jawab'] ?></td>
                            <td>
                                <span class="badge <?= $row['status'] == 'Aktif' ? 'bg-success' : 'bg-danger' ?>">
                                    <?= $row['status'] ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-primary">
                                    <?= $row['total_siswa_magang']; ?> siswa
                                </span>
                            </td>
                            <td>
                                <a href="#" class="text-warning" data-bs-toggle="modal"
                                    data-bs-target="#edit<?= $row['id'] ?>">✏️</a>
                                <a href="<?= base_url('admin/dudi/delete/' . $row['id']) ?>"
                                    onclick="return confirm('Hapus data?')"
                                    class="text-danger ms-2">🗑️</a>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="edit<?= $row['id'] ?>">
                            <div class="modal-dialog">
                                <form method="post" action="<?= base_url('admin/dudi/update/' . $row['id']) ?>" class="modal-content">
                                    <div class="modal-header">
                                        <h5>Edit DUDI</h5>
                                    </div>
                                    <div class="modal-body">
                                        <input name="nama" class="form-control mb-2" value="<?= $row['nama_perusahaan'] ?>">
                                        <input name="email" class="form-control mb-2" value="<?= $row['email'] ?>">
                                        <input name="telepon" class="form-control mb-2" value="<?= $row['telepon'] ?>">
                                        <input name="penanggung_jawab" class="form-control mb-2" value="<?= $row['penanggung_jawab'] ?>">
                                        <select name="status" class="form-select">
                                            <option <?= $row['status'] == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                                            <option <?= $row['status'] == 'Tidak Aktif' ? 'selected' : '' ?>>Tidak Aktif</option>
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="tambah">
    <div class="modal-dialog">
        <form method="post" action="<?= base_url('admin/dudi/store') ?>" class="modal-content">
            <div class="modal-header">
                <h5>Tambah DUDI</h5>
            </div>
            <div class="modal-body">
                <input name="nama" class="form-control mb-2" placeholder="Nama Perusahaan">
                <input name="email" class="form-control mb-2" placeholder="Email">
                <input name="telepon" class="form-control mb-2" placeholder="Telepon">
                <input name="penanggung_jawab" class="form-control mb-2" placeholder="Penanggung Jawab">
                <textarea name="alamat" class="form-control mb-2" placeholder="Alamat"></textarea>
                <select name="status" class="form-select">
                    <option>Aktif</option>
                    <option>Tidak Aktif</option>
                </select>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>