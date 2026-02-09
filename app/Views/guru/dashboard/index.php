<?= $this->extend('guru/template/template') ?>
<?= $this->section('content') ?>

<div class="mb-4">
    <h4 class="fw-bold mb-0">Dashboard</h4>
    <small class="text-muted">Selamat datang di sistem pelaporan magang</small>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-stat p-3">
            <small class="text-muted">Total Siswa</small>
            <h3 class="fw-bold value"><?= $totalSiswa ?></h3>
            <small>Seluruh siswa terdaftar</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat p-3">
            <small class="text-muted">DUDI Partner</small>
            <h3 class="fw-bold value"><?= $totalDudi ?></h3>
            <small>Perusahaan mitra</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat p-3">
            <small class="text-muted">Siswa Magang</small>
            <h3 class="fw-bold value"><?= $totalMagang ?></h3>
            <small>Sedang aktif magang</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat p-3">
            <small class="text-muted">Logbook Hari Ini</small>
            <h3 class="fw-bold value"><?= $totalLogbook ?></h3>
            <small>Laporan masuk</small>
        </div>
    </div>
</div>

<div class="row g-4">

    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header fw-bold">🎓 Magang Terbaru</div>
            <div class="card-body">

                <?php foreach ($magangTerbaru as $m): ?>
                    <div class="d-flex align-items-center justify-content-between border rounded p-3 mb-3">
                        <div>
                            <h6 class="mb-1"><?= $m['nama_siswa']; ?></h6>
                            <small class="text-muted"><?= $m['nama_perusahaan']; ?></small><br>
                            <small class="text-muted">
                                <?= date('d/m/Y', strtotime($m['tanggal_mulai'])); ?> -
                                <?= date('d/m/Y', strtotime($m['tanggal_selesai'])); ?>
                            </small>
                        </div>
                        <span class="badge bg-success text-capitalize">
                            <?= $m['status']; ?>
                        </span>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm">
            <div class="card-header fw-bold">🏢 DUDI Aktif</div>
            <div class="card-body">

                <?php foreach ($dudiAktif as $d): ?>
                    <div class="mb-3">
                        <strong><?= $d['nama_perusahaan']; ?></strong>
                        <div class="text-muted small"><?= $d['alamat']; ?></div>
                        <div class="text-muted small"><?= $d['telepon']; ?></div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header fw-bold">📘 Logbook Terbaru</div>
            <div class="card-body">

                <?php foreach ($logbookTerbaru as $l): ?>
                    <div class="border rounded p-3 mb-3">
                        <div class="fw-semibold"><?= $l['kegiatan']; ?></div>
                        <small class="text-muted">
                            <?= date('d/m/Y', strtotime($l['tanggal'])); ?>
                        </small>

                        <div class="mt-2 text-warning small">
                            Kendala: <?= $l['kendala'] ?: 'Tidak ada'; ?>
                        </div>

                        <?php if ($l['status_verifikasi'] == 'disetujui'): ?>
                            <span class="badge bg-success mt-2">Disetujui</span>
                        <?php elseif ($l['status_verifikasi'] == 'pending'): ?>
                            <span class="badge bg-warning mt-2">Pending</span>
                        <?php else: ?>
                            <span class="badge bg-danger mt-2">Ditolak</span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>