<?= $this->extend('guru/template/template') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <h4 class="fw-bold mb-4">Manajemen DUDI</h4>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <small>Total DUDI</small>
                    <h3><?= $totalDudi ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <small>Total Siswa Magang</small>
                    <h3><?= $totalMagang ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <small>Rata-rata Siswa</small>
                    <h3><?= $totalMagang ?></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span class="fw-semibold">Daftar DUDI</span>
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
                        <th>Siswa Magang</th>
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
                                <span class="badge bg-primary">
                                    <?= $row['total_siswa_magang']; ?> siswa
                                </span>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>