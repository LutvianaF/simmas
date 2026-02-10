<?= $this->extend('siswa/template/template') ?>
<?= $this->section('content') ?>

<h4 class="mb-4">Status Magang Saya</h4>

<?php if (!$magang): ?>
    <div class="alert alert-warning">
        Anda belum memiliki data magang.
    </div>
<?php else: ?>

    <div class="card">
        <div class="card-body">

            <h6 class="mb-3 text-primary">Data Magang</h6>

            <div class="row mb-2">
                <div class="col-md-6">
                    <small class="text-muted">Nama Siswa</small>
                    <div><?= esc($magang['nama']) ?></div>
                </div>
                <div class="col-md-6">
                    <small class="text-muted">NIS</small>
                    <div><?= esc($magang['nis']) ?></div>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-6">
                    <small class="text-muted">Kelas</small>
                    <div><?= esc($magang['kelas']) ?></div>
                </div>
                <div class="col-md-6">
                    <small class="text-muted">Jurusan</small>
                    <div><?= esc($magang['jurusan']) ?></div>
                </div>
            </div>

            <hr>

            <div class="row mb-2">
                <div class="col-md-6">
                    <small class="text-muted">Nama Perusahaan</small>
                    <div><?= esc($magang['nama_perusahaan']) ?></div>
                </div>
                <div class="col-md-6">
                    <small class="text-muted">Alamat Perusahaan</small>
                    <div><?= esc($magang['alamat']) ?></div>
                </div>
            </div>

            <hr>

            <div class="row mb-2">
                <div class="col-md-6">
                    <small class="text-muted">Periode Magang</small>
                    <div>
                        <?= date('d M Y', strtotime($magang['tanggal_mulai'])) ?>
                        s.d
                        <?= date('d M Y', strtotime($magang['tanggal_selesai'])) ?>
                    </div>
                </div>
                <div class="col-md-3">
                    <small class="text-muted">Status</small><br>
                    <span class="badge 
                    <?= $magang['status'] === 'aktif' ? 'bg-success' : ($magang['status'] === 'selesai' ? 'bg-secondary' : 'bg-warning') ?>">
                        <?= ucfirst($magang['status']) ?>
                    </span>
                </div>
                <div class="col-md-3">
                    <small class="text-muted">Nilai Akhir</small>
                    <div><?= $magang['nilai_akhir'] ?? '-' ?></div>
                </div>
            </div>

        </div>
    </div>

<?php endif ?>

<?= $this->endSection() ?>