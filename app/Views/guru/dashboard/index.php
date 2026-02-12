<?= $this->extend('guru/template/template') ?>
<?= $this->section('content') ?>

<div class="mb-4">
    <h4 class="fw-bold mb-0">Dashboard</h4>
    <small class="text-muted">Selamat datang di sistem pelaporan magang</small>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-stats p-3">
            <div class="d-flex align-items-center justify-content-between mb-3 card-dash">
                <small class="text-muted">Total Siswa</small>
                <i class="bi bi-people"></i>
            </div>
            <h3 class="fw-bold value"><?= $totalSiswa ?></h3>
            <small>Seluruh siswa terdaftar</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat p-3">
            <div class="d-flex align-items-center justify-content-between mb-3 card-dash">
                <small class="text-muted">DUDI Partner</small>
                <i class="bi bi-buildings"></i>
            </div>
            <h3 class="fw-bold value"><?= $totalDudi ?></h3>
            <small>Perusahaan mitra</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat p-3">
            <div class="d-flex align-items-center justify-content-between mb-3 card-dash">
                <small class="text-muted">Siswa Magang</small>
                <i class="bi bi-mortarboard"></i>
            </div>
            <h3 class="fw-bold value"><?= $totalMagang ?></h3>
            <small>Sedang aktif magang</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-stat p-3">
            <div class="d-flex align-items-center justify-content-between mb-3 card-dash">
                <small class="text-muted">Logbook Hari Ini</small>
                <i class="bi bi-book"></i>
            </div>
            <h3 class="fw-bold value"><?= $totalLogbook ?></h3>
            <small>Laporan masuk</small>
        </div>
    </div>
</div>

<div class="row g-4">

    <div class="col-lg-8">
        <div class="card card-hero-dash">
            <div class="card-header fw-bold"><i class="bi bi-mortarboard icon-purple"></i> Magang Terbaru</div>
            <div class="card-body">

                <?php foreach ($magangTerbaru as $m): ?>
                    <div class="d-flex justify-content-between border rounded p-3 mb-3 card-body-dash">
                        <div class="me-3 icon-dash">
                            <i class="bi bi-mortarboard"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1 fw-bold"><?= $m['nama_siswa']; ?></h6>
                            <small class="text-muted d-block"><?= $m['nama_perusahaan']; ?></small>
                            <small class="text-muted">
                                <i class="bi bi-calendar2"></i> <?= date('d/m/Y', strtotime($m['tanggal_mulai'])); ?> -
                                <?= date('d/m/Y', strtotime($m['tanggal_selesai'])); ?>
                            </small>
                        </div>
                        <div>
                            <span class="badge badge-status <?= $statusClass[$m['status']] ?? 'badge-pending'; ?> text-capitalize px-3 py-2">
                                <?= $m['status']; ?>
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card card-hero-dash">
            <div class="card-header fw-bold"><i class="bi bi-buildings text-danger"></i> DUDI Aktif</div>
            <div class="card-body">

                <?php foreach ($dudiAktif as $d): ?>
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <strong><?= esc($d['nama_perusahaan']); ?></strong>

                            <div class="text-muted small">
                                <i class="bi bi-geo-alt me-2"></i>
                                <?= esc($d['alamat']); ?>
                            </div>

                            <div class="text-muted small">
                                <i class="bi bi-telephone me-2"></i>
                                <?= esc($d['telepon']); ?>
                            </div>
                        </div>

                        <span class="badge badge-primary">
                            <?= isset($d['total_siswa_aktif']) ? $d['total_siswa_aktif'] : 0 ?> siswa
                        </span>
                    </div>

                <?php endforeach; ?>

            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card card-hero-dash">
            <div class="card-header fw-bold"><i class="bi bi-book text-success"></i> Logbook Terbaru</div>
            <div class="card-body">

                <?php foreach ($logbookTerbaru as $l): ?>
                    <div class="card-body-dash d-flex justify-content-between border rounded p-3 mb-3">
                        <div class="icon-dash-success me-3">
                            <i class="bi bi-book "></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-semibold"><?= $l['kegiatan']; ?></div>
                            <small class="text-muted">
                                <i class="bi bi-calendar2"></i> <?= date('d/m/Y', strtotime($l['tanggal'])); ?>
                            </small>
                            <div class="small text-danger">
                                <i>Kendala: <?= $l['kendala'] ?: 'Tidak ada kendala berarti'; ?></i>
                            </div>
                        </div>
                        <div class="">
                            <?php if ($l['status_verifikasi'] == 'disetujui'): ?>
                                <span class="badge badge-disetujui">Disetujui</span>
                            <?php elseif ($l['status_verifikasi'] == 'pending'): ?>
                                <span class="badge badge-pending">Pending</span>
                            <?php else: ?>
                                <span class="badge badge-ditolak">Ditolak</span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>