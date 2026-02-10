<?= $this->extend('siswa/template/template') ?>
<?= $this->section('content') ?>
<section id="dudi-siswa" class="container my-4">
    <h2 class="mb-4">Cari Tempat Magang</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($dudiList)): ?>
        <?php foreach ($dudiList as $dudi): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?= esc($dudi['nama_perusahaan']) ?></h5>
                    <p class="card-subtitle text-muted"><?= esc($dudi['bidang'] ?? 'Umum') ?></p>
                    <p class="mt-2">
                        <strong>Alamat:</strong> <?= esc($dudi['alamat']) ?> <br>
                        <strong>PIC:</strong> <?= esc($dudi['penanggung_jawab']) ?>
                    </p>
                    <p><strong>Kuota Magang:</strong> <?= esc($dudi['kuota_terisi'] ?? 0) ?>/<?= esc($dudi['kuota'] ?? 0) ?>
                        (<?= (isset($dudi['kuota']) && isset($dudi['kuota_terisi'])) ? esc($dudi['kuota'] - $dudi['kuota_terisi']) : 0 ?> slot tersisa)</p>

                    <div class="progress mb-3">
                        <?php
                        $percent = 0;
                        if (isset($dudi['kuota']) && isset($dudi['kuota_terisi']) && $dudi['kuota'] > 0) {
                            $percent = ($dudi['kuota_terisi'] / $dudi['kuota']) * 100;
                        }
                        ?>
                        <div class="progress-bar <?= in_array($dudi['id'], $daftarSiswa) ? 'bg-secondary' : 'bg-success' ?>"
                            style="width: <?= $percent ?>%;">
                            <?= $dudi['kuota_terisi'] ?? 0 ?>/<?= $dudi['kuota'] ?? 0 ?>
                        </div>
                    </div>

                    <p class="card-text">
                        <?= esc($dudi['deskripsi'] ?? '-') ?>
                    </p>

                    <button
                        class="btn btn-primary btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#modalDudi<?= $dudi['id'] ?>">
                        Detail
                    </button>
                    <?php if (in_array($dudi['id'], $daftarSiswa)): ?>
                        <a href="#" class="btn btn-secondary btn-sm disabled">Sudah Mendaftar</a>
                    <?php else: ?>
                        <a href="<?= base_url('/siswa/dudi/daftar/' . $dudi['id']) ?>" class="btn btn-success btn-sm">Daftar</a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="modal fade" id="modalDudi<?= $dudi['id'] ?>" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">

                        <!-- Header -->
                        <div class="modal-header">
                            <div>
                                <h5 class="modal-title mb-0">
                                    <?= esc($dudi['nama_perusahaan']) ?>
                                </h5>
                                <small class="text-muted">
                                    <?= esc($dudi['bidang'] ?? 'Umum') ?>
                                </small>
                            </div>

                            <?php if (in_array($dudi['id'], $daftarSiswa)): ?>
                                <span class="badge bg-warning text-dark">
                                    Menunggu Verifikasi
                                </span>
                            <?php endif; ?>

                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Body -->
                        <div class="modal-body">

                            <!-- Tentang Perusahaan -->
                            <h6>Tentang Perusahaan</h6>
                            <p class="text-muted">
                                <?= esc($dudi['deskripsi'] ?? 'Belum ada deskripsi perusahaan.') ?>
                            </p>

                            <hr>

                            <!-- Informasi Kontak -->
                            <h6>Informasi Kontak</h6>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <strong>Alamat</strong><br>
                                    <?= esc($dudi['alamat']) ?>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <strong>Penanggung Jawab</strong><br>
                                    <?= esc($dudi['penanggung_jawab']) ?>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <strong>Telepon</strong><br>
                                    <?= esc($dudi['telepon']) ?>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <strong>Email</strong><br>
                                    <?= esc($dudi['email']) ?>
                                </div>
                            </div>

                            <hr>

                            <!-- Informasi Magang -->
                            <h6>Informasi Magang</h6>
                            <ul class="list-unstyled">
                                <li><strong>Bidang:</strong> <?= esc($dudi['bidang'] ?? '-') ?></li>
                                <li><strong>Kuota:</strong>
                                    <?= esc($dudi['kuota_terisi'] ?? 0) ?>/<?= esc($dudi['kuota'] ?? 0) ?>
                                </li>
                                <li><strong>Slot Tersisa:</strong>
                                    <?= (isset($dudi['kuota'], $dudi['kuota_terisi']))
                                        ? esc($dudi['kuota'] - $dudi['kuota_terisi'])
                                        : 0 ?>
                                </li>
                            </ul>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                Tutup
                            </button>

                            <?php if (!in_array($dudi['id'], $daftarSiswa)): ?>
                                <a href="<?= base_url('siswa/dudi/daftar/' . $dudi['id']) ?>"
                                    class="btn btn-primary">
                                    Daftar Magang
                                </a>
                            <?php else: ?>
                                <button class="btn btn-secondary" disabled>
                                    Sudah Mendaftar
                                </button>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-muted">Belum ada DUDI tersedia.</p>
    <?php endif; ?>

    <div class="text-muted mt-3">
        Menampilkan <?= count($dudiList) ?> perusahaan
    </div>
</section>

<?= $this->endSection() ?>