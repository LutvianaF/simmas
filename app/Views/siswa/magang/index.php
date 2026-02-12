<?= $this->extend('siswa/template/template') ?>
<?= $this->section('content') ?>

<h2 class="mb-4  fw-bold">Status Magang Saya</h2>

<?php if (!$magang): ?>
    <div class="alert alert-warning">
        Anda belum memiliki data magang.
    </div>
<?php else: ?>

    <div class="card card-hero-dash">
        <div class="card-body p-4">

            <h5 class="fw-bold mb-4">
                <i class="bi bi-briefcase me-2 icon-purple"></i>
                Data Magang
            </h5>

            <!-- Data Siswa -->
            <div class="row gy-3">
                <div class="col-md-6">
                    <small class="text-muted d-block">Nama Siswa</small>
                    <div class="fw-medium"><?= esc($magang['nama']) ?></div>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block">NIS</small>
                    <div class="fw-medium"><?= esc($magang['nis']) ?></div>
                </div>

                <div class="col-md-6">
                    <small class="text-muted d-block">Kelas</small>
                    <div class="fw-medium"><?= esc($magang['kelas']) ?></div>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block">Jurusan</small>
                    <div class="fw-medium"><?= esc($magang['jurusan']) ?></div>
                </div>
            </div>

            <hr class="my-2">

            <!-- Data Perusahaan -->
            <div class="row gy-3">
                <div class="col-md-6">
                    <small class="text-muted d-block">Nama Perusahaan</small>
                    <div class="fw-medium"><?= esc($magang['nama_perusahaan']) ?></div>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block">Alamat Perusahaan</small>
                    <div class="fw-medium"><?= esc($magang['alamat']) ?></div>
                </div>
            </div>

            <hr class="my-2">

            <!-- Detail Magang -->
            <div class="row gy-3 align-items-center">
                <div class="col-md-6">
                    <small class="text-muted d-block">Periode Magang</small>
                    <div class="fw-medium">
                        <?= date('d M Y', strtotime($magang['tanggal_mulai'])) ?>
                        s.d
                        <?= date('d M Y', strtotime($magang['tanggal_selesai'])) ?>
                    </div>
                </div>

                <div class="col-md-3">
                    <small class="text-muted d-block">Status</small>
                    <span class="badge rounded-pill px-3 py-2
                    <?= $magang['status'] === 'aktif' ? 'bg-success-subtle text-success' : ($magang['status'] === 'selesai' ? 'bg-secondary-subtle text-secondary' :
                            'bg-warning-subtle text-warning') ?>">
                        <?= ucfirst($magang['status']) ?>
                    </span>
                </div>

                <div class="col-md-3">
                    <small class="text-muted d-block">Nilai Akhir</small>
                    <div class="fw-medium">
                        <?= $magang['nilai_akhir'] ?? '-' ?>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?php endif ?>

<?= $this->endSection() ?>