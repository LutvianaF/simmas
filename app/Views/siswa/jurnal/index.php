<?= $this->extend('siswa/template/template') ?>
<?= $this->section('content') ?>

<h4 class="mb-4">Jurnal Harian Magang</h4>

<?php if (($statistik['total'] ?? 0) == 0): ?>
    <div class="alert alert-warning d-flex justify-content-between align-items-center">
        <div>
            <strong>Jangan Lupa Jurnal Hari Ini!</strong><br>
            Anda belum membuat jurnal hari ini.
        </div>
        <a href="<?= base_url('siswa/jurnal/create') ?>" class="btn btn-warning btn-sm">
            Buat Sekarang
        </a>
    </div>
<?php endif ?>

<!-- STATISTIK -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h5><?= $statistik['total'] ?? 0 ?></h5>
                <small>Total Jurnal</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h5><?= $statistik['disetujui'] ?? 0 ?></h5>
                <small>Disetujui</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h5><?= $statistik['pending'] ?? 0 ?></h5>
                <small>Menunggu</small>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h5><?= $statistik['ditolak'] ?? 0 ?></h5>
                <small>Ditolak</small>
            </div>
        </div>
    </div>
</div>

<!-- TABEL -->
<div class="card">
    <div class="card-header">
        Riwayat Jurnal
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Kegiatan & Kendala</th>
                    <th>Status</th>
                    <th>Feedback Guru</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($logbook)): ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            Belum ada jurnal
                        </td>
                    </tr>
                <?php endif ?>

                <?php foreach ($logbook as $row): ?>
                    <tr>
                        <td>
                            <?= $row['tanggal']
                                ? date('d M Y', strtotime($row['tanggal']))
                                : '-' ?>
                        </td>
                        <td>
                            <strong>Kegiatan:</strong><br>
                            <?= esc($row['kegiatan']) ?><br>
                            <?php if ($row['kendala']): ?>
                                <strong>Kendala:</strong> <?= esc($row['kendala']) ?>
                            <?php endif ?>
                        </td>
                        <td>
                            <?php if ($row['status_verifikasi'] == 'disetujui'): ?>
                                <span class="badge bg-success">Disetujui</span>
                            <?php elseif ($row['status_verifikasi'] == 'ditolak'): ?>
                                <span class="badge bg-danger">Ditolak</span>
                            <?php else: ?>
                                <span class="badge bg-warning">Menunggu</span>
                            <?php endif ?>
                        </td>
                        <td>
                            <?= $row['catatan_guru'] ?? '<em>Belum ada feedback</em>' ?>
                        </td>
                        <td>
                            <a href="#" class="btn btn-sm btn-outline-primary">Detail</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>